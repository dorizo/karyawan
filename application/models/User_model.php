<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function login(){
                $this->db->where("username" , $this->input->post("username"));
                $this->db->where("password" , md5($this->input->post("password")));
                $db = $this->db->get("karyawan");
                 return $db->row();
        }
}