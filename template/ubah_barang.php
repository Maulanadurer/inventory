<?php $database = SimplePDO::getInstance();
	  $row = $database->get_row("SELECT * FROM tb_barang WHERE kode_barang=?",array($_GET['kode']));
?>

<div class="page-title">
  <h1>
    Ubah Barang
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Barang
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_barang.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Barang</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama barang" type="text" name="nama_barang" value="<?php echo $row->nama_barang;?>"/>
              <input type="hidden" name="kode_barang" value="<?php echo $row->kode_barang;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Deskripsi Barang</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="deskripsi" type="text" name="deskripsi" value="<?php echo $row->deskripsi_barang;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Stok Barang</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="stok" type="stok barang" name="stok_barang" value="<?php echo $row->stok_barang;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Stok Aman</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="stok" type="stok barang" name="stok_aman" value="<?php echo $row->safety_stock;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=daftar_barang" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










