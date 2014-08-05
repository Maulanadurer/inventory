<div class="page-title">
  <h1>
    Tambah User
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>User
      </div>
      <div class="widget-content padded">
        <form action="proses/tambah_user.php" class="form-horizontal" method="post">
            <div class="form-group">
            <label class="control-label col-md-2">Username</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="username" type="text" name="username" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Password</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="password" type="text" name="password" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Confirm Password</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="confirm password" type="text" name="c_password" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Nama User</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama user" type="text" name="nama_user" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Email User</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="email user" type="text" name="email_user" />
            </div>
          </div>
            <div class="form-group">
            <label class="control-label col-md-2">Nama Cabang</label>
            <div class="col-md-7">
              <select class="form-control" name="kode_cabang">
                  <option value="--">Pilih Cabang</option>
                  <?php
                    $query = "SELECT * FROM tb_cabang";
                    $result = mysql_query($query);
                    while($row = mysql_fetch_object($result)){
                  ?>
              	<option value="<?php echo $row->kode_cabang; ?>"><?php echo $row->nama_cabang; ?></option>
                    <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=daftar_user" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










