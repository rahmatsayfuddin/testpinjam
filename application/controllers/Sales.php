<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_sales');
		
	}
	public function index()
	{
		$data['data']=$this->m_sales->get_sales();
		$this->load->view('sales',$data);
	}

	public function add()
	{
		$data['id_transaksi']=strtotime("now");
		$data['total_amount']=0;
		$data['tgl_transaksi']=$_POST['tanggal'];
		$data['nama_pelanggan']=$_POST['nama_pelanggan'];
		$data['status']='false';
		$this->m_sales->add($data);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'successfully');
		redirect('sales');
		//echo json_encode($data);

	}

	public function detail_transaksi($id_transaksi='')
	{
		$data['id_transaksi']=$id_transaksi;
		$data['list_barang']=$this->m_sales->get_barang($id_transaksi);
		$data['data']=$this->m_sales->get_detail_sales($id_transaksi);
		$this->load->view('detail_sales',$data);
	}


	public function prosess($id_transaksi='')
	{
		$data['id_transaksi']=$id_transaksi;
		$data['id_barang']=$_POST['id_barang'];
		$data['jumlah_barang']=$_POST['jumlah_barang'];
		$data['harga']=$_POST['harga'];
		$check_barang= $this->m_sales->check_barang($id_transaksi,$data['id_barang']);

		if (count($check_barang)>0) {
			$this->session->set_flashdata('message_type', 'danger');
			$this->session->set_flashdata('message', 'Error, Barang sudah ada dalam list');
		}
		else{
			$this->m_sales->prosess($data);
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('message', 'successfully');	
		}

		
		redirect('sales/detail_transaksi/'.$id_transaksi);

		//echo json_encode($data);

	}

	public function delete_detail($id='')
	{
		$this->m_sales->delete_detail($id);
	}

	public function edit_detail_sales($id='')
	{
		$data['list_barang']=$this->m_sales->get_barang();
		$data['id']=$id;
		$data['data']=$this->m_sales->prepare_edit($id);
		$this->load->view('edit_detail_sales',$data);

	}

	public function action_edit($id)
	{
		$data['id_barang']=$_POST['id_barang'];
		$data['jumlah_barang']=$_POST['jumlah_barang'];
		$data['harga']=$_POST['harga'];
		$id=$id;
		$this->m_sales->edit($data,$id);

		// $data['status']='false';
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Edit data successfully');
		redirect('sales/detail_transaksi');
	}

	public function confirm($id_transaksi)
	{
		$detail_transaksi=$this->m_sales->get_detail_sales($id_transaksi);
		foreach ($detail_transaksi as $detail_transaksi) {
			$barang=$this->m_sales->get_all_barang($detail_transaksi['id_barang']);

			if ($detail_transaksi['jumlah_barang']>$barang->stock) {
				$this->session->set_flashdata('message_type', 'danger');
				$this->session->set_flashdata('message', 'jumlah barang ada yang melebihi stock');
				redirect('sales');
			}


		}

		$stock =$this->m_sales->getstock($id_transaksi);
		foreach ($stock as $stock) {
			$param['stock']=$stock['end_value'];
			$this->m_sales->updatestock($stock['id_barang'],$param);
		}
		$this->m_sales->updatestatus($id_transaksi);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Confirm successfully');
		redirect('sales');


	}

}
