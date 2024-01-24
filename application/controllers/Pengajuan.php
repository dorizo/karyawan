<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbank_pengajuan_model');
			$this->load->model('akunbank_model');
			
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
	}

	public function index(){
		
		$data["titlepage"] = "NOTIFIKASI";
		$data["datatable"] = $this->akunbank_pengajuan_model->pengajuannotiv("PENDING");
		$data["pluginjs"] = "project.js?2s2";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/notiv' , $data);
		$this->load->view('template/footer');
	}

	public function notivsp(){
		$data["titlepage"] = "NOTIFIKASI";
		$data["datatable"] = $this->akunbank_pengajuan_model->pengajuannotivsp("PENDING");
		$data["pluginjs"] = "project.js?2s2";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/notivsp' , $data);
		$this->load->view('template/footer');
	}
	public function sitax($id , $kodesitax, $pengajuan="project")
	{
		
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$data["titlepage"] = "PENGAJUAN SITAC ";
		$data["project_id"] = $id;
		$data["pengajuanproses"] = $pengajuan;
		$data["akunbank"] = $this->akunbank_model->view();
		$data["pengajuanstatus"] = $this->akunbank_pengajuan_model->pengajuanstatus($pengajuan);
		$data["sitax"] = $this->db->query("select * from project_sitax where project_id=".$id)->row();
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/addsitac' , $data);
		$this->load->view('template/footer');
		
		}else{

			$config['upload_path']          = '../../keuangan/github/pembayaran/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 100000;
			$config['max_width']            = 102400;
			$config['max_height']           = 76800;
			$config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				$this->load->view('template/header' , $data);
				$this->load->view('Pengajuan/addsitac' , $data);
				$this->load->view('template/footer');
			}else{
				// print_r();		
				echo "<script>alert('pengajuan berhasil di input')</script>";
				$this->akunbank_pengajuan_model->submitadd($this->upload->data("file_name"));
				if($this->input->post("statusPengajuan")=="project"){
				redirect('/statusproject/detail/'.$id, 'refresh');
			
				}else{

					redirect("/suratpesanan", 'refresh');   
				}	
			}
		}

	}
	public function setting($a)
	{
		$data["dataresult"] = $this->project_model->viewSinggle($a);
		$data["titlepage"] = "LIST PENGAJUAN CALL CENTER = " .$data["dataresult"]->project_code;
		$data["datatable"] = $this->akunbank_pengajuan_model->view($a);
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
		$data["pengajuanstatus"] = $this->akunbank_pengajuan_model->pengajuanstatus();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();	
		redirect($_SERVER['HTTP_REFERER']);  
		
		}
	}

    public function add($id , $pengajuan="project"){

        $data["dataresult"] = $this->project_model->viewSinggle($id);
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$data["titlepage"] = "Transaksi Project ";
		$data["project_id"] = $id;
		$data["pengajuanproses"] = $pengajuan;
		$data["akunbank"] = $this->akunbank_model->view();
		$data["pengajuanstatus"] = $this->akunbank_pengajuan_model->pengajuanstatus($pengajuan);
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/add' , $data);
		$this->load->view('template/footer');
		
		}else{

			$config['upload_path']          = '../../keuangan/github/pembayaran/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 100000;
			$config['max_width']            = 102400;
			$config['max_height']           = 76800;
			$config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				$this->load->view('template/header' , $data);
				$this->load->view('Pengajuan/add' , $data);
				$this->load->view('template/footer');
			}else{
				// print_r();		
				echo "<script>alert('pengajuan berhasil di input')</script>";
				$this->akunbank_pengajuan_model->submitadd($this->upload->data("file_name"));
				if($this->input->post("statusPengajuan")=="project"){
				redirect('/statusproject/detail/'.$id, 'refresh');
			
				}else{

					redirect("/suratpesanan", 'refresh');   
				}	
			}
		}
	}
    public function delete($d){

        $this->akunbank_pengajuan_model->delete($d);
		redirect($_SERVER['HTTP_REFERER']);  
    }
}
