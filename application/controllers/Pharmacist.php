<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pharmacist extends CI_Controller
{
     public function __construct()
     {
          Parent::__construct();
          $this->load->helper('url');
          $this->load->database();
          $this->load->model('Admin_model');
          $this->load->model('Pharmacist_model');
          $this->load->model('Admin_model', 'admin');
          if (!isset($_SESSION['IDENTITY_WHO_LOGINS']) && !isset($_SESSION['LOGGED_IN']) && !isset($_SESSION['ID'])) {
               $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
               redirect('index.php/home/login', 'refresh');
          } else if ($_SESSION['IDENTITY_WHO_LOGINS'] != "pharmacist") {
               $this->session->set_flashdata('failure', 'Access Denied ! Please Log In First!');
               redirect('index.php/home/login', 'refresh');
          }
     }
     public function dashboard()
     {
          $data=(object)[
			'medicines'=>$this->Admin_model->countmedicines(),
			'order_medicines'=>$this->Admin_model->countordermedicines(),
			'delivered_medicines'=>$this->Admin_model->countdeliveredmedicines(),
               'total_Sales_income'=>$this->Admin_model->total_sales_income(),
	   ];
		$this->load->view('Backend/Pharmacist/dashboard' ,compact('data'));
     }

     public function addmedicinecategory($flag = '', $id = 0)
     {
          // $data['categories'] = (object)$this->Pharmacist_model->get_medicines_categories();
          if ($flag == '') {
               $record = (object)[
                    'medicine_category_name' => '',
                    'medicine_category_description' => '',
               ];
          } else if ($flag == 'update') {
               $record = $this->admin->getmedicinecategoryby_id($id);
          }
          $this->load->view('Backend/Pharmacist/forms/addmedicinecategory', compact('record'));
     }


     public function form_validation()
     {
          if (isset($_POST['hidden_id'])) {
               $this->form_validation->set_rules("status", "Medicine status", 'required|trim');
          }
          $this->load->library('form_validation');
          $this->form_validation->set_rules("medicine_category_name", "Medicine Category Name", 'required');
          $this->form_validation->set_rules("medicine_category_description", "Medicine Category Description", 'required');
          if ($this->form_validation->run()) {
               if (isset($_POST['hidden_id'])) {
                    $this->update_medicine_category();
               } else {

                    $this->insert_medicine_category();
               }
          } else {
               $this->addmedicinecategory();
          }
     }
     public function inserted_medicine_category()
     {
          $this->medicinecategory();
     }
     public function insert_medicine_category()
     {
          $data = $this->input->post();
          if ($this->db->insert('medicine_category', $data)) {
               $this->session->set_flashdata('success', $data['medicine_category_name'] . ' Added to your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Category Not Added to your System');
          }
          redirect('index.php/Pharmacist/medicinecategory', 'refresh');
     }
     public function medicinecategory()
     {
          $medicines_category = $this->Pharmacist_model->get_medicines_category();
          $this->load->view("Backend/Pharmacist/medicinecategory", compact('medicines_category'));
     }
     public function delete_medicine_category($id)
     {
          if ($this->db->delete('medicine_category', array('id' => $id))) {
               $this->session->set_flashdata('success', 'Medicine Category Deleted in your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Category Not Deleted in your System');
          }
          redirect('index.php/Pharmacist/medicinecategory', 'refresh');
     }
     public function update_medicine_category()
     {
          $data = $this->input->post();
          $id = $data['hidden_id'];
          unset($data['hidden_id']);
          if ($this->db->where('id', $id)->update('medicine_category', $data)) {
               $this->session->set_flashdata('success', $data['medicine_category_name'] . ' Updated in your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Not Updated in your System');
          }
          redirect('index.php/Pharmacist/medicinecategory', 'refresh');
     }
     public function updated()
     {
          $this->medicinecategory();
     }

     //----------------------------------------------------//
     //-------------- Manage Medicine --------------------//

     public function managemedicine()
     {
          $medicines = $this->Pharmacist_model->get_medicines();
          $this->load->view("Backend/Pharmacist/medicines/managemedicine", compact('medicines'));
     }
     public function addmedicine($flag = '', $id = 0)
     {
          $data['categories'] = (object)$this->Pharmacist_model->get_medicines_categories();
          if ($flag == '') {
               $record = (object)[
                    'name' => '',
                    'category_id' => '',
                    'description' => '',
                    'price' => '',
                    'qty' => '',
                    'company' => '',
                    'status' => -1,
               ];
          } else if ($flag == 'update') {
               $record = $this->admin->getmedicineby_id($id);
          }
          $this->load->view('Backend/Pharmacist/forms/addmedicine', compact('data', 'record'));
     }
     public function form_validation_medicine()
     {
          if (isset($_POST['hidden_id'])) {
               $this->form_validation->set_rules("status", "Medicine status", 'required|trim');
          }
          $this->form_validation->set_rules("name", "Medicine Name", 'required|trim');
          $this->form_validation->set_rules("description", "Medicine Description", 'required|trim');
          $this->form_validation->set_rules("category_id", "Medicine Category", 'required|trim');
          $this->form_validation->set_rules("price", "Price", 'required|trim|integer');
          $this->form_validation->set_rules("qty", "Total Quantity", 'required|trim|integer');
          $this->form_validation->set_rules("company", "Manufacturing Company", 'required|trim');
          if ($this->form_validation->run()) {
               if (isset($_POST['hidden_id'])) {
                    $this->update_medicine();
               } else {

                    $this->insert_medicine();
               }
          } else {
               $this->addmedicine();
          }
     }

     public function insert_medicine()
     {
          $data = $this->input->post();
          if ($this->db->insert('medicines', $data)) {
               $this->session->set_flashdata('success', $data['name'] . ' Added to your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Not Added to your System');
          }
          redirect('index.php/Pharmacist/managemedicine', 'refresh');
     }

     public function update_medicine()
     {
          $data = $this->input->post();
          $id = $data['hidden_id'];
          unset($data['hidden_id']);
          if ($this->db->where('id', $id)->update('medicines', $data)) {
               $this->session->set_flashdata('success', $data['name'] . ' Updated in your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Not Updated in your System');
          }
          redirect('index.php/Pharmacist/managemedicine', 'refresh');
     }

     public function inserted_medicine()
     {
          $this->managemedicine();
     }
     public function del_medicine($id)
     {
          if ($this->db->delete('medicines', array('id' => $id))) {
               $this->session->set_flashdata('success', 'Medicine Deleted in your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Not Deleted in your System');
          }
          redirect('index.php/Pharmacist/managemedicine', 'refresh');
     }

     //--------------------------------------------------//
     //-------------- Medicine Sales --------------------//

     public function medicinesales()
     {
          $this->load->view("Backend/Pharmacist/medicines/medicinesales",['medicines'=>$this->Pharmacist_model->get_medicines()]);
     }
     public function addmedicinesale()
     {
          $this->load->view('Backend/Pharmacist/forms/addmedicinesale');
     }
     public function addmedicinesales($flag = '', $id = 0)
     {
          if ($flag == '') {
               $record = (object)[
                    'medicine_sales_name' => '',
                    'total_price' => '',
                    'patient_name' => '',
               ];
          } else if ($flag == 'update') {
               $record = $this->admin->getmedicinesalesby_id($id);
          }
          $this->load->view('Backend/Pharmacist/forms/addmedicinesales', compact('record'));
     }
     public function form_validation_sales()
     {
          $this->load->library('form_validation');
          $this->form_validation->set_rules("medicine_sales_name", "Medicine Sales Name", 'required');
          $this->form_validation->set_rules("total_price", "Total Price", 'required');
          $this->form_validation->set_rules("patient_name", "Patient Name", 'required');
          if ($this->form_validation->run()) {
               if (isset($_POST['hidden_id'])) {
                    $this->update_medicine_sales();
               } else {

                    $this->insert_medicine_sales();
               }
          } else {
               $this->addmedicinesales();
          }
     }
     public function insert_medicine_sales()
     {
          $data = $this->input->post();
          if ($this->db->insert('medicine_sales', $data)) {
               $this->session->set_flashdata('success', $data['medicine_sales_name'] . ' Added to your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Sales Not Added to your System');
          }
          redirect('index.php/Pharmacist/medicinesales', 'refresh');
     }
     public function delete_medicine_sales($id)
     {
          if ($this->db->delete('medicine_sales', array('id' => $id))) {
               $this->session->set_flashdata('success', 'Medicine Sales Deleted in your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Sales Not Deleted in your System');
          }
          redirect('index.php/Pharmacist/medicinesales', 'refresh');
     }
     public function update_medicine_sales()
     {
          $data = $this->input->post();
          $id = $data['hidden_id'];
          unset($data['hidden_id']);
          if ($this->db->where('id', $id)->update('medicine_sales', $data)) {
               $this->session->set_flashdata('success', $data['medicine_sales_name'] . ' Updated in your System');
          } else {
               $this->session->set_flashdata('success', 'Medicine Sales Not Updated in your System');
          }
          redirect('index.php/Pharmacist/medicinesales', 'refresh');
     }

     //----------------------------------------//

     public function payroll()
     {
          $this->load->view('Backend/Pharmacist/payroll');
     }
     public function profile()
     {
          $record = (object)array_merge((array)$this->admin->getpharmacistby_id($_SESSION['PROFILE_ID']), (array)$this->admin->getuserby_id($_SESSION['ID']));
          $this->load->view('Backend/Pharmacist/profile', compact('record'));
     }

     public function manage_profile()
     {
          $old_img_path = $this->input->post('prev_img');
          $post = $this->input->post();
          $logo = $_FILES['file']['name'];
          if ($logo != '') {
               $config['upload_path']          = './assets/uploads/pharmacists/';
               $config['allowed_types']        = 'gif|jpg|png|jpeg';
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $post['icon'] = base_url('assets/uploads/pharmacists/' . $data['raw_name'] . $data['file_ext']);
               } else {
                    $upload_errors = $this->upload->display_errors();
                    return redirect('index.php/pharmacist/profile?upload_error=' . $upload_errors);
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
               if ($this->admin->update_pharma_profile($post)) {
                    $this->session->set_flashdata('success', 'Pharmacist Profile Updated');
               } else {
                    $this->session->set_flashdata('success', 'Pharmacist Profile Not Updated');
               }
               return redirect('index.php/pharmacist/profile');
          } else {
               $this->load->view('Backend/Pharmacist/profile');
          }
     }

     public function edit_pass()
     {
          $this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required|min_length[4]');
          $this->form_validation->set_rules('new_pass', 'Password', 'trim|required|min_length[4]');
          $this->form_validation->set_rules('conf_pass', 'Password Confirmation', 'required|matches[new_pass]');
          $record = (object)array_merge((array)$this->admin->getpharmacistby_id($_SESSION['PROFILE_ID']), (array)$this->admin->getuserby_id($_SESSION['ID']));
          
          if ($this->form_validation->run() == FALSE) {
               $this->load->view('Backend/Pharmacist/profile', compact('record'));
          }
          else{
               $chk = password_verify($_POST['old_pass'], $this->admin->get_row_by_id()->password);
               if ($chk)
                    $this->change_pass($_POST['new_pass']);
               else {
                    $this->session->set_flashdata('form_err_msg', 'Please Enter Valid Password');
                    redirect('index.php/pharmacist/profile', 'refresh');
               }
          }
     }
     public function change_pass($pass)
    {
        $data = array(
            'password' => password_hash($pass,PASSWORD_DEFAULT),
            'online_status'=>0,
        );
        $res = $this->db->where('id', $_SESSION['ID'])->update('users', $data) && $this->db->where('id', $_SESSION['PROFILE_ID'])->update('pharmacists', ['unhash_password' => $pass]);
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
    public function orders()
    {
         $this->load->view('Backend/Pharmacist/medicines/orders',['orders'=>$this->Pharmacist_model->get_all_orders()]);
    }
    public function orderdetails($oid=0)
    {
          $ordersInfo = $this->Admin_model->getorderby_id($oid);
          $orderMedicines = $this->Admin_model->get_ordered_medicines($oid);
          $this->load->view('Backend/Pharmacist/medicines/orderdetails', compact('ordersInfo', 'orderMedicines'));
    }
    public function change_delivery_status()
    {
         $status=$_POST['status'];
         $oid=$_POST['orderId'];
         if($this->db->where('id', $oid)->update('order_details',['delivery_status'=>$status]))
               echo 1;
          else
               echo 0;
    }
    public function change_payment_status()
    {
         $status=$_POST['status'];
         $oid=$_POST['orderId'];
         if($this->db->where('id', $oid)->update('order_details',['payment_status'=>$status]))
               echo 1;
          else
               echo 0;
    }
    
}
