<?php

class M_pengeluaran extends CI_Model {
	protected $_table = 'pengeluaran';
	private $_TABLE_DETAIL_PENGELUARAN = 'detail_keluar';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	} 

	public function lihatDetail($post = null)
	{
		if ($post != null) {
			foreach ($post as $key => $value) {
				if ($value !== '' && $key !== 'tanggal') {
					$query = $this->db->where($key, $value);
				}
				if ($key == 'tanggal') {
					$tanggal = $value;
					$pecahTanggal = explode(' - ', $tanggal);
					$tglAwal = date('Y-m-d', strtotime($pecahTanggal[0]));
					$tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));

					$query = $this->db->order_by('tgl_keluar', 'ASC');
					$query = $this->db->where('tgl_keluar' . ' >=', $tglAwal);
					$query = $this->db->where('tgl_keluar' . ' <=', $tglAkhir);
				}
				
			}
		}
		$query = $this->db->join($this->_TABLE_DETAIL_PENGELUARAN, $this->_TABLE_DETAIL_PENGELUARAN.'.no_keluar='.$this->_table.'.no_keluar');
		$query = $this->db->get($this->_table)->result();
		return $query;
	}

	public function lihatByTanggal($tglAwal, $tglAkhir){
		$query = $this->db->join($this->_TABLE_DETAIL_PENGELUARAN, $this->_TABLE_DETAIL_PENGELUARAN.'.no_keluar='.$this->_table.'.no_keluar');
		$query = $this->db->order_by('tgl_keluar', 'ASC');
		$query = $this->db->where('tgl_keluar' . ' >=', $tglAwal);
		$query = $this->db->where('tgl_keluar' . ' <=', $tglAkhir);
		$query = $this->db->get($this->_table)->result();
		return $query;
	}

	public function jumlah(){
		$query = $this->db->select_sum("jumlah");
		$query = $this->db->get($this->_TABLE_DETAIL_PENGELUARAN);
		return $query->row()->jumlah;
	}

	public function lihat_no_keluar($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}

	public function getChartPengeluaranMingguan($tgl)
	{
		$query = $this->db->select_sum('jumlah');
		$query = $this->db->join('detail_keluar', $this->_table.'.no_keluar = detail_keluar.no_keluar');
		$query = $this->db->where([
			'DATE(tgl_keluar)' => $tgl
		]);
		$query = $this->db->get($this->_table);
		return $query->row()->jumlah;
	}

	public function getChartPengeluaranBulanan($bln)
	{
		$query = $this->db->select_sum('jumlah');
		$query = $this->db->join('detail_keluar', $this->_table.'.no_keluar = detail_keluar.no_keluar');
		$query = $this->db->where([
			'MONTH(tgl_keluar)' => $bln,
			'YEAR(tgl_keluar)' => date('Y')
		]);
		$query = $this->db->get($this->_table);
		return $query->row()->jumlah;
	}

}