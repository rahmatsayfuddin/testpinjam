<?php 
class M_master extends CI_Model {

	public function get_master()
	{
		$query = $this->db->get('master');
		return	$query->result_array();
	}
	public function check_master($nama)
	{
		$this->db->where('nama_barang', $nama);
		$query = $this->db->get('master');
		return	$query->result_array();
	}

	public function add($data)
	{
		$this->db->insert('master', $data); 
	}

}