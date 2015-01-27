        <?php include"proses/ar.php";
              $database = SimplePDO::getInstance();?>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
            <form action="main.php?hal=data_peramalan" class="form-horizontal" id="forecast" method="post">
            	<div class="col-lg-5">
                    <div class="form-group">
                      <label class="control-label col-md-5">Nama Barang</label>
                      <div class="col-md-5">
                      <?php $query=$database->get_results( "SELECT * FROM tb_barang" );?>
                        <select class="form-control" name="kode_barang">
                        <?php foreach($query as $row){?>
                        	<option value="<?php echo $row->kode_barang;?>"><?php echo $row->nama_barang;?></option>
                        <?php }?>
                        </select>
                      </div>
                    </div>
          					<div class="form-group">
                      <label class="control-label col-md-5">Nama Cabang</label>
                      <div class="col-md-5">
                       <?php $query=$database->get_results( "SELECT * FROM tb_cabang" );?>
                        <select class="form-control" name="kode_cabang">
                        <?php foreach($query as $row){?>
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
            $kode_cabang = $_POST['kode_cabang'];
            $kode_barang = $_POST['kode_barang'];
            $startdate = $_POST['sdate'];
            $enddate = $_POST['edate'];
            $sdate = substr($startdate, 6,4)."-".substr($startdate, 3,2)."-".substr($startdate, 0,2);
            $edate = substr($enddate, 6,4)."-".substr($enddate, 3,2)."-".substr($enddate, 0,2);
            $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            $data=$database->get_results("SELECT MONTH(tpd.tgl_jual) AS month, (SELECT SUM(td.jumlah) FROM `tb_detail_penjualan` AS td JOIN `tb_penjualan` tp ON tp.id_transaksi=td.id_transaksi WHERE tp.`tgl_jual`=tpd.`tgl_jual` AND td.`kode_barang` ='".$kode_barang."'  GROUP BY tp.`tgl_jual`) AS jumlah FROM `tb_penjualan` AS tpd WHERE tpd.`tgl_jual` BETWEEN '".$sdate."' AND '".$edate."' AND tpd.kode_cabang='".$kode_cabang."' GROUP BY MONTH(tpd.tgl_jual)");

            foreach($data as $row){
              $jumlah_barang[]=$row->jumlah;
              $n_month[] = $row->month-1;
            }
            //print_r($jumlah_barang); 
        ?>
          <?php if(sizeof($jumlah_barang)>0){?>
          <div class="row">
            <!-- Pie Graph 1 -->
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <!-- Table -->
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tbody>
                    <thead>
                      <tr>
                        <th>Periode</th>
                        <th>Data</th>
                        <th>ACF</th>
                        <th>SACF</th>
                        <th>TACF</th>
                        <th>PACF</th>
                        <th>SPACF</th>
                        <th>TPACF</th>
                      </tr>
                    </thead>
                      <?php $acf = acf($jumlah_barang);
                            $sacf = sacf(acf_awal($jumlah_barang),$acf);
                            $sr = 1/pow((6+1-1),0.5);
                            $tpacf = pacf($jumlah_barang,$acf);
                            $pacf = pacf($jumlah_barang,$acf);
                      ?>
                      <?php foreach($jumlah_barang as $i => $jumlah){?>
                      <tr>
                        <td><?php echo $month[$n_month[$i]];?></td>
                        <td><?php echo $jumlah;?></td>
                        <td><?php printf('%.4f', $acf[$i]);?></td>
                        <td><?php printf('%.4f', $sacf[$i]);?></td>
                        <td><?php printf('%.4f',$acf[$i]/$sacf[$i]);?></td>
                        <td><?php printf('%.4f',$tpacf[$i]);?></td>
                        <td><?php printf('%.4f',$sr);?></td>
                        <td><?php printf('%.4f',$pacf[$i]/$sr);?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
            <script type="text/javascript">
            $(function () {
                $('#pacf_chart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Data PACF Dan ACF'
                    },
                    xAxis: {
                        categories: ['1', '2', '3', '4', '5','6']
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'ACF',
                        data: [<?php echo implode($acf, ",")?>]
                    }, {
                        name: 'PACF',
                        data: [<?php echo implode($pacf, ",")?>]
                    }]
                });
            });

            </script>
            <!-- End Pie Graph 1 -->
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="widget-container">
                <div class="heading">
                  <i class="fa fa-bar-chart-o"></i>Grafik ACF
                </div>
                <div class="widget-content padded text-center">
                    <div id="pacf_chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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