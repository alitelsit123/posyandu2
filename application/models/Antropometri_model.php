<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antropometri_model extends CI_Model
{
		// GET DATA UMUR
		public function getDataUmur()
		{
				$query = "SELECT umur.*
										From umur
										";

				return $this->db->query($query)->result_array();
		}
		// GET DATA UMUR SANITIZED
		public function getDataUmurByBulan($umur)
		{
				$query = "SELECT umur.*
										From umur
										where bulan=$umur
										limit 1
										";

				return $this->db->query($query)->result_array();
		}
		// GET DATA Panjang Badan
		public function getDataPanjangBadanByUkuran($ukuran)
		{
				$query = "SELECT panjang_badan.*
										From panjang_badan
										where ukuran >= $ukuran
										order by ukuran asc
										limit 1
										";

				return $this->db->query($query)->result_array();
		}
		// GET DATA Panjang Badan by ukuran
		public function getDataPanjangBadan()
		{
				$query = "SELECT panjang_badan.*
										From panjang_badan

										";

				return $this->db->query($query)->result_array();
		}
		// GET DATA ANTROPOMETRI METRIC By Angka
		public function getDataAntropometriByAngka($angka)
		{
				$query = "SELECT antropometri.*
										From antropometri
										where angka".($angka < 0 ? '>='.$angka:'<='.$angka)."
										order by angka ".($angka < 0 ? 'desc':'asc')."
										limit 1
										";
				return $this->db->query($query)->result_array();
		}
		// GET DATA ANTROPOMETRI METRIC
		public function getDataAntropometri()
		{
				$query = "SELECT antropometri.*
										From antropometri
										";

				return $this->db->query($query)->result_array();
		}
    // GET DATA ANTROPOMETRI UMUR
    public function getDataAntropometriU()
    {
        $query = "SELECT antropometri_bbu.*
                    From antropometri_bbu
                    ";

        return $this->db->query($query)->result_array();
    }
		// GET DATA FILTERED ANTROPOMETRI BBU
		public function getDataAntropometriUByUmurAndMetric($umurId,$antropometriId)
    {
        $query = "SELECT antropometri_bbu.*
                    From antropometri_bbu
										where umur_id=$umurId and antropometri_id=$antropometriId
										limit 1
                    ";

        return $this->db->query($query)->result_array();
    }
		// GET DATA ANTROPOMETRI PANJANG BADAN
    public function getDataAntropometriPB()
    {
        $query = "SELECT antropometri_bbpb.*
                    From antropometri_bbpb
                    ";

        return $this->db->query($query)->result_array();
    }
		// GET DATA FILTERED ANTROPOMETRI BBPB
		public function getDataAntropometriPBByPBAndMetric($panjangId,$antropometriId)
    {
        $query = "SELECT antropometri_bbpb.*
                    From antropometri_bbpb
										where panjang_badan_id=$panjangId and antropometri_id=$antropometriId
										limit 1
                    ";

        return $this->db->query($query)->result_array();
    }
		// GET DATA FILTERED ANTROPOMETRI PBU
		public function getDataAntropometriPBByUmurAndMetric($umurId,$antropometriId)
    {
        $query = "SELECT antropometri_pbu.*
                    From antropometri_pbu
										where umur_id=$umurId and antropometri_id=$antropometriId
										limit 1
                    ";

        return $this->db->query($query)->result_array();
    }
}
