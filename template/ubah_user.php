<?php $data = mysql_query("SELECT * FROM tb_user WHERE kode_user='".$_GET['id']."'") or die(mysql_error());
	  $row2 = mysql_fetch_object($data);
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
              <input class="form-control" placeholder="username" type="text" name="username" value="<?php echo $row2->username_user;?>"/>
              <input type="hidden" name="kode_user" value="<?php echo $row2->kode_user;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Password</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="password" type="password" name="password" value="<?php echo $row2->password_user;?>" />
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
              <input class="form-control" placeholder="nama user" type="text" name="nama_user" value="<?php echo $row2->nama_user;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Email User</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="email" type="text" name="email_user" value="<?php echo $row2->email_user;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Nama Cabang</label>
            <div class="col-md-7">
            <?php $data = mysql_query("SELECT * FROM tb_cabang") or die(mysql_error());?>
              <select class="form-control" name="kode_cabang">
              	<option value="--">Pilih Cabang</option>
              <?php while($row = mysql_fetch_object($data)){?>
              	<option <?php echo ($row->kode_cabang==$row2->kode_cabang)?'selected="selected"':'';?> value="<?php echo $row->kode_cabang;?>"><?php echo $row->nama_cabang;?></option>
              <?php }?>
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










