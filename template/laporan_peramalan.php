        <?php include"proses/ar.php";
              $database = SimplePDO::getInstance();?>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
            <form action="main.php?hal=laporan_peramalan" class="form-horizontal" id="forecast" method="post">
              <div class="col-lg-5">
                    <div class="form-group">
                      <label class="control-label col-md-5">Nama Barang</label>
                      <div class="col-md-5">
                      <?php $query = $database->get_results( "SELECT * FROM tb_barang" );?>
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
                       <?php $query = $database->get_results( "SELECT * FROM tb_cabang" );?>
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
            $data = $database->get_results("SELECT MONTH(`tgl_jual`) AS month,SUM(jumlah) AS jumlah FROM `tb_penjualan` WHERE `kode_barang` ='".$kode_barang."' AND `tgl_jual` BETWEEN '".$sdate."' AND '".$edate."' AND kode_cabang='".$kode_cabang."' GROUP BY MONTH(`tgl_jual`)");
            foreach($data as $row){
              $jumlah_barang[]=$row->jumlah;
              $n_month[] = $row->month-1;
            }
            //print_r($jumlah_barang); 
        ?>
          <?php if(sizeof($jumlah_barang)>0){?>
            <div class="row">
              <!-- Pie Graph 1 -->
              <div class="col-lg-7">
                <div class="widget-container fluid-height">
                  <!-- Table -->
                  <table class="table table-filters">
                    <tbody>
                      <tr>
                      	<td>Periode</td>
                        <td>Data</td>
                        <td>AR</td>
                        <td>MA</td>
                        <td>ARIMA</td>
                      </tr>
                      <?php $zz1 = perkalian_matriks(array_1($jumlah_barang),array_2(($jumlah_barang)));
                            $z1y = perkalian_matriks(array_1($jumlah_barang), array_y($jumlah_barang));
    						            $ar = perkalian_matriks(accent($zz1),$z1y);
                            //print_r($jumlah_barang);
                            $zz1_ma = perkalian_matriks(array_1(data_ma($jumlah_barang)),array_2(data_ma($jumlah_barang)));
                            $z1y_ma = perkalian_matriks(array_1(data_ma($jumlah_barang)), array_y(data_ma($jumlah_barang)));
                            $ma = perkalian_matriks(accent($zz1_ma),$z1y_ma);
                            
                            $mse_ar = 0;
                            $mse_ma = 0;
                            $mse_arima = 0;
                            $result_ar = array();
                            $result_ma = array();
                            $result_arima = array();
                            $greater = "";
    				         ?>
                      <?php foreach($jumlah_barang as $i => $jumlah){?>
                      <tr>
                      	<td><?php echo $month[$n_month[$i]];?></td>
                        <td><?php echo $jumlah;?></td>
                        <?php 
                          $dr = $ar[0][0]+$jumlah*$ar[1][0];
                          $mr = $ma[0][0]+$jumlah*$ma[1][0];
                          $arima = $ar[0][0]+$jumlah*$ar[1][0]-$jumlah*$ma[1][0];
                        ?>
                        <?php 
                          $result_ar[] = $dr; 
                          $result_ma[] = $mr;
                          $result_armia[] = $arima;
                        ?>
                        <td><?php printf('%.0f', $dr);?></td>
                        <td><?php printf('%.0f', $mr);?></td>
                        <td><?php printf('%.0f', $arima);?></td>
                        <?php 
                          $error1 = $jumlah-$dr;
                          $error2 = $jumlah-$mr;
                          $error3 = $jumlah-$arima;
                        ?>
                      </tr>
                      <?php 
                        $mse_ar += pow($error1,2); 
                        $mse_ma += pow($error2,2);
                        $mse_arima += pow($error3,2);
                      }?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-5">
                  <div class="widget-container fluid-height">
                    <div class="widget-content padded">
                      <table class="table">
                        <thead><tr colspan="3">MSE</tr></thead>
                        <tr>
                          <td>AR</td>
                          <td>MA</td>
                          <td>ARIMA</td>
                        </tr>
                        <tr>
                          <td><input class="form-control" id="disabledInput" type="text" value="<?php printf('%.0f',abs($mse_ar/count($jumlah_barang)));?>" disable></td>
                          <td><input class="form-control" id="disabledInput" type="text" value="<?php printf('%.0f',abs($mse_ma/count($jumlah_barang)));?>" disable></td>
                          <td><input class="form-control" id="disabledInput" type="text" value="<?php printf('%.0f',abs($mse_arima/count($jumlah_barang)));?>" disable></td>
                        </tr>
                      </table>
                      <table class="table">
                        <thead><tr colspan="3">Metode Terbaik</tr></thead>
                        <tr>
                          <td colspan="3">
                            <?php if(abs($mse_ar/count($jumlah_barang)) < abs($mse_ma/count($jumlah_barang)) && abs($mse_ar/count($jumlah_barang)) < abs($mse_arima/count($jumlah_barang))){?>
                              <?php $greater = "ar";?>
                              <input class="form-control" id="disabledInput" type="text" value="AR - <?php printf('%.0f',abs($mse_ar/count($jumlah_barang)));?>" disable>
                            <?php }elseif (abs($mse_ma/count($jumlah_barang)) < abs($mse_ar/count($jumlah_barang)) && abs($mse_ma/count($jumlah_barang)) < abs($mse_arima/count($jumlah_barang))){ ?>
                              <?php $greater = "ma";?>
                              <input class="form-control" id="disabledInput" type="text" value="MA - <?php printf('%.0f',abs($mse_ma/count($jumlah_barang)));?>" disable>
                            <?php }else{?>
                              <?php $greater = "arima";?>
                              <input class="form-control" id="disabledInput" type="text" value="ARIMA - <?php printf('%.0f',abs($mse_arima/count($jumlah_barang)));?>" disable>
                            <?php }?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
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
                      $("#ar").sparkline([300,<?php foreach($jumlah_barang as $i => $jumlah){echo $jumlah.",";} ?>300], {
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
                      $("#ar").sparkline([300,<?php foreach($result_ar as $i => $jumlah){echo $jumlah.",";} ?>300], {
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
                      $("#ma").sparkline([300,<?php foreach($jumlah_barang as $i => $jumlah){echo $jumlah.",";} ?>300], {
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
                      $("#ma").sparkline([300,<?php foreach($result_ma as $i => $jumlah){echo $jumlah.",";} ?>300], {
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
                      $("#arima").sparkline([300,<?php foreach($jumlah_barang as $i => $jumlah){echo $jumlah.",";} ?>300], {
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
                      $("#arima").sparkline([300,<?php foreach($result_arima as $i => $jumlah){echo $jumlah.",";} ?>300], {
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
                <div class="col-lg-12">
                  <div class="widget-container fluid-height">
                    <div class="col-lg-4">
                      <div class="widget-container">
                        <div class="heading">
                          <i class="fa fa-bar-chart"></i>AR
                        </div>
                        <div class="widget-content padded">
                          <div id="ar">
                            Loading...
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="widget-container">
                        <div class="heading">
                          <i class="fa fa-bar-chart"></i>MA
                        </div>
                        <div class="widget-content padded">
                          <div id="ma">
                            Loading...
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="widget-container">
                        <div class="heading">
                          <i class="fa fa-bar-chart"></i>ARIMA
                        </div>
                        <div class="widget-content padded">
                          <div id="arima">
                            Loading...
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div> 
            <div class="row">
              <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading">
                    <i class="fa fa-bar-chart"></i>Rumus Peramalan
                  </div>
                  <div class="widget-content padded">
                    <table class="table">
                      <tr>
                        <td>
                          <input class="form-control" id="disabledInput" type="text" value="AR = <?php printf('%.3f',$ar[0][0]);?> + (<?php printf('%.3f',$ar[1][0]);?>) + 1 - et"/>
                        </td>
                        <td>
                          <input class="form-control" id="disabledInput" type="text" value="MA = <?php printf('%.3f',$ma[0][0]);?> + (<?php printf('%.3f',$ma[1][0]);?>) + 1 - et"/>
                        </td>
                        <td>
                          <input class="form-control" id="disabledInput" type="text" value="ARIMA = <?php printf('%.3f',$ar[0][0]);?> + (<?php printf('%.3f',$ma[1][0]);?>) + 1 - et"/>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div> 
            <?php 
            $data = '';
              if($greater == 'ar'){
                $data = $result_ar;
              }elseif ($greater == 'ma') {
                $data = $result_ma;
              }else{
                $data = $result_arima;
              }?>
            <?php
            if(sizeof($data)>0){
              foreach ($data as $key => $value){
                $thn = substr($startdate, 6,4)+1;
                $c_month = $thn. sprintf("%02s", $n_month[$key]+1);
                $where = array(
                                "by_month"=>$c_month,
                                "kode_cabang"=>$kode_cabang,
                                "kode_barang"=>$kode_barang,
                              );
                $database->delete("tb_peramalan",$where);
                $data = array(
                                "id_peramalan"=>null,
                                "by_month"=>$c_month,
                                "kode_cabang"=>$kode_cabang,
                                "kode_barang"=>$kode_barang,
                                "jumlah"=>$value,
                                "tgl_peramalan"=>"CURDATE()",
                              );
                $database->insert("tb_peramalan",$data);
              }
            }
            ?>
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