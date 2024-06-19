<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpasi_model extends CI_Model
{
    // MULAI CRUD DATA MPASI
    public function getDataMpasi()
    {
        $query = $this->db->get('mpasi');
        return $query->result_array();
    }

    public function edit($table, $data)
    {
        return $this->db->get_where($table, $data);
    }


    public function delDataMpasi($id)
    {
        $this->db->where('id_mpasi', $id);
        $this->db->delete('mpasi');
    }

    public function updDataMpasi($id, $data)
    {
        $this->db->where('id_mpasi', $id);
        $this->db->update('mpasi', $data);
    }
    // SELESAI CRUD DATA MPASI

    /*bagian rekomendasi MPASI*/

    //semua data rekomendasi
    public function getDataRekomenMpasi()
    {
        $this->db->select('anak.id_anak, anak.nama_anak,  ibu.nama_ibu,rekomendasi_mpasi.umur, rekomendasi_mpasi.jk, rekomendasi_mpasi.kalori, rekomendasi_mpasi.kode,rekomendasi_mpasi.keterangan,rekomendasi_mpasi.jml_kalori');
        $this->db->from('anak');
        // $this->db->join('penimbangan', 'anak.id_anak = penimbangan.anak_id');
        $this->db->join('ibu', 'anak.ibu_id = ibu.id_ibu');
        $this->db->join('rekomendasi_mpasi', 'anak.id_anak = rekomendasi_mpasi.id_anak');
        $query = $this->db->get()->result_array();

        // Debugging: Print the generated SQL query
        // echo $this->db->last_query();

        return $query;
    }



    //memilih semua nama anak
    public function getAllAnak()
    {
        // return $this->db->get('anak')->result_array();
        $this->db->select('penimbangan.id_penimbangan,anak.id_anak,anak.nama_anak,penimbangan.bb,penimbangan.tb,ibu.nama_ibu');
        $this->db->from('anak');
        $this->db->join('penimbangan', 'anak.id_anak=penimbangan.anak_id');
        $this->db->join('ibu', 'anak.ibu_id=ibu.id_ibu');
        $query = $this->db->get()->result_array();
        return $query;
    }

    //memilih anak untuk insert data rekomendasi menu mpasi
    public function getDataAnakDetail($id)
    {
        $this->db->select('anak.id_anak, anak.nama_anak, anak.tgl_lahir, anak.jenis_kelamin, penimbangan.bb, penimbangan.tb, ibu.nama_ibu');
        $this->db->from('anak');
        $this->db->join('penimbangan', 'anak.id_anak=penimbangan.anak_id');
        $this->db->join('ibu', 'anak.ibu_id=ibu.id_ibu');
        $this->db->where('anak.id_anak', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

     //memilih anak untuk insert data rekomendasi menu mpasi ->bagian menu penimbangan
     public function getDataAnakDetail2($id)
     {
         $this->db->select('anak.id_anak, anak.nama_anak, anak.tgl_lahir, anak.jenis_kelamin, ibu.nama_ibu');
         $this->db->from('anak');
         $this->db->join('ibu', 'anak.ibu_id=ibu.id_ibu');
         $this->db->where('anak.id_anak', $id);
         $query = $this->db->get()->row_array();
         return $query;
     }

    //menampilkan semua menu mpasi
    public function getAllMenu()
    {
        return $this->db->get('mpasi')->result_array();

    }

    //memilih menu rekomendasi mpasi berdasarkan kode mpasi
    public function getMpasiId($id)
    {
        $this->db->where('id_mpasi', $id);
        $query = $this->db->get('mpasi');
        return $query->row_array();
    }

    //get usia
    public function getMpasiByAge($ageInMonths) {
        $this->db->where('id_mpasi', $ageInMonths); // Sesuaikan dengan kolom yang sesuai di tabel mpasi
        return $this->db->get('mpasi')->row_array();
    }

    //menghitung jumlah kalori berdasarkan id_anak
    // public function calculateTotalCalorieIntake($id_anak)
    // {
    //     $this->db->select('anak.id_anak, anak.ibu_id, ibu.id_ibu, penimbangan.anak_id');
    //     $this->db->select_sum('kalori');
    //     $this->db->from('anak');
    //     $this->db->join('penimbangan', 'anak.id_anak=penimbangan.anak_id');
    //     $this->db->join('ibu', 'anak.ibu_id=ibu.id_ibu');
    //     $this->db->join('rekomendasi_mpasi','anak.id_anak=rekomendasi_mpasi.id_anak');
    //     $this->db->where('rekomendasi_mpasi.id_anak', $id_anak);
    //     $query = $this->db->get()->row();
    //     return $query ? $query->kalori : 0;    }

        public function getTotalCaloriesByIdAnak($id_anak) {
            // Mengambil total kalori berdasarkan id_anak dari tabel rekomendasi_mpasi
            $this->db->select_sum('jml_kalori');
            $this->db->where('id_anak', $id_anak);
            $query = $this->db->get('rekomendasi_mpasi');
            $result = $query->row_array();

            // Mengembalikan nilai total kalori
            return $result['jml_kalori'];
        }




        //detail data by id_anak data rekomendasi mpasi

        public function editRekomendasi($table, $data)
    {
        return $this->db->get_where($table, $data);
    }


    public function delDataRekomendasiMpasi($id)
    {
        $this->db->where('id_anak', $id);
        $this->db->delete('rekomendasi_mpasi');
    }

    public function updDataRekomendasiMpasi($id, $data)
    {
        $this->db->where('id_anak', $id);
        $this->db->update('rekomendasi_mpasi', $data);
    }
}
