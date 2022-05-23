<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Mail extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('url');
    }
    public function send($message,$from,$from_name,$to,$subject)
    {
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->from($from,$from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    //     $this->email->send(FALSE);
    //    echo $this->email->print_debugger();
    }
}
