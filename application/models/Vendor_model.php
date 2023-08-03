<?php
class Vendor_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("vendor");
            return $db->result_array();
        }
        public function viewSinggle($kode){
            $this->db->where("vendorCode" , $kode);
            $db = $this->db->get("vendor");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("vendorCode", $this->input->post("vendorCode"));
            
			$p = $this->input->post();
            if(isValidMd5($this->input->post("password"))==0){
			$p["password"] =  md5($this->input->post("password"));
            }
            $this->db->update("vendor" , $p);
        }
        
        public function delete($i){
            $this->db->where("vendorCode",$i);
            $this->db->delete("vendor");
        }
        public function submitadd(){
            
			$p = $this->input->post();
			$p["password"] =  md5($this->input->post("password"));
			// $p["saldo_sekarang"] =  str_replace(",", "", $this->input->post("saldo_sekarang"));
            $this->db->insert("vendor" , $p);
        }

       
}