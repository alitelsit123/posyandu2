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
			return $this->db->insert_id();
    }
    // SELESAI GET, ADD DATA ANAK IBU
		public function recommendMPSIById($penimbanganId = null)
    {
        $query = "SELECT *
                    From rekomendasi_mpasi 	
									".($penimbanganId ? "where id_penimbangan=".$penimbanganId:'');
        return $this->db->query($query)->result_array();
    }
		public function update($table, $data, $where) {
			$this->db->update('penimbangan', $data, $where);
			return $this->db->affected_rows();
		}
		public function delete($id) {
			// Delete the row
			$this->db->where('id_penimbangan', $id);
			return $this->db->delete('penimbangan'); // Returns TRUE on success, FALSE on failure
		}
}
