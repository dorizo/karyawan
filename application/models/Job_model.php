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

        public function view_after($key){
                $this->db->where("job_day >= $key");
                $this->db->order_by("job_day" , "ASC");
                $db = $this->db->get("job");
            return $db->result_array();
        }
       
       
}