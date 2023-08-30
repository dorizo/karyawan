<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectrequest extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			
			
	}

	public function request($id)
	{
        print_r($this->input->get("nik_api"));
        $createsession = $this->db->query("select * from karyawan where karyawanNip=".$this->input->get("nik_api"))->row();
        if($createsession){
            // echo "data";
        //    $a =  json_encode($this->user_model->login());
            print_r($createsession);
            $a = array(
                'karyawanCode'  => $createsession->karyawanCode,
                'karyawanNama'  => $createsession->karyawanNama,
                'karyawanNip'  => $createsession->karyawanNip,
                'username'  => $createsession->username,
                'akses'  => $createsession->akses,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($a);
            redirect('statusproject/detail/'.$id, 'refresh');
        }else{
           echo "<h3>Ada tdak punya akses aplikasi ini</h3>";
        }
    }

}
?>