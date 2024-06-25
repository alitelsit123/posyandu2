<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpasi_model');
    }

    // MULAI INDEX DATA MPASI
    public function index()
    {
        $data['title'] = 'Data Menu MPASI | Posyandu Desa Tanjung Tanah';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['jenis'] = $this->Mpasi_model->getAllAnak();

        $data['mpasi'] = $this->Mpasi_model->getDataMpasi();

        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('mpasi/index', $data);
        $this->load->view('templates/footer-datatables');
    }
    // SELESAI INDEX DATA MPASI

    // MULAI CREATE DATA MPASI
    public function createDataMpasi()
    {
        $data = [
            'keterangan' => $this->input->post('menu-mpasi'),
            'kode' => $this->input->post('kode-mpasi'),
        ];

        $this->db->insert('mpasi', $data);
        $this->session->set_flashdata('msg', 'Berhasil Ditambahkan');

        redirect('mpasi');
    }



    function editDataMpasi()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Edit Data MPASI | Posyandu Desa Tanjung Tanah';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['row'] = $this->Mpasi_model->edit('mpasi', array('id_mpasi' => $id))->row_array();

        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('mpasi/edit', $data);
        $this->load->view('templates/footer-datatables');
    }




    // MULAI UPDATE DATA MPASI
    public function updateDataMpasi($id)
    {
        // $id = $this->input->post['id_MPASI'];
        $data = [
            'keterangan' => $this->input->post('menu-mpasi'),
            'kode' => $this->input->post('kode-mpasi'),
        ];

        $this->Mpasi_model->updDataMpasi($id, $data);
        $this->session->set_flashdata('msg', 'Berhasil Diubah');

        redirect('mpasi/index');
    }
    // SELESAI UPDATE DATA MPASI

    // MULAI DELETE DATA MPASI
    public function deleteDataMpasi($id)
    {
        $this->Mpasi_model->delDataMpasi($id);
        $this->session->set_flashdata('msg', 'Berhasil Dihapus');

        redirect('mpasi/index');
    }
    // SELESAI DELETE DATA MPASI


    /*CRUD Rekomendasi*/

    //read data rekomendasi

    public function indexRekomendasi() {
        $data['title']='Data Menu Rekomendasi MPASI | Posyandu Desa Tanjung Tanah';
        $data['user']=$this->db->get_where('user',['username' =>$this->session->userdata('username')])->row_array();
        $data['namas'] = $this->Mpasi_model->getAllAnak();
        $data['menus'] = $this->Mpasi_model->getAllMenu();

        $data['rekomendasi']=$this->Mpasi_model->getDataRekomenMpasi();
        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi_mpasi/index', $data);
        $this->load->view('templates/footer-datatables');
    }

    //create data rekomendasi
    // public function createDataRekomendasi(){

    //     $id_anak=$this->input->post('id_anak');
    //     $anak=$this->Mpasi_model->getDataAnakDetail($id_anak);

    //     $id_mpasi=$this->input->post('id_mpasi');
    //     $mpasi=$this->Mpasi_model->getMpasiId($id_mpasi);

    //     $birthdate = new DateTime($anak['tgl_lahir']);
    //     $currentDate = new DateTime();
    //     $age = $birthdate->diff($currentDate);
    //     // Format the age to include years and months
    //     $ageInMonths = $age->y*12 + $age->m;

    //     $calorieIntake = 0; // Initialize calorie intake


    //     // Menghitung kalori berdasarkan usia anak
    //     if ($ageInMonths >= 6 && $ageInMonths <= 8) {
    //         $calorieIntake = 200;
    //         // $kode = 'M1';
    //         // $keterangan = 'pure ubi, smoothie pepaya';
    //     } elseif ($ageInMonths >= 9 && $ageInMonths <= 11) {
    //         $calorieIntake = 300;
    //         // $kode = 'M2';
    //         // $keterangan = 'pure brokoli wortel, pure beras merah melon';
    //     } elseif ($ageInMonths >= 12 && $ageInMonths <= 23) {
    //         $calorieIntake = 500;
    //         // $kode = 'M3';
    //         // $keterangan = 'bubur susu stroberi, bubur saring tuna';
    //     } else {
    //         $calorieIntake = 0; // Set default or handle other cases
    //         $kode = '';
    //         $keterangan = '';
    //     }

    //     // Memperoleh total kalori berdasarkan id_anak
    //     $totalCalories = $this->Mpasi_model->getTotalCaloriesByIdAnak($id_anak);

    //     // Menambahkan total kalori dengan kalori yang dihitung sekarang
    //     $jml_kalori = $totalCalories + $calorieIntake;

    //     $data=[
    //         'id_mpasi'=>$mpasi['id_mpasi'],
    //         'id_anak'=>$anak['id_anak'],
    //         'nama_ortu'=>$anak['nama_ibu'],
    //         'tb'=>$anak['tb'],
    //         'bb'=>$anak['bb'],
    //         'jk'=>$anak['jenis_kelamin'],
    //         'umur'=>$ageInMonths,
    //         'kalori'=>$calorieIntake,
    //         'jml_kalori' => $jml_kalori,
    //         'kode' => $mpasi['kode'],
    //         'keterangan' => $mpasi['keterangan'],
    //     ];
    //     $this->db->insert('rekomendasi_mpasi', $data);
    //     $this->session->set_flashdata('msg', 'Berhasil Ditambahkan');

    //     redirect('mpasi/indexRekomendasi');
    // }

    //detail data rekomendasi mpasi

    function editRekomendasi()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Edit Data MPASI | Posyandu Desa Tanjung Tanah';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['namas'] = $this->Mpasi_model->getAllAnak();
        $data['menus'] = $this->Mpasi_model->getAllMenu();

        $data['row'] = $this->Mpasi_model->editRekomendasi('rekomendasi_mpasi', array('id_anak' => $id))->row_array();

        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi_mpasi/edit', $data);
        $this->load->view('templates/footer-datatables');
    }

    //update data rekomendasi mpasi
    public function updDataRekomendasiMpasi($id)
    {
        $id_anak=$this->input->post('id_anak');
        $anak=$this->Mpasi_model->getDataAnakDetail($id_anak);

        $id_mpasi=$this->input->post('id_mpasi');
        $mpasi=$this->Mpasi_model->getMpasiId($id_mpasi);

        $birthdate = new DateTime($anak['tgl_lahir']);
        $currentDate = new DateTime();
        $age = $birthdate->diff($currentDate);
        // Format the age to include years and months
        $ageInMonths = $age->y*12 + $age->m;

        $calorieIntake = 0; // Initialize calorie intake


        // Menghitung kalori berdasarkan usia anak
        if ($ageInMonths >= 6 && $ageInMonths <= 8) {
            $calorieIntake = 200;
            // $kode = 'M1';
            // $keterangan = 'pure ubi, smoothie pepaya';
        } elseif ($ageInMonths >= 9 && $ageInMonths <= 11) {
            $calorieIntake = 300;
            // $kode = 'M2';
            // $keterangan = 'pure brokoli wortel, pure beras merah melon';
        } elseif ($ageInMonths >= 12 && $ageInMonths <= 23) {
            $calorieIntake = 500;
            // $kode = 'M3';
            // $keterangan = 'bubur susu stroberi, bubur saring tuna';
        } else {
            $calorieIntake = 0; // Set default or handle other cases
            $kode = '';
            $keterangan = '';
        }

        // Memperoleh total kalori berdasarkan id_anak
        $totalCalories = $this->Mpasi_model->getTotalCaloriesByIdAnak($id_anak);

        // Menambahkan total kalori dengan kalori yang dihitung sekarang
        $jml_kalori = $totalCalories + $calorieIntake;

        $data=[
            'id_mpasi'=>$mpasi['id_mpasi'],
            'id_anak'=>$anak['id_anak'],
            'nama_ortu'=>$anak['nama_ibu'],
            'tb'=>$anak['tb'],
            'bb'=>$anak['bb'],
            'jk'=>$anak['jenis_kelamin'],
            'umur'=>$ageInMonths,
            'kalori'=>$calorieIntake,
            'jml_kalori' => $jml_kalori,
            'kode' => $mpasi['kode'],
            'keterangan' => $mpasi['keterangan'],
        ];

        $this->Mpasi_model->updDataRekomendasiMpasi($id, $data);
        $this->session->set_flashdata('msg', 'Berhasil Diubah');

        redirect('mpasi/indexRekomendasi');
    }

    //delete data rekomendasi mpasi
    public function deleteDataRekomendasiMpasi($id)
    {
        $this->Mpasi_model->delDataRekomendasiMpasi($id);
        $this->session->set_flashdata('msg', 'Berhasil Dihapus');

        redirect('mpasi/indexRekomendasi');
    }



}
