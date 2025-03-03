	<style type="text/css">
		.home {
			margin: 5px;
			padding: 10px;
			background: #DDD;
			color: #111;
			border-left: blue solid 5px;
			font-weight: 35px;
		}
	</style>

	<?php
	$month = date('n');
	$year = date('Y');
	$produksidash = mysqli_query($con, "SELECT * FROM penilaian_akhir_pemilik WHERE bagian='produksi' AND id_periode_bulan_fk='$month' AND nama_periode_tahun_fk='$year'");
	$produksikary = mysqli_query($con, "SELECT * FROM karyawan WHERE jabatan='Staf Produksi'");
	$penjualandash = mysqli_query($con, "SELECT * FROM penilaian_akhir_pemilik WHERE bagian='penjualan' AND id_periode_bulan_fk='$month' AND nama_periode_tahun_fk='$year'");
	$penjualankary = mysqli_query($con, "SELECT * FROM karyawan WHERE jabatan='Staf Penjualan'");
	$gudangdash = mysqli_query($con, "SELECT * FROM penilaian_akhir_pemilik WHERE bagian='gudang' AND id_periode_bulan_fk='$month' AND nama_periode_tahun_fk='$year'");
	$gudangkary = mysqli_query($con, "SELECT * FROM karyawan WHERE jabatan='Staf Gudang'");
	?>

	<?php if ($_SESSION['logged'] == 1): ?>
		<div class="box">
			<div class="box-header">
				<h2 class="box-title" style="font-weight: bold;">Penilaian Pemilik</h2>
			</div>
			<div class="box-body">
			<div class="col-lg-4 col-8">
			<!-- small box -->
			<div class="small-box bg-primary">
				<div class="inner">
					<span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($produksidash) ?></span> Sudah Dinilai <span style="font-weight: bold; font-size: 6vh;">/</span><span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($produksikary) ?></span>Karyawan&nbsp;<span>produksi</span>
					<p>Produksi</p>
					
				</div>

			</div>
		</div>
		<div class="col-lg-4 col-8">
			<div class="small-box bg-warning">
				<div class="inner">
					<span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($gudangdash) ?></span> Sudah Dinilai <span style="font-weight:bold; font-size:6vh">/</span><span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($gudangkary) ?></span>Karyawan&nbsp;<span>gudang</span>
					<p>Gudang </p>
				</div>

			</div>
		</div>
		<div class="col-lg-4 col-8">
			<div class="small-box bg-danger">
				<div class="inner">
				<span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($penjualandash) ?></span>Sudah Dinilai <span style="font-weight: bold; font-size: 6vh;">/</span><span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($penjualankary) ?></span>Karyawan&nbsp;<span>penjualan</span>
					<p>Penjualan</p>
				</div>

			</div>
		</div>
			</div>
		</div>
		
	<?php endif; ?>
	<?php
	$koorproduksi = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_produksi WHERE id_periode_bulan_fk='$month' AND id_periode_tahun_fk='$year'");
	$koorgudang = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_gudang WHERE id_periode_bulan_fk='$month' AND id_periode_tahun_fk='$year'");
	$koorpenjualan = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_penjualan WHERE id_periode_bulan_fk='$month' AND id_periode_tahun_fk='$year'")
	?>
	<div class="box">
		<div class="box-header">
			<h2 class="box-title" style="font-weight: bold;">Penilaian Koordinator</h2>
		</div>
		<div class="box-body">
		<?php if ($_SESSION['logged'] == 2 || $_SESSION['logged'] == 1): ?>
		<div class="col-lg-4 col-8">
			<div class="small-box bg-primary">
				<div class="inner">
				<span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($koorproduksi) ?></span>Sudah Dinilai <span style="font-weight: bold; font-size: 6vh;">/</span><span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($produksikary) ?></span>Karyawan&nbsp;<span>produksi</span>

					<p> Produksi </p>
				</div>

			</div>
		</div>


	<?php endif; ?>
	<?php if ($_SESSION['logged'] == 3 || $_SESSION['logged'] == 1): ?>
		<div class="col-lg-4 col-8">
			<div class="small-box bg-warning">
				<div class="inner">
				<span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($koorgudang) ?></span>Sudah Dinilai <span style="font-weight: bold; font-size: 6vh;">/</span><span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($gudangkary) ?></span>Karyawan&nbsp;<span>gudang</span>
					<p>Gudang  </p>
				</div>

			</div>
		</div>
	<?php endif; ?>
	<?php if ($_SESSION['logged'] == 4 || $_SESSION['logged'] == 1): ?>
		<div class="col-lg-4 col-8">
			<div class="small-box bg-danger">
				<div class="inner">
				<span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($koorpenjualan) ?></span>Sudah Dinilai <span style="font-weight: bold; font-size: 6vh;">/</span><span style="font-weight: bold; font-size: 6vh;"><?= mysqli_num_rows($penjualankary) ?></span>Karyawan&nbsp;<span>penjualan</span>

					<p>Penjualan </p>
				</div>

			</div>
		</div>
	<?php endif; ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<?php if($_SESSION['logged'] == 1):?>
						<h2 class="box-title">Grafik Rata Rata Penilaian Setiap Bagian per Bulan Tahun <?php echo $year ?></h2>
					<?php else:?>
							<h2 class="box-title">Grafik Rata Rata Penilaian per Bulan Tahun 2025 <?php echo $year ?></h2>
					<?php endif;?>
				</div>
				<div class="box-body">
					<?php
					$yearsin = date('Y');
					$monthsin = date('n');
					$month = mysqli_query($con, "SELECT * FROM periode_bulan");
					$year = mysqli_query($con, "SELECT * FROM periode_tahun");

					$monthsingle = mysqli_query($con, "SELECT * FROM periode_bulan WHERE id_periode_bulan = '$monthsin'");
					$fetchMonth = mysqli_fetch_assoc($monthsingle);
					$yearsingle = mysqli_query($con, "SELECT * FROM periode_tahun WHERE nama_tahun='$yearsin'");
					$fetchYear = mysqli_fetch_assoc($yearsingle);
					?>

					<?php
					$yearnow = date('Y');
					$data = mysqli_query($con, "SELECT * FROM penilaian_akhir_pemilik WHERE nama_periode_tahun_fk='$yearnow'");
					//$datajson = json_encode($data);
					$dataku = [];
					foreach ($data as $d) {
						$dataku[] = $d;
					}
					$datajson = json_encode($dataku);
					?>

					<!-- Grafik in here -->
					<input type="hidden" name="" value="<?php echo $_SESSION['logged'] ?>" id="session-dashboard">
					<?php if ($_SESSION['logged'] == 1): ?>
						<canvas id="myChart" width="400" height="200"></canvas>
					<?php endif; ?>
					<?php if ($_SESSION['logged'] == 2): ?>
						<canvas id="myChartKoorProduksi" width="400" height="200"></canvas>

					<?php endif; ?>
					<?php if ($_SESSION['logged'] == 3): ?>
						<canvas id="myChartKoorGudang" width="400" height="200"></canvas>
					<?php endif; ?>
					<?php if ($_SESSION['logged'] == 4): ?>
						<canvas id="myChartKoorPenjualan" width="400" height="200"></canvas>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
	$yearnowbagian = date('Y');
	$dataProduksi = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_produksi WHERE id_periode_tahun_fk='$yearnowbagian'");
	if (isset($_POST['year'])) {
		$yearnowbagians = $_POST['year'];
		echo 'sdsd';
		echo $yearnowbagians;
		$dataProduksi = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_produksi WHERE id_periode_tahun_fk='$yearnowbagians'");
	}
	$dataarrprod = [];
	foreach ($dataProduksi as $dp) {
		$dataarrprod[] = $dp;
	}
	$dataProduksijson = json_encode($dataarrprod);


	$dataGudang = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_gudang WHERE id_periode_tahun_fk = '$yearnowbagian'");
	$dataarrgud = [];
	foreach ($dataGudang as $dg) {
		$dataarrgud[] = $dg;
	}
	$dataGudangjson = json_encode($dataarrgud);

	$dataPenjualan = mysqli_query($con, "SELECT * FROM penilaian_akhir_koor_penjualan WHERE id_periode_tahun_fk = '$yearnowbagian'");
	$dataarrpenj = [];
	foreach ($dataPenjualan as $dj) {
		$dataarrpenj[] = $dj;
	}

	$dataPenjualanjson = json_encode($dataarrpenj);
	?>
	<script>
		const sessionDashboard = document.getElementById("session-dashboard");


		function angkaKeBulanKoor(angka) {
			const bulan = {
				1: "Januari",
				2: "Februari",
				3: "Maret",
				4: "April",
				5: "Mei",
				6: "Juni",
				7: "Juli",
				8: "Agustus",
				9: "September",
				10: "Oktober",
				11: "November",
				12: "Desember",
			}
			return bulan[angka]
		}

		const bulanDataKoor = [];


		if (sessionDashboard.value == 2) {
			const dataframeProduksi = <?php echo $dataProduksijson; ?>;

			const groupedDataKoorProduksi = dataframeProduksi.reduce((acc, item) => {
				if (!acc[item.id_periode_bulan_fk]) {

					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					};
				};
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			}, {});
			const averagePerMonthKoorProduksi = Object.keys(groupedDataKoorProduksi).map(bulan => ({
				bulan: parseInt(bulan),
				rataRata: groupedDataKoorProduksi[bulan].total / groupedDataKoorProduksi[bulan].count
			}));
			const arrDataScoreKoorProduksi = [];
			const dataKoorProduksi = averagePerMonthKoorProduksi.forEach((v, i) => {
				arrDataScoreKoorProduksi.push(v.rataRata);
				const bulanKata = angkaKeBulanKoor(v.bulan);
				bulanDataKoor.push(bulanKata);
			});
			const ctxPr = document.getElementById("myChartKoorProduksi").getContext('2d');
			const myCharts = new Chart(ctxPr, {
				type: 'bar',
				data: {
					labels: bulanDataKoor,
					datasets: [{
						label: "Produksi",
						backgroundColor: '#007bff',
						borderColor: '#007bff',
						data: arrDataScoreKoorProduksi
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true,
							ticks: {
								max: 100, // Memastikan nilai maksimum Y adalah 100
								stepSize: 10 // Mengatur interval sumbu Y
							}
						}
					},
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						}
					}
				}
			});
		} else if (sessionDashboard.value == 3) {
			const dataframeGudang = <?php echo $dataGudangjson; ?>;
			const groupedDataKoorGudang = dataframeGudang.reduce((acc, item) => {
				if (!acc[item.id_periode_bulan_fk]) {

					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					};
				};
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			}, {});
			const averagePerMonthKoorGudang = Object.keys(groupedDataKoorGudang).map(bulan => ({
				bulan: parseInt(bulan),
				rataRata: groupedDataKoorGudang[bulan].total / groupedDataKoorGudang[bulan].count
			}));
			const arrDataScoreKoorGudang = [];
			averagePerMonthKoorGudang.forEach((v, i) => {
				arrDataScoreKoorGudang.push(v.rataRata);
				const bulanKata = angkaKeBulanKoor(v.bulan);
				bulanDataKoor.push(bulanKata);
			});
			const ctxGd = document.getElementById("myChartKoorGudang").getContext('2d');
			const myChartG = new Chart(ctxGd, {
				type: 'bar',
				data: {
					labels: bulanDataKoor,
					datasets: [{
						label: "Gudang",
						backgroundColor: '#732dff',
						borderColor: '#732dff',
						data: arrDataScoreKoorGudang
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true,
							ticks: {
								max: 100, // Memastikan nilai maksimum Y adalah 100
								stepSize: 10 // Mengatur interval sumbu Y
							}
						}
					},
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						}
					}
				}
			})
		} else if (sessionDashboard.value == 4) {
			const dataframePenjualan = <?php echo $dataPenjualanjson; ?>;
			const groupedDataKoorPenjualan = dataframePenjualan.reduce((acc, item) => {
				if (!acc[item.id_periode_bulan_fk]) {

					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					};
				};
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			}, {});
			const averagePerMonthKoorPenjualan = Object.keys(groupedDataKoorPenjualan).map(bulan => ({
				bulan: parseInt(bulan),
				rataRata: groupedDataKoorPenjualan[bulan].total / groupedDataKoorPenjualan[bulan].count
			}));
			const arrDataScoreKoorPenjualan = [];
			averagePerMonthKoorPenjualan.forEach((v, i) => {
				arrDataScoreKoorPenjualan.push(v.rataRata);
				const bulanKata = angkaKeBulanKoor(v.bulan);
				bulanDataKoor.push(bulanKata);
			});

			const ctxGd = document.getElementById("myChartKoorPenjualan").getContext('2d');
			const myChartG = new Chart(ctxGd, {
				type: 'bar',
				data: {
					labels: bulanDataKoor,
					datasets: [{
						label: "Penjualan",
						backgroundColor: '#8D6F64',
						borderColor: '#8D6F64',
						data: arrDataScoreKoorPenjualan
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true,
							ticks: {
								max: 100, // Memastikan nilai maksimum Y adalah 100
								stepSize: 10 // Mengatur interval sumbu Y
							}
						}
					},
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						}
					}
				}
			})
		}
	</script>

	<script>
		if (sessionDashboard.value == 1) {
			const dataFramePHP = <?php echo $datajson; ?>;
			const labels = [...new Set(dataFramePHP.map(item => item.id_periode_bulan_fk))];
			const score = [...dataFramePHP.map(item => item.nilai_akhir_pemilik)];
			const bulans = [...dataFramePHP]
			const cobacoba = labels.map(month => {

				const scorecoba = dataFramePHP.find(p => p.id_periode_bulan_fk == month)

			})
			function filterProduk(data) {
				return data.bagian == "produksi"
			}

			function filterGudang(data) {
				return data.bagian == "gudang"
			}

			function filterPenjualan(data) {
				return data.bagian == "penjualan"
			}

			const produksis = dataFramePHP.filter(filterProduk)
			const gudang = dataFramePHP.filter(filterGudang)
			const penjualan = dataFramePHP.filter(filterPenjualan)
			const bulanGroup = bulans.reduce((acc,item)=>{
				if (!acc[item.id_periode_bulan_fk]) {
					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					}
				}
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir_pemilik);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			},{});
			const monthLabels = [];
			const averagePerMonthOnly = Object.keys(bulanGroup).map(bulan => ({
				bulan: parseInt(bulan),
			}));

			const groupedDataProduksi = produksis.reduce((acc, item) => {
				if (!acc[item.id_periode_bulan_fk]) {
					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					}
				}
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir_pemilik);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			}, {});
			const groupedDataGudang = gudang.reduce((acc, item) => {
				if (!acc[item.id_periode_bulan_fk]) {
					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					}
				}
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir_pemilik);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			}, {});
			const groupedDataPenjualan = penjualan.reduce((acc, item) => {
				if (!acc[item.id_periode_bulan_fk]) {
					acc[item.id_periode_bulan_fk] = {
						total: 0,
						count: 0
					}
				}
				acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir_pemilik);
				acc[item.id_periode_bulan_fk].count += 1;
				return acc
			}, {});

			const averagePerMonthProduksi = Object.keys(groupedDataProduksi).map(bulan => ({
				bulan: parseInt(bulan),
				rataRata: groupedDataProduksi[bulan].total / groupedDataProduksi[bulan].count
			}));
			const averagePerMonthGudang = Object.keys(groupedDataGudang).map(bulan => ({
				bulan: parseInt(bulan),
				rataRata: groupedDataGudang[bulan].total / groupedDataGudang[bulan].count
			}));
			const averagePerMonthPenjualan = Object.keys(groupedDataPenjualan).map(bulan => ({
				bulan: parseInt(bulan),
				rataRata: groupedDataPenjualan[bulan].total / groupedDataPenjualan[bulan].count
			}));


			function angkaKeBulan(angka) {
				const bulan = {
					1: "Januari",
					2: "Februari",
					3: "Maret",
					4: "April",
					5: "Mei",
					6: "Juni",
					7: "Juli",
					8: "Agustus",
					9: "September",
					10: "Oktober",
					11: "November",
					12: "Desember",
				}
				return bulan[angka]
			}

			const pushMLabel = averagePerMonthOnly.forEach((v,i)=>{
				monthLabels.push(v.bulan)
			});

			var dataGudang = [0];
			var dataProduksi = [0];
			var dataPenjualan = [0];
			var mlabel = [];
			for (let i = 0; i < monthLabels.length; i++) {
				if(averagePerMonthGudang[i] != undefined){
					const gudangFilterData = monthLabels.findIndex((value)=>value == averagePerMonthGudang[i].bulan);
					dataGudang[gudangFilterData] = averagePerMonthGudang[i].rataRata
					
				}
				if(averagePerMonthProduksi[i] != undefined){
					const produksiFilterData = monthLabels.findIndex((value) => value == averagePerMonthProduksi[i].bulan);
					dataProduksi[produksiFilterData] = averagePerMonthProduksi[i].rataRata;
				}

				if(averagePerMonthPenjualan[i] != undefined){
					const penjualanFilterData = monthLabels.findIndex((value) => value == averagePerMonthPenjualan[i].bulan);
					dataPenjualan[penjualanFilterData] = averagePerMonthPenjualan[i].rataRata;
				}
				mlabel.push(angkaKeBulan(monthLabels[i]));
			}

			const ctx = document.getElementById("myChart").getContext('2d');
			const myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: mlabel,
					datasets: [{
							label: "Produksi",
							backgroundColor: '#007bff',
							borderColor: '#007bff',
							data: dataProduksi
						},
						{
							label: "Gudang",
							backgroundColor: '#ced4da',
							borderColor: '#ced4da',
							data: dataGudang
						},
						{
							label: "Penjualan",
							backgroundColor: '#8D6F64',
							borderColor: '#8D6F64',
							data: dataPenjualan
						}
					]
				},
				options: {
					scales: {
						y: {
							ticks: {
								max: 100, // Memastikan nilai maksimum Y adalah 100
								stepSize: 10 // Mengatur interval sumbu Y
							},
							beginAtZero: true,
						}
					},
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						}
					}
				}
			})
		}
	</script>