<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mandor extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('mandor_model');
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["result"] = $this->mandor_model->view();
		$data["titlepage"] = "user";
		$data["pluginjs"] = "pengumpulan.js";
		$this->load->view('template/header' , $data);
		$this->load->view('mandor/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('karyawanCode', 'karyawanCode', 'required');
        
        $data["dataresult"] = $this->mandor_model->single($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('mandor/edit' , $data);
		$this->load->view('template/footer');
		
		}else{

			if($this->input->post("password")){
					$post = $this->input->post();
					$post["password"] = md5($this->input->post("password"));
					$this->db->where("karyawanCode" , $this->input->post("karyawanCode"));
					$this->db->update("karyawan" , $post);
			}else{
					$post = $this->input->post();
					unset($post["password"]);
					
					$this->db->where("karyawanCode" , $this->input->post("karyawanCode"));
					$this->db->update("karyawan" , $this->input->post());
			}


			// $this->mandor_model->submitedit();	
            redirect('/mandor', 'refresh');
		
		}
	}
	
	public function sematkan($id){
		$this->form_validation->set_rules('role', 'role', 'required');
        $data["titlepage"] = "Admin | Setting Waspang";
        $data['datadetail'] = $this->db->query("SELECT * FROM `karyawan` b JOIN `karyawan_project` a  ON a.karyawanCode=b.karyawanCode where a.project_id=$id")->result();
        $data["user"] = $this->db->query("select * from project where project_id=$id")->row();
        $data['permission'] =$this->db->query("select * from karyawan")->result();
		$this->load->view('template/header' , $data);
		$this->load->view('mandor/detail' , $data);
		$this->load->view('template/footer');

	}
	public function add_detail(){
		// $role_permission    = $this->input->post('role_permission');
		$p = $this->input->post();
		print_r($p);
		$this->db->insert("karyawan_project" , $p);
		redirect($_SERVER['HTTP_REFERER']);
		// if(!empty($role_permission)){
		// 	foreach($role_permission AS $key => $val){
		// 		$del = $this->db->query("select * from role_permission WHERE permissionCode = '".$role_permission[$key]."' and roleCode = '".$rolecode."'and deleteAt IS NOT NULL")->row();
		// 		if($del){
		// 			$update = array(
		// 				'deleteAt' => NULL,
						
		// 			);
		// 			$update = $this->db->update('role_permission',$update, array('permissionCode' => $role_permission[$key], 'roleCode' => $rolecode));
		// 		}else{
		// 			$result[] = array(
		// 				'permissionCode' => $role_permission[$key],
		// 				'roleCode' => $rolecode,
		// 			);
		// 		}

		// 	}
		// 	if($result){
		// 		$insert = $this->db->insert_batch('role_permission', $result);
		// 		redirect($_SERVER['HTTP_REFERER']);
		// 	}else{
		// 		redirect($_SERVER['HTTP_REFERER']);
		// 	}
			
			
		// }
	} 
	public function delete_detail($id){ 

		$this->db->where("karyawan_projectCode" , $id);
		$update = $this->db->delete('karyawan_project');
		redirect($_SERVER['HTTP_REFERER']);
	}

    public function add(){

		$this->form_validation->set_rules('username', 'username', 'required');
      $data["titlepage"] = "KARYAWAN USER ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('mandor/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->mandor_model->submitadd();	
            redirect('/mandor', 'refresh');
		}
	}
    public function delete($d){
        $this->mandor_model->delete($d);
        redirect('/mandor', 'refresh');    
    }
}
