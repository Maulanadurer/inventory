        <?php include"proses/ar.php";?>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
            <form action="main.php?hal=laporan_distribusi" class="form-horizontal" id="forecast" method="post">
            	<div class="col-lg-5">
                    <div class="form-group">
                      <label class="control-label col-md-5">Nama Barang</label>
                      <div class="col-md-5">
                      <?php $query=mysql_query("SELECT * FROM tb_barang") or die(mysql_error());?>
                        <select class="form-control" name="kode_barang">
                        <?php while($row = mysql_fetch_object($query)){?>
                        	<option value="<?php echo $row->kode_barang;?>"><?php echo $row->nama_barang;?></option>
                        <?php }?>
                        </select>
                      </div>
                    </div>
          					<div class="form-group">
                      <label class="control-label col-md-5">Nama Cabang</label>
                      <div class="col-md-5">
                       <?php $query=mysql_query("SELECT * FROM tb_cabang") or die(mysql_error());?>
                        <select class="form-control" name="kode_cabang">
                        <?php while($row = mysql_fetch_object($query)){?>
                        	<option value="<?php echo $row->kode_cabang;?>"><?php echo $row->nama_cabang;?></option>
                        <?php }?>
                        </select>
                      </div>
                    </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                        <label class="control-label col-md-3">Rentang Waktu</label>
                        <div class="col-sm-4">
                          <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd1" placeholder="Start date" type="text" name="sdate">
                        </div>
                        <div class="col-sm-4">
                          <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd2" placeholder="End date" type="text" name="edate">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-5"></label>
                      <div class="col-md-5">
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button><button class="btn btn-default-outline">Cancel</button>
                      </div>
                    </div>
                </div>
      			</form>
            </div>
          </div>
        </div>
        <?php if(isset($_POST['submit'])){?>
        <?php $jumlah_barang = array();
            $n_month = array();
             $id_peramalan = array();
            $result_jumlah = array();
            $kode_cabang = $_POST['kode_cabang'];
            $kode_barang = $_POST['kode_barang'];
            $startdate = $_POST['sdate'];
            $enddate = $_POST['edate'];
            $sdate = substr($startdate, 6,4)."-".substr($startdate, 3,2)."-".substr($startdate, 0,2);
            $edate = substr($enddate, 6,4)."-".substr($enddate, 3,2)."-".substr($enddate, 0,2);
            $sdate_2 = substr($startdate, 6,4).substr($startdate, 3,2);
            $edate_2 = substr($enddate, 6,4).substr($enddate, 3,2);
            $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            $data = mysql_query("SELECT by_month, jumlah,id_peramalan FROM `tb_peramalan` WHERE `kode_barang` ='".$kode_barang."' AND `by_month` BETWEEN '".$sdate_2."' AND '".$edate_2."' AND kode_cabang='".$kode_cabang."'") or die(mysql_error());
            while($row = mysql_fetch_object($data)){
              $result_jumlah[] = $row->jumlah;
              $n_month[] = (int) substr($row->by_month, 4,2);
              $id_peramalan[] = $row->id_peramalan;
            }
            //print_r($result_jumlah); 
        ?>
          <?php if(sizeof($result_jumlah)>0){?>
          <div class="row">
            <!-- Pie Graph 1 -->
            <div class="col-lg-6">
              <div class="widget-container fluid-height">
                <!-- Table -->
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tbody>
                    <thead>
                      <tr>
                        <th>Periode</th>
                        <th>Data Ramalan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <form action="proses/daftar_distribusi.php" id="forecast" method="post">
                      <?php foreach($result_jumlah as $i => $jumlah){?>
                      <tr>
                        <td><?php echo $month[$n_month[$i]];?></td>
                        <td><?php echo $jumlah;?></td>
                        <td><a class="btn btn-primary" href="main.php?hal=form_distribusi_barang&id=<?php echo $id_peramalan[$i]; ?>">Buat Form Distribusi</a></td>
                      </tr>
                      <?php }?>
                    </form>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
          <?php }else{?>
            <div class="row">
              <div class="col-lg-12">
                <div class="widget-container fluid-height">
                    <div class="alert alert-success">
                      <button class="close" data-dismiss="alert" type="button">×</button>Data not available
                    </div>
                </div>
              </div>
            </div> 
          <?php }?>
        <?php }else{?>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
                <div class="alert alert-success">
                  <button class="close" data-dismiss="alert" type="button">×</button>Please Chose Your Service
                </div>
            </div>
          </div>
        </div>
        <?php }?>