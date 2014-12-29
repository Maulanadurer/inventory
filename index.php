<?php #include"config/cek_session.php";?>
<!DOCTYPE html>
<html>
<!-- Mirrored from sharpandnimble.com/se7en/demo/login1.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 29 Apr 2014 15:01:35 GMT -->
<head>
    <title>
      Inventory - Login
    </title>
    <link href="http://fonts.googleapis.com/cscs?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <?php include"template/javascript.php";?>
  </head>
  <body class="login1">
    <!-- <a href="#"><img width="100" height="30" src="images/logo-login%402x.png" /></a> Login Screen -->
    <div class="login-wrapper">
      <div class="login-container">
        <a href="#"><h2>CV Cipta Mandiri</h2></a>
        <form action="proses/login.php" method="post">
          <div class="form-group">
            <input class="form-control" placeholder="Username or Email" type="text" name="username">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Password" type="password" name="password">
            <input type="submit" value="&#xf054;" name="submit">
          </div>
          <div class="form-options clearfix">
            <a class="pull-right" href="#">Forgot password?</a>
            <div class="text-left">
              <label class="checkbox"><input type="checkbox"><span>Remember me</span></label>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- End Login Screen -->
  </body>

<!-- Mirrored from sharpandnimble.com/se7en/demo/login1.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 29 Apr 2014 15:01:40 GMT -->
</html>