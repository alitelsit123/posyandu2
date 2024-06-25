<div class="right_col" role="main">
		<?php
		if (isset($_GET["did"])) {
			$this->Penimbangan_model->delete($_GET["did"]);
			redirect(base_url('Penimbangan_Anak/data_penimbangan'));
		}
		?>
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
																<div class="form-group">
																	<label for="">Cari Tahun</label>
																	<form action="" method="get">
																		<input type="hidden" name="fmonth" value="<?= isset($_GET["fmonth"]) ? $_GET["fmonth"]:'' ?>" />
																		<select id="filterYearPenimbangan" name="fyear" onchange="this.form.submit()" class="form-control">
																			<option value="">-- Cari Tahun --</option>
																			<?php
																			foreach (range(1999,2100) as $in) {
																				if (isset($_GET["fyear"]) && $_GET["fyear"] == $in) {
																					echo '<option value="'.$in.'" selected>'.$in.'</option>';
																				} else {
																					echo '<option value="'.$in.'" >'.$in.'</option>';
																				}

																			}
																			?>
																		</select>
																	</form>
																</div>
																<div class="form-group">
																	<label for="">Cari Bulan</label>
																	<form action="" method="get">
																		<input type="hidden" name="fyear" value="<?= isset($_GET["fyear"]) ? $_GET["fyear"]:'' ?>" />
																		<select id="filterMonthPenimbangan" name="fmonth" class="form-control" onchange="this.form.submit()">
																			<option value="">-- Cari Bulan --</option>
																			<?php
																			foreach (range(01,12) as $in) {
																				if (isset($_GET["fmonth"]) && $_GET["fmonth"] == $in) {
																					echo '<option value="'.$in.'" selected>'.$in.'</option>';
																				} else {
																					echo '<option value="'.$in.'">'.$in.'</option>';
																				}
																			}
																			?>
																		</select>
																	</form>
																</div>
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
																						<th>Kalori</th>
                                            <th>Rekomendasi MPASI</th>
                                            <th>Dilakukan Oleh</th>
																						<th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($row as $n) :
																					$year = explode('-', $n['tgl_skrng'])[0];
																					$month = explode('-', $n['tgl_skrng'])[1];
																					if (isset($_GET["fyear"]) && $_GET["fyear"] != $year) {
																						continue;
																					}
																					if (isset($_GET["fmonth"]) && $_GET["fmonth"] != $month) {
																						continue;
																					}
																					$a = $this->anak_model->edit('anak', array('id_anak' => $n['anak_id']))->row_array();
																					$b = $this->anak_model->edit('ibu', array('id_ibu' => $n['ibu_id']))->row_array();
																					$c = $this->anak_model->edit('user', array('id_users' => $n['created_by']))->row_array();
																					$rmpasi = $this->Penimbangan_model->recommendMPSIById($n['id_penimbangan']);
																					if (isset($rmpasi[0])) {
																						$rmpasi = $rmpasi[0];
																					} else {
																						$rmpasi = [];
																					}

                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <center><?= $i; ?></center>
                                                </th>
                                                <td><?= isset($a['nama_anak']) ? $a['nama_anak']: ''; ?></td>
                                                <td><?= isset($n['tgl_lahir']) ? $n['tgl_lahir']: ''; ?></td>
                                                <td><?= isset($n['jenis_kelamin']) ? $n['jenis_kelamin']: ''; ?></td>
                                                <td><?= isset($b['nama_ibu']) ? $b['nama_ibu']: ''; ?></td>
                                                <td><?= isset($n['tgl_skrng']) ? $n['tgl_skrng']: ''; ?></td>
                                                <td><?= isset($n['usia']) ? $n['usia']: ''; ?>&nbsp;Bulan</td>
                                                <td><?= isset($n['bb']) ? $n['bb']: ''; ?></td>
                                                <td><?= isset($n['tb']) ? $n['tb']: ''; ?></td>
                                                <td><?= isset($n['deteksi']) ? $n['deteksi']: ''; ?></td>
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
                                                <td><?= isset($n['ket']) ? $n['ket']: ''; ?></td>
																								<td>
                                                  <?= (isset($rmpasi["kalori"]) ? $rmpasi["kalori"]:'') ?>
                                                </td>
                                                <td>
																									<?php if($n['usia'] < 6): ?>
																									Tidak Ada Menu Rekomendasi
																									<?php else: ?>
																										<?= (isset($rmpasi["keterangan"]) ? $rmpasi["keterangan"]:'') ?>
																									<?php endif; ?>
                                                </td>
                                                <td><?= isset($c['name']) ? $c['name']: ''; ?></td>
																								<td>
																									<?php if((isset($a['nama_anak']) ? $a['nama_anak']:false)): ?> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $i - 1; ?>">
																												Edit
																										</button> <?php endif; ?>
																									<?php if((isset($a['nama_anak']) ? $a['nama_anak']:false)): ?> 
																										<form action="" method="get">
																											<input type="hidden" name="did" id="" value="<?= $n["id_penimbangan"] ?>">
																											<button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus ?');">
																												Hapus
																											</button>
																										</form> 
																									<?php endif; ?>
																								</td>
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
		<?php foreach($row as $i => $n): ?>
			<?php
			$a = $this->anak_model->edit('anak', array('id_anak' => $n['anak_id']))->row_array();
			$b = $this->anak_model->edit('ibu', array('id_ibu' => $n['ibu_id']))->row_array();
			$c = $this->anak_model->edit('user', array('id_users' => $n['created_by']))->row_array();	
			?>
			<div class="modal fade" id="editModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $i; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $i; ?>">Edit Data Anak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('Penimbangan_Anak/update_method') ?>" method="post">
                        <input type="hidden" name="id_penimbangan" value="<?= $n['id_penimbangan'] ?>">
                        <input type="hidden" name="id_mpasi" value="<?= $n['id_mpasi'] ?>">
                        <input type="hidden" name="usia" value="<?= $n['usia'] ?>">
                        <input type="hidden" name="id_anak" value="<?= $a['id_anak'] ?>">
                        <input type="hidden" name="id_ibu" value="<?= $a['ibu_id'] ?>">
												<div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Sekarang
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="date-picker form-control" value="<?= $n["tgl_skrng"] ?>" name="tgl_skrng" id="tgl_skrng" type="text" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'text';
                                        }, 60000);
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="usia">Usia
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input type=number step=any id="usia" name="usia" value="<?= $n["usia"] ?>" class="form-control">
                            </div>
                            <label class="col-form-label label-align" for="bulan">bulan
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="bb">Berat Badan [BB]
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input type=number step=any id="bb" value="<?= $n["bb"] ?>" name="bb" class="form-control">
                            </div>
                            <label class="col-form-label label-align" for="bb">kg
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="tb">Panjang Badan [PB]
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input type=number step=any id="tb" name="tb" value="<?= $n["tb"] ?>" class="form-control">
                            </div>
                            <label class="col-form-label label-align" for="tb">cm
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Deteksi</label>
                            <div class="col-md-6 col-sm-6 ">
                                <p style="margin-top: 5px !important;margin-bottom: -2rem !important;">
                                    <input type="radio" class="flat" name="deteksi[]" id="deteksiS" value="Sesuai" <?= $n["deteksi"] == 'Sesuai' ? 'checked':'' ?> /> Sesuai
                                    <input type="radio" class="flat" name="deteksi[]" id="deteksiT" value="Tidak Sesuai" <?= $n["deteksi"] == 'Tidak Sesuai' ? 'checked':'' ?> /> Tidak Sesuai
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Keterangan
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <textarea id="keterangan" class="form-control" name="keterangan" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?= $n["ket"] ?></textarea>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" id="proses" name="proses" class="btn btn-success">Proses</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		<?php endforeach; ?>
</div>
<script>
	$('#datatable')
</script>
