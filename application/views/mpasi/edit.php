<!-- modals -->
<!-- Large modal -->
<div class="right_col" role="main">



    <form id="demo-form2" action="<?php echo base_url('mpasi/updateDataMpasi/') . $row['id_mpasi']; ?>" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id_mpasi'] ?>">

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
            <a href="<?= base_url() ?>mpasi" class="btn btn-warning">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

</div>