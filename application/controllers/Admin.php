<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		$this->load->helper('url');
		$this->load->model('Admin_model');
        $this->load->model('Admin_model', 'admin');
		$this->load->model('Lab_model');
		$this->load->model('mail');
	}
	// public function generate_unique_id()
	// {
	// 	echo strtoupper(str_replace('.','',uniqid('',true)));
	// }
	public function validate()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]', array('min_length' => '{field} must be {param} characters in length'));

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Frontend/Login');
		} else {
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
			$this->login($email, $pass);
		}
	}
	public function login($email, $pass)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		if ($query->num_rows() > 0) {
			$chk = password_verify($pass, $query->row()->password);
			if ($chk) {
				$session_data = array(
					'ID' => $query->row()->id,
					'IDENTITY_WHO_LOGINS' => $query->row()->type,
					'PROFILE_ID' => $query->row()->profile_id,
					'LOGGED_IN' => true,
				);

				$this->session->set_userdata($session_data);
				$this->session->set_flashdata('success', $_SESSION['IDENTITY_WHO_LOGINS'] . ' Logged In Successfully!');
				$this->Admin_model->set_status_online();

				switch ($_SESSION['IDENTITY_WHO_LOGINS']) {

					case 'admin':
						return redirect('index.php/admin/dashboard');
						break;

					case 'doctor':
						return redirect('index.php/doctor/dashboard');
						break;

					case 'patient':
						return redirect('index.php/patient/dashboard');
						break;

					case 'nurse':
						return redirect('index.php/nurse/dashboard');
						break;

					case 'pharmacist':
						return redirect('index.php/pharmacist/dashboard');
						break;

					case 'laboratorist':
						return redirect('index.php/lab/dashboard');
						break;

					case 'accountant':
						return redirect('index.php/accountant/dashboard');
						break;

					case 'receptionist':
						return redirect('index.php/receptionist/dashboard');
						break;
				}
			} else {
				$this->session->set_flashdata('failure', 'Your Password is Incorrect!');
				$email = $this->Admin_model->encryption($_POST['email']);
				redirect('index.php/home/login?email=' . $email, 'refresh');
			}
		} else {
			$this->session->set_flashdata('failure', 'Please Check Your Email!');
			$email = $this->Admin_model->encryption($_POST['email']);
			redirect('index.php/home/login?email=' . $email, 'refresh');
		}
	}
	public function hash()
	{
		$data0 = ['name' => 'admin'];
		$this->db->insert('admins', $data0); //adding admin profile details
		$profile_id = $this->db->insert_id();
		$data1 = ['email' => 'admin@gmail.com', 'password' => password_hash('admin', PASSWORD_DEFAULT), 'type' => 'admin', 'profile_id' => $profile_id];
		$this->db->insert('users', $data1); //adding admin login details
	}

	public function profile()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$this->load->view('Backend/Admin/profile');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function dashboard()
	{
		$this->check_session_exists();
		$data=(object)[
			'donors'=>$this->Admin_model->countdonors(),
			'diagnosis_reports'=>$this->Admin_model->countdiagnosisreports(),
			'patients'=>$this->Admin_model->countpatients(),
			'doctors'=>$this->Admin_model->countdoctors(),
			'nurses'=>$this->Admin_model->countnurses(),
			'pharmacists'=>$this->Admin_model->countpharmacists(),
			'receptionists'=>$this->Admin_model->countreceptionists(),
			'medicines'=>$this->Admin_model->countmedicines(),
			'operationreports'=>$this->Admin_model->countoperationreports(),
			'birthreports'=>$this->Admin_model->countbirthreports(),
			'deathreports'=>$this->Admin_model->countdeathreports(),
			'lab_workers'=>$this->Admin_model->countlabworkers(),
			'chats'=>$this->Admin_model->countchats(),
			'stars'=>$this->Admin_model->countstars(),
			'users'=>$this->Admin_model->countusers(),
			'departments'=>$this->Admin_model->countdepartments(),
			'events'=>$this->Admin_model->countevents(),
			'mydoctors'=>$this->Admin_model->get_doctors(),
			'mypatients'=>$this->Admin_model->get_patients()
	   ];
		$this->load->view('Backend/Admin/dashboard' ,compact('data'));
	}

	public function paymenthistory()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$this->load->view('Backend/Admin/MonitorHospital/paymenthistory');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function bedallotment()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = (object)$this->Admin_model->get_bedallotments();
        $this->load->view('Backend/Admin/MonitorHospital/bedallotment', compact('records'));
			
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function bloodbank()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$this->load->view('Backend/Admin/MonitorHospital/bloodbank');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function blooddonor()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			// $this->load->view('Backend/Admin/MonitorHospital/blooddonor');
			$blood_donor = $this->Lab_model->get_blood_donor();
        	$this->load->view("Backend/Admin/MonitorHospital/blooddonor", compact('blood_donor'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
		
	}
	public function medicines()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$medicines = $this->Admin_model->get_medicines();
          $this->load->view("Backend/Admin/MonitorHospital/medicines", compact('medicines'));
			// $this->load->view('Backend/Admin/MonitorHospital/medicines');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function operationreport()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$reports = (object)[
				'operation' => $this->Admin_model->get_reports('operation_report'),
				'birth' => $this->Admin_model->get_reports('birth_report'),
				'death' => $this->Admin_model->get_reports('death_report')
			];
			$this->load->view('Backend/Admin/MonitorHospital/operationreport', compact('reports'));
			// $this->load->view('Backend/Admin/MonitorHospital/operationreport');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function fetch_report()
    {
        $report_id = $_POST['id'];
        $row = $this->Admin_model->getreportby_id($report_id);
        $report = $this->Admin_model->getreport_file_by_id($report_id);
        if (!empty($report)) {
            echo '<tr><td><p style="text-align:center">' . str_replace('C:/xampp/htdocs/Clinic-Automation-System/assets/uploads/reports/', '', $row->report_file_path) . '</p></td><td style="text-align:center"><a href="' . base_url('index.php/admin/download_report?file=' . $row->report_file_path) . '" class="btn btn-sm btn-success">Download</a></td></tr>';
        } else {
            echo "<tr><td colspan=2 class='text-danger'>No Reports Found!</td></tr>";
        }
    }
    public function download_report()
    {
        if (isset($_GET['file'])) {
            $filename = basename($_GET['file']);
            $filepath = $_GET['file'];
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
                redirect('index.php/admin/operationreport', 'refresh');
            }
        }
    }
	public function birthreport()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$reports = (object)[
				'operation' => $this->Admin_model->get_reports('operation_report'),
				'birth' => $this->Admin_model->get_reports('birth_report'),
				'death' => $this->Admin_model->get_reports('death_report')
			];
			$this->load->view('Backend/Admin/MonitorHospital/birthreport', compact('reports'));
			// $this->load->view('Backend/Admin/MonitorHospital/operationreport');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function deathreport()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$reports = (object)[
				'operation' => $this->Admin_model->get_reports('operation_report'),
				'birth' => $this->Admin_model->get_reports('birth_report'),
				'death' => $this->Admin_model->get_reports('death_report')
			];
			$this->load->view('Backend/Admin/MonitorHospital/deathreport', compact('reports'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function report()
    {
        $reports = (object)[
            'operation' => $this->Admin_model->get_reports('operation_report'),
            'birth' => $this->Admin_model->get_reports('birth_report'),
            'death' => $this->Admin_model->get_reports('death_report')
        ];
        $this->load->view('Backend/Doctor/report', compact('reports'));
    }
	public function createpayroll()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$this->load->view('Backend/Admin/payroll/createpayroll');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function payrolllist()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$this->load->view('Backend/Admin/payroll/payrolllist');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function noticeboard()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$this->load->view('Backend/Admin/noticeboard');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function account()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$data = (array)$this->Admin_model->get_row_by_id();
			$name = $this->Admin_model->get_admin_profile()->name;
			$data['name'] = $name;
			$this->load->view('Backend/Admin/account', ['record' => (object)$data]);
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function logout()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$session_data = array(
				'ID',
				'IDENTITY_WHO_LOGINS',
				'LOGGED_IN',
				'PROFILE_ID'
			);
			$this->session->unset_userdata($session_data);
			// session_destroy();
			$this->session->set_flashdata('failure', 'Logged Out Successfully!');
			redirect('index.php/home/login', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Already Logged Out!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function check_session_exists()
	{
		if ($this->session->has_userdata('IDENTITY_WHO_LOGINS') && $_SESSION['LOGGED_IN'] == true && $_SESSION['IDENTITY_WHO_LOGINS'] == 'admin') {
			return true;
		} else {
			$this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_account_details()
	{
		$this->form_validation->set_rules('username', 'UserName', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Backend/Admin/account');
		} else {
			$name = $_POST['username'];
			$email = $_POST['email'];
			$this->Admin_model->edit_account_details($name, $email);
		}
	}
	public function edit_password()
	{
		$data = $this->Admin_model->get_row_by_id();
		$current_pass = $_POST['current_pass'];
		$new_pass = $_POST['new_pass'];
		$conf_pass = $_POST['conf_pass'];
		$chk = password_verify($current_pass, $this->Admin_model->get_row_by_id()->password);
		if ($chk) {
			$this->form_validation->set_rules('current_pass', 'Old Password', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('new_pass', 'Password', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('conf_pass', 'Password Confirmation', 'required|matches[new_pass]');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('Backend/Admin/account');
			} else {
				$this->Admin_model->change_pass($new_pass);
			}
		} else if ($current_pass == '') {
			$this->session->set_flashdata('form_err_msg', 'Please Enter Password');
			redirect('index.php/admin/account', 'refresh');
		} else {
			$this->session->set_flashdata('form_err_msg', 'Please Enter Valid Password');
			redirect('index.php/admin/account', 'refresh');
		}
	}
	public function system_settings()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$data = $this->Admin_model->get_sys_settings();
			$this->load->view('Backend/Admin/system_settings.php', ['record' => $data]);
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function update_sys_settings()
	{
		$this->form_validation->set_rules('system_name', 'System Name', 'trim|required');
		$this->form_validation->set_rules('system_title', 'System Title', 'trim|required');
		$this->form_validation->set_rules('system_address', 'System Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');
		$this->form_validation->set_rules('system_currency', 'System Currency', 'trim|required');
		$this->form_validation->set_rules('system_email', 'System Email', 'trim|required');
		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['logo']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/system/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('logo')) {
				$data = $this->upload->data();
				$post['image_path'] = base_url('assets/uploads/system/' . $data['raw_name'] . $data['file_ext']);
			} else {
				$upload_errors = $this->upload->display_errors();
				redirect('index.php/admin/system_settings?upload_error=' . $upload_errors, 'refresh');
			}
		} else {
			if ($old_img_path != '') {
				$post['image_path'] = $old_img_path;
			} else {
				$post['image_path'] = 'null';
			}
		}
		if ($this->form_validation->run()) {
			unset($post['old_img']);
			$res = $this->Admin_model->update_system_settings($post);
			if ($res) {
				$this->session->set_flashdata('success', 'System Settings Updated');
			} else {
				$this->session->set_flashdata('success', 'System Settings Not Updated');
			}
			redirect('index.php/admin/system_settings', 'refresh');
		} else {
			$_POST['old_img'] = $post['image_path'];
			$this->load->view('Backend/Admin/system_settings');
		}
	}
	// Department Main functions
	public function departments()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_depts();
			$this->load->view('Backend/Admin/departments', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function adddepartments($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)['name' => '', 'description' => '', 'icon' => ''];
			$this->load->view('Backend/Admin/forms/adddepartment', compact('record'));
		} else {
			if ($record = $this->Admin_model->getdeptby_id($id)) {
				$this->load->view('Backend/Admin/forms/adddepartment', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Department Not Exists');
				redirect('index.php/admin/departments');
			}
		}
	}
	public function manage_depts()
	{
		$this->form_validation->set_rules('name', 'Department Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Department description', 'trim|required');
		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/departments/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/departments/' . $data['raw_name'] . $data['file_ext']);
			} else {
				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/adddepartment', compact('upload_errors'));
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
				$res = $this->Admin_model->update_dept($post);
				if ($res) {
					$this->session->set_flashdata('success', 'Department Updated');
				} else {
					$this->session->set_flashdata('success', 'Department Not Updated');
				}
				redirect('index.php/admin/departments', 'refresh');
			} else {
				$_POST['old_img'] = $post['icon'];
				$hidden_id = $_POST['hidden_id'];
				$this->load->view('Backend/Admin/forms/adddepartment', compact('hidden_id'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_dept($post);
				if ($res) {
					$this->session->set_flashdata('success', 'Department Added');
				} else {
					$this->session->set_flashdata('success', 'Department Not Added');
				}
				redirect('index.php/admin/departments', 'refresh');
			} else {
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/adddepartment');
			}
		}
	}
	public function delete_dept($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($this->Admin_model->delete_dept($id)) {
				$this->session->set_flashdata('success', 'Department Deleted');
			} else {
				$this->session->set_flashdata('success', 'Department Not Deleted');
			}
			redirect('index.php/admin/departments', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_dept($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getdeptby_id($id)) {
				redirect('index.php/admin/adddepartments/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Department Not Exists');
			}
			redirect('index.php/admin/departments', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	// Department Main functions

	//Doctor Main Functions


	public function doctors()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_doctors();
			$this->load->view('Backend/Admin/doctors', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function adddoctors($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '', 'department_id' => 0,
				'profile' => '', 'fb_link' => '', 'twitter_link' => '',
				'googleplus_link' => '', 'Linkedin_link' => '', 'icon' => '',
				'departments' => $this->Admin_model->get_depts(),
			];
			$this->load->view('Backend/Admin/forms/adddoctor', compact('record'));
		} else {
			if ($record = $this->Admin_model->getdoctorby_id($id)) {
				$record = (object)[
					'name' => $record->name,
					'email' => $this->Admin_model->get_login_details($id, 'doctor')->email,
					'password' => $record->unhash_password,
					'address' => $record->address, 'phone' => $record->phone,
					'profile' => $record->profile,
					'fb_link' => $record->fb_link,
					'twitter_link' => $record->twitter_link,
					'googleplus_link' => $record->googleplus_link,
					'Linkedin_link' => $record->Linkedin_link,
					'icon' => $record->icon,
					'departments' => $this->Admin_model->get_depts(),
					'department_id' => $record->department_id,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/adddoctor', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Doctor Not Exists');
				redirect('index.php/admin/doctors');
			}
		}
	}
	public function manage_doctors()
	{
		if (isset($_POST['hidden_id'])) {
			$unique_chk_email = '';
			$unique_chk_phone = '';
		} else {
			$unique_chk_email = "|is_unique[users.email]";
			$unique_chk_phone = "|is_unique[doctors.phone]";
		}
		$this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Doctor email', 'trim|required' . $unique_chk_email);

		$this->form_validation->set_rules('password', 'Doctor password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('address', 'Doctor Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Doctor Phone', 'trim|required|numeric' . $unique_chk_phone);
		$this->form_validation->set_rules('department_id', 'Department Name', 'trim|required');
		$this->form_validation->set_rules('profile', 'Doctor Profile', 'trim|required');

		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/doctors/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/doctors/' . $data['raw_name'] . $data['file_ext']);
			} else {
				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/adddoctor', compact('upload_errors'));
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
				$res = $this->Admin_model->update_doctor($post);
				if ($res) {
					$data['email'] = $this->Admin_model->getuser($_POST['hidden_id'], 'doctor')->email;
					$data['password'] = $this->Admin_model->getdoctorby_id($_POST['hidden_id'])->unhash_password;
					$data['usertype'] = 'Doctor';
					$message = $this->load->view('email/updateaccount', $data, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $data['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Doctor Updated');
				} else {
					$this->session->set_flashdata('success', 'Doctor Not Updated');
				}
				redirect('index.php/admin/doctors', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'departments' => $this->Admin_model->get_depts(),
					'department_id' => set_value('department_id'),
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/adddoctor', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_doctor($post);
				if ($res) {
					$this->session->set_flashdata('success', 'Doctor Added');
					$post['usertype'] = 'Doctor';
					$message = $this->load->view('email/addaccount', $post, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $post['email'], 'Welcome');
				} else {
					$this->session->set_flashdata('success', 'Doctor Not Added');
				}
				redirect('index.php/admin/doctors', 'refresh');
			} else {
				$record = (object)[
					'departments' => $this->Admin_model->get_depts(),
					'department_id' => set_value('department_id'),
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/adddoctor', compact('record'));
			}
		}
	}
	public function delete_doctor($id = 0)
	{
		$chk_session = $this->check_session_exists();
		$post = [];
		$post['email'] = $this->Admin_model->getuser($id, 'doctor')->email;
		if ($chk_session) {
			if ($this->Admin_model->delete_doctor($id)) {
				$post['usertype'] = 'Doctor';
				$message = $this->load->view('email/deleteaccount', $post, true);
				$from = $this->Admin_model->get_row_by_id()->email;
				$this->mail->send($message, $from, 'Admin', $post['email'], 'Leaving Clinic');
				$this->session->set_flashdata('success', 'Doctor Deleted');
			} else {
				$this->session->set_flashdata('success', 'Doctor Not Deleted');
			}
			redirect('index.php/admin/doctors', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_doctor($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getdoctorby_id($id)) {
				redirect('index.php/admin/adddoctors/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Doctor Not Exists');
			}
			redirect('index.php/admin/doctors', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	//Doctor Main Functions

	//patient Main functions
	public function patients()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_patients();
			$this->load->view('Backend/Admin/patients', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	


	public function addpatients($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '',
				'gender_id' => 0, 'blood_group_id' => 0,
				'icon' => '', 'birth_date' => '', 'age' => '',
			];
			$this->load->view('Backend/Admin/forms/addpatient', compact('record'));
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
				$this->load->view('Backend/Admin/forms/addpatient', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Patient Not Exists');
				redirect('index.php/admin/patients');
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
				$this->load->view('Backend/Admin/forms/addpatient', compact('upload_errors'));
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
					$data['email'] = $this->Admin_model->getuser($_POST['hidden_id'], 'patient')->email;
					$data['password'] = $this->Admin_model->getpatientby_id($_POST['hidden_id'])->unhash_password;
					$data['usertype'] = 'Patient';
					$message = $this->load->view('email/updateaccount', $data, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $data['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Patient Updated');
				} else {
					$this->session->set_flashdata('success', 'Patient Not Updated');
				}
				redirect('index.php/admin/patients', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'gender_id' => set_value('gender'),
					'blood_group_id' => set_value('blood_group'),
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addpatient', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$post['birth_date']=$this->getdateformat($post['birth_date']);
				$res = $this->Admin_model->add_patient($post);
				if ($res) {
					$this->session->set_flashdata('success', 'Patient Added');
					$post['usertype'] = 'Patient';
					$message = $this->load->view('email/addaccount', $post, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $post['email'], 'Welcome');
				} else {
					$this->session->set_flashdata('success', 'Patient Not Added');
				}
				redirect('index.php/admin/patients', 'refresh');
			} else {
				$record = (object)[
					'gender_id' => set_value('gender'),
					'blood_group_id' => set_value('blood_group'),
				];

				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addpatient', compact('record'));
			}
		}
	}
	public function delete_patient($id = 0)
	{
		$chk_session = $this->check_session_exists();
		$post = [];
		$post['email'] = $this->Admin_model->getuser($id, 'patient')->email;
		if ($chk_session) {
			if ($this->Admin_model->delete_patient($id)) {
				$post['usertype'] = 'Patient';
				$message = $this->load->view('email/deleteaccount', $post, true);
				$from = $this->Admin_model->get_row_by_id()->email;
				$this->mail->send($message, $from, 'Admin', $post['email'], 'Leaving Clinic');
				$this->session->set_flashdata('success', 'Patient Deleted');
			} else {
				$this->session->set_flashdata('success', 'Patient Not Deleted');
			}
			redirect('index.php/admin/patients', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_patient($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getpatientby_id($id)) {
				redirect('index.php/admin/addpatients/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Patient Not Exists');
			}
			redirect('index.php/admin/patients', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	//patient Main functions

	//Nurses Main functions

	public function nurses()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_nurses();
			$this->load->view('Backend/Admin/nurses', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}


	public function addnurses($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '',
				'icon' => ''
			];
			$this->load->view('Backend/Admin/forms/addnurse', compact('record'));
		} else {
			if ($record = $this->Admin_model->getnurseby_id($id)) {
				$record = (object)[
					'name' => $record->name,
					'email' => $this->Admin_model->get_login_details($id, 'nurse')->email,
					'password' => $record->unhash_password,
					'address' => $record->address,
					'phone' => $record->phone,
					'icon' => $record->icon,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/addnurse', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Nurse Not Exists');
				redirect('index.php/admin/nurses');
			}
		}
	}
	public function manage_nurses()
	{
		if (isset($_POST['hidden_id'])) {
			$unique_chk_email = '';
			$unique_chk_phone = '';
		} else {
			$unique_chk_email = "|is_unique[users.email]";
			$unique_chk_phone = "|is_unique[nurses.phone]";
		}
		$this->form_validation->set_rules('name', 'Nurse Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Nurse email', 'trim|required' . $unique_chk_email);

		$this->form_validation->set_rules('password', 'Nurse password', 'trim|required');
		$this->form_validation->set_rules('address', 'Nurse Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Nurse Phone', 'trim|required|numeric' . $unique_chk_phone);

		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/nurses/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/nurses/' . $data['raw_name'] . $data['file_ext']);
			} else {

				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/addnurse', compact('upload_errors'));
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
				$res = $this->Admin_model->update_nurse($post);
				if ($res) {
					$data['email'] = $this->Admin_model->getuser($_POST['hidden_id'], 'nurse')->email;
					$data['password'] = $this->Admin_model->getnurseby_id($_POST['hidden_id'])->unhash_password;
					$data['usertype'] = 'Nurse';
					$message = $this->load->view('email/updateaccount', $data, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $data['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Nurse Updated');
				} else {
					$this->session->set_flashdata('success', 'Nurse Not Updated');
				}
				redirect('index.php/admin/nurses', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addnurse', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_nurse($post);
				if ($res) {
					$post['usertype'] = 'Nurse';
					$message = $this->load->view('email/addaccount', $post, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $post['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Nurse Added');
				} else {
					$this->session->set_flashdata('success', 'Nurse Not Added');
				}
				redirect('index.php/admin/nurses', 'refresh');
			} else {
				$record = (object)[];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addnurse', compact('record'));
			}
		}
	}

	public function delete_nurse($id = 0)
	{
		$chk_session = $this->check_session_exists();
		$post = [];
		$post['email'] = $this->Admin_model->getuser($id, 'nurse')->email;

		if ($chk_session) {
			if ($this->Admin_model->delete_nurse($id)) {
				$post['usertype'] = 'Nurse';
				$message = $this->load->view('email/deleteaccount', $post, true);
				$from = $this->Admin_model->get_row_by_id()->email;
				$this->mail->send($message, $from, 'Admin', $post['email'], 'Leaving Clinic');
				$this->session->set_flashdata('success', 'Nurse Deleted');
			} else {
				$this->session->set_flashdata('success', 'Nurse Not Deleted');
			}
			redirect('index.php/admin/nurses', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_nurse($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getnurseby_id($id)) {
				redirect('index.php/admin/addnurses/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Nurse Not Exists');
			}
			redirect('index.php/admin/nurses', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	//Nurses Main functions


	// pharmacists Main functions

	public function pharmacists()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_pharmacists();
			$this->load->view('Backend/Admin/pharmacists', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}


	public function addpharmacists($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '',
				'icon' => ''
			];
			$this->load->view('Backend/Admin/forms/addpharmacist', compact('record'));
		} else {
			if ($record = $this->Admin_model->getpharmacistby_id($id)) {
				$record = (object)[
					'name' => $record->name,
					'email' => $this->Admin_model->get_login_details($id, 'pharmacist')->email,
					'password' => $record->unhash_password,
					'address' => $record->address,
					'phone' => $record->phone,
					'icon' => $record->icon,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/addpharmacist', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'pharmacist Not Exists');
				redirect('index.php/admin/pharmacists');
			}
		}
	}
	public function manage_pharmacists()
	{
		if (isset($_POST['hidden_id'])) {
			$unique_chk_email = '';
			$unique_chk_phone = '';
		} else {
			$unique_chk_email = "|is_unique[users.email]";
			$unique_chk_phone = "|is_unique[pharmacists.phone]";
		}
		$this->form_validation->set_rules('name', 'Pharmacist Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Pharmacist email', 'trim|required' . $unique_chk_email);

		$this->form_validation->set_rules('password', 'Pharmacist password', 'trim|required');
		$this->form_validation->set_rules('address', 'Pharmacist Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Pharmacist Phone', 'trim|required|numeric' . $unique_chk_phone);

		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/pharmacists/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/pharmacists/' . $data['raw_name'] . $data['file_ext']);
			} else {

				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/addpharmacist', compact('upload_errors'));
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
				$res = $this->Admin_model->update_pharmacist($post);
				if ($res) {
					$data['email'] = $this->Admin_model->getuser($_POST['hidden_id'], 'pharmacist')->email;
					$data['password'] = $this->Admin_model->getpharmacistby_id($_POST['hidden_id'])->unhash_password;
					$data['usertype'] = 'Pharmacist';
					$message = $this->load->view('email/updateaccount', $data, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $data['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Pharmacist Updated');
				} else {
					$this->session->set_flashdata('success', 'Pharmacist Not Updated');
				}
				redirect('index.php/admin/pharmacists', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addpharmacist', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_pharmacist($post);
				if ($res) {
					$post['usertype'] = 'Pharmacist';
					$message = $this->load->view('email/addaccount', $post, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $post['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Pharmacist Added');
				} else {
					$this->session->set_flashdata('success', 'Pharmacist Not Added');
				}
				redirect('index.php/admin/pharmacists', 'refresh');
			} else {
				$record = (object)[];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addpharmacist', compact('record'));
			}
		}
	}

	public function delete_pharmacist($id = 0)
	{
		$chk_session = $this->check_session_exists();
		$post = [];
		$post['email'] = $this->Admin_model->getuser($id, 'pharmacist')->email;

		if ($chk_session) {
			if ($this->Admin_model->delete_pharmacist($id)) {
				$post['usertype'] = 'Pharmacist';
				$message = $this->load->view('email/deleteaccount', $post, true);
				$from = $this->Admin_model->get_row_by_id()->email;
				$this->mail->send($message, $from, 'Admin', $post['email'], 'Leaving Clinic');

				$this->session->set_flashdata('success', 'Pharmacist Deleted');
			} else {
				$this->session->set_flashdata('success', 'Pharmacist Not Deleted');
			}
			redirect('index.php/admin/pharmacists', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_pharmacist($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getpharmacistby_id($id)) {
				redirect('index.php/admin/addpharmacists/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Pharmacist Not Exists');
			}
			redirect('index.php/admin/pharmacists', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	// pharmacists Main functions


	// laboratorists Main functions

	public function laboratorists()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_laboratorists();
			$this->load->view('Backend/Admin/laboratorists', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	public function addlaboratorists($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '',
				'icon' => ''
			];
			$this->load->view('Backend/Admin/forms/addlaboratorist', compact('record'));
		} else {
			if ($record = $this->Admin_model->getlaboratoristby_id($id)) {
				$record = (object)[
					'name' => $record->name,
					'email' => $this->Admin_model->get_login_details($id, 'laboratorist')->email,
					'password' => $record->unhash_password,
					'address' => $record->address,
					'phone' => $record->phone,
					'icon' => $record->icon,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/addlaboratorist', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Laboratorist Not Exists');
				redirect('index.php/admin/laboratorists');
			}
		}
	}
	public function manage_laboratorists()
	{
		if (isset($_POST['hidden_id'])) {
			$unique_chk_email = '';
			$unique_chk_phone = '';
		} else {
			$unique_chk_email = "|is_unique[users.email]";
			$unique_chk_phone = "|is_unique[laboratorists.phone]";
		}
		$this->form_validation->set_rules('name', 'laboratorist Name', 'trim|required');
		$this->form_validation->set_rules('email', 'laboratorist email', 'trim|required' . $unique_chk_email);

		$this->form_validation->set_rules('password', 'laboratorist password', 'trim|required');
		$this->form_validation->set_rules('address', 'laboratorist Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'laboratorist Phone', 'trim|required|numeric' . $unique_chk_phone);

		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/laboratorists/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/laboratorists/' . $data['raw_name'] . $data['file_ext']);
			} else {

				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/addlaboratorist', compact('upload_errors'));
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
				$res = $this->Admin_model->update_laboratorist($post);
				if ($res) {
					$data['email'] = $this->Admin_model->getuser($_POST['hidden_id'], 'laboratorist')->email;
					$data['password'] = $this->Admin_model->getlaboratoristby_id($_POST['hidden_id'])->unhash_password;
					$data['usertype'] = 'Laboratorist';
					$message = $this->load->view('email/updateaccount', $data, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $data['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Laboratorist Updated');
				} else {
					$this->session->set_flashdata('success', 'Laboratorist Not Updated');
				}
				redirect('index.php/admin/laboratorists', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addlaboratorist', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_laboratorist($post);
				if ($res) {
					$post['usertype'] = 'Laboratorist';
					$message = $this->load->view('email/addaccount', $post, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $post['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Laboratorist Added');
				} else {
					$this->session->set_flashdata('success', 'Laboratorist Not Added');
				}
				redirect('index.php/admin/laboratorists', 'refresh');
			} else {
				$record = (object)[];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addlaboratorist', compact('record'));
			}
		}
	}

	public function delete_laboratorist($id = 0)
	{
		$chk_session = $this->check_session_exists();
		$post = [];
		$post['email'] = $this->Admin_model->getuser($id, 'laboratorist')->email;

		if ($chk_session) {
			if ($this->Admin_model->delete_laboratorist($id)) {
				$post['usertype'] = 'Laboratorist';
				$message = $this->load->view('email/deleteaccount', $post, true);
				$from = $this->Admin_model->get_row_by_id()->email;
				$this->mail->send($message, $from, 'Admin', $post['email'], 'Leaving Clinic');

				$this->session->set_flashdata('success', 'Laboratorist Deleted');
			} else {
				$this->session->set_flashdata('success', 'Laboratorist Not Deleted');
			}
			redirect('index.php/admin/laboratorists', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_laboratorist($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getlaboratoristby_id($id)) {
				redirect('index.php/admin/addlaboratorists/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Laboratorist Not Exists');
			}
			redirect('index.php/admin/laboratorists', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}


	// laboratorists Main functions


	//Accountant fns


	public function accountants()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_accountants();
			$this->load->view('Backend/Admin/accountants', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	public function addaccountants($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '',
				'icon' => ''
			];
			$this->load->view('Backend/Admin/forms/addaccountant', compact('record'));
		} else {
			if ($record = $this->Admin_model->getaccountantby_id($id)) {
				$record = (object)[
					'name' => $record->name,
					'email' => $this->Admin_model->get_login_details($id, 'accountant')->email,
					'password' => $record->unhash_password,
					'address' => $record->address,
					'phone' => $record->phone,
					'icon' => $record->icon,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/addaccountant', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Accountant Not Exists');
				redirect('index.php/admin/accountants');
			}
		}
	}
	public function manage_accountants()
	{
		if (isset($_POST['hidden_id'])) {
			$unique_chk_email = '';
			$unique_chk_phone = '';
		} else {
			$unique_chk_email = "|is_unique[users.email]";
			$unique_chk_phone = "|is_unique[accountants.phone]";
		}
		$this->form_validation->set_rules('name', 'Accountant Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Accountant email', 'trim|required' . $unique_chk_email);

		$this->form_validation->set_rules('password', 'Accountant password', 'trim|required');
		$this->form_validation->set_rules('address', 'Accountant Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Accountant Phone', 'trim|required|numeric' . $unique_chk_phone);

		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/accountants/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/accountants/' . $data['raw_name'] . $data['file_ext']);
			} else {

				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/addaccountant', compact('upload_errors'));
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
				$res = $this->Admin_model->update_accountant($post);
				if ($res) {
					$this->session->set_flashdata('success', 'Accountant Updated');
				} else {
					$this->session->set_flashdata('success', 'Accountant Not Updated');
				}
				redirect('index.php/admin/accountants', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addaccountant', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_accountant($post);
				if ($res) {
					$this->session->set_flashdata('success', 'Accountant Added');
				} else {
					$this->session->set_flashdata('success', 'Accountant Not Added');
				}
				redirect('index.php/admin/accountants', 'refresh');
			} else {
				$record = (object)[];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addaccountant', compact('record'));
			}
		}
	}

	public function delete_accountant($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($this->Admin_model->delete_accountant($id)) {
				$this->session->set_flashdata('success', 'Accountant Deleted');
			} else {
				$this->session->set_flashdata('success', 'Accountant Not Deleted');
			}
			redirect('index.php/admin/accountants', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_accountant($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getaccountantby_id($id)) {
				redirect('index.php/admin/addaccountants/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Accountant Not Exists');
			}
			redirect('index.php/admin/accountants', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	//Accountant fns

	//Receptionists fns

	public function receptionists()
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records = $this->Admin_model->get_receptionists();
			$this->load->view('Backend/Admin/receptionists', compact('records'));
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	public function addreceptionists($flag = 'add', $id = 0)
	{
		if ($flag == 'add') {
			$record = (object)[
				'name' => '', 'email' => '', 'password' => '',
				'address' => '', 'phone' => '',
				'icon' => ''
			];
			$this->load->view('Backend/Admin/forms/addreceptionist', compact('record'));
		} else {
			if ($record = $this->Admin_model->getreceptionistby_id($id)) {
				$record = (object)[
					'name' => $record->name,
					'email' => $this->Admin_model->get_login_details($id, 'receptionist')->email,
					'password' => $record->unhash_password,
					'address' => $record->address,
					'phone' => $record->phone,
					'icon' => $record->icon,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/addreceptionist', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Receptionist Not Exists');
				redirect('index.php/admin/receptionists');
			}
		}
	}
	public function manage_receptionists()
	{
		if (isset($_POST['hidden_id'])) {
			$unique_chk_email = '';
			$unique_chk_phone = '';
		} else {
			$unique_chk_email = "|is_unique[users.email]";
			$unique_chk_phone = "|is_unique[receptionists.phone]";
		}
		$this->form_validation->set_rules('name', 'Receptionist Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Receptionist email', 'trim|required' . $unique_chk_email);

		$this->form_validation->set_rules('password', 'Receptionist password', 'trim|required');
		$this->form_validation->set_rules('address', 'Receptionist Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Receptionist Phone', 'trim|required|numeric' . $unique_chk_phone);

		$old_img_path = $this->input->post('old_img');
		$post = $this->input->post();
		$logo = $_FILES['icon']['name'];
		if ($logo != '') {
			$config['upload_path']          = './assets/uploads/receptionists/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('icon')) {
				$data = $this->upload->data();
				$post['icon'] = base_url('assets/uploads/receptionists/' . $data['raw_name'] . $data['file_ext']);
			} else {

				$upload_errors = $this->upload->display_errors();
				$this->load->view('Backend/Admin/forms/addreceptionist', compact('upload_errors'));
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
				$res = $this->Admin_model->update_receptionist($post);
				if ($res) {
					$data['email'] = $this->Admin_model->getuser($_POST['hidden_id'], 'receptionist')->email;
					$data['password'] = $this->Admin_model->getreceptionistby_id($_POST['hidden_id'])->unhash_password;
					$data['usertype'] = 'Receptionist';
					$message = $this->load->view('email/updateaccount', $data, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $data['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Receptionist Updated');
				} else {
					$this->session->set_flashdata('success', 'Receptionist Not Updated');
				}
				redirect('index.php/admin/receptionists', 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'hidden_id' => $hidden_id,
				];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addreceptionist', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				unset($post['old_img']);
				$res = $this->Admin_model->add_receptionist($post);
				if ($res) {
					$post['usertype'] = 'Receptionist';
					$message = $this->load->view('email/addaccount', $post, true);
					$from = $this->Admin_model->get_row_by_id()->email;
					$this->mail->send($message, $from, 'Admin', $post['email'], 'Welcome');
					$this->session->set_flashdata('success', 'Receptionist Added');
				} else {
					$this->session->set_flashdata('success', 'Receptionist Not Added');
				}
				redirect('index.php/admin/receptionists', 'refresh');
			} else {
				$record = (object)[];
				$_POST['old_img'] = $post['icon'];
				$this->load->view('Backend/Admin/forms/addreceptionist', compact('record'));
			}
		}
	}

	public function delete_receptionist($id = 0)
	{
		$chk_session = $this->check_session_exists();
		$post = [];
		$post['email'] = $this->Admin_model->getuser($id, 'receptionist')->email;

		if ($chk_session) {
			if ($this->Admin_model->delete_receptionist($id)) {
				$post['usertype'] = 'Receptionist';
				$message = $this->load->view('email/deleteaccount', $post, true);
				$from = $this->Admin_model->get_row_by_id()->email;
				$this->mail->send($message, $from, 'Admin', $post['email'], 'Leaving Clinic');
				$this->session->set_flashdata('success', 'Receptionist Deleted');
			} else {
				$this->session->set_flashdata('success', 'Receptionist Not Deleted');
			}
			redirect('index.php/admin/receptionists', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_receptionist($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getreceptionistby_id($id)) {
				redirect('index.php/admin/addreceptionists/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Receptionist Not Exists');
			}
			redirect('index.php/admin/receptionists', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}

	//Receptionists fns


	//facilities fns

	public function facilities($name = '', $id = 0)
	{
		$name = str_replace("%20", " ", $name);
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$records['records'] = $this->Admin_model->get_facilities($id);
			$records['department_id'] = $id;
			$records['dept_facility'] = $name;
			$this->load->view('Backend/Admin/facilities', $records);
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function addfacilities($flag = 'add', $id = 0)
	{
		// $dept_id=$_GET['dept_id'];
		if ($flag == 'add') {
			$record = (object)[
				'title' => '',
				'description' => ''
			];
			$this->load->view('Backend/Admin/forms/addfacilities', compact('record'));
		} else {
			if ($record = $this->Admin_model->getfacilityby_id($id)) {
				$record = (object)[
					'title' => $record->title,
					'description' => $record->description,
					'hidden_id' => $record->id,
				];
				$this->load->view('Backend/Admin/forms/addfacilities', compact('record'));
			} else {
				$this->session->set_flashdata('success', 'Facility Not Exists');
				redirect('index.php/admin/facilities');
			}
		}
	}

	public function manage_facilities()
	{
		$this->form_validation->set_rules('title', 'Facility Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Facility Description', 'trim|required');

		$post = $this->input->post();

		if (isset($_POST['hidden_id'])) {
			if ($this->form_validation->run()) {
				$res = $this->Admin_model->update_facility($post);
				if ($res['response']) {
					$this->session->set_flashdata('success', 'Facility Updated');
				} else {
					$this->session->set_flashdata('success', 'Facility Not Updated');
				}
				redirect('index.php/admin/Facilities/' . $res['dept_name'] . '/' . $res['department_id'], 'refresh');
			} else {
				$hidden_id = $_POST['hidden_id'];
				$record = (object)[
					'hidden_id' => $hidden_id,
				];
				$this->load->view('Backend/Admin/forms/addfacilities', compact('record'));
			}
		} else {
			if ($this->form_validation->run()) {
				$res = $this->Admin_model->add_facility($post);
				if ($res['response']) {
					$this->session->set_flashdata('success', 'Facility Added');
				} else {
					$this->session->set_flashdata('success', 'Facility Not Added');
				}
				redirect('index.php/admin/Facilities/' . $res['dept_name'] . '/' . $res['department_id'], 'refresh');
			} else {
				$record = (object)[];
				$this->load->view('Backend/Admin/forms/addfacilities', compact('record'));
			}
		}
	}
	public function delete_facility($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			$res = $this->Admin_model->delete_facility($id);
			if ($res['response']) {
				$this->session->set_flashdata('success', 'Facility Deleted');
			} else {
				$this->session->set_flashdata('success', 'Facility Not Deleted');
			}
			redirect('index.php/admin/facilities/' . $res['dept_name'] . '/' . $res['dept_id'], 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	public function edit_facility($id = 0)
	{
		$chk_session = $this->check_session_exists();
		if ($chk_session) {
			if ($record = $this->Admin_model->getfacilityby_id($id)) {
				redirect('index.php/admin/addfacilities/update/' . $record->id);
			} else {
				$this->session->set_flashdata('success', 'Facility Not Exists');
			}
			$dept_id = $this->Admin_model->getfacilityby_id($id)->department_id;
			$dept_name = $this->Admin_model->getdeptby_id($dept_id)->name;
			redirect('index.php/admin/facilities/' . $dept_name . '/' . $dept_id, 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Please Log In First!');
			redirect('index.php/home/login', 'refresh');
		}
	}
	//facilities fns
	public function getdateformat($date)
    {
        $timestamp = strtotime($date);
        $formattedDate = date('d/m/Y', $timestamp);
        return $formattedDate;
    }
	public function getdesireddateformat($date)
	{
		$date = str_replace('/', '-', $date);
		return date('Y-m-d', strtotime($date));
	}
}