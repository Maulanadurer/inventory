<?php $database = SimplePDO::getInstance();
    $row = $database->get_row("SELECT * FROM tb_admin WHERE kode_admin=?",array($_GET['kode']));
?>


<div class="page-title">
  <h1>
    Ubah User
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>User
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_user.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Username</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="username" type="text" name="username" value="<?php echo $row->username_admin;?>"/>
              <input type="hidden" name="kode_user" value="<?php echo $row->kode_admin;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Password</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="password" type="password" name="password" value="<?php echo $row->password_admin;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Confirm Password</label>
            <div class="col-md-7">
                <input class="form-control" placeholder="confirm password" type="password" name="c_password" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Nama User</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama user" type="text" name="nama_user" value="<?php echo $row->nama_admin;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Email User</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="email" type="text" name="email_user" value="<?php echo $row->email_admin;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Role</label>
            <div class="col-md-7">
              <select class="form-control" name="role">
                  <option value="admin">Administrator</option>
                  <option value="gudang">Bag. Gudang</option>
                  <option value="distribusi">Bag. Distribusi</option>
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










