<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penimbangan_model extends CI_Model
{
    public $table = "penimbangan";

    // MULAI GET, ADD DATA ANAK IBU
    public function getDataAnakIbu()
    {
        $query = "SELECT anak.*, ibu.nama_ibu
                    From anak JOIN ibu
                    ON anak.ibu_id = ibu.id_ibu
                    ";

        return $this->db->query($query)->result_array();
    }

		// MULAI GET, ADD DATA ANAK IBU difilter
    public function getDataAnakIbuByDateAndGroupID($year = null,$anakId = null)
    {
        $query = "SELECT anak.id_anak
                    From penimbangan 
										JOIN anak
                    ON penimbangan.anak_id = anak.id_anak
										where YEAR(tgl_skrng)=".($year ? $year:date('Y'))." ".($anakId ? 'and anak_id='.$anakId: '').' group by anak.id_anak';
				var_dump($query);
        return $this->db->query($query)->result_array();
    }

		// MULAI GET, ADD DATA ANAK IBU difilter
    public function getDataAnakIbuByDateAnd($year = null,$anakId = null)
    {
        $query = "SELECT anak.nama_anak,penimbangan.usia,penimbangan.bb,penimbangan.tb,MONTH(penimbangan.tgl_skrng) as bulan
                    From penimbangan 
										JOIN anak
                    ON penimbangan.anak_id = anak.id_anak
										where YEAR(tgl_skrng)=".($year ? "$year":date('Y'))." ".($anakId ? 'and anak_id='.$anakId: '');

        return $this->db->query($query)->result_array();
    }

    function add($data)
    {
        $this->db->insert($this->table, $data);
    }
    // SELESAI GET, ADD DATA ANAK IBU
}
