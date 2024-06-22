<!-- page content -->
<div class="right_col" role="main">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-female"></i></div>
                <div class="count"><?= $count_ibu; ?></div>
                <h3>Data Ibu</h3>
                <p></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-child"></i></div>
                <div class="count"><?= $count_anak; ?></div>
                <h3>Data Anak</h3>
                <p></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count"><?= $count_petugas; ?></div>
                <h3>Data Petugas</h3>
                <p></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count"><?= $count_log; ?></div>
                <h3>Login</h3>
                <p></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Dashboard <small>Bidan</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                        <h3>Selamat datang, <?= $user['name']; ?></h3>
                        <p>Aplikasi posyandu</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Grafik Data Penimbangan Anak
				</div>
				<div class="card-body">
					<form class="row form-cart">
						<div class="col-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
								<select name="year" id="" class="form-control" onchange="$('.form-cart').submit()">
									<?php foreach(range(2010,2050) as $row): ?>
									<option value="<?= $row ?>" 
									<?= isset($_GET["year"]) ? ($_GET["year"] == $row ? 'selected': ''):($row == date('Y') ? 'selected':'') ?>
									><?= $row ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Anak</label>
								<select name="anak_id" id="" class="form-control" onchange="$('.form-cart').submit()">
									<option value="" <?= isset($_GET["anak_id"]) ? '':'selected' ?>>Semua</option>
									<?php foreach($this->Anak_model->getDataAnak() as $row): ?>
									<option value="<?= $row["id_anak"] ?>"
									<?= isset($_GET["anak_id"]) ? ($_GET["anak_id"] == $row["id_anak"] ? 'selected': ''):'' ?>
									><?= $row["nama_anak"] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</Form>
					<h4 class="my-3">Perkembangan BB/U (Z-Score)</h4>
					<canvas id="myChartSinglebbu" style="width:100%;" class="mt-3"></canvas>
					<h4 class="my-3">Perkembangan PB/U (Z-Score)</h4>
					<canvas id="myChartSinglepbu" style="width:100%;" class="mt-3"></canvas>
					<h4 class="my-3">Perkembangan BB/PB (Z-Score)</h4>
					<canvas id="myChartSinglebbpb" style="width:100%;" class="mt-3"></canvas>
					<h4 class="my-3">Perkembangan BB Anak</h4>
					<canvas id="myChartSinglebb" style="width:100%;" class="mt-3"></canvas>
					<h4 class="my-3">Perkembangan PB Anak</h4>
					<canvas id="myChartSingletb" style="width:100%;" class="mt-3"></canvas>
				</div>
			</div>
		</div>
</div>

