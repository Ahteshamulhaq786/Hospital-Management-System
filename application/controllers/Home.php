<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		$this->load->helper('url');
		$this->load->model(['Admin_model', 'mail']);
	}
	public function index()
	{
		$this->load->view('Frontend/Home',['departments'=>$this->Admin_model->get_depts(),'doctors'=>$this->Admin_model->get_doctors(),'settings'=>$this->Admin_model->get_system_settings()]);
	}
	public function getdatetimeformat($dt)
	{
		$dd = date_format(date_create($dt), "d/m/Y H:i");
		return explode(' ', $dd);
	}
	public function register()
	{
		$this->form_validation->set_rules('name', 'UserName', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone no', 'trim|required|is_unique[patients.phone]|integer');
		$this->form_validation->set_rules('birthday', 'Birth Date', 'trim|required');
		$this->form_validation->set_rules('blood_group', 'Blood group', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('age', 'Age', 'trim|required|integer');

		$config['upload_path']          = './assets/uploads/patients/';
		$config['allowed_types']        = 'gif|png|jpg|jpeg';
		$this->load->library('upload', $config);

		$captcha_response=$_POST['g-recaptcha-response'];
		$secret_key="6LdK0XAbAAAAAGLxwOK8BfBrGuyNmVGn7XBnySCs";
		$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$captcha_response;
		$response=file_get_contents($url);
		$response=json_decode($response,true);
		$capchta_error='';

		if ($this->form_validation->run() && $this->upload->do_upload('icon') && $response['success']) {
			$data = $this->upload->data();
			$icon = base_url('assets/uploads/patients/' . $data['raw_name'] . $data['file_ext']);
			$_POST['birthday'] = $this->getdatetimeformat($_POST['birthday'])[0];
			//insert patient tb
			$patient = array(
				'name' => $_POST['name'],
				'unhash_password' => $_POST['password'],
				'address' => $_POST['address'],
				'phone' => $_POST['phone'],
				'birth_date' => $_POST['birthday'],
				'age' => $_POST['age'],
				'gender' => $_POST['gender'],
				'blood_group' => $_POST['blood_group'],
				'icon' => $icon,
			);
			$this->db->insert('patients', $patient);
			$insert_id = $this->db->insert_id();
			//insert users tb
			$user = array(
				'email' => $_POST['email'],
				'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
				'type' => 'patient',
				'profile_id' => $insert_id,
			);
			$this->db->insert('users', $user);
			$send['email'] = $user['email'];
			$send['password'] = $patient['unhash_password'];
			$send['usertype'] = 'Patient';
			$send['msg'] = "Hi ".$patient['name']."! You are Registered Please Login to Your Account to Make Appointment with Doctor";
			$message = $this->load->view('email/addaccount', $send, true);
			$from = $this->Admin_model->get_system_settings()->system_email;
			$this->mail->send($message, $from, 'Admin', $user['email'], 'Welcome');
			$this->session->set_flashdata('success', 'Dear ' . $patient['name'] . '! You are Registered successfully');
			redirect('index.php/home/register_patient', 'refresh');
		} else {
			$data['depts'] = $this->Admin_model->get_depts();
			$data['captcha_error']=  $response['success'] ? '' : "Invalid Captcha Please Try Again";
			$data['error'] = $this->upload->display_errors();
		}
		$this->load->view('Frontend/register', compact('data'));
	}
	public function get_doctors_of_dept()
	{
		$dept_id = $_POST['dept_id'];
		$doctors = $this->Admin_model->get_doctors_of_dept($dept_id);
		$html = '<option value="">Please Select Doctor</option>';
		foreach ($doctors as $doctor) {
			$html .= '<option value="' . $doctor->id . '">' . $doctor->name . '</>';
		}
		echo $html;
	}
	public function doctors($dept_id=0)
	{
		$departments=$this->Admin_model->get_depts();
		if($dept_id==0)
			$doctors=$this->Admin_model->get_doctors(); 
		else if($dept_id>0)
			$doctors=$this->Admin_model->get_doctors_of_dept($dept_id);
		$this->load->view('Frontend/Doctors',compact('doctors','departments','dept_id'));
	}
	public function about()
	{
		$this->load->view('Frontend/About');
	}
	public function register_patient()
	{
		$this->load->view('Frontend/register');
	}
	public function contact()
	{
		$contact_no = $this->Admin_model->get_sys_settings()->phone;
		$this->load->view('Frontend/Contact', compact('contact_no'));
	}
	public function makecontact()
	{

		
		$this->form_validation->set_rules('name', 'UserName', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone no', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');

		$captcha_response=$_POST['g-recaptcha-response'];
		$secret_key="6LdK0XAbAAAAAGLxwOK8BfBrGuyNmVGn7XBnySCs";
		$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$captcha_response;
		$response=file_get_contents($url);
		$response=json_decode($response,true);
		$capchta_error='';
		
		if ($this->form_validation->run() && $response['success']) {
			$msg = $this->load->view('email/contact', $_POST, true);
			$to = $this->Admin_model->get_sys_settings()->system_email;
			$this->mail->send($msg, $_POST['email'], $_POST['name'], $to, 'Contacting With Me');
			$this->session->set_flashdata('success', 'Your Query has been Received Successfully!');
			redirect('index.php/home/contact');
		} else {
			$capchta_error=$response['success'] ? '' : 'Invalid Captcha Please Try Again';
			$contact_no = $this->Admin_model->get_sys_settings()->phone;
			$this->load->view('Frontend/Contact', compact('contact_no','capchta_error'));
		}
	}

	public function login()
	{
		if ($this->check_session_exists()) {
			switch ($_SESSION['IDENTITY_WHO_LOGINS']) {
				case 'admin':
					return redirect('index.php/admin/dashboard');
					break;
				case 'doctor':
					return redirect('index.php/doctor/dashboard');
					break;
				case 'nurse':
					return redirect('index.php/nurse/dashboard');
					break;
				case 'patient':
					return redirect('index.php/patient/dashboard');
					break;
				case 'pharmacist':
					return redirect('index.php/pharmacist/dashboard');
					break;
				case 'laboratorist':
					return redirect('index.php/laboratorist/dashboard');
					break;
				case 'accountant':
					return redirect('index.php/accountant/dashboard');
					break;
				case 'receptionist':
					return redirect('index.php/receptionist/dashboard');
					break;
			}
		} else
			$this->load->view('Frontend/Login');
	}
	public function doctorDetails($doctorID)
	{
		$doctor=(Array)$this->Admin_model->getdoctorby_id($doctorID);
		$doctor['email']=$this->db->get_where('users', array('profile_id' =>$doctorID,'type'=>'doctor'))->row()->email;
		$this->load->view('Frontend/doctordetails',compact('doctor'));
	}
	public function department($detp_id=0)
	{
		if ($detp_id == 0) {
			$departments=$this->Admin_model->get_depts();
			$this->load->view('Frontend/Alldepartments',compact('departments'));
		} else {
			$department=$this->Admin_model->getdeptby_id($detp_id);
			$this->load->view('Frontend/deptdetails',compact('department','detp_id'));
		}
	}
	public function check_session_exists()
	{
		if ($this->session->has_userdata('IDENTITY_WHO_LOGINS') && $_SESSION['LOGGED_IN'] == true) {
			return true;
		} else
			return false;
	}
	public function fetch_avg_rating()
    {
		$did=$_POST['did'];
        $query = $this->db->query("SELECT AVG(stars) AS average_stars from ratings where doctor_id=" . $did);
        $stars = $query->result()[0]->average_stars;
        if ($stars != NULL) {
            echo $stars;
        } else {
            echo 0;
        }
    }
	public function make_appointment()
	{
		//login ha aur patient ha to
		if($this->session->has_userdata('IDENTITY_WHO_LOGINS') && $this->session->has_userdata('LOGGED_IN') && $_SESSION['IDENTITY_WHO_LOGINS']=='patient')
		{
			$this->session->set_flashdata('success','Please Apply For Your Appointment Here ');
			return redirect('index.php/Patient/appointment_list','refresh');
		}
		//login ha aur patient nhi ha to
		else if($this->session->has_userdata('IDENTITY_WHO_LOGINS') && $this->session->has_userdata('LOGGED_IN') && $_SESSION['IDENTITY_WHO_LOGINS']!='patient')
		{
			$this->session->set_flashdata('success','Please Make a Patient Account and then Apply for an Appointment after Login&nbsp;&nbsp;<a href="login">Check Login Page</a>');
			return redirect('index.php/home/register_patient','refresh');
		}
		//koi bhi login ni ha to
		else
		{
			$this->session->set_flashdata('success','Please go to your dashboard to make an Appointment or simply log in to your Account&nbsp;&nbsp;<a href="login">Check Login Page</a>');
			return redirect('index.php/home/register_patient','refresh');
		}
	}
}