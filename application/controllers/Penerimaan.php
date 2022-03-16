<?php

use Dompdf\Adapter\CPDF;      
use Dompdf\Dompdf;
use Dompdf\Exception;

class Penerimaan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'penerimaan';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_penerimaan', 'm_penerimaan');
		$this->load->model('M_detail_terima', 'm_detail_terima');
	}

	public function index(){
		$this->data['title'] = 'Penerimaan Barang';
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat();
		$this->data['no'] = 1;

		$this->load->view('penerimaan/lihat', $this->data);
	}

	public function view_detail()
	{
		$report_filter = null;
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihatDetail();
		$stok_keseluruhan = 0;
		$stok_filtered = 0;
		foreach($this->data['all_penerimaan'] as $a){
			$stok_keseluruhan += $a->jumlah;
		}

		// $this->data['all_barang'] = $this->m_barang->lihat();
		$post = $this->input->post(NULL, TRUE);
		
		$this->data['filter'] = [
			'nama_barang' => null,
			'warna' => null,
			'ukuran_kaos' => null,
			'tanggal' => null
		];
		if (isset($post['filter'])) {
			unset($post['filter']);
			$this->data['all_penerimaan'] = $this->m_penerimaan->lihatDetail($post);
			foreach($this->data['all_penerimaan'] as $a){
				$stok_filtered += $a->jumlah;
			}
			$this->data['filter'] = [
				'nama_barang' => $post['nama_barang'],
				'warna' => $post['warna'],
				'ukuran_kaos' => $post['ukuran_kaos'],
				'tanggal' => $post['tanggal']
			];

			$report_filter = '?';
			foreach ($post as $key => $value) {
				if ($value != '') {
					$report_filter .= $key."=".$value;
					$report_filter .= '&';
				}
			}
		}
		$this->data['report_filter'] = $report_filter;
		
		$this->data['title'] = 'Data Detail Penerimaan';
		$this->data['no'] = 1;

		$this->data['stok_keseluruhan'] = $stok_keseluruhan;
		$this->data['stok_filtered'] = $stok_filtered;

		$this->load->view('penerimaan/view_detail', $this->data);
	}

	public function filter(){
			// $tanggalawal = $this->input->post('tanggalawal');
			// $tanggalakhir = $this->input->post('tanggalakhir');

			$tanggalawal = '';
			$tanggalakhir = '';

			if ($nilaifilter = 1) {

				$data['title'] = "Laporan barang masuk by tanggal";
				$data['subtitle'] = "Dari tanggal : ".$tanggalawal.' Sampai Tanggal : '.$tanggalakhir;
				$data['datafilter'] = $this->m_penerimaan->filterbytanggal($tanggalawal,$tanggalakhir);

				$this->load->view('penerimaan/print_laporan', $data);
			} elseif ($nilaifilter = 2) {

				$data['title'] = "Laporan barang masuk by Team";
				$data['datafilter'] = $this->m_penerimaan->getdatatim();

				$this->load->view('penerimaan/print_laporan', $data);
			}

	}

	public function tambah(){
		$this->data['title'] = 'Tambah Stok Penerimaan';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_distinct();
		$this->data['all_supplier'] = $this->m_supplier->lihat_spl();
		$this->data['all_customer'] = $this->m_customer->lihat_cst();


		$this->load->view('penerimaan/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_diterima = count($this->input->post('nama_barang_hidden'));

		$data_terima = [
			'no_terima' => $this->input->post('no_terima'),
			'tgl_terima' => $this->input->post('tgl_terima'),
			'jam_terima' => $this->input->post('jam_terima'),
			'nama_supplier' => $this->input->post('nama_supplier'),
			'nama_petugas' => $this->input->post('nama_petugas'),
		];

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			array_push($data_detail_terima, ['no_terima' => $this->input->post('no_terima')]);
			$data_detail_terima[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_terima[$i]['warna'] = $this->input->post('warna_hidden')[$i];
			$data_detail_terima[$i]['ukuran_kaos'] = $this->input->post('ukuran_kaos_hidden')[$i];
			$data_detail_terima[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($this->m_penerimaan->tambah($data_terima) && $this->m_detail_terima->tambah($data_detail_terima)){
			for ($i=0; $i < $jumlah_barang_diterima ; $i++) { 
				// $this->m_barang->plus_stok($data_detail_terima[$i]['jumlah'], $data_detail_terima[$i]['nama_barang']) or die('gagal min stok');
				$this->m_barang->plus_stok($this->input->post('jumlah_hidden')[$i], $this->input->post('kode_barang_hidden')[$i]) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('penerimaan');
		}
	}

	public function detail($no_terima){
		$this->data['title'] = 'Detail Penerimaan';
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['no'] = 1;

		$this->load->view('penerimaan/detail', $this->data);
	}

	public function hapus($no_terima){
		if($this->m_penerimaan->hapus($no_terima) && $this->m_detail_terima->hapus($no_terima)){
			$this->session->set_flashdata('success', 'Invoice Penerimaan <strong>Berhasil</strong> Dihapus!');
			redirect('penerimaan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penerimaan <strong>Gagal</strong> Dihapus!');
			redirect('penerimaan');
		}
	}


	public function get_barang_warna(){
		$data = $this->m_barang->lihat_warna_barang_by_nama($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function get_barang_ukuran(){
		$data = $this->m_barang->lihat_ukuran_barang_by_nama($_POST['nama_barang'], $_POST['warna']);
		echo json_encode($data);
	}

	public function get_barang_detail(){
		$data = $this->m_barang->lihat_detail_barang_by_nama($_POST['nama_barang'], $_POST['warna'], $_POST['ukuran_kaos']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('penerimaan/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		$post = $this->input->post(NULL, TRUE);
		if (isset($post)) {
			$tanggal = $post['tanggal'];
			$pecahTanggal = explode(' - ', $tanggal);
			$tglAwal = date('Y-m-d', strtotime($pecahTanggal[0]));
			$tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));
			
			// $this->data['perusahaan'] = $this->m_usaha->lihat();
			$this->data['all_penerimaan'] = $this->m_penerimaan->lihatByTanggal($tglAwal, $tglAkhir);

			$this->data['tanggal'] = $tanggal;
			
			$this->data['title'] = 'Laporan Data Penerimaan';
			$this->data['no'] = 1;
			
			$dompdf->setPaper('A4', 'potrait');
			$html = $this->load->view('penerimaan/report', $this->data, true);
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	
		}
	}

	public function export_detail($no_terima){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['title'] = 'Laporan Detail Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'potrait');
		$html = $this->load->view('penerimaan/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail_penerimaan(){
		$dompdf = new Dompdf();
		$get = $this->input->get(NULL, TRUE);
		if (isset($get)) {
		$this->data['all_detail_terima'] = $this->m_penerimaan->lihatDetail($get);
		}else {
			$this->data['all_detail_terima'] = $this->m_penerimaan->lihatDetail();
		}
		$this->data['title'] = 'Laporan Data Penerimaan';
		$this->data['no'] = 1;
		
		$dompdf->setPaper('A4', 'potrait');
		$html = $this->load->view('penerimaan/view_detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	
	}
}