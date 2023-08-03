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

    }

?>