<?php $data = mysql_query("SELECT * FROM tb_cabang WHERE kode_cabang='".$_GET['id']."'") or die(mysql_error());
	  $row2 = mysql_fetch_object($data);
?>

<div class="page-title">
  <h1>
    Ubah Cabang
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Cabang
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_cabang.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Cabang</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama cabang" type="text" name="nama_cabang" value="<?php echo $row2->nama_cabang;?>"/>
              <input type="hidden" name="kode_cabang" value="<?php echo $row2->kode_cabang;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Alamat</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="alamat" type="text" name="alamat_cabang" value="<?php echo $row2->alamat_cabang;?>" />
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-2">No. Telepon cabang</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="no. telepon cabang" type="text" name="telepon_cabang" value="<?php echo $row2->telepon_cabang;?>" />
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=daftar_cabang" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










