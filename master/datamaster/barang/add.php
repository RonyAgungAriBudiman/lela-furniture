<?php 
if(isset($_POST["simpan"]))
{
	$sql_1="SELECT SUBSTRING(BarangID,4,5) BarangID FROM ms_barang 
        	Order By SUBSTRING(BarangID,4,5) Desc Limit 1";
	$data_1=$sqlLib->select($sql_1);
	$urut = strtok($data_1[0]['BarangID'], "0")+ 1;
	$barangid = "BRG".str_pad($urut, 5, '0', STR_PAD_LEFT);

	//cek nama barang
	$sql_2="SELECT NamaBarang FROM ms_barang WHERE NamaBarang = '".$_POST['namabarang']."' ";
	$data_2=$sqlLib->select($sql_2);
	if(COUNT($data_2)<1)
	{
		$sql ="INSERT INTO ms_barang (BarangID, NamaBarang, Spesifikasi, Merk, RecUser, CreateTime)
			VALUES ('".$barangid."', '".$_POST['namabarang']."', '".$_POST['spesifikasi']."', '".$_POST['merk']."','".$_SESSION['userid']."','".date("Y-m-d H:i:s")."' )";
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
	    $note = "Proses simpan gagal, nama barang sudah ada";
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