<div class="page-title">
  <h1>
    Tambah Admin
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Administrator
      </div>
      <div class="widget-content padded">
        <form action="proses/tambah_admin.php" class="form-horizontal" method="post">
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
            <label class="control-label col-md-2">Nama Admin</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama admin" type="text" name="nama_admin" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Email Admin</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="email admin" type="text" name="email_admin" />
            </div>
          </div>
            <div class="form-group">
            <label class="control-label col-md-2">Level</label>
            <div class="col-md-7">
              <select class="form-control" name="level">
              	<option value="--">Pilih Kategori</option>
              	<option value="admin">admin</option>
                <option value="operator">operator</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              <a href="main.php?hal=daftar_admin" class="btn btn-default-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>










