<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nurse extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
        $this->load->helper('url');
        $this->load->model('Admin_model');
        $this->load->model('Lab_model');
        $this->load->model('Admin_model', 'admin');
        if (!isset($_SESSION['IDENTITY_WHO_LOGINS']) && !isset($_SESSION['LOGGED_IN']) && !isset($_SESSION['ID'])) {
            $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
            redirect('index.php/home/login', 'refresh');
        }
        else if ($_SESSION['IDENTITY_WHO_LOGINS'] != "nurse") {
          $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
          redirect('index.php/home/login', 'refresh');
     }
	}
    //Dashboard
    public function dashboard()
    {  
        $data=(object)[
			'patients'=>$this->Admin_model->countpatients(),
			'assigned_patients'=>$this->Admin_model->countassignedpatients(),
			'doctors'=>$this->Admin_model->countdoctors(),
			'nurses'=>$this->Admin_model->countnurses()
	   ];
		$this->load->view('Backend/Nurse/dashboard' ,compact('data'));  
        // $this->load->view('Backend/Nurse/dashboard');
    } 
    //patient
    // public function patient()
    // {    
    //     $this->load->view('Backend/Nurse/patient');
    // } 
    // public function addpatient()
    // {    
    //     $this->load->view('Backend/Nurse/forms/addpatient');
    // } 
    // pateint crud operations
    public function allpatients()
    {
        $records = (object)$this->Admin_model->get_patients();
        $this->load->view('Backend/Nurse/patient', compact('records'));
    }
    // pateint crud operations
    // Manage Bed
    public function managebed()
    {    
        $this->load->view('Backend/Nurse/bedroom/managebed');
    } 
    public function editbed()
    {    
        $this->load->view('Backend/Nurse/forms/editbed');
    } 
    public function addbed()
    {    
        $this->load->view('Backend/Nurse/forms/addbed');
    }
    // Bed Allotment
//     public function bedallotment()
//     {    
//         $this->load->view('Backend/Nurse/bedroom/bedallotment');
//     }
    public function bedallotment()
    {
        $records = (object)$this->Admin_model->get_bedallotments();
        $this->load->view('Backend/Nurse/bedroom/bedallotment', compact('records'));
    } 
    public function editbedallotment()
    {    
        $this->load->view('Backend/Nurse/forms/editbedallotment');
    } 
