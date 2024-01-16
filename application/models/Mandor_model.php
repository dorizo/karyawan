<?php
class Mandor_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function single($role){
                // $this->db->where("email" , $this->input->post("username"));
                // $this->db->where("password" , md5($this->input->post("password")));
                $this->db->where("karyawanCode" , $role);
                $db = $this->db->get("karyawan");
                 return $db->row();
            }
        public function view(){
                $db = $this->db->get("karyawan");
                 return $db->result_array();
        }
        public function submitadd(){
                $param = $this->input->post();
                $param["password"] = md5($this->input->post("password"));
                $this->db->insert("karyawan" , $param);
        }
        public function submitedit(){
                $param = $this->input->post();
                if(strlen($this->input->post("password")) <= 30){
                        $param["password"] = md5($this->input->post("password"));
                };
                $this->db->where("userCode" , $this->input->post("userCode"));
                $this->db->update("user" , $param);
        }
        public function delete($id){

                $this->db->where("karyawanCode" , $id);
                $this->db->delete("karyawan");
        }

}