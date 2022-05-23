<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lab extends CI_Controller
{
     public function __construct()
     {
          Parent::__construct();
          $this->load->helper('url');
          $this->load->database();
          $this->load->model('Admin_model');
          $this->load->model('Lab_model');
          $this->load->model('Admin_model', 'admin');
          if (!isset($_SESSION['IDENTITY_WHO_LOGINS']) && !isset($_SESSION['LOGGED_IN']) && !isset($_SESSION['ID'])) {
               $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
               redirect('index.php/home/login', 'refresh');
          } else if ($_SESSION['IDENTITY_WHO_LOGINS'] != "laboratorist") {
               $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
               redirect('index.php/home/login', 'refresh');
          }
     }

     public function dashboard()
     {
          $data=(object)[
               'donors'=>$this->Admin_model->countdonors(),
               'diagnosis_reports'=>$this->Admin_model->countdiagnosisreports(),
               'patients'=>$this->Admin_model->countpatients(),
               'lab_workers'=>$this->Admin_model->countlabworkers()
          ];
          $this->load->view('Backend/Labortorist/dashboard',compact('data'));
     }
     public function blood_bank()
     {
          $this->load->view('Backend/Labortorist/bloodbank');
     }
     public function blood_donor()
     {
          $blood_donor = $this->Lab_model->get_blood_donor();
          $this->load->view("Backend/Labortorist/blooddonor", compact('blood_donor'));
          // $this->load->view('Backend/Labortorist/blooddonor');
     }
     public function pathology_report()
     {
          $reports = $this->Admin_model->get_all_diagnosis_reports();
          $this->load->view('Backend/Labortorist/pathologyreport', compact('reports'));
     }
     public function addreport()
     {
          $data = (object)array(
               'time' => '',
               'date' => '',
               'report_type' => '',
               'report_file' => '',
               'report_file_type' => '',
               'description' => '',
          );
          $patients = $this->Admin_model->get_patients();
          $this->load->view('Backend/Labortorist/forms/addreport', compact('data', 'patients'));
     }


     public function update_report($id)
     {
          $data = $this->Admin_model->get_diagnosis_report_by_id($id);
          $data->date=$this->getdesireddateformat($data->date);
          $patients = $this->Admin_model->get_patients();
          $this->load->view('Backend/Labortorist/forms/addreport', compact('data', 'patients'));
     }

     public function manage_report()
     {
          $this->form_validation->set_rules('time', 'Time', 'trim|required');
          $this->form_validation->set_rules('date', 'Date', 'trim|required');
          $this->form_validation->set_rules('patient_id', 'Patient', 'trim|required');
          $this->form_validation->set_rules('report_type', 'Test Report Type', 'trim|required');
          $this->form_validation->set_rules('report_file_type', 'Time', 'trim|required');
          $this->form_validation->set_rules('description', 'Report Description', 'trim|required');
          $config['upload_path']          = './assets/uploads/diagnosisreports';
          $config['allowed_types']        = 'pdf|word|ppt|excell|jpg|jpeg|doc';
          $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|word|ppt|excell|txt|xml|json';
          $config['max_width']            = 0;
          $config['max_height']           = 0;
          $config['max_size']             = 0;
          if ($this->form_validation->run()) {
               if (isset($_POST['hidden_id'])) {
                    if (isset($_FILES['report_file']['name']) && $_FILES['report_file']['name'] == true) {
                         //upload new
                         $this->load->library('upload', $config);
                         if (!$this->upload->do_upload('report_file')) {
                              $error = $this->upload->display_errors();
                              $this->session->set_flashdata('upload_error', $error);
                              redirect('index.php/lab/addreport', 'refresh');
                         } else {
                              // if (file_exists($_POST['hidden_path'])) {
                              //      unlink('./assets/uploads/diagnosisreports/'.basename($_POST['hidden_path']));
                              // }

                              $filename = str_replace('http://localhost/Clinic-Automation-system/assets/uploads/diagnosisreports/', '', $_POST['hidden_path']);

                              $abspath = $_SERVER['DOCUMENT_ROOT'];
                              $path = $abspath . '/Clinic-Automation-system/assets/uploads/diagnosisreports/' . $filename;


                              if (file_exists($path)) {
                                   unlink($path);
                              }


                              $data = $this->upload->data();
                              $filepath = base_url('assets/uploads/diagnosisreports/' . $data['raw_name'] . $data['file_ext']);
                         }
                    } else {
                         //upload previous
                         $filepath = $_POST['hidden_path'];
                    }

                    $this->editreport($_POST['hidden_id'], $filepath);
               } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('report_file')) {
                         $error = $this->upload->display_errors();
                         $this->session->set_flashdata('upload_error', $error);
                         redirect('index.php/lab/addreport', 'refresh');
                    } else {
                         $data =  $this->upload->data();
                         $filepath = base_url('assets/uploads/diagnosisreports/' . $data['raw_name'] . $data['file_ext']);
                    }
                    $this->addingreport($filepath);
               }
          } else {
               $this->addreport();
          }
     }
     public function addingreport($filepath)
     {
          $_POST['report_file'] = $filepath;
          $_POST['laboratorist_id'] = $_SESSION['PROFILE_ID'];
          $_POST['date']=$this->getdateformat($_POST['date']);
          $this->db->insert('diagnosis_reports', $_POST);
          $this->session->set_flashdata('success', 'Report Added Successfully!');
          redirect('index.php/lab/pathology_report', 'refresh');
     }
     public function editreport($id, $filepath)
     {
          $_POST['report_file'] = $filepath;
          unset($_POST['hidden_id']);
          unset($_POST['hidden_path']);
          $_POST['date']=$this->getdateformat($_POST['date']);
          $this->db->where('id', $id)->update('diagnosis_reports', $_POST);
          $this->session->set_flashdata('success', 'Report Updated!');
          redirect('index.php/lab/pathology_report', 'refresh');
     }
     public function delete_report($id)
     {
          $report_path = $this->Admin_model->get_diagnosis_report_by_id($id)->report_file;
          $filename = str_replace('http://localhost/Clinic-Automation-system/assets/uploads/diagnosisreports/', '', $report_path);
          $abspath = $_SERVER['DOCUMENT_ROOT'];
          $path = $abspath . '/Clinic-Automation-system/assets/uploads/diagnosisreports/' . $filename;

          if (file_exists($path)) {
               unlink($path);
          }
          $this->db->delete('diagnosis_reports', array('id' => $id));
          $this->session->set_flashdata('success', 'Report Deleted!');
          redirect('index.php/lab/pathology_report', 'refresh');
     }
     public function payroll()
     {
          $this->load->view('Backend/Labortorist/payroll');
     }
     public function profile()
     {
          $record = (object)array_merge((array)$this->admin->getlabby_id($_SESSION['PROFILE_ID']), (array)$this->admin->getuserby_id($_SESSION['ID']));
          $this->load->view('Backend/Labortorist/profile', compact('record'));
          // $this->load->view('Backend/Labortorist/profile');
     }
     public function edit_pass()
     {
          $this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required');
          $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required');
          $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'trim|required|matches[new_pass]');
          if ($this->form_validation->run()) {

               $chk = password_verify($_POST['old_pass'], $this->admin->get_row_by_id()->password);
               if ($chk) {
                    $data = array(
                         'password' => password_hash($_POST['new_pass'], PASSWORD_DEFAULT),
                    );
                    $this->db->where('id', $_SESSION['ID'])->update('users', $data) && $this->db->where('id', $_SESSION['PROFILE_ID'])->update('laboratorists', ['unhash_password' => $_POST['new_pass']]);
                    $session_data = array(
                         'ID',
                         'IDENTITY_WHO_LOGINS',
                         'LOGGED_IN',
                         'PROFILE_ID'
                    );
                    $this->session->unset_userdata($session_data);
                    $this->session->set_flashdata('failure', 'Password Changed!');
                    redirect('index.php/home/login', 'refresh');
               } else {
                    $this->session->set_flashdata('form_err_msg', 'Old Password is Invalid');
                    redirect('index.php/lab/profile', 'refresh');
               }
          } else {
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
               $config['upload_path']          = './assets/uploads/laboratorists/';
               $config['allowed_types']        = 'gif|jpg|png|jpeg';
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $post['icon'] = base_url('assets/uploads/laboratorists/' . $data['raw_name'] . $data['file_ext']);
               } else {
                    $upload_errors = $this->upload->display_errors();
                    return redirect('index.php/lab/profile?upload_error=' . $upload_errors);
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
               if ($this->admin->update_lab_profile($post)) {
                    $this->session->set_flashdata('success', 'Lab Profile Updated');
               } else {
                    $this->session->set_flashdata('success', 'Lab Profile Not Updated');
               }
               return redirect('index.php/lab/profile');
          } else {
               $this->load->view('Backend/Labortorist/profile');
          }
     }

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
               $record->last_donation_date=$this->getdesireddateformat($record->last_donation_date);
          }
          $this->load->view('Backend/Labortorist/forms/addblooddonor', compact('record'));
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
          $data['last_donation_date']=$this->getdateformat($data['last_donation_date']);
          if ($this->db->insert('lab_blood_donors', $data)) {
               $this->session->set_flashdata('success', $data['donor_name'] . ' Added to your System');
          } else {
               $this->session->set_flashdata('success', 'Blood Donor Not Added to your System');
          }
          redirect('index.php/lab/blood_donor', 'refresh');
     }
     public function delete_blood_donor($id)
     {
          if ($this->db->delete('lab_blood_donors', array('id' => $id))) {
               $this->session->set_flashdata('success', 'Donor Deleted in your System');
          } else {
               $this->session->set_flashdata('success', 'Donor Not Deleted in your System');
          }
          redirect('index.php/lab/blood_donor', 'refresh');
     }
     public function update_blood_donor()
     {
          $data = $this->input->post();
          $id = $data['hidden_id'];
          unset($data['hidden_id']);
          $data['last_donation_date']=$this->getdateformat($data['last_donation_date']);
          if ($this->db->where('id', $id)->update('lab_blood_donors', $data)) {
               $this->session->set_flashdata('success', $data['donor_name'] . ' Updated in your System');
          } else {
               $this->session->set_flashdata('success', 'Donor Not Updated in your System');
          }
          redirect('index.php/lab/blood_donor', 'refresh');
     }
     public function getreportname($path)
     {
          $filename = str_replace('http://localhost/Clinic-Automation-system/assets/uploads/diagnosisreports/', '', $path);
          return $filename;
     }
     public function download_report()
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
                    redirect('index.php/lab/pathology_report', 'refresh');
               }
          }
     }
     public function fetchreportdetails()
     {
          $pid = $_POST['pid'];
          $reports = $this->Admin_model->get_diagnosis_report_by_patientid($pid);
          if (count($reports) > 0) {
               $html = '<table class="table table-striped table-bordered table-hover">
               <thead>
                   <tr>
                       <th>Report Name</th>
                       <th>Description</th>
                       <th>Download</th>
                   </tr>
               </thead>
               <tbody>';
               foreach ($reports as $report) {
                    $html .= '
                        <tr>
                            <td>' . $this->getreportname($report->report_file) . '</td>
                            <td>' . $report->description . '</td>
                            <td>
                                   <a href="' . base_url('index.php/lab/download_report?file=' . $report->report_file) . '" class="btn btn-info">
                                   Download
                                   </a>
                            </td>
                        </tr>';
               }
               $html .= '</tbody>
               </table>';
               echo $html;
          } else {
               echo '<div class="alert alert-warning">
               No Reports Found for that patient
             </div>';
          }
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
		return date('Y-m-d', strtotime($date));
	}
}
