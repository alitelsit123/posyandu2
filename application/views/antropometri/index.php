<div class="right_col" role="main">
	<div class="page-title">
			<div class="title_left">
					<h3>Data Antropometri</h3>
			</div>
	</div>
	<div class="flash-dataw" data-flashdata="<?php echo $this->session->flashdata('msg'); ?>"></div>
	<?php if ($this->session->flashdata('msg')) : ?>

	<?php endif; ?>
	<div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataAnakModal">Tambah Data Anak</button>
                    <div class="clearfix"></div> -->
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
																<h4 class="mb-3">Antropometri Umur</h4>
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
																					<th rowspan="2" width="15%">Umur (Bulan)</th>
																					<th colspan="7">Berat Badan (KG)</th>
                                        </tr>
																				<tr>
																					<!-- LOOPING METRIC -->
																					<?php foreach ($antropometri as $row): ?>
																					<th><?= $row["angka"] ?></th>
																					<?php endforeach; ?>
                                        </tr>
                                    </thead>

                                    <tbody>
																			  <!-- LOOPING 3D TABEL -->
                                        <?php foreach ($umur as $rowUmur) : ?>  
																					<tr>
																						<td><?= $rowUmur["bulan"] ?></td>
																						<?php foreach ($antropometri as $rowAntropometri): ?>
																						<td><?= $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($rowUmur["id"],$rowAntropometri["id"])[0]["angka"] ?></td>
																						<?php endforeach; ?>
																					</tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
														<div class="card-box table-responsive">
																<h4 class="my-3">Antropometri Panjang Badan</h4>
																<table class="datatable" class="table table-striped table-bordered" style="width:100%">
																		<thead>
																				<tr>
																					<th rowspan="2" width="15%">Umur (Bulan)</th>
																					<th colspan="7">Panjang Badan (CM)</th>
																				</tr>
																				<tr>
																					<!-- LOOPING METRIC -->
																					<?php foreach ($antropometri as $row): ?>
																					<th><?= $row["angka"] ?></th>
																					<?php endforeach; ?>
																				</tr>
																		</thead>

																		<tbody>
																				<!-- LOOPING 3D TABEL -->
																				<?php foreach ($pb as $rowPB) : ?>  
																					<tr>
																						<td><?= $rowPB["ukuran"] ?></td>
																						<?php foreach ($antropometri as $rowAntropometri): ?>
																						<td><?= $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($rowPB["id"],$rowAntropometri["id"])[0]["angka"] ?></td>
																						<?php endforeach; ?>
																					</tr>
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
	</div>

</div>
