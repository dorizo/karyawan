<?php
class Suratpesanan_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            if($this->input->get("NoSuratpesanan")){    
             $this->db->like("NoSuratpesanan" , $this->input->get("NoSuratpesanan"));
            }
            $db = $this->db->get("suratpesanan");
            return $db->result_array();
        }
        public function viewSinggle($kode){
            $this->db->where("suratpesananCode" , $kode);
            $db = $this->db->get("suratpesanan");
            return $db->row();
        }

        public function witelfilter($wid){
            $this->db->select("* ,project.project_id , (select witel_name from witel where witel_id=project.witel_id) as witel , (select vendorID from vendor where vendorCode=project.vendorCode) as vendor ,(select COALESCE(sum(a.transaksiJumlah),0) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  COALESCE(sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) )),0)  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh");
                $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
                $this->db->join("suratpesanandetail" , "suratpesanandetail.project_id=project.project_id", "left");
                $this->db->order_by("project.project_id" , "DESC");
                $this->db->where("witel_id" , $wid);
                $this->db->where("suratpesananDetailCode IS NULL");
                $this->db->where("project_status != 'PAID'");
                $db = $this->db->get("project");
                return $db->result_array();
        }
        public function witelfilterpilih($wid){
            $this->db->select("* ,project.project_id , (select witel_name from witel where witel_id=project.witel_id) as witel , (select vendorID from vendor where vendorCode=project.vendorCode) as vendor ,(select COALESCE(sum(a.transaksiJumlah),0) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  COALESCE(sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) )),0)  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh");
                $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
                $this->db->join("suratpesanandetail" , "suratpesanandetail.project_id=project.project_id");
                $this->db->order_by("project.project_id" , "DESC");
                $this->db->where("suratpesananCode" , $wid);
                $db = $this->db->get("project");
                return $db->result_array();
        }

        
        public function allproject($wid){
            $this->db->select("* ,project.project_id , (select witel_name from witel where witel_id=project.witel_id) as witel , (select vendorID from vendor where vendorCode=project.vendorCode) as vendor ,(select COALESCE(sum(a.transaksiJumlah),0) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  COALESCE(sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) )),0)  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh");
                $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
                $this->db->join("suratpesanandetail" , "suratpesanandetail.project_id=project.project_id");
                $this->db->order_by("project.project_id" , "DESC");
                $this->db->where("suratpesananCode" , $wid);
                $db = $this->db->get("project");
                return $db->result_array();
        }
        
        
        public function submitedit(){
            $this->db->where("biayalainCode", $this->input->post("biayalainCode"));
			$p = $this->input->post();
            $this->db->update("biayalain" , $p);
        }
        
        public function delete($i){
            $this->db->where("suratpesananCode",$i);
            $this->db->delete("suratpesanan");
        }
        public function submitadd(){
            
			$p = $this->input->post();
            // $p["biayalain"] =  str_replace(",", "",$this->input->post("biayalain"));
            $this->db->insert("suratpesanan" , $p);
            $last_id = $this->db->insert_id();
            return $last_id; 
        }
        public function jumlah($id){
           return $this->db->query("select sum(nilai_project) as mo from suratpesanandetail join project on project.project_id=suratpesanandetail.project_id where suratpesanandetail.suratpesananCode=".$id)->row();
        }
        public function jumlahoutstanding($id){
            return $this->db->query("select sum(nilai_outstanding) as mo from suratpesananoutstanding where suratpesananCode=".$id)->row();
        }
        

       
}