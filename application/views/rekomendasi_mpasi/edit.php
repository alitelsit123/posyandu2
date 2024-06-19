<!-- modals -->
<!-- Large modal -->
<div class="right_col" role="main">



    <form id="demo-form2" action="<?php echo base_url('mpasi/updDataRekomendasiMpasi/') . $row['id_anak']; ?>" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id_anak'] ?>">

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
                            </div>
                        </div>

        <div class="modal-footer">
            <a href="<?= base_url() ?>mpasi" class="btn btn-warning">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

</div>