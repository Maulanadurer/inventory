        <?php include"proses/ar.php";?>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
            <form action="main.php?hal=log_stok_barang" class="form-horizontal" id="forecast" method="post">
            	<div class="col-lg-5">
                    <div class="form-group">
                      <label class="control-label col-md-5">Nama Barang</label>
                      <div class="col-md-5">
                      <?php $query=mysql_query("SELECT * FROM tb_barang") or die(mysql_error());?>
                        <select class="form-control" name="kode_barang">
                          <option value="all">Semua Barang</option>
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
                          <option value="all">Semua Cabang</option>
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
                        <button class="btn btn-primary" type="submit" name="proses">Submit</button><button class="btn btn-default-outline">Cancel</button>
                      </div>
                    </div>
                </div>
      			</form>
            </div>
          </div>
        </div>
        <?php if(isset($_POST['proses'])){?>
        <?php 
            $query ='';
            $jumlah_barang = array();
            $n_month = array();
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
            if($kode_barang == 'all'){
              $query = "SELECT MONTH(tp.tgl_jual) AS month,tb.nama_barang,tp.jumlah FROM tb_penjualan tp JOIN tb_barang tb ON tb.kode_barang=tp.kode_barang WHERE tp.tgl_jual BETWEEN '".$sdate."' AND '".$edate."' GROUP BY MONTH(tp.tgl_jual), tp.kode_barang";
            }
            $data = mysql_query($query) or die(mysql_error());
            while($row = mysql_fetch_object($data)){
              $jumlah_barang[]=$row->jumlah;
              $n_month[] = $row->month-1;
              //$nama_barang[] = $row->nama_barang;
            }
            $data = mysql_query("SELECT jumlah FROM `tb_peramalan` WHERE `kode_barang` ='".$kode_barang."' AND `by_month` BETWEEN '".$sdate_2."' AND '".$edate_2."' AND kode_cabang='".$kode_cabang."'") or die(mysql_error());
            while($row = mysql_fetch_object($data)){
              $result_jumlah[]=$row->jumlah;
            }
            print_r($result_jumlah); 
        ?>
          <?php if(sizeof($jumlah_barang)>0){?>
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
                        <th>Data Distribusi</th>
                        <th>Data Peramalan</th>
                        <th>Persentase Error</th>
                      </tr>
                    </thead>
                      <?php foreach($jumlah_barang as $i => $jumlah){?>
                      <tr>
                        <?php echo $result_jumlah[1]; $error = ($result_jumlah[$i]-$jumlah)/100*$result_jumlah[$i];?>
                        <td><?php echo $month[$n_month[$i]];?></td>
                        <td><?php echo $jumlah;?></td>
                        <td><?php echo $result_jumlah[$i];?></td>
                        <td><?php echo $error;?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
                  <!-- End Pie Graph 1 -->
                  <script type="text/javascript">
                  /*
                  # =============================================================================
                  #   Sparkline Linechart JS
                  # =============================================================================
                  */

                  (function() {
                    var linechartResize;
                    
                    linechartResize = function() {
                      $("#arima").sparkline([<?php foreach($jumlah_barang as $i => $jumlah){echo $jumlah.",";} ?>], {
                        type: "line",
                        width: "100%",
                        height: "226",
                        lineColor: "#a5e1ff",
                        fillColor: "rgba(241, 251, 255, 0.9)",
                        lineWidth: 2,
                        spotColor: "#a5e1ff",
                        minSpotColor: "#bee3f6",
                        maxSpotColor: "#a5e1ff",
                        highlightSpotColor: "#80cff4",
                        highlightLineColor: "#cccccc",
                        spotRadius: 6,
                        chartRangeMin: 0
                      });
                      $("#arima").sparkline([<?php foreach($result_jumlah as $i => $jumlah){echo $jumlah.",";} ?>], {
                        type: "line",
                        width: "100%",
                        height: "226",
                        lineColor: "#cfee74",
                        fillColor: "rgba(244, 252, 225, 0.5)",
                        lineWidth: 2,
                        spotColor: "#b9e72a",
                        minSpotColor: "#bfe646",
                        maxSpotColor: "#b9e72a",
                        highlightSpotColor: "#b9e72a",
                        highlightLineColor: "#cccccc",
                        spotRadius: 6,
                        chartRangeMin: 0,
                        composite: true
                      });                  
                    };

                    $(document).ready(function() {
                      /*
                      # =============================================================================
                      #   Sparkline Linechart JS
                      # =============================================================================
                      */

                      var $alpha, $container, $container2, addEvent, buildMorris, checkin, checkout, d, date, handleDropdown, initDrag, m, now, nowTemp, timelineAnimate, y;
                      $(".sparkslim").sparkline('html', {
                        type: "line",
                        width: "100",
                        height: "30",
                        lineColor: "#adadad",
                        fillColor: "rgba(244, 252, 225, 0.0)",
                        lineWidth: 2,
                        spotColor: "#909090",
                        minSpotColor: "#909090",
                        maxSpotColor: "#909090",
                        highlightSpotColor: "#666",
                        highlightLineColor: "#666",
                        spotRadius: 0,
                        chartRangeMin: 0
                      });
                       /*
                      # =============================================================================
                      #   Sparkline Resize Script
                      # =============================================================================
                      */

                      linechartResize();
                      $(window).resize(function() {
                        return linechartResize();
                      });
                    });

                  }).call(this);

                  </script>
            <div class="col-lg-6">
              <div class="widget-container">
                <div class="heading">
                  <i class="fa fa-bar-chart-o"></i>Grafik Komparasi
                </div>
                <div class="widget-content padded text-center">
                  <div id="arima">
                      Loading...
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