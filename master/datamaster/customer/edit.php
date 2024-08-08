<?php
if ($_POST["tgllahir"] == "") $_POST["tgllahir"] = date("d-M-Y");
if (isset($_POST["update"])) {
	$sql = "UPDATE ms_customer SET NamaCustomer = '" . $_POST['namacustomer'] . "',
								Alamat = '" . $_POST['alamat'] . "',
								NoTelp = '" . $_POST['notelp'] . "',
								RecUser = '" . $_SESSION['userid'] . "',
								UpdateTime = '" . date("Y-m-d H:i:s") . "'
							WHERE CustomerID = '" . $_POST['customerid'] . "'	 ";
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
if ($_GET["customerid"] != "") {
	$sql_user = "SELECT CustomerID, NamaCustomer, Alamat, NoTelp, NoKtp, RecUser
				FROM ms_customer  WHERE CustomerID = '" . $_GET['customerid'] . "' ";
	$data_user = $sqlLib->select($sql_user);
	$_POST['namacustomer'] = $data_user[0]['NamaCustomer'];
	$_POST['alamat']   = $data_user[0]['Alamat'];
	$_POST['notelp']  = $data_user[0]['NoTelp'];
	$_POST['noktp']  = $data_user[0]['NoKtp'];
	$_POST['customerid']  = $data_user[0]['CustomerID'];
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
							<label>Nama Customer</label>
							<input type="text" name="namacustomer" required="required" value="<?php echo $_POST["namacustomer"]?>" class="form-control" placeholder="" >
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
					<div class="form-group row">							  
						<div class="col-sm-6">
							<label>No KTP</label>
							<input type="text" name="noktp" required="required" value="<?php echo $_POST["noktp"]?>" class="form-control" placeholder="" >
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
                        <input type="hidden" name="customerid" value="<?php echo $_POST["customerid"] ?>">
                    </div>    
                    <div class="col-sm-6">
							&nbsp;
					</div>
                </div>


            </form>
        </div>
    </div>
</div>