<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receptionist extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Receptionist_model');
        $this->load->model('Doctor_model');
        $this->load->helper('url');
        if (!isset($_SESSION['IDENTITY_WHO_LOGINS']) && !isset($_SESSION['LOGGED_IN']) && !isset($_SESSION['ID'])) {
            $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
            redirect('index.php/home/login', 'refresh');
        }
        else if($_SESSION['IDENTITY_WHO_LOGINS']!="receptionist")
        {
            $this->session->set_flashdata('failure','Access Denied ! Please Log In First!');
            redirect('index.php/home/login', 'refresh');
        }
	}
    public function dashboard()
    {  
        $this->load->view('Backend/Receptionist/dashboard');
    } 
    public function appointment_list()
    {   
        $appointments = $this->Admin_model->get_approved_appointments();
        $this->load->view('Backend/Receptionist/Appointment/Appointment_list', compact('appointments')); 
        // $this->load->view('Backend/Receptionist/Appointment/appointment_list');
    }  
    public function addappointment()
    {
        $doctors = $this->Admin_model->get_doctors();
        $patients = $this->Admin_model->get_patients();
        $record = (object)[
            'time' => '',
            'date' => '',
            'doctor_id' => '',
            'patient_id' => '',
        ];
        $this->load->view('Backend/Receptionist/forms/addappointment', compact('doctors', 'patients', 'record'));
    }
    public function manage_appointment()
    {
        $this->form_validation->set_rules('time', 'Appointment time', 'trim|required');
        $this->form_validation->set_rules('date', 'Appointment date', 'trim|required');
        $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|required');
        $this->form_validation->set_rules('patient_id', 'Patient', 'trim|required');
        if ($this->form_validation->run()) {
            $data = $_POST;
            $data['is_requested'] = 1;
            $this->db->insert('appointments', $data);
            $this->session->set_flashdata('success', 'Your Appointment has been Created');
            redirect('index.php/Receptionist/requested_appointment', 'refresh');
        } else
            $this->addappointment();
    }
    public function requested_appointment()
    {
        $appointments = $this->Admin_model->get_pending_appointments();
        $this->load->view('Backend/Receptionist/Appointment/requested_appointment', compact('appointments'));
    } 
    public function approveform()
    {    
        $this->load->view('Backend/Receptionist/forms/approveform');
    }
    /*public function patients()
    {    
        $this->load->view('Backend/Receptionist/patients');
    } 
    public function addpatient()
    {    
        $this->load->view('Backend/Receptionist/forms/addpatient');
    }*/  
    public function payroll()
    {    
        $this->load->view('Backend/Receptionist/payroll');
    }  
    public function profile()
    {    
        $data = $this->get_combined_data();
        $this->load->view('Backend/Receptionist/profile', compact('data'));
        // $this->load->view('Backend/Receptionist/profile');
    } 
    public function update_password()
    {
        $this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('conf_pass', 'Confirm Passsword', 'trim|required|matches[new_password]');

        if ($this->form_validation->run()) {
            $data = $this->Admin_model->get_row_by_id();
            $current_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_password'];
            $conf_pass = $_POST['conf_pass'];
            $chk = password_verify($current_pass, $this->Admin_model->get_row_by_id()->password);
            if ($chk) {
                $hash = password_hash($new_pass, PASSWORD_DEFAULT);
                $this->db->where('id', $_SESSION['ID'])->update('users', ['password' => $hash]);
                $this->db->where('id', $_SESSION['PROFILE_ID'])->update('receptionists', ['unhash_password' => $new_pass]);
                $session_data = array(
                    'ID',
                    'IDENTITY_WHO_LOGINS',
                    'LOGGED_IN',
                    'PROFILE_ID',
                );
                $this->session->unset_userdata($session_data);
                $this->session->set_flashdata('failure', 'Password Changed!');
                redirect('index.php/home/login', 'refresh');
            } else {
                $this->session->set_flashdata('pass_error', 'Please Enter Valid Password');
                redirect('index.php/receptionist/profile', 'refresh');
            }
        } else {
            $this->profile();
        }
    }
    public function get_combined_data()
    {
        $profile = $this->Admin_model->getreceptionistby_id($_SESSION['PROFILE_ID']);
        $login = $this->Admin_model->get_login_details($_SESSION['PROFILE_ID'], 'receptionist');
        $data = (object)array_merge((array)$profile, (array)$login);
        return $data;
    }
    public function update_profile()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|integer');
        if ($this->form_validation->run()) {

            $logo = $_FILES['icon']['name'];
            if ($logo == true) {
                $config['upload_path'] = './assets/uploads/receptionists/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('icon')) {
                    $data = $this->upload->data();
                    unset($_POST['old_img']);
                    $_POST['icon'] = base_url('assets/uploads/receptionists/' . $data['raw_name'] . $data['file_ext']);
                } else {
                    $upload_errors = $this->upload->display_errors();
                    $this->session->set_flashdata('upload_error',$upload_errors);
                    redirect('index.php/Receptionist/profile','refresh');
                }
            } else {
                $_POST['icon'] = $this->input->post('old_img');
                unset($_POST['old_img']);
            }
            //update patient email
            $this->db->where(['type'=>'receptionist','profile_id'=>$_SESSION['PROFILE_ID']])->update('users',array('email'=>$_POST['email']));
            unset($_POST['email']);
            //update patient tb
            $this->db->where('id',$_SESSION['PROFILE_ID'])->update('receptionists',$_POST);
            $this->session->set_flashdata('success','Receptionist Updated');
            redirect('index.php/receptionist/profile','refresh');

        } else {
            $data = $this->get_combined_data();
            $this->load->view('Backend/Receptionist/profile', compact('data'));
        }
    }
    
    //_-----------------------------//
    public function patients()
    {
        $records = (object)$this->Admin_model->get_patients();
        $this->load->view('Backend/Receptionist/patients', compact('records'));
    }
    public function addpatient($flag = 'add', $id = 0)
    {
        if ($flag == 'add') {
            $record = (object)[
                'name' => '', 'email' => '', 'password' => '',
                'address' => '', 'phone' => '',
                'gender_id' => 0, 'blood_group_id' => 0,
                'icon' => '', 'birth_date' => '', 'age' => '',
            ];
            $this->load->view('Backend/Receptionist/forms/addpatient', compact('record'));
        } else {

            if ($record = $this->Admin_model->getpatientby_id($id)) {
                $record = (object)[
                    'name' => $record->name,
                    'email' => $this->Admin_model->get_login_details($id, 'patient')->email,
                    'password' => $record->unhash_password,
                    'address' => $record->address,
                    'phone' => $record->phone,
                    'icon' => $record->icon,
                    'age' => $record->age,
                    'birth_date' => $this->getdesireddateformat($record->birth_date),
                    'blood_group_id' => $record->blood_group,
                    'gender_id' => $record->gender,
                    'hidden_id' => $record->id,
                ];
                $this->load->view('Backend/Receptionist/forms/addpatient', compact('record'));
            }
        }
    }
    public function manage_patients()
    {
        if (isset($_POST['hidden_id'])) {
            $unique_chk_email = '';
            $unique_chk_phone = '';
        } else {
            $unique_chk_email = "|is_unique[users.email]";
            $unique_chk_phone = "|is_unique[patients.phone]";
        }
        $this->form_validation->set_rules('name', 'Patient Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Patient email', 'trim|required' . $unique_chk_email);

        $this->form_validation->set_rules('password', 'Patient password', 'trim|required');
        $this->form_validation->set_rules('address', 'Patient Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Patient Phone', 'trim|required|numeric' . $unique_chk_phone);

        $this->form_validation->set_rules('birth_date', 'Birth Date', 'trim|required');

        $this->form_validation->set_rules('age', 'Age', 'trim|required|numeric');

        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('blood_group', 'Blood Group', 'trim|required');

        $old_img_path = $this->input->post('old_img');
        $post = $this->input->post();
        $logo = $_FILES['icon']['name'];
        if ($logo != '') {
            $config['upload_path']          = './assets/uploads/patients/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('icon')) {
                $data = $this->upload->data();
                $post['icon'] = base_url('assets/uploads/patients/' . $data['raw_name'] . $data['file_ext']);
            } else {

                $upload_errors = $this->upload->display_errors();
                $this->load->view('Backend/Receptionist/forms/addpatient', compact('upload_errors'));
            }
        } else {
            if ($old_img_path != '') {
                $post['icon'] = $old_img_path;
            } else {
                $post['icon'] = '';
            }
        }
        if (isset($_POST['hidden_id'])) {
            if ($this->form_validation->run()) {
                unset($post['old_img']);
                $post['birth_date']=$this->getdateformat($post['birth_date']);
                $res = $this->Admin_model->update_patient($post);
                if ($res) {
                    $this->session->set_flashdata('success', 'Patient Updated');
                } else {
                    $this->session->set_flashdata('success', 'Patient Not Updated');
                }
                redirect('index.php/receptionist/patients', 'refresh');
            } else {
                $hidden_id = $_POST['hidden_id'];
                $record = (object)[
                    'gender_id' => set_value('gender'),
                    'blood_group_id' => set_value('blood_group'),
                    'hidden_id' => $hidden_id,
                ];
                $_POST['old_img'] = $post['icon'];
                $this->load->view('Backend/Receptionist/forms/addpatient', compact('record'));
            }
        } else {
            if ($this->form_validation->run()) {
                unset($post['old_img']);
                $post['birth_date']=$this->getdateformat($post['birth_date']);
                $res = $this->Admin_model->add_patient($post);
                if ($res) {
                    $this->session->set_flashdata('success', 'Patient Added');
                } else {
                    $this->session->set_flashdata('success', 'Patient Not Added');
                }
                redirect('index.php/receptionist/patients', 'refresh');
            } else {
                $record = (object)[
                    'gender_id' => set_value('gender'),
                    'blood_group_id' => set_value('blood_group'),
                ];

                $_POST['old_img'] = $post['icon'];
                $this->load->view('Backend/Receptionist/forms/addpatient', compact('record'));
            }
        }
    }
    public function delete_patient($id = 0)
    {
        if ($this->Admin_model->delete_patient($id)) {
            $this->session->set_flashdata('success', 'Patient Deleted');
        } else {
            $this->session->set_flashdata('success', 'Patient Not Deleted');
        }
        redirect('index.php/receptionist/patients', 'refresh');
    }
    public function edit_patient($id = 0)
    {
        if ($record = $this->Admin_model->getpatientby_id($id)) {
            redirect('index.php/admin/addpatients/update/' . $record->id);
        } else {
            $this->session->set_flashdata('success', 'Patient Not Exists');
        }
        redirect('index.php/admin/patients', 'refresh');
    }
    public function patient_profile()
    {
        $pid = $_GET['pid'];
        $patient = (array)$this->Admin_model->getpatientby_id($pid);
        $patient['email'] = $this->db->get_where('users', array('profile_id' => $pid, 'type' => 'patient'))->row()->email;
        $this->load->view('Backend/Receptionist/patient_profile', compact('patient'));
    }

    public function getdateformat($date)
    {
        $timestamp = strtotime($date);
        $formattedDate = date('d/m/Y', $timestamp);
        return $formattedDate;
    }
    public function getdesireddateformat($date)
	{
		$date = str_replace('/', '-', $date);
		return date('m/d/Y', strtotime($date));
	}

    // pateint crud operations
}
?>
