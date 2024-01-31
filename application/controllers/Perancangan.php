<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perancangan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('user_model');
			
	}


	public function hapus($id,$kode)
	{
        $this->db->where("projectPerancanganCode" , $kode);
        $this->db->delete("projectperancangan");
        redirect("/statusproject/detail/".$id, 'refresh'); 
    }
	public function add($id)
	{
        $data["dataresult"] = $this->project_model->viewSinggle($id);
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$data["titlepage"] = "Tambah Perancangan ";
		$data["project_id"] = $id;
		
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('perancangan/add' , $data);
		$this->load->view('template/footer');
		
		}else{
            $p = $this->input->post();
            $p["nilai"] = str_replace(",", "", $this->input->post("nilai"));
            $this->db->insert("projectperancangan" , $p);
            redirect("/statusproject/detail/".$p["project_id"], 'refresh'); 


			// $config['upload_path']          = '../../keuangan/github/pembayaran/';
			// $config['allowed_types']        = '*';
			// $config['max_size']             = 100000;
			// $config['max_width']            = 102400;
			// $config['max_height']           = 76800;
			// $config['encrypt_name']           = TRUE;

			// $this->load->library('upload', $config);

			// if ( ! $this->upload->do_upload('file'))
			// {
			// 	$error = array('error' => $this->upload->display_errors());
			// 	print_r($error);
			// 	$this->load->view('template/header' , $data);
			// 	$this->load->view('Pengajuan/add' , $data);
			// 	$this->load->view('template/footer');
			// }else{
			// 	// print_r();		
			// 	echo "<script>alert('pengajuan berhasil di input')</script>";
			// 	$this->akunbank_pengajuan_model->submitadd($this->upload->data("file_name"));
			// 	if($this->input->post("statusPengajuan")=="project"){
			// 	redirect('/statusproject/detail/'.$id, 'refresh');
			
			// 	}else{
  
			// 	}	
			// }
		}
    }
}
?>