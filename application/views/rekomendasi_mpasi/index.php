<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Data Rekomendasi MPASI</h3>
        </div>
    </div>
    <div class="flash-dataw" data-flashdata="<?php echo $this->session->flashdata('msg'); ?>"></div>
    <?php if ($this->session->flashdata('msg')) : ?>

    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <!-- <div class="x_title">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataRekomendasiModal">Tambah Data</button>
                    <div class="clearfix"></div>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Anak</th>
                                            <th>Nama Ibu</th>
                                            <th>Usia</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kalori</th>
                                            <th>Total Kalori</th>
                                            <th>Kode</th>
                                            <th>Menu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($rekomendasi as $n) : ?>
                                            <tr>
                                                <th scope="row">
                                                    <center><?= $i; ?></center>
                                                </th>
                                                <td><?= $n['nama_anak']; ?></td>
                                                <td><?= $n['nama_ibu']; ?></td>
                                                <td><?= $n['umur']; ?> Bulan</td>
                                                <td><?= $n['jk']; ?></td>
                                                <td><?= $n['kalori']; ?></td>
                                                <td><?= $n['jml_kalori']; ?></td>
                                                <td><?= $n['kode']; ?></td>
                                                <td><?= $n['keterangan']; ?></td>

                                                <td>

                                                    <a href="<?= base_url(); ?>mpasi/editRekomendasi/<?= $n['id_anak']; ?>" class="btn btn-warning btn-circle btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="tooltip" href="<?= base_url(''); ?>mpasi/deleteDataRekomendasiMpasi/<?= $n['id_anak']; ?>" class="btn btn-danger btn-circle btn-sm tbl-hapus" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
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

    <!-- modals -->
    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" id="addDataRekomendasiModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Form Data Rekomendasi </h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="demo-form2" action="<?php echo base_url('mpasi/createDataRekomendasi') ?>" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 form-group">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ibu_id">Nama Anak</label>
                                    <div class="col-md-9">
                                        <select name="id_anak" class="form-control" id="project-select">
                                            <option value="">--Nama Anak--</option>
                                            <?php foreach ($namas as $nama) : ?>
                                                <option value="<?= $nama['id_anak'] ?>"><?= $nama['nama_anak'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ibu_id">Menu MPASI</label>
                                    <div class="col-md-9">
                                        <select name="id_mpasi" class="form-control" id="project-select">
                                            <option value="">--Pilih Menu--</option>
                                            <?php foreach ($menus as $nama) : ?>
                                                <option value="<?= $nama['id_mpasi'] ?>"><?= $nama['keterangan'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-anak">Berat Badan</label>
                                    <div class="col-md-9">
                                        <input type="number" id="nama-anak" name="bb" required="required" class="form-control">
                                    </div>
                                </div> -->
                                <!-- <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tmt-lahir">Tinggi Badan</label>
                                    <div class="col-md-9">
                                        <input type="text" id="tmt-lahir" name="tt" class="form-control">
                                    </div>
                                </div> -->

                                <!-- <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="jenis-kelamin">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                        <select name="jenis-kelamin" id="jenis-kelamin" class="form-control" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>



</div>
</div>

</div>