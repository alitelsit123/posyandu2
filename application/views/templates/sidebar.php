<div class="col-md-3 left_col sidebar_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a class="site_title" style="display: flex; align-items: center;">
                <img src="<?= base_url('vendors/kab_kerinci.png'); ?>" width="20%" style="margin-right: 10px;">
                <span>POSYANDU</span>
            </a>
        </div>

        <div class="clearfix"></div>
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1) : ?>
                        <!-- Tautan Dashboard Admin -->
                        <li><a href="<?= base_url('dashboard/admin') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <?php elseif ($user['level_id'] == 2) : ?>
                        <!-- Tautan Dashboard Petugas -->
                        <li><a href="<?= base_url('dashboard/petugas') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <?php elseif ($user['level_id'] == 3) : ?>
                        <!-- Tautan Dashboard Bidan -->
                        <li><a href="<?= base_url('dashboard/bidan') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <?php endif; ?>


                </ul>
            </div>
            <div class="menu_section">
                <h3>Master Data</h3>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1) : ?>
                        <!-- Hanya tampilkan tautan Data Anak jika pengguna adalah admin -->
                        <li><a href="<?= base_url('ibu') ?>"><i class="fa fa-female"></i> Data Ibu</a>
                        </li> <?php endif; ?>

                </ul>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1) : ?>
                        <!-- Hanya tampilkan tautan Data Anak jika pengguna adalah admin -->
                        <li><a href="<?= base_url('anak') ?>"><i class="fa fa-child"></i> Data Anak</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1) : ?>
                        <!-- Hanya tampilkan tautan Data Anak jika pengguna adalah admin -->
                        <li><a href="<?= base_url('petugas') ?>"><i class="fa fa-users"></i> Data Petugas</a></li>
                    <?php endif; ?>

                </ul>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1) : ?>
                        <li><a href="<?= base_url('bidan') ?>"><i class="fa fa-users"></i> Data Bidan</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1 || $user['level_id'] == 2) : ?>
                        <li><a href="<?= base_url('mpasi') ?>"><i class="fa fa-list"></i> Data MPASI</a>
                        </li>
                    <?php endif; ?>

                </ul>
								<ul class="nav side-menu">
                    <?php if ($user['level_id'] == 1) : ?>
                        <li><a href="<?= base_url('antropometri') ?>"><i class="fa fa-list"></i> Data Antropometri</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Layanan</h3>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 3 || $user['level_id'] == 2) : ?>
                        <li><a href="<?= base_url('mpasi/indexRekomendasi') ?>"><i class="fa fa-file-text"></i> Rekomendasi MPASI</a>
                        </li>
                    <?php endif; ?>

                </ul>

                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 3 || $user['level_id'] == 2) : ?>
                        <li><a href="<?= base_url('penimbangan_anak/index') ?>"><i class="fa fa-file-text"></i> Penimbangan Anak</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 3 || $user['level_id'] == 2) : ?>
                        <li><a href="<?= base_url('penimbangan_anak/data_penimbangan') ?>"><i class="fa fa-list"></i> Data Penimbangan</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 3 || $user['level_id'] == 2) : ?>
                        <li><a href="<?= base_url('imunisasi_anak/index') ?>"><i class="fa fa-plus-square"></i> Imunisasi Anak</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <ul class="nav side-menu">
                    <?php if ($user['level_id'] == 3 && $user['level_id'] == 2) : ?>
                        <li><a href="<?= base_url('imunisasi_anak/data_imunisasi') ?>"><i class="fa fa-list"></i> Data Imunisasi</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Laporan</h3>
                <ul class="nav side-menu">
                    <li><a href="<?= base_url('laporan_anak/index') ?>"><i class="fa fa-file-pdf-o"></i> Laporan Anak</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
