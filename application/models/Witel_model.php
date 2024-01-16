<?php
class Witel_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("witel");
            return $db->result_array();
        }
        public function role_witel($userCode){
            $this->db->where("userCode" , $userCode);
           $db =  $this->db->get("role_witel");
            return $db->result();

        }

    }

?>