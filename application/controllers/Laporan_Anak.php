<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Anak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Laporan_model');
        $this->load->model('Antropometri_model');
        $this->load->model('Anak_model');
        $this->load->model('Penimbangan_model');
				
    }

    // MULAI MENAMPILKAN
    public function index()
    {
        $data['title'] = 'Laporan Anak | Posyandu Desa Tanjung Tanah';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['d_anak'] = $this->Laporan_model->getDataAnakIbu();

        $this->load->view('templates/header-datatables', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/daftar_data', $data);
        $this->load->view('templates/footer-datatables');
    }
    // SELESAI MENAMPILKAN
		function Cetak_Laporan_all() {
			$this->load->model('Laporan_model');
				$filter = [];
				$mpdf = new \Mpdf\Mpdf();
				// $watermark = base_url('assets/images/icon.png');
				// $logo = base_url('build/img/icon-posyandu.png');

				// $mpdf->SetHeader("<table width='100%'>
				// <tr>
				// <td width='50' align='center'><h1>POSYANDU EH INDAH</h1></td>
				// </tr>
				// </table>");
				$mpdf->SetFooter("Laporan Perkembangan Anak | Posyandu Sakura | {PAGENO}");
				$mpdf->SetMargins(0, 0, 10);

				$html = "<h1 align='center' style='margin-bottom:1px'>Laporan Perkembangan Anak</h1>";
        if ($this->input->is_ajax_request())
            $this->load->view('laporan/daftar_data_table', $data);
        // die;
        else {
					$anaks = $this->Anak_model->getDataAnak();
					foreach ($anaks as $row) {
						$filter['h.anak_id'] = $row['id_anak'];
            $filter['p.id_ibu'] = $row['ibu_id'];
            $filter['p.nama_suami'] = $row['nama_suami'];
            $filter['i.tgl_lahir'] = $row['tgl_lahir'];

            $dt = $this->Laporan_model->get($filter);
            $dtId = $this->Laporan_model->getId($filter);
            // var_dump($dt);
            // die;

            $html = $html . "<p align='left'><b>Tanggal Terakhir Periksa  : " . tanggal() . "</b></p>";

            //MUlai Data Anak
            $html = $html . "<h3>DATA ANAK</h3>";
            $html = $html . "<table>";
            $html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>NIK</td><td>:</td><td>" . ($dtId[0]->nik_anak ?? '') . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Nama Anak</td><td>:</td><td>" . ($dtId[0]->nama_anak ?? '') . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Tanggal Lahir</td><td>:</td><td>" . date_format(date_create(($dtId[0]->tgl_lahir ?? '')), "j F Y") . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Nama Ayah</td><td>:</td><td>" . ($dtId[0]->nama_suami ?? '') . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Nama Ibu</td><td>:</td><td>" . ($dtId[0]->nama_ibu ?? '') . "</td>";
						$html = $html . "</tr>";
            $html = $html . "</table>";
            //Selesai Data Anak

            $html = $html . "<br>";
            $html = $html . "<h3>REKAP DATA PENIMBANGAN DAN IMUNISASI ANAK</h3>";
            $html = $html . "<table border='1' cellspacing='0' cellpading='0' >";
            $html = $html . "<thead>";
            $html = $html . "<tr>";
            $html = $html . "<th>Tanggal Periksa</th>";
            $html = $html . "<th>Usia</th>";
            $html = $html . "<th>Berat Badan</th>";
            $html = $html . "<th>Tinggi Badan</th>";
            $html = $html . "<th>Deteksi</th>";
            $html = $html . "<th>Imunisasi</th>";
            $html = $html . "<th>Vit. A</th>";
            $html = $html . "<th>Keterangan</th>";
            $html = $html . "<th>BB/U</th>";
            $html = $html . "<th>PB/U</th>";
            $html = $html . "<th>BB/PB</th>";
            $html = $html . "</tr>";
            $html = $html . "</thead>";
            $html = $html . "<tbody>";
            foreach ($dt as $rows) {
								$bbu = '-';
								$bbuText = '-';
								if ($rows->usia >= 0 && $rows->usia <= 24) {
									$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
									$umurId = $this->Antropometri_model->getDataUmurByBulan($rows->usia)[0]["id"];
									$antropometriMedian = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
									$min = $rows->bb - $antropometriMedian;
									$toFixed = customRound($min);
									$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
									$antropometriResult = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
									$bbu = ($antropometriMedian - $antropometriResult) != 0 ? ($rows->bb - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($rows->bb - $antropometriMedian);
									if ($bbu < -3) {
										$bbuText = '<span class="badge badge-danger">Gizi Buruk</span>';
									} else if($bbu >= -3 && $bbu < -2) {
										$bbuText = '<span class="badge badge-warning">Gizi Kurang</span>';
									} else if($bbu >= -2 && $bbu <= 2) {
										$bbuText = '<span class="badge badge-success">Gizi Baik</span>';
									} else if($bbu > 2) {
										$bbuText = '<span class="badge badge-danger">Gizi Lebih</span>';
									}
								}
								$pbu = '-';
								$pbuText = '-';
								if ($rows->usia >= 0 && $rows->usia <= 24) {
									$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
									$umurId = $this->Antropometri_model->getDataUmurByBulan($rows->usia)[0]["id"];
									$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
									$min = $rows->tb - $antropometriMedian;
									$toFixed = customRound($min);
									$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
									$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
									$pbu = ($antropometriMedian - $antropometriResult) != 0 ? ($rows->tb - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($rows->tb - $antropometriMedian);
									if ($pbu < -3) {
										$pbuText = '<span class="badge badge-danger">Sangat Pendek</span>';
									} else if($pbu >= -3 && $pbu < -2) {
										$pbuText = '<span class="badge badge-warning">Pendek</span>';
									} else if($pbu >= -2 && $pbu <= 2) {
										$pbuText = '<span class="badge badge-success">Normal</span>';
									} else if($pbu > 2) {
										$pbuText = '<span class="badge badge-danger">Tinggi</span>';
									}
								}
								$bbpb = '-';
								$bbpbText = '-';
								if ($rows->tb >= 45 && $rows->tb <= 110) {
									$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
									$pbId = $this->Antropometri_model->getDataPanjangBadanByUkuran($rows->tb)[0]["id"];
									$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriId)[0]["angka"];
									$min = $rows->tb - $antropometriMedian;
									$toFixed = customRound($min);
									$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
									$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriIdFixedId)[0]["angka"];
									$bbpb = ($antropometriMedian - $antropometriResult) != 0 ? ($rows->tb - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($rows->tb - $antropometriMedian);
									if ($bbpb < -3) {
										$bbpbText = '<span class="badge badge-danger">Sangat Kurus</span>';
									} else if($bbpb >= -3 && $bbpb < -2) {
										$bbpbText = '<span class="badge badge-warning">Kurus</span>';
									} else if($bbpb >= -2 && $bbpb <= 2) {
										$bbpbText = '<span class="badge badge-success">Normal</span>';
									} else if($bbpb > 2) {
										$bbpbText = '<span class="badge badge-danger">Gemuk</span>';
									}
								}
                $html = $html . "<tr>";
                $html = $html . "<td align='center'>" . date_format(date_create($rows->tgl_skrng), "j F Y") . "</td><td align='center'>" . $rows->usia . ' bulan' . "</td><td align='center'>" . $rows->bb . ' kg' . "</td><td align='center'>" . $rows->tb . ' cm' . "</td><td align='center'>" . $rows->deteksi . "</td><td align='center'>" . $rows->imunisasi . "</td><td align='center'>" . $rows->vit_a . "</td><td align='center'>" . $rows->ket . "</td>".
								"<td>".$bbuText."</td>".
								"<td>".$pbuText."</td>".
								"<td>".$bbpbText."</td>";
                $html = $html . "</tr>";
            }
            $html = $html . "</tbody>";
            $html = $html . "</table>";
					}
					$mpdf->WriteHTML($html);
					$mpdf->Output('Semua Laporan Anak.pdf', 'I');
        }
		}
    function Cetak_Laporan()
    {
        $this->load->model('Laporan_model');
        $idanak = $this->input->post('id_anak');
        $idibu = $this->input->post('ibu_id');
        $namaayah = $this->input->post('nama_ayah');
        $tgllahir = $this->input->post('tgl_lahir');
        $filter = array();

        if ($idanak != '0')
					$filter['h.anak_id'] = $idanak;
					$filter['p.id_ibu'] = $idibu;
					$filter['p.nama_suami'] = $namaayah;
					$filter['i.tgl_lahir'] = $tgllahir;


        $data['laporan'] = $this->Laporan_model->get($filter);

        if ($this->input->is_ajax_request())
            $this->load->view('laporan/daftar_data_table', $data);
        // die;
        else {
            // echo 'print';
            // $html = $this->load->view('laporan/daftar_data_table', $data, true);
            // $mpdf = new \Mpdf\Mpdf();
            // $mpdf->WriteHTML($html);
            // $mpdf->Output();

            // $header = $this->ModLaporan->LaporanHeader($id_penilaian);
            // $detail = $this->ModLaporan->LaporanDetail($id_penilaian);
            $idanak = $this->input->post('id_anak');
            $idibu = $this->input->post('ibu_id');
            $namaayah = $this->input->post('nama_ayah');
            $tgllahir = $this->input->post('tgl_lahir');
            $filter = array();

            $filter['h.anak_id'] = $idanak;
            // $filter['p.id_ibu'] = $idibu;
            // $filter['p.nama_suami'] = $namaayah;
            // $filter['i.tgl_lahir'] = $tgllahir;

            $dt = $this->Laporan_model->get($filter);
            $dtId = $this->Laporan_model->getId($filter);
            // var_dump($dt);
            $mpdf = new \Mpdf\Mpdf();
            // $watermark = base_url('assets/images/icon.png');
            // $logo = base_url('build/img/icon-posyandu.png');

            // $mpdf->SetHeader("<table width='100%'>
            // <tr>
            // <td width='50' align='center'><h1>POSYANDU EH INDAH</h1></td>
            // </tr>
            // </table>");
            $mpdf->SetFooter("Laporan Perkembangan Anak | Posyandu Sakura | {PAGENO}");
            $mpdf->SetMargins(0, 0, 10);

            $html = "<h1 align='center' style='margin-bottom:1px'>Laporan Perkembangan Anak</h1>";

            $html = $html . "<p align='left'><b>Tanggal Terakhir Periksa  : " . tanggal() . "</b></p>";

            //MUlai Data Anak
            $html = $html . "<h3>DATA ANAK</h3>";
            $html = $html . "<table>";
            $html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>NIK</td><td>:</td><td>" . $dt[0]->nik_anak . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Nama Anak</td><td>:</td><td>" . $dt[0]->nama_anak . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Tanggal Lahir</td><td>:</td><td>" . date_format(date_create($dt[0]->tgl_lahir), "j F Y") . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Nama Ayah</td><td>:</td><td>" . $dt[0]->nama_suami . "</td>";
						$html = $html . "</tr>";
						$html = $html . "<tr>";
						$html = $html . "<td style='width:150px'>Nama Ibu</td><td>:</td><td>" . $dt[0]->nama_ibu . "</td>";
						$html = $html . "</tr>";
            $html = $html . "</table>";
            //Selesai Data Anak

            $html = $html . "<br>";
            $html = $html . "<h3>REKAP DATA PENIMBANGAN DAN IMUNISASI ANAK</h3>";
            $html = $html . "<table border='1' cellspacing='0' cellpading='0' >";
            $html = $html . "<thead>";
            $html = $html . "<tr>";
            $html = $html . "<th>Tanggal Periksa</th>";
            $html = $html . "<th>Usia</th>";
            $html = $html . "<th>Berat Badan</th>";
            $html = $html . "<th>Tinggi Badan</th>";
            $html = $html . "<th>Deteksi</th>";
            $html = $html . "<th>Imunisasi</th>";
            $html = $html . "<th>Vit. A</th>";
            $html = $html . "<th>Keterangan</th>";
            $html = $html . "<th>BB/U</th>";
            $html = $html . "<th>PB/U</th>";
            $html = $html . "<th>BB/PB</th>";
						$html = $html . "<th>Kalori MPSI</th>";
						$html = $html . "<th>Keterangan MPSI</th>";
            $html = $html . "</tr>";
            $html = $html . "</thead>";
            $html = $html . "<tbody>";
            foreach ($dtId as $rows) {
								$bbu = '-';
								$bbuText = '-';
								if ($rows->usia >= 0 && $rows->usia <= 24) {
									$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
									$umurId = $this->Antropometri_model->getDataUmurByBulan($rows->usia)[0]["id"];
									$antropometriMedian = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
									$min = $rows->bb - $antropometriMedian;
									$toFixed = customRound($min);
									$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
									$antropometriResult = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
									$bbu = ($antropometriMedian - $antropometriResult) != 0 ? ($rows->bb - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($rows->bb - $antropometriMedian);
									if ($bbu < -3) {
										$bbuText = '<span class="badge badge-danger">Gizi Buruk</span>';
									} else if($bbu >= -3 && $bbu < -2) {
										$bbuText = '<span class="badge badge-warning">Gizi Kurang</span>';
									} else if($bbu >= -2 && $bbu <= 2) {
										$bbuText = '<span class="badge badge-success">Gizi Baik</span>';
									} else if($bbu > 2) {
										$bbuText = '<span class="badge badge-danger">Gizi Lebih</span>';
									}
								}
								$pbu = '-';
								$pbuText = '-';
								if ($rows->usia >= 0 && $rows->usia <= 24) {
									$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
									$umurId = $this->Antropometri_model->getDataUmurByBulan($rows->usia)[0]["id"];
									$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
									$min = $rows->tb - $antropometriMedian;
									$toFixed = customRound($min);
									$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
									$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
									$pbu = ($antropometriMedian - $antropometriResult) != 0 ? ($rows->tb - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($rows->tb - $antropometriMedian);
									if ($pbu < -3) {
										$pbuText = '<span class="badge badge-danger">Sangat Pendek</span>';
									} else if($pbu >= -3 && $pbu < -2) {
										$pbuText = '<span class="badge badge-warning">Pendek</span>';
									} else if($pbu >= -2 && $pbu <= 2) {
										$pbuText = '<span class="badge badge-success">Normal</span>';
									} else if($pbu > 2) {
										$pbuText = '<span class="badge badge-danger">Tinggi</span>';
									}
								}
								$bbpb = '-';
								$bbpbText = '-';
								if ($rows->tb >= 45 && $rows->tb <= 110) {
									$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
									$pbId = $this->Antropometri_model->getDataPanjangBadanByUkuran($rows->tb)[0]["id"];
									$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriId)[0]["angka"];
									$min = $rows->tb - $antropometriMedian;
									$toFixed = customRound($min);
									$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
									$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriIdFixedId)[0]["angka"];
									$bbpb = ($antropometriMedian - $antropometriResult) != 0 ? ($rows->tb - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($rows->tb - $antropometriMedian);
									if ($bbpb < -3) {
										$bbpbText = '<span class="badge badge-danger">Sangat Kurus</span>';
									} else if($bbpb >= -3 && $bbpb < -2) {
										$bbpbText = '<span class="badge badge-warning">Kurus</span>';
									} else if($bbpb >= -2 && $bbpb <= 2) {
										$bbpbText = '<span class="badge badge-success">Normal</span>';
									} else if($bbpb > 2) {
										$bbpbText = '<span class="badge badge-danger">Gemuk</span>';
									}
								}
								$rmpasi = $this->Penimbangan_model->recommendMPSIById($rows->id_penimbangan)[0] ?? [];
                $html = $html . "<tr>";
                $html = $html . "<td align='center'>" . date_format(date_create($rows->tgl_skrng), "j F Y") . "</td><td align='center'>" . $rows->usia . ' bulan' . "</td><td align='center'>" . $rows->bb . ' kg' . "</td><td align='center'>" . $rows->tb . ' cm' . "</td><td align='center'>" . $rows->deteksi . "</td><td align='center'>" . $rows->imunisasi . "</td><td align='center'>" . $rows->vit_a . "</td><td align='center'>" . $rows->ket . "</td>".
								"<td>".$bbuText."</td>".
								"<td>".$pbuText."</td>".
								"<td>".$bbpbText."</td>".
								"<td>".($rmpasi["kalori"] ?? '')."</td>".
								"<td>".($rmpasi["keterangan"] ?? '')."</td>";
                $html = $html . "</tr>";
            }
            $html = $html . "</tbody>";
            $html = $html . "</table>";
            $mpdf->WriteHTML($html);
            $mpdf->Output('Laporan Anak.pdf', 'I');
        }
    }
}
