<?php

class M_penerimaan extends CI_Model {
	protected $_table = 'penerimaan';
	private $_TABLE_DETAIL_PENERIMAAN = 'detail_terima';

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

					$query = $this->db->order_by('tgl_terima', 'ASC');
					$query = $this->db->where('tgl_terima' . ' >=', $tglAwal);
					$query = $this->db->where('tgl_terima' . ' <=', $tglAkhir);
				}
				
			}
		}
		$query = $this->db->join($this->_TABLE_DETAIL_PENERIMAAN, $this->_TABLE_DETAIL_PENERIMAAN.'.no_terima='.$this->_table.'.no_terima');
		$query = $this->db->get($this->_table)->result();
		return $query;
	}

	public function lihatByTanggal($tglAwal, $tglAkhir){
		$query = $this->db->join($this->_TABLE_DETAIL_PENERIMAAN, $this->_TABLE_DETAIL_PENERIMAAN.'.no_terima='.$this->_table.'.no_terima');
		$query = $this->db->order_by('tgl_terima', 'ASC');
		$query = $this->db->where('tgl_terima' . ' >=', $tglAwal);
		$query = $this->db->where('tgl_terima' . ' <=', $tglAkhir);
		$query = $this->db->get($this->_table)->result();
		return $query;
	} 

	public function jumlah(){
		$query = $this->db->select_sum("jumlah");
		$query = $this->db->get($this->_TABLE_DETAIL_PENERIMAAN);
		return $query->row()->jumlah;
	}

	public function lihat_no_terima($no_terima){
		return $this->db->get_where($this->_table, ['no_terima' => $no_terima])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_terima){
		return $this->db->delete($this->_table, ['no_terima' => $no_terima]);
	}

	public function gettahun()
	{
		$query = $this->db->query("SELECT YEAR(tgl_terima) AS tahun FROM  penerimaan GROUP BY  YEAR(tgl_terima) ORDER BY  YEAR(tgl_terima) ASC" );

		return $query->result();
	}

	public function getdatatim()
	{
		$query = $this->db->query("SELECT * FROM customer ORDER BY nama ASC ");

		return $query->result();
	}

	public function filterbytanggal($tanggalawal,$tanggalakhir)
	{
		$query = $this->db->query("SELECT * FROM penerimaan WHERE tgl_terima BETWEEN '$tanggalawal' and '$tanggalakhir' ORDER BY tgl_terima ASC" );

		return $query->result();
	}

	public function getChartPenerimaanMingguan($tgl)
	{
		$query = $this->db->select_sum('jumlah');
		$query = $this->db->join('detail_terima', $this->_table.'.no_terima = detail_terima.no_terima');
		$query = $this->db->where(['DATE(tgl_terima)' => $tgl]);
		$query = $this->db->get($this->_table);
		return $query->row()->jumlah;
	}

	public function getChartPenerimaanBulanan($bln)
	{
		$query = $this->db->select_sum('jumlah');
		$query = $this->db->join('detail_terima', $this->_table.'.no_terima = detail_terima.no_terima');
		$query = $this->db->where([
			'MONTH(tgl_terima)' => $bln,
			'YEAR(tgl_terima)' => date('Y')
		]);
		$query = $this->db->get($this->_table);
		return $query->row()->jumlah;
	}

}