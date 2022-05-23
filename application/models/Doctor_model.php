<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function change_pass($pass)
    {
        $data = array(
            'password' => password_hash($pass, PASSWORD_DEFAULT),
            'online_status'=>0,
        );
        $res = $this->db->where('id', $_SESSION['ID'])->update('users', $data) && $this->db->where('id', $_SESSION['PROFILE_ID'])->update('doctors', ['unhash_password' => $pass]);
        if ($res) {
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
    }

}

?>