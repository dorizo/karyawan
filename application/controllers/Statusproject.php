<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusproject extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
			
	}

	public function detail($id)
	{
		$data["titlepage"] = "Detail Project";
		$data["error"] = "";
		$data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["log_project"] = $this->db->from("log_project")->where("project_id" , $id)->order_by("log_date","desc")->get()->result();
		$data["upload_list"] = $this->db->from("karyawan_upload")->where("project_id" , $id)->order_by("log_date","desc")->get()->result();
		$data["datastatus"] = $this->db->query("select * from job where job_name='".$data["dataresult"]->project_status."' order by job_day asc")->row();
		$data["datastatusnext"] = $this->db->query("select * from job where job_day='".($data["datastatus"]->job_day +1)."' order by job_day asc")->row();
 		$this->load->view('template/header' , $data);
		$this->load->view('detail', $data);
		$this->load->view('template/footer');
	}

	public function submitprogress(){
			$data["div"] = "alert-success";
			$data["titlepage"] = "Berhasil Di input";
			$data["error"] = "Data Berhasil Di input";
			$post = $this->input->post();
			$this->db->where("project_id" , $post["project_id"]);
			$this->db->limit(1);
			$this->db->update("project" , $post);
			$postlog =array("tables" => "project", "log_date" => date("Y-m-d h:i:sa"), "log_name" => "Update project di ".$post["project_status"]." di update oleh ".$this->session->userdata("karyawanNama") , "project_id" => $this->input->post("project_id"));
			$this->db->insert("log_project" , $postlog);
			$this->load->view('template/headerpage' , $data);
			$this->load->view('template/error' , $data);
			$this->load->view('template/footer');
	}
	public function adddetail(){
		$date = str_replace( ':', '', date('Y-m-d'));
		if (!is_dir('uploads/'.$date)) {
			mkdir('./uploads/' . $date, 0777, TRUE);
		
		}
		$config['upload_path']          = './uploads/'.$date;
		$config['allowed_types']        = '*';
		// $config["encrypt_name"] = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('filedata'))
		{
			$data["titlepage"] = "error";
			$data["div"] = "alert-danger";
			$data["error"]  = array('error' => $this->upload->display_errors());
			$this->load->view('template/headerpage' , $data);
			$this->load->view('template/error' , $data);
			$this->load->view('template/footer');

		}
		else
		{
			$data = $this->upload->data();
			$data["div"] = "alert-success";
			$data["titlepage"] = "Berhasil Di input";
			$data["error"] = "Data Berhasil Di input";
			$post = $this->input->post();
			$post["filedata"] = $date."/".$data["file_name"];
			$this->db->insert("karyawan_upload" , $post);
			$postlog =array("tables" => "karyawan_upload", "log_date" => date("Y-m-d h:i:sa"), "log_name" => "update  foto di ".$post["project_status"]." di update oleh ".$this->session->userdata("karyawanNama") , "project_id" => $this->input->post("project_id"));
			$this->db->insert("log_project" , $postlog);
			$this->load->view('template/headerpage' , $data);
			$this->load->view('template/error' , $data);
			$this->load->view('template/footer');
		}
	}
	
}
