<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
			// print_r($user_logged_in);
			
	}

	public function index()
	{
		$data["titlepage"] = "HOME";
		if($this->session->userdata("akses") == "PM" or $this->session->userdata("akses") == "OWNER"){
			$array = array();
			$witel = $this->witel_model->role_witel($this->session->userdata("userCodex"));
			foreach ($witel as $key => $value) {
				# code...
				$array[] = $value->witelCode;
			}
			
			$data["dataresult"] = $this->project_model->viewn($array);
		}else{

			$data["dataresult"] = $this->project_model->view();
		}
		
		$this->load->view('template/header' , $data);
		$this->load->view('home', $data);
		$this->load->view('template/footer');

	}
	public function addabsen()
	{
		$date = str_replace( ':', '', date('Y-m-d'));
		if (!is_dir('uploads/absen/'.$date)) {
			mkdir('./uploads/absen/' . $date, 0777, TRUE);
		
		}
		$config['upload_path']          = './uploads/absen/'.$date;
		$config['allowed_types']        = 'gif|jpg|png';
		$config["encrypt_name"] = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('image'))
		{	
			redirect('home/add', 'refresh');
		}
		else
		{
			$po = $this->input->post();
			$data = $this->upload->data();
			$po["image"] =  $date."/".$data["file_name"];
		$this->db->insert("absen" ,$po );
		redirect('home/add', 'refresh');

		}

	}
	public function add(){
		
		$data["titlepage"] = "FITURE LAINNYA";
		$data["absen"] = $this->db->from("absen")->where("mappingCode" , $this->session->userdata("karyawanCode"))->where("DATE_FORMAT(create_at , '%Y-%m-%d')=" , date("Y-m-d"))->get()->num_rows();
		
        $data["vendorresult"] = $this->vendor_model->view();
		
        $data["witelresult"] = $this->witel_model->view();
		$data["kategori"] = $this->db->query("select * from project_cat")->result_array();
			$this->form_validation->set_rules('project_name', 'project_name', 'required');
		 if ($this->form_validation->run() === FALSE)
		  {
		   $this->load->view('template/header' , $data);
		  $this->load->view('vendor/addproject' , $data);
		  $this->load->view('template/footer');
		  
		  }else{
			  $this->project_model->submitadd();	
			  redirect('/', 'refresh');
		  }
	}
	public function profile(){
		
		$data["titlepage"] = "Profile";
		$data["dataresult"] = $this->project_model->view();
		$this->load->view('template/header' , $data);
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	}
}
