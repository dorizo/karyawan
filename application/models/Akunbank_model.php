<?php
class Akunbank_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("akunbank");
            return $db->result_array();
        }
        public function viewsingle($kode){
            $this->db->where("akunbankCode" , $kode);
            $db = $this->db->get("akunbank");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("akunbankCode", $this->input->post("akunbankCode"));
            $this->db->update("akunbank" , $this->input->post());
        }
        
        public function delete($i){
            $this->db->where("akunbankCode",$i);
            $this->db->delete("akunbank");
        }
        public function submitadd(){
            
			$p = $this->input->post();
			$p["total_akunbank"] =  str_replace(",", "", $this->input->post("total_akunbank"));
			$p["saldo_sekarang"] =  str_replace(",", "", $this->input->post("saldo_sekarang"));
            $this->db->insert("akunbank" , $p);
        }

       
}