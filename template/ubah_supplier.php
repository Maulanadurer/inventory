<?php $data = mysql_query("SELECT * FROM tb_supplier WHERE kode_supplier='".$_GET['id']."'") or die(mysql_error());
	  $row2 = mysql_fetch_object($data);
?>

<div class="page-title">
  <h1>
    Ubah Supplier
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Supplier
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_supplier.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Supplier</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama supplier" type="text" name="nama_supplier" value="<?php echo $row2->nama_supplier;?>"/>
              <input type="hidden" name="kode_supplier" value="<?php echo $row2->kode_supplier;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Alamat Supplier</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="alamat" type="text" name="alamat" value="<?php echo $row2->alamat_supplier;?>" />
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=daftar_supplier" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










