<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Daftar Imunisasi Yang Telah Dilakukan</h3>
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
                                            <th>Tanggal Imunisasi</th>
                                            <th>Usia Anak</th>
                                            <th>Jenis Imunisasi</th>
                                            <th>Vitamin</th>
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
                                                <td><?= $a['nama_anak'] ?? ''; ?></td>
                                                <td><?= $n['tgl_lahir'] ?? ''; ?></td>
                                                <td><?= $n['jenis_kelamin'] ?? ''; ?></td>
                                                <td><?= $b['nama_ibu'] ?? ''; ?></td>
                                                <td><?= $n['tgl_skrng'] ?? ''; ?></td>
                                                <td><?= $n['usia'] ?? ''; ?>&nbsp;Bulan</td>
                                                <td><?= $n['imunisasi'] ?? ''; ?></td>
                                                <td><?= $n['vit_a'] ?? ''; ?></td>
                                                <td><?= $n['ket'] ?? ''; ?></td>
                                                <td><?= $c['name'] ?? ''; ?></td>
																								<td>
																									<?php if(($a["nama_anak"] ?? false)): ?> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $i - 1; ?>">
																												Edit
																										</button> <?php endif; ?>
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
                    <form action="<?= site_url('imunisasi_anak/update_method') ?>" method="post">
                        <input type="hidden" name="id_imunisasi" value="<?= $n['id_imunisasi'] ?>">
												<div class="form-group">
                            <label for="nama_anak">Usia</label>
                            <input type="text" class="form-control" id="usia" name="usia" value="<?= $n['usia'] ?? ''; ?>">
                        </div>
												<div class="form-group">
                            <label for="nama_anak">imunisasi</label>
                            <select name="imunisasi" id="" class="form-control">
																<option value="BCG (Bacillus Calmette-Guérin):" <?= $n['imunisasi'] == 'BCG (Bacillus Calmette-Guérin):' ? 'selected' : '' ?>>BCG (Bacillus Calmette-Guérin):</option>
																<option value="Hepatitis B" <?= $n['imunisasi'] == 'Hepatitis B' ? 'selected' : '' ?>>Hepatitis B</option>
																<option value="DPT (Difteri, Pertusis, Tetanus)" <?= $n['imunisasi'] == 'DPT (Difteri, Pertusis, Tetanus)' ? 'selected' : '' ?>>DPT (Difteri, Pertusis, Tetanus)</option>
																<option value="Polio" <?= $n['imunisasi'] == 'Polio' ? 'selected' : '' ?>>Polio</option>
																<option value="Hib (Haemophilus influenzae tipe b)" <?= $n['imunisasi'] == 'Hib (Haemophilus influenzae tipe b)' ? 'selected' : '' ?>>Hib (Haemophilus influenzae tipe b)</option>
																<option value="PCV (Pneumococcal Conjugate Vaccine)" <?= $n['imunisasi'] == 'PCV (Pneumococcal Conjugate Vaccine)' ? 'selected' : '' ?>>PCV (Pneumococcal Conjugate Vaccine)</option>
																<option value="Rotavirus" <?= $n['imunisasi'] == 'Rotavirus' ? 'selected' : '' ?>>Rotavirus</option>
																<option value="MR/MMR (Measles, Rubella / Measles, Mumps, Rubella)" <?= $n['imunisasi'] == 'MR/MMR (Measles, Rubella / Measles, Mumps, Rubella)' ? 'selected' : '' ?>>MR/MMR (Measles, Rubella / Measles, Mumps, Rubella)</option>
																<option value="Varicella" <?= $n['imunisasi'] == 'Varicella' ? 'selected' : '' ?>>Varicella</option>
																<option value="-" <?= !(in_array($n['imunisasi'], ['BCG (Bacillus Calmette-Guérin)','Hepatitis B','DPT (Difteri, Pertusis, Tetanus)','Polio','Hib (Haemophilus influenzae tipe b)','PCV (Pneumococcal Conjugate Vaccine)','Rotavirus','MR/MMR (Measles, Rubella / Measles, Mumps, Rubella)','Varicella'])) ? 'selected' : '' ?>>Lain lain</option>
														</select>
														<input type=text id="" name="imun_custom" class="form-control ic<?= $n['id_imunisasi'] ?>" 
														<?php if(in_array($n['imunisasi'], ['BCG (Bacillus Calmette-Guérin)','Hepatitis B','DPT (Difteri, Pertusis, Tetanus)','Polio','Hib (Haemophilus influenzae tipe b)','PCV (Pneumococcal Conjugate Vaccine)','Rotavirus','MR/MMR (Measles, Rubella / Measles, Mumps, Rubella)','Varicella'])): ?>
														style="display:none;"
														<?php endif; ?>
														value="<?= $n['imunisasi'] ?>"
														placeholder="Input Manual" />
														<script>
															$(document).ready(function() {
																$('select[name="imunisasi"]').change(function() {
																	if ($(this).val() == '-') {
																		$('.ic<?= $n['id_imunisasi'] ?>').show()
																	} else {
																		$('.ic<?= $n['id_imunisasi'] ?>').hide()
																	}
																});
															})
														</script>
                        </div>
												<div class="form-group">
                            <label for="nama_anak">vit_a</label>
														<select name="vit_a" class="form-control">
																<option value="Vitamin A" <?= $n['vit_a'] == 'Vitamin A' ? 'selected' : '' ?>>Vitamin A</option>
																<option value="Vitamin C" <?= $n['vit_a'] == 'Vitamin C' ? 'selected' : '' ?>>Vitamin C</option>
																<option value="Vitamin D" <?= $n['vit_a'] == 'Vitamin D' ? 'selected' : '' ?>>Vitamin D</option>
																<option value="Zat Besi" <?= $n['vit_a'] == 'Zat Besi' ? 'selected' : '' ?>>Zat Besi</option>
																<option value="Yodium" <?= $n['vit_a'] == 'Yodium' ? 'selected' : '' ?>>Yodium</option>
																<option value="-" <?= !(in_array($n['vit_a'], ['Vitamin A','Vitamin C','Vitamin D','Zat Besi','Yodium'])) == '-' ? 'selected' : '' ?>>Lain lain</option>
														</select>
														<input type=text id="" name="vit_custom" class="form-control vitc<?= $n['id_imunisasi'] ?>" 
														<?php if(in_array($n['vit_a'], ['Vitamin A','Vitamin C','Vitamin D','Zat Besi','Yodium'])): ?>
														style="display:none;"
														<?php endif; ?>

														value="<?= $n['vit_a'] ?>" placeholder="Input Manual" />
														<script>
															$(document).ready(function() {
																$('select[name="vit_a"]').change(function() {
																	if ($(this).val() == '-') {
																			$('.vitc<?= $n['id_imunisasi'] ?>').show();
																	} else {
																			$('.vitc<?= $n['id_imunisasi'] ?>').hide();
																	}
																});
															})
														</script>
                        </div>
												<div class="form-group">
                            <label for="nama_anak">ket</label>
                            <input type="text" class="form-control" id="ket" name="ket" value="<?= $n['ket'] ?? ''; ?>">
                        </div>
                        <!-- Add other form fields as needed -->
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
		<?php endforeach; ?>
</div>
