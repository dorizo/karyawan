<?php
class Akun_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                // $this->db->where("email" , $this->input->post("username"));
                $this->db->where("deleteAt is NULL");
                $db = $this->db->get("akutansi_akun");
                 return $db->result_array();
        }
        public function viewSinggle($role){
            // $this->db->where("email" , $this->input->post("username"));
            // $this->db->where("password" , md5($this->input->post("password")));
            $this->db->where("Kode_akun" , $role);
            $db = $this->db->get("akutansi_akun");
             return $db->row();
        }
        public function submitadd(){
                $param = $this->input->post();
                // $param["password"] = password_hash($this->input->post("password") , PASSWORD_DEFAULT);
                $this->db->insert("akutansi_akun" , $param);
        }
        public function submitedit(){
                $param = $this->input->post();
                $this->db->where("kode_akun" , $this->input->post("kode_akun"));
                $this->db->update("akutansi_akun" , $param);
        }
        public function delete($id){
                $this->db->where("Kode_akun" , $id);
                $this->db->update("akutansi_akun" , array("deleteAt" => date("Y-m-d")));
        }
        public function detail($id){
            $this->db->select('*');
            $this->db->from('role as a');
            $this->db->join('role_permission as b', 'a.Kode_akun = b.Kode_akun');
            $this->db->join('permission as c', 'b.permissionCode= c.permissionCode');
            $this->db->where('a.Kode_akun =', $id);
            $this->db->where('b.deleteAt IS NULL', NULL, FALSE);
            $this->db->order_by('c.permission','ASC');
            return $query = $this->db->get();

        }

}