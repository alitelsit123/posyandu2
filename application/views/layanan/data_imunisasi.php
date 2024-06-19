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
                                                <td><?= $a['nama_anak']; ?></td>
                                                <td><?= $n['tgl_lahir']; ?></td>
                                                <td><?= $n['jenis_kelamin']; ?></td>
                                                <td><?= $b['nama_ibu']; ?></td>
                                                <td><?= $n['tgl_skrng']; ?></td>
                                                <td><?= $n['usia']; ?>&nbsp;Bulan</td>
                                                <td><?= $n['imunisasi']; ?></td>
                                                <td><?= $n['vit_a']; ?></td>
                                                <td><?= $n['ket']; ?></td>
                                                <td><?= $c['name']; ?></td>

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