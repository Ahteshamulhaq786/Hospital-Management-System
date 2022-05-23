<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		$this->load->helper('url');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$chk_session=$this->check_session_exists();
		$id=$_SESSION['IDENTITY_WHO_LOGINS'];
		if($chk_session)
		{
			$session_data=array(
					'ID',
					'IDENTITY_WHO_LOGINS',
					'LOGGED_IN',
					'PROFILE_ID',
				);
            $this->Admin_model->set_status_offline();
			$this->session->unset_userdata($session_data);
			if($id=='patient')
			{
				unset($_SESSION['cart_medicines']);
			}
			$this->session->set_flashdata('failure','Logged Out Successfully!');
				redirect('index.php/home/login', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('failure','Already Logged Out!');
				redirect('index.php/home/login', 'refresh');
		}
	}

	public function check_session_exists()
	{
		if($this->session->has_userdata('IDENTITY_WHO_LOGINS') && $_SESSION['LOGGED_IN']==true){
			return true;
		}
		else
			return false;
	}


}

?>