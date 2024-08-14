<?php
class Oprasional_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){

                
                // $this->db->where("email" , $this->input->post("username"));
                // $this->db->where("a.deleteAt is NULL");
                $this->db->join("akutansi_akun b" , "b.kode_akun=a.kode_akun");
                $this->db->join("witelho c" , "c.witelhoID=a.witel_id");
                $this->db->join("sto d" , "d.stoCode=a.stoCode");
                $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
                $this->db->order_by("ID" , "DESC");
                if($this->input->get("mulai")){
                        $this->db->where("tanggal BETWEEN '".$this->input->get("mulai")."' AND '".$this->input->get("selesai")."'");
                                
                }
                $db = $this->db->get("oprasional a");

                 return $db->result_array();
        }
        public function viewSinggle($role){
            // $this->db->where("email" , $this->input->post("username"));
            // $this->db->where("password" , md5($this->input->post("password")));
            $this->db->where("ID" , $role);
            $db = $this->db->get("oprasional");
             return $db->row();
        }
        public function submitadd(){
                $param = $this->input->post();
                $param["debit"] = str_replace(".", "",$this->input->post("debit"));
                $param["kredit"] = str_replace(".", "", $this->input->post("kredit"));
                $this->db->insert("oprasional" , $param);
        }
        public function submitedit(){
                $param = $this->input->post();
                $param["debit"] = str_replace(".", "",$this->input->post("debit"));
                $param["kredit"] = str_replace(".", "", $this->input->post("kredit"));
                $this->db->where("ID" , $this->input->post("ID"));
                $this->db->update("oprasional" , $param);
        }
        public function delete($id){
                $this->db->where("ID" , $id);
                $this->db->limit(1);
                $this->db->delete("oprasional");
        }
        public function detail($id){
            $this->db->select('*');
            $this->db->from('role as a');
            $this->db->join('role_permission as b', 'a.oprasionalCode = b.oprasionalCode');
            $this->db->join('permission as c', 'b.permissionCode= c.permissionCode');
            $this->db->where('a.oprasionalCode =', $id);
            $this->db->where('b.deleteAt IS NULL', NULL, FALSE);
            $this->db->order_by('c.permission','ASC');
            return $query = $this->db->get();

        }

}