<?php
	$months = range(1,12);
	$monthText = array_map(function($item) {
		return bulan($item);
	}, $months);
	$anakIds = $this->Penimbangan_model->getDataAnakIbuByDateAndGroupID((isset($_GET['year']) ? $_GET['year']:null),(isset($_GET['anak_id']) ? $_GET['anak_id']:null));
	$anakMapperBBU = array_map(function($item) use ($months) {
		$penimbangan = $this->Penimbangan_model->getDataAnakIbuByDateAnd( (isset($_GET['year']) ? $_GET['year']:null),$item );
		$resItem = array_fill(0, 12, 0); // Initialize with 12 elements set to 0
    // Populate $resItem with data from $penimbangan
    foreach ($months as $month) {
			$filtered = array_filter($penimbangan, function($record) use ($month) {
					return ltrim($record['bulan']) == $month;
			});

			if (!empty($filtered)) {
					$firstMatch = reset($filtered); // Get the first matching record
					$n = $firstMatch;
					$bbu = 0;
					if ($n['usia'] >= 0 && $n['usia'] <= 24) {
						$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
						$umurId = $this->Antropometri_model->getDataUmurByBulan($n['usia'])[0]["id"];
						$antropometriMedian = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
						$min = $n['bb'] - $antropometriMedian;
						$toFixed = customRound($min);
						$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
						$antropometriResult = $this->Antropometri_model->getDataAntropometriUByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
						$bbu = ($antropometriMedian - $antropometriResult) != 0 ? ($n['bb'] - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($n['bb'] - $antropometriMedian);
					}
					$resItem[$month - 1] = $bbu; // Adjust index (months are 1-12, array indices are 0-11)
			} else {
				$resItem[$month - 1] = 0;
			}
		}

    return $resItem;
	}, array_column($anakIds,'id_anak'));
	$anakMapperPBU = array_map(function($item) use ($months) {
		$penimbangan = $this->Penimbangan_model->getDataAnakIbuByDateAnd( (isset($_GET['year']) ? $_GET['year']:null),$item );
		$resItem = array_fill(0, 12, 0); // Initialize with 12 elements set to 0
    // Populate $resItem with data from $penimbangan
    foreach ($months as $month) {
			$filtered = array_filter($penimbangan, function($record) use ($month) {
					return ltrim($record['bulan']) == $month;
			});

			if (!empty($filtered)) {
					$firstMatch = reset($filtered); // Get the first matching record
					$n = $firstMatch;
					$pbu = '-';
					if ($n['usia'] >= 0 && $n['usia'] <= 24) {
						$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
						$umurId = $this->Antropometri_model->getDataUmurByBulan($n['usia'])[0]["id"];
						$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriId)[0]["angka"];
						$min = $n['tb'] - $antropometriMedian;
						$toFixed = customRound($min);
						$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
						$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByUmurAndMetric($umurId,$antropometriIdFixedId)[0]["angka"];
						$pbu = ($antropometriMedian - $antropometriResult) != 0 ? ($n['tb'] - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($n['tb'] - $antropometriMedian);
					}
					$resItem[$month - 1] = $pbu; // Adjust index (months are 1-12, array indices are 0-11)
			} else {
				$resItem[$month - 1] = 0;
			}
		}

    return $resItem;
	}, array_column($anakIds,'id_anak'));
	$anakMapperBBPB = array_map(function($item) use ($months) {
		$penimbangan = $this->Penimbangan_model->getDataAnakIbuByDateAnd( (isset($_GET['year']) ? $_GET['year']:null),$item );
		$resItem = array_fill(0, 12, 0); // Initialize with 12 elements set to 0
    // Populate $resItem with data from $penimbangan
    foreach ($months as $month) {
			$filtered = array_filter($penimbangan, function($record) use ($month) {
					return ltrim($record['bulan']) == $month;
			});

			if (!empty($filtered)) {
					$firstMatch = reset($filtered); // Get the first matching record
					$n = $firstMatch;
					$bbpb = '-';
					if ($n['tb'] >= 45 && $n['tb'] <= 110) {
						$antropometriId = $this->Antropometri_model->getDataAntropometriByAngka(0)[0]["id"];
						$pbId = $this->Antropometri_model->getDataPanjangBadanByUkuran($n['tb'])[0]["id"];
						$antropometriMedian = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriId)[0]["angka"];
						$min = $n['bb'] - $antropometriMedian;
						$toFixed = customRound($min);
						$antropometriIdFixedId = $this->Antropometri_model->getDataAntropometriByAngka($toFixed)[0]["id"];
						$antropometriResult = $this->Antropometri_model->getDataAntropometriPBByPBAndMetric($pbId,$antropometriIdFixedId)[0]["angka"];
						$bbpb = ($antropometriMedian - $antropometriResult) != 0 ? ($n['bb'] - $antropometriMedian) / ($antropometriMedian - $antropometriResult): ($n['bb'] - $antropometriMedian);
					}
					$resItem[$month - 1] = $bbpb; // Adjust index (months are 1-12, array indices are 0-11)
			} else {
				$resItem[$month - 1] = 0;
			}
		}

    return $resItem;
	}, array_column($anakIds,'id_anak'));
	$anakMapperBB = array_map(function($item) use ($months) {
		$penimbangan = $this->Penimbangan_model->getDataAnakIbuByDateAnd( (isset($_GET['year']) ? $_GET['year']:null),$item );
		$resItem = array_fill(0, 12, 0); // Initialize with 12 elements set to 0
    // Populate $resItem with data from $penimbangan
    foreach ($months as $month) {
			$filtered = array_filter($penimbangan, function($record) use ($month) {
					return ltrim($record['bulan']) == $month;
			});

			if (!empty($filtered)) {
					$firstMatch = reset($filtered); // Get the first matching record
					$resItem[$month - 1] = $firstMatch['bb']; // Adjust index (months are 1-12, array indices are 0-11)
			} else {
				$resItem[$month - 1] = 0;
			}
		}

    return $resItem;
	}, array_column($anakIds,'id_anak'));
	$anakMapperTB = array_map(function($item) use ($months) {
		$penimbangan = $this->Penimbangan_model->getDataAnakIbuByDateAnd( (isset($_GET['year']) ? $_GET['year']:null),$item );
		$resItem = array_fill(0, 12, 0); // Initialize with 12 elements set to 0

    // Populate $resItem with data from $penimbangan
    foreach ($months as $month) {
			$filtered = array_filter($penimbangan, function($record) use ($month) {
					return ltrim($record['bulan']) == $month;
			});

			if (!empty($filtered)) {
					$firstMatch = reset($filtered); // Get the first matching record
					$resItem[$month - 1] = $firstMatch['tb']; // Adjust index (months are 1-12, array indices are 0-11)
			} else {
				$resItem[$month - 1] = 0;
			}
		}

    return $resItem;
	}, array_column($anakIds,'id_anak'));
	
