<?php
class akunbankTransaksi_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view($id){
            $this->db->where("akunbank_transaksi.project_id" , $id);
            $this->db->join("project" , "project.project_id=akunbank_transaksi.project_id" );
            $db = $this->db->get("akunbank_transaksi");
            return $db->result_array();
        }
        
        public function sumproject($id){
            $this->db->select_sum('transaksiJumlah');
            $this->db->where("project_id" , $id);
            $db = $this->db->get("akunbank_transaksi");
            return $db->row();
        }
        public function viewsingle($kode){
            $this->db->where("akunbank_transaksiCode" , $kode);
            $db = $this->db->get("akunbank_transaksi");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("akunbank_transaksiCode", $this->input->post("akunbank_transaksiCode"));
            $this->db->update("akunbank_transaksi" , $this->input->post());
        }
        
        public function delete($i){
            $this->db->where("akunbank_transaksiCode",$i);
            $this->db->delete("akunbank_transaksi");
        }
        public function submitadd(){
            
            $this->db->trans_begin();
            $p =  $this->input->post();
            $julahtransaksi = str_replace(",", "",$this->input->post("transaksiJumlah"));
            $p["transaksiJumlah"] =  str_replace(",", "",$this->input->post("transaksiJumlah"));
            $this->db->insert("akunbank_transaksi" , $p);
            $a = $this->db->query('Select saldo_sekarang from akunbank where akunBankCode='.$this->input->post("akunBankCode"))->row();
           if($this->input->post("statusTransaksi") == "CR"){
            // credit saldo mengurangi dan input ke sini
            $saldo = $a->saldo_sekarang - str_replace(",", "",$this->input->post("transaksiJumlah"));
            $this->db->query("UPDATE `akunbank` SET saldo_sekarang=$saldo where akunBankCode=".$this->input->post("akunBankCode"));
            $this->db->query("INSERT INTO `akunbank_debit_kredit`( `akunbankCode`, `debit`, `credit`, `saldo`)VALUES (".$this->input->post("akunBankCode").",0,".$julahtransaksi.",".$saldo.")");
            }else{
                $saldo = $a->saldo_sekarang + str_replace(",", "",$this->input->post("transaksiJumlah"));
                $this->db->query("UPDATE `akunbank` SET saldo_sekarang=$saldo where akunBankCode=".$this->input->post("akunBankCode"));
                $this->db->query("INSERT INTO `akunbank_debit_kredit`( `akunbankCode`, `debit`, `credit`, `saldo`)VALUES (".$this->input->post("akunBankCode").",".$julahtransaksi.",0,".$saldo.")");
                    
            }
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            }
        }

       
}