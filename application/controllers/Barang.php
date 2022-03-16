<?php

use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

class Barang extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang', 'm_barang');
	}

	public function index(){
		$report_filter = null;

		$this->data['all_barang'] = $this->m_barang->lihat();
		$stok_keseluruhan = 0;
		$stok_filtered = 0;
		foreach($this->data['all_barang'] as $a){
			$stok_keseluruhan += $a->stok;
		}

		$post = $this->input->post(NULL, TRUE);
		$this->data['filter'] = [
			'nama_barang' => null,
			'warna' => null,
			'ukuran_kaos' => null
		];
		
		if (isset($post['filter'])) {
			unset($post['filter']);
			$this->data['all_barang'] = $this->m_barang->lihat($post);
			foreach($this->data['all_barang'] as $a){
				$stok_filtered += $a->stok;
			}
			$this->data['filter'] = [
				'nama_barang' => $post['nama_barang'],
				'warna' => $post['warna'],
				'ukuran_kaos' => $post['ukuran_kaos']
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
		
		$this->data['title'] = 'Data Stok Gudang';
		$this->data['no'] = 1;
		$this->data['stok_keseluruhan'] = $stok_keseluruhan;
		$this->data['stok_filtered'] = $stok_filtered;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Stok';

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'warna' => $this->input->post('warna'),
			'ukuran_kaos' => $this->input->post('ukuran_kaos'),
			'stok' => $this->input->post('stok'),
			'satuan' => $this->input->post('satuan'),
			'status' => $this->input->post('status'),
		];

		if($this->m_barang->tambah($data)){
			$this->session->set_flashdata('success', 'Data Stok Kaos <strong>Berhasil</strong> Ditambahkan!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Stok Kaos <strong>Gagal</strong> Ditambahkan!');
			redirect('barang');
		}
	}

	public function ubah($kode_barang){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->load->view('barang/ubah', $this->data);
	}

	public function proses_ubah($kode_barang){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'warna' => $this->input->post('warna'),
			'ukuran_kaos' => $this->input->post('ukuran_kaos'),
			'stok' => $this->input->post('stok'),
			'satuan' => $this->input->post('satuan'),
			'status' => $this->input->post('status'),
		];

		if($this->m_barang->ubah($data, $kode_barang)){
			$this->session->set_flashdata('success', 'Data Stok Kaos <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Stok Kaos <strong>Gagal</strong> Diubah!');
			redirect('barang');
		}
	}

	public function hapus($kode_barang){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_barang->hapus($kode_barang)){
			$this->session->set_flashdata('success', 'Data Stok Kaos <strong>Berhasil</strong> Dihapus!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Stok Kaos <strong>Gagal</strong> Dihapus!');
			redirect('barang');
		}
	}

	public function report(){

		$dompdf = new Dompdf();

		$get = $this->input->get(NULL, FALSE);
		if (isset($get)) {
			$this->data['all_barang'] = $this->m_barang->lihat($get);
		}else{
			$this->data['all_barang'] = $this->m_barang->lihat();
		}
		
		
		$this->data['title'] = 'Laporan Data Stok Kaos';
		$this->data['no'] = 1;
		
		$html = $this->output->get_output();
		$this->load->library('pdf');

		$dompdf->setPaper('A4', 'potrait');
		$html = $this->load->view('barang/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Stok Tgl ' . date('d-m-Y'), array("Attachment" => false));

	}
}