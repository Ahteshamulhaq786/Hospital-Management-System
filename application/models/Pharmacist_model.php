<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pharmacist_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
    //--------------------------------------------------------------//
    public function get_medicines_category()
    {
            $this->db->select("*")->from("medicine_category");
            $query = $this->db->get();        	   
            return $query->result();
    }
    public function insert_medicine_category($data)
    {
        $this->db->insert("medicine_category", $data);
    }
    public function fetch_medicine_category()
    { 
           $this->db->select("*");  
           $this->db->from("medicine_category");  
           $query = $this->db->get();  
           return $query;
    }
    function delete_medicine_category_data($id){  
        $this->db->where("id", $id);  
        $this->db->delete("medicine_category");
   }
   function fetch_single_data($id)  
      {  
           $this->db->where("id", $id);  
           $query = $this->db->get("medicine_category");  
           return $query;   
      }  
      function update_medicine_category_data($data, $id)  
      {  
           $this->db->where("id", $id);  
           $this->db->update("medicine_category", $data);   
      }
    //---------------------------------------------//

    public function fetch_manage_medicine()
    { 
           $this->db->select("*");  
           $this->db->from("manage_medicines");  
           $query = $this->db->get();  
           return $query;
    }
    public function insert_medicine()
    {
        $data['pharmacist_id']=$_SESSION['PROFILE_ID'];
	   	return $this->db->insert('manage_medicines'); 
    }
    
    public function getmedicinecategoryby_id($id)
    {
            if($id==0)
                return 0;
            else
            return $this->db->get_where('medicine_category', array('id' =>$id))->row();
    }
    public function getmedicineiconby_id($id)
    {
            if($id==0)
                return 0;
            else
            return $this->db->get_where('pharmacists', array('id' =>$id))->row();
    }
    function medicine_category_ids()
    {
    $this->db->order_by("medicine_category_name", "ASC");
    $query = $this->db->get("medicine_category");
    return $query->result();
    }

    public function get_medicines_categories()
    {
            $this->db->select("*")->from("medicine_category")->where('status',1);
            $query = $this->db->get();        	   
            return $query->result();
    }

    public function get_medicines()
    {
            $this->db->select("*")->from("medicines")->where('status',1);
            $query = $this->db->get();        	   
            return $query->result();
    }
    public function get_medicine_sales()
    {
            $this->db->select("*")->from("medicine_sales");
            $query = $this->db->get();        	   
            return $query->result();
    }
    
    public function getcategoryby_id($id)
	   {
	   		if($id==0)
		   		return 0;
		   	else
		   	return $this->db->get_where('medicine_category', array('id' =>$id))->row();
	   }
           public function get_all_orders()
           {
                $this->db->select("*")->from("order_details")->where('status',1);
                $query = $this->db->get();        	   
                return $query->result();   
           }

}

?>