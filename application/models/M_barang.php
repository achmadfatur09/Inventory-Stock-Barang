<?php

class M_barang extends CI_Model{
	protected $_table = 'barang';

	public function lihat($post = null){
		if ($post != null) {
			foreach ($post as $key => $value) {
				if ($value !== '') {
					$query = $this->db->where($key, $value);
				}
			}
		}
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->select_sum("stok");
		$query = $this->db->get($this->_table);
		return $query->row()->stok;
	}

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok > 0');
		return $query->result();
	}

	public function lihat_stok_distinct(){
		$query = $this->db->distinct();
		$query = $this->db->select('nama_barang');
		$query = $this->db->get_where($this->_table, 'stok > 0');
		return $query->result();
	}

	public function lihat_id($kode_barang){
		$query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
		return $query->row();
	}


	public function lihat_nama_barang_by_nama($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_warna_barang_by_nama($nama_barang){
		$query = $this->db->distinct();
		$query = $this->db->select('warna');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_ukuran_barang_by_nama($nama_barang, $warna){
		$query = $this->db->select('*');
		$query = $this->db->where(
			[
				'nama_barang' => $nama_barang,
				'warna' => $warna
			]
	);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_detail_barang_by_nama($nama_barang, $warna, $ukuran_kaos){
		$query = $this->db->select('*');
		$query = $this->db->where(
			[
				'nama_barang' => $nama_barang,
				'warna' => $warna,
				'ukuran_kaos' => $ukuran_kaos
			]
	);
		$query = $this->db->get($this->_table);
		return $query->row();
	}


	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function plus_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('kode_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}


	public function min_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('kode_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_barang){
		return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
	}

	public function getStokBarangByUkuran()
	{
		$query = $this->db->select('ukuran_kaos, SUM(stok) as stok');
		$query = $this->db->where('ukuran_kaos IS NOT NULL');
		$query = $this->db->group_by('ukuran_kaos');
		$query = $this->db->order_by('ukuran_kaos');
		$query = $this->db->get('barang');
		return $query->result();
	}
}