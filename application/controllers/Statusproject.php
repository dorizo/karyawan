<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "vendor/autoload.php";
use Google\Cloud\Storage\StorageClient;
class Statusproject extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('Akunbank_pengajuan_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
			
	}

	public function generateboq(){
		$this->db->where("project_id" ,$this->input->post("project_id"));
		$this->db->limit(1);
		$this->db->update("project" , $this->input->post());
		redirect('/statusproject/detail/'.$this->input->post("project_id"), 'refresh');
	}

	public function detail($id , $m =0)
	{


		$data["titlepage"] = "Detail Project";
		$data["error"] = "";
		$data["id"]= $id;
		 $data["designatorconfig"] = $this->db->query("select * from datateknis_projectkhs_detail where id_project_khs_v2_detail=".$m)->result_array();
        $data["designatorlist"] = $this->db->query("select * from datateknis_projectkhs_detail where project_id=".$id)->result_array();
		
		$data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["log_project"] = $this->db->from("log_project")->where("project_id" , $id)->order_by("log_date","desc")->get()->result();
		$data["upload_list"] = $this->db->from("karyawan_upload")->where("project_id" , $id)->order_by("log_date","desc")->get()->result();

		$data["datastatus"] = $this->db->query("select * from job where job_name='".$data["dataresult"]->project_status."' order by job_day asc")->row();
		// print_r($data["dataresult"]);
		// echo "<hr />";
		$main = $this->db->query("select * from parent_cat where parentcatCode=".$data["dataresult"]->parentcatCode)->row();
		$explod = explode(",",$main->parentcatStruktur);
		// print_r($explod);
		$dayjobnext =0;
		if($data["datastatus"]){
			// echo "ssdfd";
			$index = array_search($data["datastatus"]->job_day, $explod);
		$dayjobnext = ($explod[$index+1]);
		
		}
		$data["datastatusnext"] = $this->db->query("select * from job where job_day='".($dayjobnext)."' order by job_day asc")->row();
 		$this->load->view('template/header' , $data);
		$this->load->view('detail', $data);
		$this->load->view('template/footer');
	}

	public function addsitac(){
		$p = $this->input->post();
		$p["sitax_total"] = str_replace(",", "",$this->input->post("sitax_total"));
		$p["sitax_penagihan"] = str_replace(",", "", $this->input->post("sitax_penagihan"));
		if($this->input->post("sitax_id")){
			$this->db->where("sitax_id" , $this->input->post("sitax_id"));
			$this->db->update("project_sitax" , $p);
		
		}else{
			$this->db->insert("project_sitax" , $p);
		
		}
		
		redirect('/statusproject/detail/'.$this->input->post("project_id"), 'refresh');

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
			$data = $_FILES["filedata"];
			$data["div"] = "alert-success";
			$data["titlepage"] = "Berhasil Di input";
			$data["error"] = "Data Berhasil Di input";
			if(isset($data)){
				$errors= array();
				// Authentication with Google Cloud Platform
				$client = new StorageClient([
					'keyFilePath' => getcwd().'/stoked-clone-433103-n2-cae2b0391f98.json',
				]);
				$bucket = $client->bucket('ciptateknologimuda');
	
				// Upload a file to the bucket.
				$file = pathinfo($data['name']);
				$prefix = uniqid('data_', true); //generate random string to avoid name conflicts
				$filename = $prefix . "." . $file['extension'];
				$post = $this->input->post();
				$post["filedata"] = $date."/".$filename;
	
				$bucket->upload(
				fopen($data['tmp_name'], 'r'),
				['name' => "uploads/$date/".$filename]
				);  
				$this->db->insert("karyawan_upload" , $post);
				$postlog =array("tables" => "karyawan_upload", "log_date" => date("Y-m-d h:i:sa"), "log_name" => "update  foto di ".$post["project_status"]." di update oleh ".$this->session->userdata("karyawanNama") , "project_id" => $this->input->post("project_id"));
				$this->db->insert("log_project" , $postlog);
				$this->load->view('template/headerpage' , $data);
				$this->load->view('template/error' , $data);
				$this->load->view('template/footer');
			}
			
	}

	public function adddetailold(){
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
