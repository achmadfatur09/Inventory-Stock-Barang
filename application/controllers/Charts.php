<?php

class Charts extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'charts';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_penerimaan', 'm_penerimaan');
		$this->load->model('M_customer', 'm_customer');
	}

	public function index(){
		$this->data['title'] = 'Halaman Charts';
		$this->data['chart_stok_barang'] = $this->m_barang->getStokBarangByUkuran();
		$this->load->view('charts', $this->data);
	}

	public function get_chart()
	{
		$post = $this->input->post(NULL, TRUE);

		switch ($post["time"]) {
			case 'Mingguan':
				$labels = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

				if($post['type'] == "Pengeluaran"){
					foreach ($this->_getDateFromWeek() as $tgl) {
						$datas[] = $this->m_pengeluaran->getChartPengeluaranMingguan($tgl);
					}
				}else{
					foreach ($this->_getDateFromWeek() as $tgl) {
						$datas[] = $this->m_penerimaan->getChartPenerimaanMingguan($tgl);
					}
				}
				break;
			
			case 'Bulanan':
				$labels = ["Januari", "Februari","Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
				
				if($post['type'] == "Pengeluaran"){
					foreach($labels as $bln => $value){
						$datas[] = $this->m_pengeluaran->getChartPengeluaranBulanan($bln + 1);
					}
				}else{
					foreach($labels as $bln => $value){
						$datas[] = $this->m_penerimaan->getChartPenerimaanBulanan($bln + 1);
					}
				}
				break;
			
			default:
				
				break;
		}

		$data = [
			"labels" => $labels,
			"datas" => $datas
		];	
		
		echo json_encode($data);

	}

	private function _getDateFromWeek()
	{
		$dateTime = new DateTime();
		$dateTime->setISODate(date('Y'),date('W'));

		$result[] = $dateTime->format('Y-m-d');

		for ($i=1; $i <= 6; $i++) { 
			$dateTime->modify('+1 days');
			$result[] = $dateTime->format('Y-m-d');

		}

		return $result;
	}
}