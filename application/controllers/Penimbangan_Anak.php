<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penimbangan_Anak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpasi_model');

        $this->load->model('Penimbangan_model');
        $this->load->model('Antropometri_model');
    }

    // MULAI MENAMPILKAN
    public function index()
    {
        $data['title'] = 'Penimbangan Anak | Posyandu Desa Tanjung Tanah';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['d_anak'] = $this->Penimbangan_model->getDataAnakIbu();

        // var_dump($data['d_anak']);
        // die;
        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('layanan/penimbangan-form', $data);
        $this->load->view('templates/footer-datatables');
    }
    // SELESAI MENAMPILKAN

    // MULAI TAMBAH DATA
    public function submit()
    {
        $data['title'] = 'Penimbangan Anak | Posyandu Sakura';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $deteksiValues = $_POST['deteksi'];

        $id_anak = $this->input->post('id_anak');
        $anak = $this->Mpasi_model->getDataAnakDetail2($id_anak);
        $usia = $this->input->post('usia');
        $currentDate = new DateTime();


        $calorieIntake = 0; // Initialize calorie intake

        $kode = '';
        $menu = '';


        // Menghitung kalori berdasarkan usia anak
        try {
					if ($usia >= 6 && $usia <= 8) {

							// Pilihan menu untuk usia 6-8 bulan
							switch ($usia) {
									case 6:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = $mpasi['id_mpasi'];
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 7:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 8:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									default:
											$menu = "Pilihan menu tidak tersedia";
							}
							$calorieIntake = 200; // Kalori untuk usia 6-8 bulan

					} elseif ($usia >= 9 && $usia <= 11) {
							// Pilihan menu untuk usia 9-11 bulan
							switch ($usia) {
									case 9:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 10:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 11:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									default:
											$menu = "Pilihan menu tidak tersedia";
							}
							$calorieIntake = 300; // Kalori untuk usia 9-11 bulan
					} elseif ($usia >= 12 && $usia <= 23) {
							// Pilihan menu untuk usia 12-23 bulan
							switch ($usia) {
									case 12:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 13:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 14:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 15:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 16:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;


									case 17:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;


									case 18:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 19:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 20:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 21:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;


									case 22:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									case 23:
											$mpasi = $this->db->get_where('mpasi', ['id_mpasi' => $usia - 5])->row_array();
											$id_mpasi = ($mpasi['id_mpasi'] ?? '');
											$kode = ($mpasi['kode'] ?? '');
											$menu = ($mpasi['keterangan'] ?? '');
											break;

									default:
											$menu = "Pilihan menu tidak tersedia";
							}
							$calorieIntake = 500; // Kalori untuk usia 12-23 bulan
					} else {
							$calorieIntake = 0; // Set default atau tangani kasus lainnya
							$menu = '';
					}
				} catch (\Throwable $th) {
					$calorieIntake = 0; // Set default atau tangani kasus lainnya
					$menu = 'Pilihan menu tidak tersedia';
				}

        // Memperoleh total kalori berdasarkan id_anak
        $totalCalories = $this->Mpasi_model->getTotalCaloriesByIdAnak($id_anak);

        // Menambahkan total kalori dengan kalori yang dihitung sekarang
        $jml_kalori = $totalCalories + $calorieIntake;

        $resp = $this->Penimbangan_model->add(
            array(
                'id_mpasi' => $id_mpasi,
                'anak_id' => $this->input->post('id_anak'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'ibu_id' => $this->input->post('ibu_id'),
                'usia' => $this->input->post('usia'),
                'deteksi' => $deteksiValues[0],
                'tgl'=>$currentDate->format('Y-m-d'),
                'tb' => $this->input->post('tb'),
                'bb' => $this->input->post('bb'),
                'tgl_skrng' => $this->input->post('tgl_skrng'),
                'ket' => $this->input->post('keterangan'),
                'created_by' => $user['id_users'],
            )
        );
        $data = [
            'id_mpasi' => $id_mpasi,
            'id_anak' => $anak['id_anak'],
						'id_penimbangan' => $resp,
            'nama_ortu' => $anak['nama_ibu'],
            'tb' => $this->input->post('tb'),
            'bb' => $this->input->post('bb'),
            'jk' => $this->input->post('jenis_kelamin'),
            'umur' => $usia,
            'kalori' => $calorieIntake,
            'jml_kalori' => $jml_kalori,
            'kode' => $kode,
            'keterangan' => $menu,
        ];
        $this->db->insert('rekomendasi_mpasi', $data);


        // $this->db->insert('penimbangan', $data);
        $this->session->set_flashdata('msg', ' Data Berhasil Ditambahkan');
        redirect('penimbangan_anak/index');
    }
    // SELESAI TAMBAH DATA


    function data_penimbangan()
    {

        // $q=$this->db->query("SELECT * FROM imunisasi WHERE id_imunisasi ORDER BY id_imunisasi DESC");
        // $b=$this->db->fetch_array($q);
        $data['title'] = 'Penimbangan Anak | Posyandu Sakura';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['row'] = $this->anak_model->edit('penimbangan', array('id_penimbangan'))->result_array();

        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('layanan/data_penimbangan', $data);
        $this->load->view('templates/footer-datatables');
    }
		
}
