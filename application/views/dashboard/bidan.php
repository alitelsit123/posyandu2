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
		<!-- <div class="col-12">
			<div class="card">
				<div class="card-header">
					Grafik Data Anak
				</div>
				<div class="card-body">
					<div>
						<select name="" id="" class="form-control">
							<option value="" selected>Semua</option>
							<?php foreach($this->Anak_model->getDataAnak() as $row): ?>
							<option value="<?= $row["id_anak"] ?>"><?= $row["nama_anak"] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<canvas id="myChartSingle" style="width:100%;" class="mt-3"></canvas>
				</div>
			</div>
		</div> -->
</div>

<script>
	$(document).ready(function() {
		const xValues = [100,200,300,400,500,600,700,800,900,1000];

		new Chart("myChartSingle", {
			type: "line",
			data: {
				labels: xValues,
				datasets: [{ 
					data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
					borderColor: "red",
					fill: false
				}, { 
					data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
					borderColor: "green",
					fill: false
				}, { 
					data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
					borderColor: "blue",
					fill: false
				}]
			},
			options: {
				legend: {display: false}
			}
		});
	})
</script>
