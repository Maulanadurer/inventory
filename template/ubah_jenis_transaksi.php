<?php $data = mysql_query("SELECT * FROM tb_jenistransaksi WHERE id_jenistransaksi='".$_GET['id']."'") or die(mysql_error());
	  $row = mysql_fetch_object($data);
?>
<div class="page-title">
  <h1>
    Ubah Jenis Transaksi
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Jenis Transaksi
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_jenis_transaksi.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Jenis Transaksi</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="jenis transaksi" type="text" name="jenis_transaksi" value="<?php echo $row->jenis_transaksi;?>"/>
              <input type="hidden" name="id_jenistransaksi" value="<?php echo $row->id_jenistransaksi;?>" />
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=jenis_transaksi" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