//     public function addbedallotment()
//     {    
//         $this->load->view('Backend/Nurse/forms/addbedallotment');
//     }
    public function addbedallotment($flag = 'add', $id = 0)
    {

        if ($flag == 'add') {
            $records = (object)[
                'beds' => $this->Admin_model->get_beds(), 'patients' => $this->Admin_model->get_patients(), 'discharge_time' => '', 'allotment_time' => '',
                'patient_id' => 0, 'bed_id' => '0'
            ];
            $this->load->view('Backend/Nurse/forms/addbedallotment', compact('records'));
        } else {
            $row = $this->Admin_model->getbedallotmentby_id($id);
            if ($row) {
                $records = (object)[
                    'beds' => $this->Admin_model->get_beds(),
                    'patients' => $this->Admin_model->get_patients(),
                    'bed_id' => $row->bed_id,
                    'patient_id' => $row->patient_id,
                    'hidden_id' => $row->id,
                    'allotment_time' => $this->getdesireddateformat($row->allotment_time),
                    'discharge_time' => $this->getdesireddateformat($row->discharge_time),
                ];
                $this->load->view('Backend/Nurse/forms/addbedallotment', compact('records'));
            }
        }
    }
    public function manage_bedallotments()
    {
        $post = $this->input->post();
        if (isset($_POST['hidden_id'])) {
            $post['allotment_time']=$this->getdateformat($post['allotment_time']);
            $post['discharge_time']=$this->getdateformat($post['discharge_time']);
            $res = $this->Admin_model->update_bedallotment($post);
            if ($res) {
                $this->session->set_flashdata('success', 'Bed Allotment Updated');
            } else {
                $this->session->set_flashdata('success', 'Bed Allotment Not Updated');
            }
            redirect('index.php/nurse/bedallotment', 'refresh');
        } else {
            $post['allotment_time']=$this->getdateformat($post['allotment_time']);
            $post['discharge_time']=$this->getdateformat($post['discharge_time']);
            $res = $this->Admin_model->addbedallotmentbynurse($post);
            if ($res) {
                $this->session->set_flashdata('success', 'Bed Alloted');
            } else {
                $this->session->set_flashdata('success', 'Bed Not Alloted');
            }
            redirect('index.php/nurse/bedallotment', 'refresh');
        }
    }
    //Manage Blood Bank
    public function managebloodbank()
    {    
        $this->load->view('Backend/Nurse/bloodbank/managebloodbank');
    } 
    public function editbloodbank()
    {    
        $this->load->view('Backend/Nurse/forms/editbloodbank');
    } 
    //Donor
    public function blooddonor()
    { 
        $blood_donor = $this->Lab_model->get_blood_donor();
        $this->load->view("Backend/Nurse/bloodbank/blooddonor", compact('blood_donor'));  
        // $this->load->view('Backend/Nurse/bloodbank/blooddonor');
    } 
    // public function addblooddonor()
    // {    
    //     $this->load->view('Backend/Nurse/forms/addblooddonor');
    // }
    public function addblooddonor($flag = '', $id = 0)
	{
		if ($flag == '') {
			$record = (object)[
				 'donor_name' => '',
				 'donor_email' => '',
				 'donor_address' => '',
				 'donor_phone' => '',
				 'donor_age' => '',
				 'donor_gender' => '',
				 'donor_blood_group' => '',
				 'last_donation_date' => '',
			];
	   } else if ($flag == 'update') {
			$record = $this->admin->getdonorby_id($id);
	   }
	   $this->load->view('Backend/Nurse/forms/addblooddonor', compact('record'));
		// $this->load->view('Backend/Labortorist/forms/addblooddonor');
	}
    public function donors()
     {
          $this->load->library('form_validation');
          $this->form_validation->set_rules("donor_name", "Donor Name", 'required');
          $this->form_validation->set_rules("donor_email", "Donor Email", 'required');
          $this->form_validation->set_rules("donor_address", "Donor Address", 'required');
          $this->form_validation->set_rules("donor_phone", "Donor Phone", 'required');
          $this->form_validation->set_rules("donor_age", "Donor Age", 'required');
          $this->form_validation->set_rules("donor_gender", "Donor Gender", 'required');
          $this->form_validation->set_rules("donor_blood_group", "Donor Blood Group", 'required');
          $this->form_validation->set_rules("last_donation_date", "Last Donation date", 'required');
          if ($this->form_validation->run()) {
               if (isset($_POST['hidden_id'])) {
                    $this->update_blood_donor();
               } else {

                    $this->insert_blood_donor();
               }
          } else {
               $this->addblooddonor();
          }
     }
     public function insert_blood_donor()
     {
          $data = $this->input->post();
          if ($this->db->insert('lab_blood_donors', $data)) {
               $this->session->set_flashdata('success', $data['donor_name'] . ' Added to your System');
          } else {
               $this->session->set_flashdata('success', 'Blood Donor Not Added to your System');
          }
          redirect('index.php/nurse/blooddonor', 'refresh');
     }
	 public function delete_blood_donor($id)
     {
          if ($this->db->delete('lab_blood_donors', array('id' => $id))) {
               $this->session->set_flashdata('success', 'Donor Deleted in your System');
          } else {
               $this->session->set_flashdata('success', 'Donor Not Deleted in your System');
          }
          redirect('index.php/nurse/blooddonor', 'refresh');
     }
     public function update_blood_donor()
     {
          $data = $this->input->post();
          $id = $data['hidden_id'];
          unset($data['hidden_id']);
          if ($this->db->where('id', $id)->update('lab_blood_donors', $data)) {
               $this->session->set_flashdata('success', $data['donor_name'] . ' Updated in your System');
          } else {
               $this->session->set_flashdata('success', 'Donor Not Updated in your System');
          }
          redirect('index.php/nurse/blooddonor', 'refresh');
     }
     public function delete_bedallotment($id = 0)
    {
        if ($this->Admin_model->delete_bedallotment($id)) {
            $this->session->set_flashdata('success', 'Bed Allotment Deleted');
        } else {
            $this->session->set_flashdata('success', 'Bed Allotment Not Deleted');
        }
        redirect('index.php/nurse/bedallotment', 'refresh');
    }
    public function edit_bedallotment($id = 0)
    {
        if ($record = $this->Admin_model->getbedallotmentby_id($id)) {
            redirect('index.php/nurse/addbedallotment/update/' . $record->id);
        } else {
            $this->session->set_flashdata('success', 'Bed Not Alloted');
        }
        redirect('index.php/doctor/bed_allotment', 'refresh');
    }
    public function editblooddonor()
    {    
        $this->load->view('Backend/Nurse/forms/editblooddonor');
    } 
    //Report
    public function report()
    {
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $this->db->select("*")->from("reports")->where('patient_id', $pid);
            $reports = $this->db->get()->result();
            $this->db->select("*")->from("diagnosis_reports")->where('patient_id', $pid);
            $diagnosis = $this->db->get()->result();
        } else {
            $reports = (object)[
                'operation' => $this->Admin_model->get_reports('operation_report'),
                'birth' => $this->Admin_model->get_reports('birth_report'),
                'death' => $this->Admin_model->get_reports('death_report')
            ];
            $diagnosis = (object)[
                'diagnosis' => $this->Admin_model->get_diagnosis_reports('diagnosis'),
            ];
        }
        $this->load->view('Backend/Nurse/report', compact('reports', 'diagnosis'));

    }
    public function fetch_report()
    {
        $report_id = $_POST['id'];
        $row = $this->Admin_model->getreportby_id($report_id);
        $report = $this->Admin_model->getreport_file_by_id($report_id);
        if (!empty($report)) {
            echo '<tr><td><p style="text-align: center;">' . basename($report). '</p></td><td style="text-align: center;"><a href="' . base_url('index.php/nurse/download_report?file=' . $row->report_file_path) . '" class="btn btn-sm btn-success">Download</a></td></tr>';
        } else {
            echo "<tr><td colspan=2 class='text-danger'>No Reports Found!</td></tr>";
        }
    }
    public function download_report()
    {
        if (isset($_GET['file'])) {
            $filename = basename($_GET['file']);
            $filepath = $_GET['file'];
            $abspath = $_SERVER['DOCUMENT_ROOT'];
            $filepath = $abspath . '/Clinic-Automation-system/assets/uploads/reports/' . $filename;
            if (!empty($filename) && file_exists($filepath)) {

                header('Content-Description: File Transfer');
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename=' . $filename);
                header('Content_Transfer-Emcoding:binary');
                header('Cache-Control: public');
                readfile($filepath);
                exit;
            } else {
                $this->session->set_flashdata('success', 'Report Not Found to Download');
                redirect('index.php/nurse/report', 'refresh');
            }
        }
    }

    public function download_diagnosis_report() // download diagnosis report
    {
        if (isset($_GET['file'])) {
            $filename = basename($_GET['file']);
            $filepath = $_GET['file'];
            $abspath = $_SERVER['DOCUMENT_ROOT'];
            $filepath = $abspath . '/Clinic-Automation-system/assets/uploads/diagnosisreports/' . $filename;
            if (!empty($filename) && file_exists($filepath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename=' . $filename);
                header('Content_Transfer-Emcoding:binary');
                header('Cache-Control: public');
                readfile($filepath);
                exit;
            } else {
                $this->session->set_flashdata('success', 'Report Not Found to Download');
                redirect('index.php/nurse/report', 'refresh');
            }
        }
    }
    public function diagnosis_report()
    {
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $this->db->select("*")->from("diagnosis_reports")->where('patient_id', $pid);
            $diagnosis = $this->db->get()->result();
        } else {
            $diagnosis = (object)[
                'diagnosis' => $this->Admin_model->get_diagnosis_reports('diagnosis'),
            ];
        }
        $this->load->view('Backend/Nurse/report', compact('diagnosis'));

    }
    // public function finddiagnosis()
    // {
    //     $pid = $_POST['id'];
    //     $diagnosis = $this->Admin_model->get_diagnosis_reports($_SESSION['PROFILE_ID'], $pid);
    //     $count = count($diagnosis);
    //     if ($count > 0) {
    //         foreach ((object)$diagnosis as $diagnos) {
    //             echo '<table class="table table-bordered table-striped dataTable" id="table-2">
    //                                                     <thead>
    //                                                         <tr>
    //                                                             <th>Date</th>
    //                                                             <th>Report Type</th>
    //                                                             <th>Document Type</th>
    //                                                             <th>Description</th>
    //                                                             <th>Options</th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>
    //                                                         <tr>
    //                                                             <td>' . $diagnos->date . ' ' . $diagnos->time . '</td>
    //                                                             <td>' . $diagnos->report_type . '</td>
    //                                                             <td>' . $diagnos->report_file_type . '</td>
    //                                                             <td>' . $diagnos->description . '</td>
    //                                                             <td>
    //                                                                 <a href="' . base_url('index.php/doctor/download_report?file=' . $diagnos->report_file) . '" class="btn btn-info">
    //                                                                     <i class="fa fa-download"></i>
    //                                                                 </a>
    //                                                                 <a href="' . base_url('index.php/doctor/delete_diagnosis/' . $diagnos->id . '?file=' . $diagnos->report_file) . '" class="btn btn-danger btn-sm">
    //                                                                     <i class="fa fa-trash-o"></i>
    //                                                                 </a>
    //                                                             </td>
    //                                                         </tr>
    //                                                     </tbody>
    //                                                 </table>';
    //         }
    //     } else {
    //         echo '<div class="alert alert-warning">
    //                     <p class="text-danger">No Diagnosis Report Exits!</p>
    //             </div>';
    //     }
    // }
    //report fns

    //Payroll
    public function payroll()
    {    
        $this->load->view('Backend/Nurse/payroll');
    } 
    public function profile()
     {
          $record = (object)array_merge((array)$this->admin->getnurseby_id($_SESSION['PROFILE_ID']), (array)$this->admin->getuserby_id($_SESSION['ID']));
          $this->load->view('Backend/Nurse/profile', compact('record'));
     }

     public function edit_pass()
     {
          $this->form_validation->set_rules('old_pass','Old Password','trim|required');
          $this->form_validation->set_rules('new_pass','New Password','trim|required');
          $this->form_validation->set_rules('conf_pass','Confirm Password','trim|required|matches[new_pass]');
          if($this->form_validation->run()){

               $chk = password_verify($_POST['old_pass'], $this->admin->get_row_by_id()->password);
                    if ($chk)
                    {
                         $data = array(
                              'password' => password_hash($_POST['new_pass'],PASSWORD_DEFAULT),
                              'online_status'=>0,
                         );
                         $this->db->where('id', $_SESSION['ID'])->update('users', $data) && $this->db->where('id', $_SESSION['PROFILE_ID'])->update('nurses', ['unhash_password' => $_POST['new_pass']]);
                              $session_data = array(
                              'ID',
                              'IDENTITY_WHO_LOGINS',
                              'LOGGED_IN',
                              'PROFILE_ID'
                              );
                              $this->session->unset_userdata($session_data);
                              $this->session->set_flashdata('failure', 'Password Changed!');
                              redirect('index.php/home/login', 'refresh');             
                    }
                    else
                         {
                              $this->session->set_flashdata('form_err_msg','Old Password is Invalid');
                              redirect('index.php/nurse/profile','refresh');
                         }
           }
           else
           {
               // echo "Ok";
               // exit;
               $this->profile();
          }
     }
     public function manage_profile()
     {
          $old_img_path = $this->input->post('prev_img');
          $post = $this->input->post();
          $logo = $_FILES['file']['name'];
          if ($logo != '') {
               $config['upload_path']          = './assets/uploads/nurses/';
               $config['allowed_types']        = 'gif|jpg|png|jpeg';
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $post['icon'] = base_url('assets/uploads/nurses/' . $data['raw_name'] . $data['file_ext']);
               } else {
                    $upload_errors = $this->upload->display_errors();
                    return redirect('index.php/nurse/profile?upload_error=' . $upload_errors);
               }
          } else {
               if ($old_img_path != '') {
                    $post['icon'] = $old_img_path;
               } else {
                    $post['icon'] = '';
               }
          }
          $this->form_validation->set_rules("name", "Name", 'required|trim');
          $this->form_validation->set_rules("email", "Email", 'required|trim|valid_email');
          $this->form_validation->set_rules("address", "Address", 'required|trim');
          $this->form_validation->set_rules("phone", "Phone", 'required|trim|integer');
          if ($this->form_validation->run()) {
               if ($this->admin->update_nurse_profile($post)) {
                    $this->session->set_flashdata('success', 'Nurse Profile Updated');
               } else {
                    $this->session->set_flashdata('success', 'Nurse Profile Not Updated');
               }
               return redirect('index.php/nurse/profile');
          } else {
               $this->load->view('Backend/nurse/profile');
          }
     }
     public function assigned_patients()
    {
        $records = (object)$this->Admin_model->get_assigned_patients();
        $this->load->view('Backend/Nurse/assigned_patients', compact('records'));
    }
    public function patient_profile()
    {
        $pid = $_GET['pid'];
        $patient = (array)$this->Admin_model->getpatientby_id($pid);
        $patient['email'] = $this->db->get_where('users', array('profile_id' => $pid, 'type' => 'patient'))->row()->email;
        $patient['feedbacks'] = $this->Admin_model->get_feedbacks_by_patient($pid);
        $patient['otherfeeds'] = $this->Admin_model->get_other_feeds($_SESSION['PROFILE_ID'], $_GET['pid']);
        $patient['myfeeds'] = $this->Admin_model->get_myfeed_by_that_patient($pid, $_SESSION['PROFILE_ID']);
        $this->load->view('Backend/Nurse/patient_profile', compact('patient'));
    }
    public function prescription()
    {
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $this->db->select("*")->from("prescriptions")->where('patient_id', $pid);
            $prescriptions = $this->db->get()->result();
        } else {
            $prescriptions = (object)$this->Admin_model->get_prescriptions();
        }
        $this->load->view('Backend/Nurse/prescription', compact('prescriptions'));
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

    

    

    
}
?>
