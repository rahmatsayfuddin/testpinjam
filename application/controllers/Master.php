<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_master');
		
	}
	public function index()
	{
		$data['data']=$this->m_master->get_master();
		$this->load->view('master',$data);
	}

	public function add()
	{
		$data['nama_barang']=$_POST['nama_item'];
		$data['stock']=$_POST['jumlah_item'];

		$check_master=$this->m_master->check_master($_POST['nama_item']);

		if (count($check_master)>0) {
			$this->session->set_flashdata('message_type', 'danger');
			$this->session->set_flashdata('message', 'Error, Nama tidak boleh sama');
			redirect('master');	
		}
		$this->m_master->add($data);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Create item successfully');
		redirect('master');

	}

}
