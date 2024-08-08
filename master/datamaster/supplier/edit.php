<?php

if ($_POST["tgllahir"] == "") $_POST["tgllahir"] = date("d-M-Y");
if (isset($_POST["update"])) {
	$sql = "UPDATE ms_supplier SET NamaSupplier = '" . $_POST['namasupplier'] . "',
								Alamat = '" . $_POST['alamat'] . "',
								NoTelp = '" . $_POST['notelp'] . "',
								RecUser = '" . $_SESSION['userid'] . "',
								UpdateTime = '" . date("Y-m-d H:i:s") . "'
							WHERE SupplierID = '" . $_POST['supplierid'] . "'	 ";
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

if ($_GET["supplierid"] != "") {
	$sql_user = "SELECT SupplierID, NamaSupplier, Alamat, NoTelp, RecUser
				FROM ms_supplier  WHERE SupplierID = '" . $_GET['supplierid'] . "' ";
	$data_user = $sqlLib->select($sql_user);
	$_POST['namasupplier'] = $data_user[0]['NamaSupplier'];
	$_POST['alamat']   = $data_user[0]['Alamat'];
	$_POST['notelp']  = $data_user[0]['NoTelp'];
	$_POST['supplierid']  = $data_user[0]['SupplierID'];
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
							<label>Nama Supplier</label>
							<input type="text" name="namasupplier" required="required" value="<?php echo $_POST["namasupplier"]?>" class="form-control" placeholder="" >
						</div>

						<div class="col-sm-6">
							&nbsp;
						</div>
					</div> 
				
					<div class="form-group row">							  
						<div class="col-sm-6">
							<label>Alamat</label>
							<input type="text" name="alamat" required="required" value="<?php echo $_POST["alamat"]?>" class="form-control" placeholder="" >
						</div>

						<div class="col-sm-6">
							&nbsp;
						</div>
					</div> 
				
				
					<div class="form-group row">							  
						<div class="col-sm-6">
							<label>No Telp</label>
							<input type="text" name="notelp" required="required" value="<?php echo $_POST["notelp"]?>" class="form-control" placeholder="" >
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
                        <input type="hidden" name="supplierid" value="<?php echo $_POST["supplierid"] ?>">
                    </div>    
                    <div class="col-sm-6">
							&nbsp;
					</div>
                </div>


            </form>
        </div>
    </div>
</div>