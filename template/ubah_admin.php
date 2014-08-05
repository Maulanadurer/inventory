<?php $data = mysql_query("SELECT * FROM tb_admin WHERE kode_admin='".$_GET['id']."'") or die(mysql_error());
	  $row2 = mysql_fetch_object($data);
?>

<div class="page-title">
  <h1>
    Ubah Admin
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Administrator
      </div>
      <div class="widget-content padded">
        <form action="proses/ubah_admin.php" class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Username</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="username" type="text" name="username" value="<?php echo $row2->username_admin;?>"/>
              <input type="hidden" name="kode_admin" value="<?php echo $row2->kode_admin;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Password</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="password" type="password" name="password" value="<?php echo $row2->password_admin;?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Confirm Password</label>
            <div class="col-md-7">
                <input class="form-control" placeholder="confirm password" type="password" name="c_password" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Nama Admin</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="nama admin" type="text" name="nama_admin" value="<?php echo $row2->nama_admin;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Email Admin</label>
            <div class="col-md-7">
              <input class="form-control" placeholder="email" type="text" name="email_admin" value="<?php echo $row2->email_admin;?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Level</label>
            <div class="col-md-7">
            <?php $data = mysql_query("SELECT * FROM tb_admin") or die(mysql_error());?>
              <select class="form-control" name="level">
              	<option value="--">Pilih Level</option>
              <?php while($row = mysql_fetch_object($data)){?>
              	<option <?php echo ($row->level==$row2->level)?'selected="selected"':'';?> value="<?php echo $row->level;?>"><?php echo $row->level;?></option>
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










