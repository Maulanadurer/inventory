          <?php 
                $_MIN = 500;
                $p_month = array();
                $p_sum = array();
                $p_year = 0;
                for($i=1;$i<=6;$i++){
                  $tmp = array();
                  $sum = 0;
                  $hpenjualan = mysql_query("SELECT jumlah, MONTH(tgl_jual) AS month, YEAR(tgl_jual) AS year FROM tb_penjualan WHERE kode_cabang='".$_SESSION['kode_cabang']."' AND MONTH(tgl_jual)='".$i."'") or die(mysql_error());
                  while($row = mysql_fetch_object($hpenjualan)){
                      $tmp[] = $row->jumlah;
                      $sum += $row->jumlah;
                      $year = $row->year;
                  }
                  $p_sum [$i] = $sum; 
                  //print_r($tmp);
                  $p_month[$i] = implode(',', $tmp);
                }
                //print_r($p_sum);
            $list_m = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
          ?>
          <?php $ptotal = 0; foreach ($p_month as $key => $data_m) { $persen = ($p_sum[$key] - $_MIN)/$_MIN * 100; $ptotal+=$persen;}?> 
        <script type="text/javascript">
    /*
    # =============================================================================
    #   Morris Chart JS
    # =============================================================================
    */

    $(window).resize(function(e) {
      var morrisResize;
      clearTimeout(morrisResize);
      return morrisResize = setTimeout(function() {
        return buildMorris(true);
      }, 500);
    });
    $(function() {
      return buildMorris();
    });
    buildMorris = function($re) {
      var tax_data;
      if ($re) {
        $(".graph").html("");
      }
      tax_data = [
      <?php foreach($p_sum as $k => $p_sum_n){ 
        echo '{
          period: "'.$year.' Q'.$k.'",
          licensed: '.$p_sum_n.',
          sorned: 660
        }, ';
      }?>
      ];
      if ($('#hero-graph').length) {
        Morris.Line({
          element: "hero-graph",
          data: tax_data,
          xkey: "period",
          ykeys: ["licensed", "sorned"],
          labels: ["Licensed", "Off the road"],
          lineColors: ["#5bc0de", "#60c560"]
        });
      }
    };
        </script>
        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-4">
                <div class="number">
                  <div class="icon globe"></div>
                  <?php echo $ptotal;?><small>%</small>
                </div>
                <div class="text">
                  Overall growth
                </div>
              </div>
              <div class="col-md-4">
                <div class="number">
                  <div class="icon visitors"></div>
                  <?php $data=mysql_query("SELECT COUNT(*) AS jum_cabang FROM tb_cabang");
              $row=mysql_fetch_object($data);
            echo $row->jum_cabang;?>
                </div>
                <div class="text">
                  Cabang
                </div>
              </div>
<!--              <div class="col-md-3">
                <div class="number">
                  <div class="icon money"></div>
                  <small>IDR</small>924,-
                </div>
                <div class="text">
                  Stok Gudang
                </div>
              </div>-->
              <div class="col-md-4">
                <div class="number">
                  <div class="icon chat-bubbles"></div>
                  325
                </div>
                <div class="text">
                 Pesanan
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Statistics -->

        <div class="row">
          <!-- Pie Graph 1 -->
          <div class="col-lg-5">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Penjualan
              </div>
              <div class="widget-content padded text-center">
                <div class="graph-container">
                  <div class="caption"></div>
                  <div class="graph" id="hero-graph"></div>
                  <!-- Line Chart:Morris -->
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-7">
            <div class="widget-container fluid-height">
              <!-- Table -->
              <table class="table table-filters">
                <tbody>
                
                <?php 
                  foreach ($p_month as $key => $data_m) { ?>                        
                  <tr>
                    <td class="filter-category <?php echo ($key%2==0)?"blue":"red";?>">
                      <div class="arrow-left"></div>
                      <?php echo $list_m[$key-1];?>
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        <?php echo $data_m;?>
                      </div>
                    </td>
                    <td>
                      <?php $persen = ($p_sum[$key] - $_MIN)/$_MIN * 100;?>
                      <div class=<?php echo ($persen<=0)? "danger": "success";?>>
                        <?php echo $persen;?>%
                      </div>
                    </td>
                  </tr>
                <?php }?>
                 
                </tbody>
              </table>
            </div>
          </div>
          <!-- End Pie Graph 1 -->
        </div>