<?php

if ($_POST["tgllahir"] == "") $_POST["tgllahir"] = date("d-M-Y");
if (isset($_POST["update"])) {
	$sql = "UPDATE ms_barang SET NamaBarang = '" . $_POST['namabarang'] . "',
								Spesifikasi = '" . $_POST['spesifikasi'] . "',
								Merk = '" . $_POST['merk'] . "',
								RecUser = '" . $_SESSION['userid'] . "',
								UpdateTime = '" . date("Y-m-d H:i:s") . "'
							WHERE BarangID = '" . $_POST['barangid'] . "'	 ";
	$run = $sqlLib->update($sql);

	if ($run == "1") {
		$alert = '0';
		$note = "Proses update berhasil";
	} else {
		$alert = '1';
		$note = "Proses update gagal";
	}
}

// if (isset($_POST["delete"])) {
// 	$sql_del = "DELETE FROM ms_barang 
// 				WHERE BarangID = '" . $_POST['barangid'] . "'	 ";
// 	$run 	= $sqlLib->delete($sql_del);

// 	if ($run == "1") {
// 		$alert = '0';
// 		$note = "Proses delete berhasil";
// 	} else {
// 		$alert = '1';
// 		$note = "Proses delete gagal";
// 	}
// }


if ($_GET["barangid"] != "") {
	$sql_user = "SELECT BarangID, NamaBarang, Spesifikasi, Merk, RecUser, CreateTime
				FROM ms_barang a WHERE a.BarangID = '" . $_GET['barangid'] . "' ";
	$data_user = $sqlLib->select($sql_user);
	$_POST['namabarang'] = $data_user[0]['NamaBarang'];
	$_POST['spesifikasi']   = $data_user[0]['Spesifikasi'];
	$_POST['merk']  = $data_user[0]['Merk'];
	$_POST['barangid']  = $data_user[0]['BarangID'];
}


?>
<div class="section-header">
    <h1><?php echo acakacak("decode", $_GET["p"]) ?></h1>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="post" id="form-transaksi" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    <?php
                    if ($alert == "0") { ?> 
                        <div class="form-group">
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <?php echo $note ?>
                                </div>
                            </div>
                        </div><?php 
                    } else if ($alert == "1") { ?>
                        <div class="form-group">
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <?php echo $note ?>
                                </div>
                            </div>
                        </div><?php
                    } ?>
                    
					<div class="form-group row">							  
						<div class="col-sm-6">
							<label>Nama Barang</label>
							<input type="text" name="namabarang" required="required" value="<?php echo $_POST["namabarang"]?>" class="form-control" placeholder="" >
						</div>

						<div class="col-sm-6">
							&nbsp;
						</div>
					</div> 
				
					<div class="form-group row">							  
						<div class="col-sm-6">
							<label>Spesifikasi</label>
							<input type="text" name="spesifikasi" required="required" value="<?php echo $_POST["spesifikasi"]?>" class="form-control" placeholder="" >
						</div>

						<div class="col-sm-6">
							&nbsp;
						</div>
					</div> 
				
				
					<div class="form-group row">							  
						<div class="col-sm-6">
							<label>Merk</label>
							<input type="text" name="merk" required="required" value="<?php echo $_POST["merk"]?>" class="form-control" placeholder="" >
						</div>

						<div class="col-sm-6">
							&nbsp;
						</div>
					</div> 

                </div>
                <div class="card-footer text-center">
                    <div class="col-sm-6">
                        <button type="reset" name="batal" class="btn btn-danger">Batal</button>
                        <input type="submit" class="btn btn-primary" name="update" Value="Update">
                        <input type="hidden" name="barangid" value="<?php echo $_POST["barangid"] ?>">
                    </div>    
                    <div class="col-sm-6">
							&nbsp;
					</div>
                </div>


            </form>
        </div>
    </div>
</div>