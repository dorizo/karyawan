<?php
class Job_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("job");
            return $db->result_array();
        }

       
}