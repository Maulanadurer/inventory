<div class="page-title">
  <h1>
    Tambah Satuan
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Satuan
      </div>
      <div class="widget-content padded">
        <form action="proses/tambah_satuan.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Satuan</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="Text" type="text" name="nama_satuan" />
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
