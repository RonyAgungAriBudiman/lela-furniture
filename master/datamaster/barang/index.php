<div class="section-header">
	<h1><?php echo acakacak("decode", $_GET["p"]) ?></h1>
</div>

<style>
	#parent {
		height: 500px;
	}

	th {
		background-color: #133b5c;
		color: rgb(241, 245, 179);

		text-align: center;
		font-weight: normal;
		font-size: 14px;
		outline: 0.7px solid black;
		border: 1.5px solid black;

	}

	td {
		border-bottom: 1.5px solid black;
		font-size: 12px;

	}
</style>

<script>
	$(document).ready(function() {
		$("#fixTable").tableHeadFixer();
		$("#fixTable").tableHeadFixer({
			'foot': true,
			'head': false
		});
	});;
	<?php if ($_POST['dari'] == "") {
		$_POST['dari'] = date("Y-m-01");
		$_POST['sampai'] = date("Y-m-d");
	}		?>
</script>

<link rel="stylesheet" href="assets/css/jquery-ui.css" />
<!-- <script src="assets/js/jquery-1.12.4.js"></script> -->
<script src="assets/js/jquery-ui.js"></script>

<div class="row">
	<div class="col-12">
		<div class="card">
			<form method="post" id="form" autocomplete="off" enctype="multipart/form-data">
				<div class="form-group row mt-3 mb-0">
					<div class="col-sm-2 ml-4">
						<input type="text" name="namabarang" id="namabarang" value="<?php echo $_POST['namabarang']; ?>" class="form-control" placeholder="Nama Barang">
						<input type="hidden" name="barangid" id="barangid" value="<?php echo $_POST['barangid']; ?>" class="form-control">
					</div>
                    <div class="col-sm-2">
                        <select name="merk" id="merk" class="form-control">
								<option value="">Pilih Merk</option>
								<?php
								$sql_1 = "SELECT DISTINCT Merk FROM ms_barang ";
								$data_1 = $sqlLib->select($sql_1);
								foreach ($data_1 as $row_1) {
								?><option value="<?php echo $row_1['Merk'] ?>" <?php if ($_POST['merk'] == $row_1['Merk']) {
																					echo "selected";
																				} ?>><?php echo $row_1['Merk'] ?></option> <?php
																														}
																															?>
						</select>
					</div>

					<div class="col-sm-3 ml-3">
						<button type="submit" name="cari" class="btn btn-primary" value="Cari"><i class="fas fa-search"> </i> Cari</button>
                        <a href="index.php?m=<?php echo acakacak("encode", "datamaster/barang") ?>&sm=<?php echo acakacak("encode", "add") ?>&p=<?php echo $_GET["p"] ?>">
				            <button type="button" class="btn btn-info"><i class="fas fa-plus"> </i> Barang</button></a> 
                        
						<!-- <a href="print/LapBahanBaku.php?dari=<?php echo $_POST['dari'] ?>&sampai=<?php echo $_POST['sampai'] ?>&kodebarang=<?php echo $_POST['kodebarang'] ?>&namabarang=<?php echo $_POST['namabarang'] ?>" target="_blank">
							<input type="button" class="btn btn-warning" name="cetak" Value="Cetak">
						</a>

						<a href="download/excel/LapBahanBaku.php?dari=<?php echo $_POST['dari']; ?>&sampai=<?php echo $_POST['sampai']; ?>&kodebarang=<?php echo $_POST['kodebarang'] ?>&namabarang=<?php echo $_POST['namabarang'] ?>" target="_blank">
							<input type="button" name="export" class="btn btn-success" value="Export"></a> -->


					</div>
				</div>
			</form>

			<div class="card-body">

				<div id="parent">
					<table id="fixTable" class="table">
						<thead>
							<tr>
								<th style="background-color:#133b5c; color:#FFF;">No</th>
								<th style="background-color:#133b5c; color:#FFF;">Nama Barang</th>
								<th style="background-color:#133b5c; color:#FFF;">Spesifikasi</th>
								<th style="background-color:#133b5c; color:#FFF;">Merk</th>
								<th style="background-color:#133b5c; color:#FFF;">Edit</th>
							</tr>

						</thead>
						<tbody>
							<?php
							
                            $kondisi = "";
                            if ($_POST['barangid'] != "" AND  $_POST['namabarang'] != "") $kondisi .= " AND a.BarangID ='" . $_POST['barangid'] . "'";
                            if ($_POST['merk'] != "") $kondisi .= " AND a.Merk ='" . $_POST['merk'] . "'";
							$no = 1;
							$sql = "SELECT a.BarangID, a.NamaBarang, a.Merk, a.Spesifikasi
                                    FROM ms_barang a	
                                    WHERE a.NamaBarang != '' " . $kondisi;
							$sql .= " Order By a.NamaBarang Asc ";
							$data = $sqlLib->select($sql);
							foreach ($data as $row) {
								
							?>
								<tr style="color:#000;">
									<td style="text-align: center;"><?php echo $no ?></td>
									<td><?php echo $row['NamaBarang'] ?></td>
									<td><?php echo $row['Spesifikasi'] ?></td>
									<td><?php echo $row['Merk'] ?></td>
									<td style="text-align: center;">
                                        <a href="index.php?m=<?php echo acakacak("encode", "datamaster/barang") ?>&sm=<?php echo acakacak("encode", "edit") ?>&barangid=<?php echo $row['BarangID'] ?>&p=<?php echo acakacak("decode", $_GET["p"]) ?>">
											<button type="button" class="btn btn-success"><i class="fas fa-edit"> </i> Edit</button>
										</a>
                                    </td>
								</tr>
							<?php $no++;
							}


							?>


						</tbody>
						<tfoot>
							<tr style="background-color:#133b5c; color:#FFF; font-weight: bold;">
								<td style="text-align: center;" colspan="5">&nbsp;</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		var ac_config = {
			source: "json/barang.php",
			select: function(event, ui) {
				$("#barangid").val(ui.item.id);
				$("#namabarang").val(ui.item.namabarang);
			},
			focus: function(event, ui) {
				$("#barangid").val(ui.item.id);
				$("#namabarang").val(ui.item.namabarang);
			},
			minLength: 1
		};
		$("#namabarang").autocomplete(ac_config);
	});
</script>