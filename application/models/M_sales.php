<?php 
class M_sales extends CI_Model {

	public function get_sales()
	{
		$query = $this->db->get('transaksi');
		return	$query->result_array();
	}

	public function add($data)
	{
		$this->db->insert('transaksi', $data); 
	}

	public function get_detail_sales($id='')
	{
		$query = $this->db->get_where('v_detail_transaksi', array('id_transaksi' => $id));
		return	$query->result_array();
	}

	public function get_barang()
	{
		$this->db->where('stock >=', 0);
		$query = $this->db->get('master');
		return	$query->result_array();
	}

	public function prosess($data)
	{

		$this->db->insert('detail_transaksi', $data); //insert

		$amount=$data['harga']*$data['jumlah_barang'];//get new amoutn
		$this->db->where('id_transaksi =', $data['id_transaksi']);//get current amount
		$query = $this->db->get('transaksi');
		$row = $query->row();
		$total_amount=$amount+$row->total_amount;//sum amount

		$this->db->where('id_transaksi', $data['id_transaksi']);
		$param ['total_amount'] = $total_amount;//end value amount

		$this->db->update('transaksi', $param); 
	}

	public function delete_detail($id)
	{
		$this->db->where('id =', $id);
		$detail_query = $this->db->get('detail_transaksi');
		$data = $detail_query->row();
		$amount=$data->harga*$data->jumlah_barang;//get new amoutn


		$this->db->where('id_transaksi >=', $data->id_transaksi);//get current amount
		$query = $this->db->get('transaksi');
		$row = $query->row();
		$total_amount=$row->total_amount-$amount;//sum amount

		$this->db->where('id_transaksi', $data->id_transaksi);
		$param ['total_amount'] = $total_amount;//end value amount

		$this->db->update('transaksi', $param); 

		$this->db->where('id', $id);
		$this->db->delete('detail_transaksi'); 

		// echo "amount  : ".$amount;
		// echo "total_amount: ".$total_amount;
	}

	public function prepare_edit($id)
	{
		$this->db->where('id =', $id);
		$detail_query = $this->db->get('detail_transaksi');
		return $data = $detail_query->row();
	}

	public function edit($data,$id)
	{
		$data_detail=$this->prepare_edit($id);


		$this->db->where('id', $id);
		$this->db->update('detail_transaksi', $data); 


		$amount_query=$this->db->query("select SUM(harga*jumlah_barang) as amount from detail_transaksi where id_transaksi=".$data_detail->id_transaksi);
		$amount=$amount_query->row();


		$this->db->where('id_transaksi', $data_detail->id_transaksi);
		$param ['total_amount'] = $amount->amount;//end value amount

		$this->db->update('transaksi', $param); 
	}

	public function check_barang($id_detail,$id_barang)
	{
		$query = $this->db->get_where('detail_transaksi', array('id_transaksi' => $id_detail,'id_barang'=>$id_barang));
		return	$query->result_array();
	}

	public function get_all_barang($id_barang)
	{
		$this->db->where('id =',$id_barang);
		$query = $this->db->get('master');
		return	$query->row();
	}

	public function updatestock($id_barang,$param)
	{

		$this->db->where('id', $id_barang);
		$this->db->update('master', $param); 
	}

	public function getstock($id_transaksi='')
	{
		$amount_query=$this->db->query("SELECT id_barang,(stock-jumlah_barang) as end_value from v_detail_transaksi where id_transaksi =".$id_transaksi);
		return $amount=$amount_query->result_array();
	}

	public function updatestatus($id_transaksi)
	{
		$param['status']='true';
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->update('transaksi', $param); 
	}


}