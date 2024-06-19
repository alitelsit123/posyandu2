<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Daftar Penimbangan Anak Yang Telah Dilakukan</h3>
                    <div class="clearfix"></div>
                </div>
                <?php

                ?>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Anak</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nama Ibu</th>
                                            <th>Tanggal Penimbangan</th>
                                            <th>Usia Anak</th>
                                            <th>Berat Badan (KG)</th>
                                            <th>Panjang Badan (CM) (45-110)</th>
                                            <th>Deteksi</th>
																						<th>BB/U</th>
																						<th>PB/U</th>
																						<th>BB/PB</th>
                                            <th>Keterangan</th>
                                            <th>Dilakukan Oleh</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($row as $n) :
                                            $a = $this->anak_model->edit('anak', array('id_anak' => $n['anak_id']))->row_array();
                                            $b = $this->anak_model->edit('ibu', array('id_ibu' => $n['ibu_id']))->row_array();
                                            $c = $this->anak_model->edit('user', array('id_users' => $n['created_by']))->row_array();
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <center><?= $i; ?></center>
                                                </th>
                                                <td><?= $a['nama_anak'] ?? '-'; ?></td>
                                                <td><?= $n['tgl_lahir'] ?? '-'; ?></td>
                                                <td><?= $n['jenis_kelamin'] ?? '-'; ?></td>
                                                <td><?= $b['nama_ibu'] ?? '-'; ?></td>
                                                <td><?= $n['tgl_skrng'] ?? '-'; ?></td>
                                                <td><?= $n['usia'] ?? '-'; ?>&nbsp;Bulan</td>
                                                <td><?= $n['bb'] ?? '-'; ?></td>
                                                <td><?= $n['tb'] ?? '-'; ?></td>
                                                <td><?= $n['deteksi'] ?? '-'; ?></td>
                                                <!-- BB/U -->
																								<td>
																									<?php
																									$bbu = '-';
																									$bbuText = '-';
																									if ($n['usia'] >= 0 && $n['usia'] <= 24) {
																										$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
																										$umurId = $this->Antropometri_model->getDataUmurByBulan($n['usia'])[0]["id"];
																										$antropometriMedian = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
																										$min = $n['bb'] - $antropometriMedian;
																										$toFixed = customRound($min);
																										$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
																										$antropometriResult = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
																										$bbu = ($antropometriMedian - $antropometriResult) != 0 ? ($n['bb'] - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($n['bb'] - $antropometriMedian);
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
																									?>
																									<?= $bbuText ?>
																								</td>
                                                <!-- PB/U -->
																								<td>
																									<?php
																									$pbu = '-';
																									$pbuText = '-';
																									if ($n['usia'] >= 0 && $n['usia'] <= 24) {
																										$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
																										$umurId = $this->Antropometri_model->getDataUmurByBulan($n['usia'])[0]["id"];
																										$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
																										$min = $n['tb'] - $antropometriMedian;
																										$toFixed = customRound($min);
																										$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
																										$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
																										$pbu = ($antropometriMedian - $antropometriResult) != 0 ? ($n['tb'] - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($n['tb'] - $antropometriMedian);
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
																									?>
																									<?= $pbuText ?>
																								</td>
                                                <!-- BB/PB -->
																								<td>
																									<?php
																									$bbpb = '-';
																									$bbpbText = '-';
																									if ($n['tb'] >= 45 && $n['tb'] <= 110) {
																										$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
																										$pbId = $this->Antropometri_model->getDataPanjangBadanByUkuran($n['tb'])[0]["id"];
																										$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriId)[0]["angka"];
																										$min = $n['bb'] - $antropometriMedian;
																										$toFixed = customRound($min);
																										$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
																										$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriIdFixedId)[0]["angka"];
																										$bbpb = ($antropometriMedian - $antropometriResult) != 0 ? ($n['bb'] - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($n['bb'] - $antropometriMedian);
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
																									?>
																									<?= $bbpbText ?>
																								</td>
                                                <td><?= $n['ket'] ?? '-'; ?></td>
                                                <td><?= $c['name'] ?? '-'; ?></td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