?>
<script>
	$(document).ready(function() {
		const xValues = <?= json_encode($monthText) ?>;
		new Chart("myChartSinglebbu", {
			type: "line",
			data: {
				labels: xValues,
				datasets: [
					<?php foreach($anakMapperBBU as $bb): ?>
					{ 
						data: <?= json_encode($bb) ?>,
						borderColor: "green",
						fill: false
					}, 
					<?php endforeach; ?>
				]
			},
			options: {
				legend: {display: false}
			}
		});
		new Chart("myChartSinglepbu", {
			type: "line",
			data: {
				labels: xValues,
				datasets: [
					<?php foreach($anakMapperPBU as $bb): ?>
					{ 
						data: <?= json_encode($bb) ?>,
						borderColor: "green",
						fill: false
					}, 
					<?php endforeach; ?>
				]
			},
			options: {
				legend: {display: false}
			}
		});
		new Chart("myChartSinglebbpb", {
			type: "line",
			data: {
				labels: xValues,
				datasets: [
					<?php foreach($anakMapperBBPB as $bb): ?>
					{ 
						data: <?= json_encode($bb) ?>,
						borderColor: "green",
						fill: false
					}, 
					<?php endforeach; ?>
				]
			},
			options: {
				legend: {display: false}
			}
		});
		new Chart("myChartSinglebb", {
			type: "line",
			data: {
				labels: xValues,
				datasets: [
					<?php foreach($anakMapperBB as $bb): ?>
					{ 
						data: <?= json_encode($bb) ?>,
						borderColor: "green",
						fill: false
					}, 
					<?php endforeach; ?>
				]
			},
			options: {
				legend: {display: false}
			}
		});
		new Chart("myChartSingletb", {
			type: "line",
			data: {
				labels: xValues,
				datasets: [
					<?php foreach($anakMapperTB as $tb): ?>
					{ 
						data: <?= json_encode($tb) ?>,
						borderColor: "blue",
						fill: false
					}, 
					<?php endforeach; ?>
				]
			},
			options: {
				legend: {display: false}
			}
		});
	})
</script>
