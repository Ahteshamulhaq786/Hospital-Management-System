<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();

        include APPPATH . 'third_party/stripe-php-master/init.php';

        $this->publishableKey = "pk_test_51J5idJE0xzCVW7UcqF0w8GWwG3ZPIOcXsph3tBIPqpw4umOQi7M6hM62XlO6dXYs3qE4GS9mWYJA3mCIECwF5i1c00RR4hsQXX";

        $this->secretKey = "sk_test_51J5idJE0xzCVW7UcM1oLAmTxenqgNe81TwCFUK2SfUiVCnfOpRV4MU03lVTZMJvx9f6pMz3kzmRi9diqUQZsHla700AbQWzUlT";

        \Stripe\Stripe::setApiKey($this->secretKey);

        $this->load->helper('url');
        $this->load->model('Admin_model');
        if (!isset($_SESSION['IDENTITY_WHO_LOGINS']) && !isset($_SESSION['LOGGED_IN']) && !isset($_SESSION['ID'])) {
            $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
            redirect('index.php/home/login', 'refresh');
        } else if ($_SESSION['IDENTITY_WHO_LOGINS'] != "patient") {
            $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
            redirect('index.php/home/login', 'refresh');
        }
    }
    public function dashboard()
    {
        $this->load->view('Backend/Patient/dashboard');
    }
    public function checkout()
    {
        if (isset($_SESSION['cart_medicines']) && count($_SESSION['cart_medicines']) > 0) {
            $sum = 0;
            $total_price = 0;
            foreach ($_SESSION['cart_medicines'] as $carted_item) {
                $total_price = $carted_item['qty'] * $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->price;
                $sum = $sum + $total_price;
            }
            $this->load->view('Backend/Patient/checkout', ['total_price' => $sum]);
        } else {
            $this->session->set_flashdata('failure', 'Please First Add Medicines to Cart');
            redirect('index.php/patient/buymedicines', 'refresh');
        }
    }
    public function appointment_list()
    {
        $appointments = $this->Admin_model->get_approved_appointments();
        $this->load->view('Backend/Patient/Appointment/Appointment_list', compact('appointments'));
    }
    public function requested_appointment()
    {
        $appointments = $this->Admin_model->get_pending_appointments();
        $this->load->view('Backend/Patient/Appointment/Requested_Appointment', compact('appointments'));
    }
    public function prescription()
    {
        $pid = $_SESSION['PROFILE_ID'];
        $this->db->select("*")->from("prescriptions")->where('patient_id', $pid);
        $prescriptions = $this->db->get()->result();
        $this->load->view('Backend/patient/prescription', compact('prescriptions'));
    }

    public function doctors()
    {
        $doctors = $this->Admin_model->get_doctors();
        $this->load->view('Backend/Patient/doctors', compact('doctors'));
    }
    public function admit_history()
    {
        $allotments = $this->Admin_model->get_patient_allotments($_SESSION['PROFILE_ID']);
        $this->load->view('Backend/Patient/admit_history', compact('allotments'));
    }
    public function bloodbank()
    {
        $records = (object)$this->Admin_model->get_bloodbank_data();
        $this->load->view('Backend/Patient/bloodbank', compact('records'));
        // $this->load->view('Backend/Patient/bloodbank');
    }
    public function payroll()
    {
        $this->load->view('Backend/Patient/payroll');
    }
    public function message()
    {
        $data['doctors'] = (object)$this->Admin_model->get_doctors();
        $this->load->view('Backend/Patient/message', compact('data'));
    }
    public function get_combined_data()
    {
        $profile = $this->Admin_model->getpatientby_id($_SESSION['PROFILE_ID']);
        $login = $this->Admin_model->get_login_details($_SESSION['PROFILE_ID'], 'patient');
        $data = (object)array_merge((array)$profile, (array)$login);
        return $data;
    }
    public function profile()
    {
        $data = $this->get_combined_data();
        $data->birth_date = $this->getdesireddateformat($data->birth_date);
        $this->load->view('Backend/Patient/profile', compact('data'));
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
                $this->db->where('id', $_SESSION['ID'])->update('users', ['password' => $hash, 'online_status' => 0]);
                $this->db->where('id', $_SESSION['PROFILE_ID'])->update('patients', ['unhash_password' => $new_pass]);
                $session_data = array(
                    'ID',
                    'IDENTITY_WHO_LOGINS',
                    'LOGGED_IN',
                    'PROFILE_ID',
                    'cart_medicines',
                );
                $this->session->unset_userdata($session_data);
                $this->session->set_flashdata('failure', 'Password Changed!');
                redirect('index.php/home/login', 'refresh');
            } else {
                $this->session->set_flashdata('pass_error', 'Please Enter Valid Password');
                redirect('index.php/patient/profile', 'refresh');
            }
        } else {
            $data = $this->get_combined_data();
            $this->load->view('Backend/Patient/profile', compact('data'));
        }
    }
    public function update_profile()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|integer');
        $this->form_validation->set_rules('birth_date', 'Birth day', 'trim|required');
        $this->form_validation->set_rules('age', 'age', 'trim|required|integer');
        $this->form_validation->set_rules('gender', 'Appointment date', 'trim|required');
        $this->form_validation->set_rules('blood_group', 'Doctor', 'trim|required');
        if ($this->form_validation->run()) {

            $logo = $_FILES['icon']['name'];
            if ($logo == true) {
                $config['upload_path'] = './assets/uploads/patients/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('icon')) {
                    $data = $this->upload->data();
                    unset($_POST['old_img']);
                    $_POST['icon'] = base_url('assets/uploads/patients/' . $data['raw_name'] . $data['file_ext']);
                } else {
                    $upload_errors = $this->upload->display_errors();
                    $this->session->set_flashdata('upload_error', $upload_errors);
                    redirect('index.php/Patient/profile', 'refresh');
                }
            } else {
                $_POST['icon'] = $this->input->post('old_img');
                unset($_POST['old_img']);
            }
            //update patient email
            $this->db->where(['type' => 'patient', 'profile_id' => $_SESSION['PROFILE_ID']])->update('users', array('email' => $_POST['email']));
            unset($_POST['email']);
            //update patient tb
            $this->db->where('id', $_SESSION['PROFILE_ID'])->update('patients', $_POST);
            $this->session->set_flashdata('success', 'Patient Updated');
            redirect('index.php/patient/profile', 'refresh');
        } else {
            $data = $this->get_combined_data();
            $this->load->view('Backend/Patient/profile', compact('data'));
        }
    }
    public function addappointment()
    {
        $doctors = $this->Admin_model->get_doctors();
        $record = (object)[
            'time' => '',
            'date' => '',
            'doctor_id' => '',
        ];
        $this->load->view('Backend/Patient/forms/addappointment', compact('doctors', 'record'));
    }

    public function manage_appointment()
    {

         // this format is string comparable

        // echo date("Y M d", strtotime("19951012"));

        $current_date=date("Y-m-d");
        $user_date=date("Y-m-d", strtotime($_POST['date']));

        if($user_date==$current_date || $user_date>$current_date){
            $this->form_validation->set_rules('time', 'Appointment time', 'trim|required');
            $this->form_validation->set_rules('date', 'Appointment date', 'trim|required');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|required');
            if ($this->form_validation->run()) {
                $data = $_POST;
                $data['is_requested'] = 1;
                $data['patient_id'] = $_SESSION['PROFILE_ID'];
                $this->db->insert('appointments', $data);
                $this->session->set_flashdata('success', 'Your Appointment has been Created');
                redirect('index.php/Patient/requested_appointment', 'refresh');
            } else
                $this->addappointment();
        }
        else
        {
            $this->session->set_flashdata('date_error', 'Please Select Current Date or Next Date');
            redirect('index.php/Patient/addappointment', 'refresh');
        }
            
    }

    public function addprescription()
    {
        $this->load->view('Backend/Patient/forms/addprescription');
    }
    public function addhistory()
    {
        $this->load->view('Backend/Patient/forms/addhistory');
    }
    public function adddoctor()
    {
        $this->load->view('Backend/Patient/forms/adddoctor');
    }
    public function bloodbankstatus()
    {
        $this->load->view('Backend/Patient/bloodbankstatus');
    }
    public function basicreports()
    {
        $pid = $_SESSION['PROFILE_ID'];
        $this->db->select("*")->from("reports")->where('patient_id', $pid);
        $reports = $this->db->get()->result();
        $this->load->view('Backend/Patient/basicreports', compact('reports'));
    }
    public function diagnosisreports()
    {
        $pid = $_SESSION['PROFILE_ID'];
        $this->db->select("*")->from("diagnosis_reports")->where('patient_id', $pid);
        $reports = $this->db->get()->result();
        $this->load->view('Backend/Patient/diagnosisreports', compact('reports'));
    }

    public function fetch_report()
    {
        $report_id = $_POST['id'];
        $row = $this->Admin_model->getreportby_id($report_id);
        $report = $this->Admin_model->getreport_file_by_id($report_id);
        if (!empty($report)) {
            echo '<tr><td><span>' . basename($row->report_file_path) . '</span></td><td><a href="' . base_url('index.php/patient/download_other_report?file=' . $row->report_file_path) . '" class="btn btn-sm btn-success">Download</a></td></tr>';
        } else {
            echo "<tr><td colspan=2 class='text-danger'>No Reports Found!</td></tr>";
        }
    }
    public function download_other_report()
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
                redirect('index.php/patient/basicreports', 'refresh');
            }
        }
    }

    public function addoperationreport()
    {
        $this->load->view('Backend/Patient/forms/addoperationreport');
    }
    public function addbirthreport()
    {
        $this->load->view('Backend/Patient/forms/addbirthreport');
    }
    public function adddeathreport()
    {
        $this->load->view('Backend/Patient/forms/adddeathreport');
    }

    public function adddiagnosisreport()
    {
        $this->load->view('Backend/Patient/forms/adddiagnosisreport');
    }
    public function medication_history($pid = '')
    {
        $this->load->view('Backend/Patient/medicationhistory');
    }
    public function insert_msg()
    {
        $msg = $_POST['msg'];
        $did = $_POST['did'];
        $res = $this->db->insert('chats', ['patient_id' => $_SESSION['PROFILE_ID'], 'doctor_id' => $did, 'send_by' => 'patient', 'recieved_by' => 'doctor', 'msg' => $msg]);
        $inserted_id = $this->db->insert_id();
        if ($res) {
            $img = $this->Admin_model->getpatientby_id($_SESSION['PROFILE_ID'])->icon;
            $name = $this->Admin_model->getpatientby_id($_SESSION['PROFILE_ID'])->name;
            $created_at = $this->db->get_where('chats', array('id' => $inserted_id))->row()->created_at;
            echo '<div class="chat-message right">
                                        <img class="message-avatar" src="' . $img . '" alt="">
                                        <div class="message">
                                            <a class="message-author" href="#">' . $name . '</a>
                                            <span class="message-date">' . date("D M d Y - h:i:s A", strtotime($created_at)) . '</span>
                                            <span class="message-content">' . $msg . '</span>
                                        </div>
                                    </div>';
        }
    }
    public function get_doctor_chat()
    {
        $did = $_POST['did'];
        $msgs = $this->Admin_model->get_total_msgs_with_doctor($did);
        $html1 = '<input type="hidden" id="send_to_id" value="' . $did . '">';
        $html2 = '';
        if ($msgs > 0) {
            $this->Admin_model->set_msg_status_read_for_patient($did);
            $chats = $this->Admin_model->get_all_chat_with_doctor($did, $_SESSION['PROFILE_ID']);
            foreach ($chats as $chat) {
                $ordering = $chat->send_by == 'doctor' && $chat->recieved_by == 'patient' ? 'left' : 'right';
                if ($ordering == 'left') {
                    $img = $this->Admin_model->getdoctorby_id($chat->doctor_id)->icon;
                    $name = $this->Admin_model->getdoctorby_id($chat->doctor_id)->name;
                } else {
                    $img = $this->Admin_model->getpatientby_id($chat->patient_id)->icon;
                    $name = $this->Admin_model->getpatientby_id($chat->patient_id)->name;
                }
                $html2 .= '<div class="chat-message ' . $ordering . '">
                                        <img class="message-avatar" src="' . $img . '" alt="">
                                        <div class="message">
                                            <a class="message-author" href="#">' . $name . '</a>
                                            <span class="message-date">' . date("D M d Y - h:i:s A", strtotime($chat->created_at)) . '</span>
                                            <span class="message-content">' . $chat->msg . '</span>
                                        </div>
                                    </div>';
            }
            $html2 .= $html1;
            echo $html2;
        } else {
            $html2 .= '<div class="alert alert-danger">
                   Sorry! There is no Chat with that patient
                </div>';
            $html2 .= $html1;
            echo $html2;
        }
    }
    public function get_unread_msgs()
    {
        $did = $_POST['did'];
        $unread_msgs = $this->Admin_model->get_unread_msgs_for_patient($did);
        echo $unread_msgs;
    }
    public function reviewrating()
    {
        $this->load->view('Backend/patient/reviewrating');
    }
    public function doctor_profile()
    {
        if (isset($_GET['did']) && $_GET['did'] != '') {
            $doctor = (array)$this->Admin_model->getdoctorby_id($_GET['did']);
            $this->load->view('Backend/Patient/doctor_profile', compact('doctor'));
        } else {
            echo "Doctor Not Found";
        }
    }
    public function fetch_all_ratings()
    {
        $did = $_POST['did'];
        $ratings = $this->Admin_model->get_ratings_by_doctor_id($did);
        $html = '';
        if ($ratings) {
            foreach ($ratings as $rating) {
                $html .= '<div class="feed-element">
                                        <a href="#" class="pull-left">
                                            <img alt="image" class="img-circle img-responsive" src="' . $this->Admin_model->getpatientby_id($rating->patient_id)->icon . '">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right">
                                            <div class="rateYo" data-did="' . $rating->doctor_id . '" data-pid="' . $rating->patient_id . '"></div>
                                            </small>
                                            <strong>' . $this->Admin_model->getpatientby_id($rating->patient_id)->name . '</strong> posted feedback on <strong>' . $this->Admin_model->getdoctorby_id($rating->doctor_id)->name . '</strong> Profile. <br>
                                            <small class="text-muted">' . date("D M d Y - h:i:s A", strtotime($rating->created_at)) . '</small>
                                            <div class="well">' . $rating->review . '</div>
                                            <div class="pull-right">';
                if ($_SESSION['PROFILE_ID'] == $rating->patient_id) {
                    $html .= '<button data-toggle="modal" data-ddoctorid="' . $rating->doctor_id . '" data-target="#edtmodal" class="btn btn-xs btn-white edtrat"><i class="fa fa-thumbs-up"></i> Edit </button>';
                }
                $html .= '</div>
                                        </div>
                                    </div>';
            }
            echo $html;
        } else {
            echo "There are no Ratings and Feedbacks given to that Doctor";
        }
    }
    public function fetch_stars()
    {
        $row = $this->db->get_where('ratings', array('doctor_id' => $_POST['did'], 'patient_id' => $_POST['pid']))->row();
        echo $row->stars;
    }
    public function fetchalldoctors()
    {
        $doctors = (array)$this->Admin_model->get_doctors();
        $html = '';
        foreach ($doctors as $doctor) {
            $html .= '<div class="col-lg-3">
            <div class="contact-box center-version">
                <a href="doctor_profile?did=' . $doctor->id . '">
                    <img alt="image" class="img-circle" src="' . $doctor->icon . '">
                    <h3 class="m-b-xs"><strong>' . $doctor->name . '</strong></h3>
                    <div class="font-bold">Doctor</div>
                    <address class="m-t-sm">
                        <center>
                            <div class="m-b-sm avg-rating rateYo" data-did="' . $doctor->id . '"></div>
                        </center>
                        <p style="margin: 0px;">' . $doctor->address . '</p>
                        <br>
                        <abbr title="Phone">P:</abbr>' . $doctor->phone . '
                    </address>
                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">';
            if ($this->Admin_model->check_add_review_btn($_SESSION['PROFILE_ID'], $doctor->id) == 1) {
                $html .= '<a class="btn btn-warning edtrat" data-toggle="modal" data-target="#edtmodal" data-ddoctorid="' . $doctor->id . '">Edit Review & Rating</a>';
            } else {
                $html .= '<a class="btn btn-primary addrat" data-ddoctorid="' . $doctor->id . '" data-toggle="modal" data-target="#myModal">Add Review & Rating</a>';
            }
            $html .= '</div>
                </div>
            </div>
        </div>';
        }
        echo $html;
    }

    public function fetch_avg_rating()
    {
        $did = $_POST['did'];
        $query = $this->db->query("SELECT AVG(stars) AS average_stars from ratings where doctor_id=" . $did);
        $stars = $query->result()[0]->average_stars;
        if ($stars != NULL) {
            echo $stars;
        } else {
            echo 0;
        }
    }
    public function fetch_stars2()
    {
        $row = $this->db->get_where('ratings', array('doctor_id' => $_POST['did'], 'patient_id' => $_SESSION['PROFILE_ID']))->row();
        echo json_encode(['stars' => $row->stars, 'feedback' => $row->review]);
    }
    public function setstars()
    {
        $did = $_POST['did'];
        $rating = $_POST['rating'];
        $pid = $_SESSION['PROFILE_ID'];
        //check if patient already give rating then update
        $query = $this->db->query("SELECT * FROM `ratings` where doctor_id='{$did}' && patient_id='{$pid}'");
        if ($query->num_rows() == 1) {
            //update rating
            $res = $this->db->where(['patient_id' => $pid, 'doctor_id' => $did])->update('ratings', array('stars' => $rating));
            if ($res) {
                echo "Rating Updated!";
            }
        } else {
            //add rating
            $res = $this->db->insert('ratings', ['patient_id' => $pid, 'doctor_id' => $did, 'stars' => $rating]);
            if ($res) {
                echo "Rating Added!";
            }
        }
    }
    public function addfeedback()
    {
        $did = $_POST['did'];
        $pid = $_SESSION['PROFILE_ID'];
        $feedback = $_POST['feedback'];
        //check if patient already give feedback then update else add
        $query = $this->db->query("SELECT * FROM `ratings` where doctor_id='{$did}' && patient_id='{$pid}'");
        if ($query->num_rows() == 1) {
            //update feedback
            $res = $this->db->where(['patient_id' => $pid, 'doctor_id' => $did])->update('ratings', array('review' => $feedback));
            if ($res) {
                echo "Feedback Updated!";
            } else {
                echo "Feedback Not Updated!";
            }
        } else {
            //add feedback
            $res = $this->db->insert('ratings', ['patient_id' => $pid, 'doctor_id' => $did, 'review' => $feedback]);
            if ($res) {
                echo "Feedback Added!";
            } else {
                echo "Feedback Not Added";
            }
        }
    }

    public function fetch_doc_profile()
    {
        if (isset($_POST['did']) && $_POST['did'] != '') {
            $doctor = (array)$this->Admin_model->getdoctorby_id($_POST['did']);
            if (!empty($doctor)) {
                $html = '';
                $html .= '<div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Profile Detail</h5>
                                </div>
                                <div>
                                    <div class="ibox-content no-padding border-left-right">
                                        <img alt="image" class="img-responsive" src="' . $doctor['icon'] . '">
                                    </div>
                                    <div class="ibox-content profile-content">
                                        <h4><strong>' . $doctor['name'] . '</strong></h4>
                <p><i class="fa fa-map-marker"></i> ' . $doctor['address'] . '</p>
                <div id="rateYoavg"></div>
                <div class="row m-t-lg">
                    <div class="col-md-4">
                        <h5>
                            <strong>' . $this->Admin_model->get_diagnosis_reports_by_doctor($doctor['id']) . '</strong>
                            Diagnosis</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>
                            <strong>' . $this->Admin_model->get_prescriptions_by_doctor($doctor['id']) . '</strong>
                            Prescription</h5>
                    </div>
                    <div class="col-md-4">
                        <h5><strong>' . $this->Admin_model->get_doctor_feedbacks($doctor['id']) . '</strong>
                            Feedbacks</h5>
                    </div>
                </div>
                <div class="user-button">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="' . site_url("index.php/patient/message") . '">
                                <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                        class="fa fa-envelope"></i> Send Message
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">';
                $btn = '';
                if ($this->Admin_model->check_add_review_btn($_SESSION['PROFILE_ID'], $doctor['id']) == 1) {
                    $btn .= '<button type="button" data-toggle="modal" data-target="#edtmodal" data-ddoctorid="' . $doctor['id'] . '" class="btn btn-warning btn-sm btn-block edtrat"><i class="fa fa-coffee"></i> Edit Review & Rating</button>';
                } else {
                    $btn .= '<button type="button" data-ddoctorid="' . $doctor['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm btn-block addrat"><i class="fa fa-coffee"></i> Add Review & Rating</button>';
                }
                $html .= $btn;
                $html .= '</div>
                    </div>
                </div>
                </div>
                </div>
                </div>';
            } else {
                $html = "Doctor Profile does not Exists";
            }
            echo $html;
        }
    }
    public function buymedicines()
    {
        $this->load->view('Backend/Patient/buymedicines');
    }
    public function render_medicines()
    {
        $medicines = $this->Admin_model->get_medicines_by_name($_POST['medicine']);
        if (count($medicines) > 0) {
            $html = '';
            foreach ($medicines as $medicine) {
                $html .= '<div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation" >
                            <h1 class="text-danger">' . $medicine->name . '</h1>
                        </div>
                        <div class="product-desc">
                            <span class="product-price">
                                 ' . $this->Admin_model->get_system_settings()->system_currency . ' ' . $medicine->price . '
                            </span>
                            <small class="text-muted">Category</small>
                            <a href="#" class="product-name">' . $this->Admin_model->getmedicinecategoryby_id($medicine->category_id)->medicine_category_name . '</a>
                            <div class="small m-t-xs">
                                ' . $medicine->description . '
                            </div>
                            <div class="m-t text-righ">
                            <form class="form-inline" action="">
                                <div class="form-group" style="display: flex;
                                justify-content: center;">
                                    <input type="number" autocomplete="off" class="form-control qtyMedicine">
                                    <button type="submit" data-medicine_id="' . $medicine->id . '" class="btn btn-secondary addcartbtn">Add to Cart</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
            echo $html;
        } else {
            echo '<div class="col-12">
                <h1 style="margin:30px;">Sorry ! No Medicines</h1>
            </div>';
        }
    }
    public function render_all_medicines()
    {
        $medicines = $this->Admin_model->get_medicines();
        if (count($medicines) > 0) {
            $html = '';
            foreach ($medicines as $medicine) {
                $html .= '<div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation" >
                            <h1 class="text-danger">' . $medicine->name . '</h1>
                        </div>
                        <div class="product-desc">
                            <span class="product-price">
                                 ' . $this->Admin_model->get_system_settings()->system_currency . ' ' . $medicine->price . '
                            </span>
                            <small class="text-muted">Category</small>
                            <a href="#" class="product-name">' . $this->Admin_model->getmedicinecategoryby_id($medicine->category_id)->medicine_category_name . '</a>
                            <div class="small m-t-xs">
                                ' . $medicine->description . '
                            </div>
                            <div class="small m-t-xs">
                                <span style="font-weight:600;">Available Quantity</span>&nbsp;&nbsp' . $medicine->qty . '
                            </div>';
                if ($medicine->qty == 0) {
                    $html .= '<div class="small m-t-xs">
                                <span style="font-weight:200;" class="text-danger">Out of Stock</span>
                                </div>';
                }
                $html .= '<div class="m-t text-righ">
                            <form class="form-inline" action="">
                                <div class="form-group" style="display: flex;
                                justify-content: center;">
                                    <input type="number" autocomplete="off" class="form-control qtyMedicine">
                                    <button type="submit" data-medicine_id="' . $medicine->id . '" class="btn btn-secondary addcartbtn">Add to Cart</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
            echo $html;
        } else {
            echo '<div class="col-12">
                <h1 style="margin:30px;">Sorry ! No Medicines</h1>
            </div>';
        }
    }

    public function addtocart()
    {
        $medicine_id = $_POST['med_id'];
        $qty = $_POST['qty'];
        //checking medicine total_qty
        $total_qty = $this->Admin_model->getmedicineby_id($medicine_id)->qty;
        if ($total_qty == 0) {
            echo "Medicine Out of Stock Not Added to Cart";
        } else if ($qty > $total_qty) {
            echo "Can't added to Cart! Your Quantity must be less than " . $total_qty;
        } else {
            $cart_data = array(
                'medicine_id' => $medicine_id,
                'qty' => $qty,
            );
            $_SESSION['cart_medicines'][$medicine_id] = $cart_data;
            echo $cart_data['qty'] . " Medicines added to Cart";
        }
    }

    public function refresh_cart()
    {
        if (isset($_SESSION['cart_medicines'])) {
            echo count($_SESSION['cart_medicines']);
        } else {
            echo 0;
        }
    }

    public function cart()
    {
        $this->load->view('Backend/Patient/cart');
    }

    public function get_carted_items()
    {
        if (isset($_SESSION['cart_medicines']) && count($_SESSION['cart_medicines']) > 0) {
            $items = count($_SESSION['cart_medicines']);
            $html = '<div class="ibox">
            <div class="ibox-title">
                <span class="pull-right">(<strong>' . $items . '</strong>) items</span>
                <h5>Items in your cart</h5>
            </div>';
            foreach ($_SESSION['cart_medicines'] as $carted_item) {
                $html .= '<div class="ibox-content ibox-' . $carted_item['medicine_id'] . '">
                <div class="table-responsive">
                    <table class="table shoping-cart-table">
                        <tbody>
                        <tr>
                            <td width="90">
                                <div class="cart-product-imitation">
                                </div>
                            </td>
                            <td class="desc">
                                <h3>
                                <a href="#" class="text-navy">
                                    ' . $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->name . '
                                </a>
                                </h3>
                                <p class="small">
                                    ' . $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->description . '
                                </p>
                                <div class="m-t-sm">
                                    <a href="#" data-mid="' . $carted_item['medicine_id'] . '" class="text-muted remcart"><i class="fa fa-trash"></i> Remove item</a>
                                </div>
                            </td>
                            <td>
                                ' . $this->Admin_model->get_system_settings()->system_currency . ' ' . $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->price . '
                            </td>
                            <td width="65">
                                <input type="text" class="form-control" placeholder="' . $carted_item['qty'] . '">
                            </td>
                            <td>
                                <h4>
                                    ' . $this->Admin_model->get_system_settings()->system_currency . ' ' . $carted_item['qty'] * $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->price . '
                                </h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>';
            }

            $html .= '<div class="ibox-content">

            <a href="' . site_url('index.php/patient/checkout') . '"><button class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button></a>
            <a href="' . site_url('index.php/patient/buymedicines') . '"><button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button></a>

        </div>';
            echo $html;
        } else {
            echo '<div class="alert alert-warning"><strong>No Medicines In Cart</strong>
          </div>';
        }
    }
    public function rm_cart()
    {
        $mid = $_POST['mid'];
        unset($_SESSION['cart_medicines'][$mid]);
        echo "Medicine Removed from Cart";
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
                redirect('index.php/Patient/prescription', 'refresh');
            }
        }
    }
    public function finddiagnosis()
    {
        $pid = $_POST['id'];
        $diagnosis = $this->Admin_model->get_diagnosis_reports_of_patients($pid);
        $count = count($diagnosis);
        if ($count > 0) {
            foreach ((object)$diagnosis as $diagnos) {
                echo '<table class="table table-bordered table-striped dataTable" id="table-2">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Report Type</th>
                                                                <th>Document Type</th>
                                                                <th>Description</th>
                                                                <th>Options</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>' . $diagnos->date . ' ' . $diagnos->time . '</td>
                                                                <td>' . $diagnos->report_type . '</td>
                                                                <td>' . $diagnos->report_file_type . '</td>
                                                                <td>' . $diagnos->description . '</td>
                                                                <td>
                                                                    <a href="' . base_url('index.php/patient/download_report?file=' . $diagnos->report_file) . '" class="btn btn-info">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>';
            }
        } else {
            echo '<div class="alert alert-warning">
                        <p class="text-danger">No Diagnosis Report Exits!</p>
                </div>';
        }
    }
    public function findprescription()
    {
        $id = $_POST['id'];
        $prescription = (object)$this->Admin_model->getprescriptionby_id($id);
        $doctor=$prescription->doctor_id==-1 ? 'Doctor Not Exists' : $this->Admin_model->getdoctorby_id($prescription->doctor_id)->name;
        echo '<div id="prescription_print">
                <table width="100%" border="0">
                    <tbody>
                        <tr>
                            <td align="left" valign="top"> Patient Name: ' . $this->Admin_model->getpatientby_id($prescription->patient_id)->name
            . '<br> Age: ' . $this->Admin_model->getpatientby_id($prescription->patient_id)->age . '
                                <br> Gender: ' . $this->Admin_model->getpatientby_id($prescription->patient_id)->gender . '
                                <br> </td>
                            <td align="right" valign="top"> Doctor Name: ' . $doctor . '
                                <br> Date: ' . date('F j, Y', strtotime($prescription->date)) . '
                                <br> Time: ' . date('h:i:s a', strtotime($prescription->time)) . '
                                <br> </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-body"> <b>Case History :</b>
                                <p>' . $prescription->case_history . '</p>
                                <hr> <b>Medication :</b>
                                <p>' . $prescription->meditation . '</p>
                                <hr> <b>Note :</b>
                                <p>' . $prescription->note . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
    public function fetch_cart_summary()
    {
        if (isset($_SESSION['cart_medicines']) && count($_SESSION['cart_medicines']) > 0) {
            $sum = 0;
            $total_price = 0;
            foreach ($_SESSION['cart_medicines'] as $carted_item) {
                $total_price = $carted_item['qty'] * $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->price;
                $sum = $sum + $total_price;
            }
            echo '<div class="ibox">
            <div class="ibox-title">
                <h5>Cart Summary</h5>
            </div>
            <div class="ibox-content">
                <span>
                    Total
                </span>
                <h2 class="font-bold">
                    ' . $this->Admin_model->get_system_settings()->system_currency . ' ' . $sum . '
                </h2>
                <hr />
                <span class="text-muted small">
                    *For Pakistan applicable sales tax will be applied
                </span>
                <div class="m-t-sm">
                    <div class="btn-group">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                    </div>
                </div>
            </div>
        </div>';
        } else {
            echo "";
        }
    }

    public function get_doctor_details()
    {
        $did = $_POST['did'];
        $email = $this->Admin_model->get_doctor_email($did)->email;
        $doctor = $this->Admin_model->getdoctorby_id($did);
        echo '<div class="row">
        <div class="col-sm-3">

            <a href="#" class="profile-picture">
                <img src="' . $doctor->icon . '" class="img-responsive img-circle">
            </a>

        </div>

        <div class="col-sm-9" style="display: flex; align-items: center; height: 100px;">

            <h3>' . $doctor->name . '</h3>

        </div>
    </div>
    <div>
        <br>
        <table class="table table-bordered">

            <tbody>
                <tr>
                    <td>Email</td>
                    <td><b>' . $email . '</b></td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td><b>' . $doctor->address . '</b></td>
                </tr>

                <tr>
                    <td>Phone</td>
                    <td><b>' . $doctor->phone . '</b></td>
                </tr>

                <tr>
                    <td>
                    <button class="btn btn-sm btn-success"><i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp;&nbsp;Facebook</button>
                    </td>
                    <td><b>' . $doctor->fb_link . '</b></td>
                </tr>

                <tr>
                    <td>
                    
                    <button class="btn btn-sm btn-primary"><i class="fa fa-twitter-square" aria-hidden="true"></i>&nbsp;&nbsp;Twitter</button>
                    
                    
                    </td>
                    <td><b>' . $doctor->twitter_link . '</b></td>
                </tr>
                <tr>
                    <td><button class="btn btn-sm btn-warning"><i class="fa fa-google-plus" aria-hidden="true"></i>
                    
                    &nbsp;&nbsp;Google +</button>
                    </td>
                    <td><b>' . $doctor->googleplus_link . '</b></td>
                </tr>
                <tr>
                    <td><button class="btn btn-sm btn-info"><i class="fa fa-linkedin" aria-hidden="true"></i>
                    
                    &nbsp;&nbsp;Linked In</button></td>
                    <td><b>' . $doctor->Linkedin_link . '</b></td>
                </tr>

            </tbody>
        </table>
    </div>';
    }
    public function getbill()
    {
        $sum = 0;
        $total_price = 0;
        foreach ($_SESSION['cart_medicines'] as $carted_item) {
            $total_price = $carted_item['qty'] * $this->Admin_model->getmedicineby_id($carted_item['medicine_id'])->price;
            $sum = $sum + $total_price;
        }
        return $sum + $this->Admin_model->get_system_settings()->standard_shipping_fee;
    }
    public function makepayment()
    {
        if (isset($_POST['stripeToken'])) {
            $order_id = $_GET['order_id'];
            \Stripe\Stripe::setVerifySslCerts(false); // restricting not to check website ssl
            $token = $_POST['stripeToken'];
            $data = \Stripe\Charge::create(array(
                "amount" => $this->Admin_model->gettotalcharges($order_id) * 100,
                "currency" => strtolower($this->Admin_model->get_sys_settings()->system_currency),
                "description" => $this->Admin_model->get_system_settings()->system_title,
                "source" => $token,
            ));
            if ($data->status == 'succeeded') {
                // change availble medicine qty e.g change qty in medicines table
                $data = [];
                $data = $this->db->get_where('orders', array('order_detail_id' => $order_id))->result();
                foreach ($data as $orderedmedicine) {
                    $total_qty = $this->Admin_model->getmedicineby_id($orderedmedicine->medicine_id)->qty;
                    $sold_qty = $this->Admin_model->getmedicineby_id($orderedmedicine->medicine_id)->sold_qty;
                    $this->db->where('id', $orderedmedicine->medicine_id)->update('medicines', ['qty' => $total_qty - $orderedmedicine->qty, 'sold_qty' => $sold_qty + $orderedmedicine->qty]);
                }
                $this->db->where('id', $order_id)->update('order_details', ['payment_status' => 1, 'pay_with_card' => 1]);
                $this->session->set_flashdata('success', 'Payment Succeeded Your Order will be delivered Soon!');
            } else {
                $this->db->where('id', $order_id)->update('order_details', ['payment_status' => 1]);
                $this->session->set_flashdata('success', 'Sorry Something went Wrong!');
            }
            return redirect('index.php/patient/orderdetails?orderid=' . $order_id);
        }
    }
    public function cash_on_delivery()
    {
        $order_id = $_GET['order_id'];
        $data = [];
        $data = $this->db->get_where('orders', array('order_detail_id' => $order_id))->result();
        foreach ($data as $orderedmedicine) {
            $total_qty = $this->Admin_model->getmedicineby_id($orderedmedicine->medicine_id)->qty;
            $sold_qty = $this->Admin_model->getmedicineby_id($orderedmedicine->medicine_id)->sold_qty;
            $this->db->where('id', $orderedmedicine->medicine_id)->update('medicines', ['qty' => $total_qty - $orderedmedicine->qty, 'sold_qty' => $sold_qty + $orderedmedicine->qty]);
        }
        $this->db->where('id', $order_id)->update('order_details', ['cash_on_delivery' => 1, 'payment_method' => '']);
        $this->session->set_flashdata('success', 'We will get Cash from You on Delivery!');
        return redirect('index.php/patient/orderdetails?orderid=' . $order_id);
    }
    public function placeorder()
    {
        $this->form_validation->set_rules('shipping_address', 'Shipping Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('zip', 'Zip Code', 'trim|required|integer|min_length[4]|max_length[10]');
        if ($this->form_validation->run()) {
            $_POST['patient_id'] = $_SESSION['PROFILE_ID'];
            // $_POST['total_charge']=$this->getbill();
            if ($this->db->insert('order_details', $_POST)) {
                $insert_id = $this->db->insert_id();
                if ($this->insert_cart_porducts($insert_id)) {
                    unset($_SESSION['cart_medicines']);
                    $this->session->set_flashdata('success', 'Order Created Successfully!');
                    redirect('index.php/patient/orders', 'refresh');
                }
            } else {
                $this->session->set_flashdata('success', 'Order Not Created!');
                redirect('index.php/patient/orders', 'refresh');
            }
        } else {
            $this->checkout();
        }
    }
    public function insert_cart_porducts($order_details_id)
    {
        $data = [];
        foreach ($_SESSION['cart_medicines'] as $carted_item) {
            $data = array(
                'order_detail_id' => $order_details_id,
                'medicine_id' => $carted_item['medicine_id'],
                'qty' => $carted_item['qty'],
            );
            $this->db->insert('orders', $data);
        }
        return 1;
    }
    public function orders()
    {
        $orders = $this->Admin_model->orders($_SESSION['PROFILE_ID']);
        $this->load->view('Backend/Patient/orders', compact('orders'));
    }
    public function orderdetails()
    {
        $oid = $_GET['orderid'];
        $orders = $this->Admin_model->getorderby_id($oid);
        $orderMedicines = $this->Admin_model->get_ordered_medicines($oid);
        $this->load->view('Backend/Patient/orderdetails', compact('orders', 'orderMedicines'));
    }
    public function delete_order()
    {
        if ($this->db->delete('orders', array('id' => $_GET['oid']))) {
            $order_detail_id = $_GET['order_detail_id'];
            $child_orders = $this->db->select("*")->from("orders")->where(['order_detail_id' => $order_detail_id])->get()->result();
            // check if no order exists for order_details then return view to orders Page
            if (count($child_orders) > 0) {
                $this->session->set_flashdata('success', 'Medicine Successfully deleted from Orders');
                return redirect('index.php/patient/orderdetails?orderid=' . $order_detail_id, 'refresh');
            } else {
                $this->db->delete('order_details', array('id' => $order_detail_id));
                $this->session->set_flashdata('success', 'No Orders Exists Please Make Order First!');
                return redirect('index.php/patient/orders', 'refresh');
            }
        }
    }
    public function delete_Order_details()
    {
        if ($this->db->delete('order_details', array('id' => $_GET['id']))) {
            $this->db->delete('orders', array('order_detail_id' => $_GET['id']));
            $this->session->set_flashdata('success', 'Order Deleted Successfully!');
            return redirect('index.php/patient/orders', 'refresh');
        }
        echo "Ahtesham";
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
