<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Data MPASI</h3>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataMpasiModal">Tambah Data MPASI</button>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Kode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($mpasi as $n) : ?>
                                            <tr>
                                                <th scope="row">
                                                    <center><?= $i; ?></center>
                                                </th>
                                                <td><?= $n['keterangan']; ?></td>
                                                <td><?= $n['kode']; ?></td>
                                                <td>
                                                    <!-- <a data-toggle="modal" data-target="#viewDataAnakModal<?= $n['id_mpasi']; ?>" href="<?= base_url(); ?>anak/viewDataAnak/<?= $n['id_mpasi']; ?>" class="btn btn-info btn-circle btn-sm">
                                                        <i class="fa fa-sticky-note"></i>
                                                    </a> -->
                                                    <a href="<?= base_url(); ?>mpasi/editDataMpasi/<?= $n['id_mpasi']; ?>" class="btn btn-warning btn-circle btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="tooltip" href="<?= base_url(''); ?>mpasi/deleteDataMpasi/<?= $n['id_mpasi']; ?>" class="btn btn-danger btn-circle btn-sm tbl-hapus" title="Delete">
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
    <div class="modal fade bs-example-modal-lg" id="addDataMpasiModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Input Menu MPASI </h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="demo-form2" action="<?php echo base_url('mpasi/createDataMpasi') ?>" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 form-group">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nik-anak">Kombinasi Menu MPASI</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nik-anak" name="menu-mpasi" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-anak">Kode Menu</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nama-anak" name="kode-mpasi" required="required" class="form-control">
                                    </div>
                                </div>
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