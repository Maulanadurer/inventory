        
        <?php $role = $_SESSION['level'];
        $nav = 0;
        if ($role == "gudang"){
          $nav = 2;
        }else if($role == "distribusi"){
          $nav = 1;
        }else{
          $nav = 0;
        }?>
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-flag"></span>
                  <div class="sr-only">
                    Notifications
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New user added: Jane Smith
                    </p></a>
                    
                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      Sales targets available
                    </p></a>
                    
                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New performance metric added
                    </p></a>
                    
                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New growth data available
                    </p></a>
                    
                  </li>
                </ul>
              </li>
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-envelope"></span>
                  <div class="sr-only">
                    Messages
                  </div>
                </a>
                <ul class="dropdown-menu messages">
                  <li><a href="#">
                    <img width="34" height="34" src="images/avatar-male2.png" />Could we meet today? I wanted...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="images/avatar-female.png" />Important data needs your analysis...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="images/avatar-male2.png" />Buy Se7en today, it's a great theme...</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <?php echo $_SESSION['username'];?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <i class="fa fa-user"></i>My Account</a>
                  </li>
                  <li><a href="#">
                    <i class="fa fa-gear"></i>Account Settings</a>
                  </li>
                  <li><a href="proses/logout.php">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="main.php?hal=home">Inventory</a>
          <form class="navbar-form form-inline col-lg-2 hidden-xs">
            <input class="form-control" placeholder="Search" type="text">
          </form>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a class="current" href="main.php?hal=home"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
              </li>
              <li><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-feed"></span>Pengolahan Data<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php if($nav == 0 or $nav == 2){?>
                  <li><a href="main.php?hal=daftar_stok">
                    <p>
                      Daftar Stok Barang
                    </p></a>
                    
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 2){?>
                  <li><a href="main.php?hal=daftar_pembelian">
                    <p>
                      Daftar Pembelian
                    </p></a>
                    
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 1){?>
                  <li><a href="main.php?hal=daftar_permintaan">
                    <p>
                      Daftar Permintaan
                    </p></a>
                    
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 1){?>
                  <li><a href="main.php?hal=daftar_penjualan">
                    <p>
                      Daftar Penjualan
                    </p></a>
                    
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 1){?>
                  <li><a href="main.php?hal=daftar_distribusi">
                    <p>
                      Daftar Distribusi
                    </p></a>
                    
                  </li>
                  <?php }?>
                </ul>
              </li>
              <?php if($nav == 0){?>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-star"></span>Data Master<b class="caret"></b></a>
                <ul class="dropdown-menu">
                <?php if($nav == 0){?>
                  <li><a href="main.php?hal=daftar_supplier">
                    <p>
                      Daftar Supplier
                    </p></a>
                    
                  </li>
                <?php }?>
                <?php if($nav == 0){?>
                  <li><a href="main.php?hal=daftar_barang">
                    <p>
                     Master Barang
                    </p></a>
                    
                  </li>
                <?php }?>
                <?php if($nav == 0){?>
                  <li><a href="main.php?hal=daftar_cabang">
                    <p>
                     Daftar Cabang
                    </p></a>
                    
                  </li>
                <?php }?>
                </ul>
              </li>
              <?php }?>
              <?php if($nav == 0 or $nav == 2){?>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-forms"></span>Peramalan<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="main.php?hal=data_peramalan">Data Peramalan</a>
                  </li>
                  <li>
                    <a href="main.php?hal=laporan_peramalan">Peramalan ARIMA</a>
                  </li>
                </ul>
              </li>
              <?php }?>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-tables"></span>Laporan<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php if($nav == 0 or $nav == 1){?>
                  <li>
                    <a href="main.php?hal=laporan_jual">Penjualan</a>
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 1){?>
                  <li>
                    <a href="main.php?hal=laporan_peramalan">Peramalan ARIMA</a>
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 1){?>
                  <li>
                    <a href="main.php?hal=lap_distribusi">Distribusi</a>
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 2){?>
                  <li>
                    <a href="main.php?hal=lap_pembelian"> Pembelian</a>
                  </li>
                  <?php }?>
                  <?php if($nav == 0 or $nav == 2){?>
                  <li>
                    <a href="main.php?hal=laporan_stok"> Stok Barang</a>
                  </li>
                  <?php }?>
                </ul>
              </li>
            <?php if($nav == 0){?>
             <li><a href="main.php?hal=daftar_user">
                <span aria-hidden="true" class="se7en-gear"></span>Pengguna</a>
             </li>
            <?php }?>
          </ul>
          </div>
        </div>