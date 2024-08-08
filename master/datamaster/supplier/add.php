<?php

if($_POST["tgllahir"]=="") $_POST["tgllahir"] = date("d-M-Y");
if(isset($_POST["simpan"]))
{
	$sql_1="SELECT SUBSTRING(SupplierID,4,5) SupplierID FROM ms_supplier
        	Order By SUBSTRING(SupplierID,4,5) Desc Limit 1";
	$data_1=$sqlLib->select($sql_1);
	$urut = strtok($data_1[0]['SupplierID'], "0")+ 1;
	$supplierid = "SUP".str_pad($urut, 5, '0', STR_PAD_LEFT);

	//cek nama barang
	$sql_2="SELECT NamaSupplier FROM ms_supplier WHERE NamaSupplier = '".$_POST['namasupplier']."' ";
	$data_2=$sqlLib->select($sql_2);
	if(COUNT($data_2)<1)
	{
		$sql ="INSERT INTO ms_supplier (SupplierID, NamaSupplier, Alamat, NoTelp, RecUser, CreateTime)
			VALUES ('".$supplierid."', '".$_POST['namasupplier']."', '".$_POST['alamat']."', '".$_POST['notelp']."','".$_SESSION['userid']."','".date("Y-m-d H:i:s")."' )";
		$run =$sqlLib->insert($sql); 
		if($run=="1")
		{
			$alert = '0'; 
			$note = "Proses simpan berhasil";
		}
		else
		{
			$alert = '1'; 
			$note = "Proses simpan gagal";
		}

	}else{
		$alert = '1'; 
	    $note = "Proses simpan gagal, nama supplier sudah ada";
	}	
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
                        <input type="submit" class="btn btn-primary" name="simpan" Value="Simpan">
                    </div>    
                    <div class="col-sm-6">
							&nbsp;
					</div>
                </div>


            </form>
        </div>
    </div>
</div>