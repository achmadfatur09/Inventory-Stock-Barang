<?php

use Dompdf\Adapter\CPDF;      
use Dompdf\Dompdf;
use Dompdf\Exception;

class Pengeluaran extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
	}

	public function index(){
		$this->data['title'] = 'Pengeluaran Barang';
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/lihat', $this->data);
	}

	public function view_detail()
	{
		$report_filter = null;

		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihatDetail();
		$stok_keseluruhan = 0;
		$stok_filtered = 0;
		foreach($this->data['all_pengeluaran'] as $a){
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
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihatDetail($post);
			foreach($this->data['all_pengeluaran'] as $a){
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

		$this->load->view('pengeluaran/view_detail', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_distinct();
		$this->data['all_customer'] = $this->m_customer->lihat_cst();

		$this->load->view('pengeluaran/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));

		$data_keluar = [
			'no_keluar' => $this->input->post('no_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'nama_customer' => $this->input->post('nama_customer'),
			'nama_petugas' => $this->input->post('nama_petugas'),
		];

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			array_push($data_detail_keluar, ['no_keluar' => $this->input->post('no_keluar')]);
			$data_detail_keluar[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_keluar[$i]['warna'] = $this->input->post('warna_hidden')[$i];
			$data_detail_keluar[$i]['ukuran_kaos'] = $this->input->post('ukuran_kaos_hidden')[$i];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($this->m_pengeluaran->tambah($data_keluar) && $this->m_detail_keluar->tambah($data_detail_keluar)){
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) { 
				// $this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal min stok');
				$this->m_barang->min_stok($this->input->post('jumlah_hidden')[$i], $this->input->post('kode_barang_hidden')[$i]) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('pengeluaran');
		}
	}

	public function detail($no_keluar){
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/detail', $this->data);
	}

	public function hapus($no_keluar){
		if($this->m_pengeluaran->hapus($no_keluar) && $this->m_detail_keluar->hapus($no_keluar)){
			$this->session->set_flashdata('success', 'Invoice Pengeluaran <strong>Berhasil</strong> Dihapus!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Invoice Pengeluaran <strong>Gagal</strong> Dihapus!');
			redirect('pengeluaran');
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

	private $data= [];
	public function keranjang_barang(){
		$this->load->view('pengeluaran/keranjang');
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
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihatByTanggal($tglAwal, $tglAkhir);

			$this->data['tanggal'] = $tanggal;

			$this->data['title'] = 'Laporan Data Pengeluaran';
			$this->data['no'] = 1;

			$dompdf->setPaper('A4', 'potrait');
			$html = $this->load->view('pengeluaran/report', $this->data, true);
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
		}
	}

	public function export_detail($no_keluar){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['title'] = 'Laporan Detail Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'potrait');
		$html = $this->load->view('pengeluaran/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_view_detail(){
		$dompdf = new Dompdf();
		$post = $this->input->post(NULL, TRUE);
		if (isset($post)) {
			$tanggal = $post['tanggal'];
			$pecahTanggal = explode(' - ', $tanggal);
			$tglAwal = date('Y-m-d', strtotime($pecahTanggal[0]));
			$tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihatByTanggal($tglAwal, $tglAkhir);

			$this->data['tanggal'] = $tanggal;

			$this->data['title'] = 'Laporan Data Pengeluaran';
			$this->data['no'] = 1;

			$dompdf->setPaper('A4', 'potrait');
			$html = $this->load->view('pengeluaran/report', $this->data, true);
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
		}
	}

	public function export_detail_pengeluaran(){
		$dompdf = new Dompdf();
		$get = $this->input->get(NULL, TRUE);
		if (isset($get)) {
		$this->data['all_detail_keluar'] = $this->m_pengeluaran->lihatDetail($get);
		}else {
			$this->data['all_detail_keluar'] = $this->m_pengeluaran->lihatDetail();
		}
		$this->data['title'] = 'Laporan Data Pengeluaran';
		$this->data['no'] = 1;
		
		$dompdf->setPaper('A4', 'potrait');
		$html = $this->load->view('pengeluaran/view_detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	
	}
}