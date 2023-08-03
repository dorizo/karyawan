<?php
class Log_project_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function getlogproject($a){
            $this->db->where("log_project.project_id", $a);
            $this->db->join("project" , "project.project_id=log_project.project_id");
            $this->db->order_by("log_date","desc");
            $db = $this->db->get("log_project");
            return $db->result_array();
        }
}