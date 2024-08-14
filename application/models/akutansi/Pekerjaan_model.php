<?php
class pekerjaan_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                // $this->db->where("email" , $this->input->post("username"));
                $this->db->where("deleteAt is NULL");
                $db = $this->db->get("pekerjaan");
                 return $db->result_array();
        }
        public function viewSinggle($role){
            // $this->db->where("email" , $this->input->post("username"));
            // $this->db->where("password" , md5($this->input->post("password")));
            $this->db->where("pekerjaanCode" , $role);
            $db = $this->db->get("pekerjaan");
             return $db->row();
        }
        public function submitadd(){
                $param = $this->input->post();
                // $param["password"] = password_hash($this->input->post("password") , PASSWORD_DEFAULT);
                $this->db->insert("pekerjaan" , $param);
        }
        public function submitedit(){
                $param = $this->input->post();
                $this->db->where("pekerjaanCode" , $this->input->post("pekerjaanCode"));
                $this->db->update("pekerjaan" , $param);
        }
        public function delete($id){
                $this->db->where("pekerjaanCode" , $id);
                $this->db->update("pekerjaan" , array("deleteAt" => date("Y-m-d")));
        }
        public function detail($id){
            $this->db->select('*');
            $this->db->from('role as a');
            $this->db->join('role_permission as b', 'a.pekerjaanCode = b.pekerjaanCode');
            $this->db->join('permission as c', 'b.permissionCode= c.permissionCode');
            $this->db->where('a.pekerjaanCode =', $id);
            $this->db->where('b.deleteAt IS NULL', NULL, FALSE);
            $this->db->order_by('c.permission','ASC');
            return $query = $this->db->get();

        }

}