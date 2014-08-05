<?php $data = mysql_query("SELECT * FROM tb_satuan WHERE kode_satuan='".$_GET['id']."'") or die(mysql_error());
	  $row = mysql_fetch_object($data);
?>
<div class="page-title">
  <h1>
    Ubah Satuan
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Satuan Barang
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_satuan.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Satuan</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="Text" type="text" name="nama_satuan" value="<?php echo $row->nama_satuan;?>"/>
              <input type="hidden" name="kode_satuan" value="<?php echo $row->kode_satuan;?>" />
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=satuan" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










