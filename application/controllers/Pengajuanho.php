<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuanho extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbank_pengajuan_model');
			$this->load->model('akunbank_model');
			$this->load->model('akutansi/Oprasional_model');
			$this->load->model('akutansi/Akun_model');
			$this->load->model('akutansi/Sto_model');
			$this->load->model('akutansi/Pekerjaan_model');
			$this->load->model('akutansi/Witel_model');
			$this->load->model('Akunakutansi_model');
			
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
	}

	public function index($a=0){
        $data["titlepage"]="Pengajuan HO";
        $this->db->join("witelho c" , "c.witelhoID=a.witel_id");
        $this->db->join("sto d" , "d.stoCode=a.stoCode");
        $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
        $this->db->limit(10, $a);
        $this->db->order_by("orCode" , "DESC");
        $data["result"] = $this->db->get("oprasionalrequest a")->result_array();
        $this->load->view('template/header' , $data);
        $this->load->view('pengajuanho/view' , $data);
        $this->load->view('template/footer');
    }

    public function add()
	{
        $data["titlepage"]="Tambah PengajuanHO";
	  
		$data["akun"] = $this->Akun_model->view();
		$data["sto"] = $this->Sto_model->view();
		$data["witel"] = $this->Witel_model->view();
		$data["Pekerjaan"] = $this->Pekerjaan_model->view();


			$config['upload_path']          = '../../keuangan/github/pembayaran/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 100000;
			$config['max_width']            = 102400;
			$config['max_height']           = 76800;
			$config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('bukti'))
			{
				$data["error"]= $this->upload->display_errors();
				$this->load->view('template/header' , $data);
				$this->load->view('pengajuanho/add' , $data);
				$this->load->view('template/footer');
			}else{
				// print_r();		
				echo "<script>alert('pengajuan berhasil di input')</script>";
				$p = $this->input->post();
				$p["bukti"] = $this->upload->data("file_name");
				$p["kredit"] = str_replace(".", "", $this->input->post("kredit"));
				$this->db->insert("oprasionalrequest" , $p);
				redirect("/pengajuanho", 'refresh'); 
			}
		
    }
}
?>