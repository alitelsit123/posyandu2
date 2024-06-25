<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antropometri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antropometri_model');
    }

    // MULAI INDEX DATA ANTROPOMETRI
    public function index()
    {
        $data['title'] = 'Data Antropometri | Posyandu Desa Tanjung Tanah';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $user_level = $this->session->userdata('level_id');
				
				// CALL ANTROPOMETRI 3D FROM DB
        $data['umur'] = $this->Antropometri_model->getDataUmur();
        $data['pb'] = $this->Antropometri_model->getDataPanjangBadan();
        $data['antropometri'] = $this->Antropometri_model->getDataAntropometri();
        $data['antropometri_umur'] = $this->Antropometri_model->getDataAntropometriU();
        $data['antropometri_pb'] = $this->Antropometri_model->getDataAntropometriPB();

        $this->load->view('templates/header-datatables', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('templates/topbar', $data);
				$this->load->view('antropometri/index', $data);
				$this->load->view('templates/footer-datatables');


    }
}
