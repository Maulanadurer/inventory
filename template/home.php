        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-4">
                <div class="number">
                  <div class="icon globe"></div>
                  86<small>%</small>
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
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart"></i>Penjualan Tahun 2013
              </div>
              <div class="widget-content padded">
                <div id="linechart-1">
                  Loading...
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="widget-container fluid-height">
              <!-- Table -->
              <table class="table table-filters">
                <tbody>
                  <tr>
                    <td class="filter-category blue">
                      <div class="arrow-left"></div>
                      <i class="fa fa-stethoscope"></i>
                    </td>
                    <td>
                      Januari
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        50,55,60,40,30,35,30,20,25,30,40,20,15
                      </div>
                    </td>
                    <td>
                      <div class="danger">
                        -4%
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-category green">
                      <div class="arrow-left"></div>
                      <i class="fa fa-coffee"></i>
                    </td>
                    <td>
                      Februari
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        5,10,15,50,80,50,40,30,50,60,70,75,75
                      </div>
                    </td>
                    <td>
                      <div class="success">
                        +12%
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-category orange">
                      <div class="arrow-left"></div>
                      <i class="fa fa-gamepad"></i>
                    </td>
                    <td>
                      Maret
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        100,100,80,70,40,20,20,40,50,60,70
                      </div>
                    </td>
                    <td>
                      <div class="success">
                        +5%
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-category red">
                      <div class="arrow-left"></div>
                      <i class="fa fa-gift"></i>
                    </td>
                    <td>
                      April
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        5,10,15,20,30,40,80,100,120,120,140
                      </div>
                    </td>
                    <td>
                      <div class="success">
                        +26%
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-category blue">
                      <div class="arrow-left"></div>
                      <i class="fa fa-stethoscope"></i>
                    </td>
                    <td>
                      Mei
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        50,55,60,40,30,35,30,20,25,30,40,20,15
                      </div>
                    </td>
                    <td>
                      <div class="danger">
                        -4%
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-category magenta">
                      <div class="arrow-left"></div>
                      <i class="fa fa-trophy"></i>
                    </td>
                    <td>
                      Juni
                    </td>
                    <td class="hidden-xs">
                      <div class="sparkslim">
                        20,40,50,60,70,80,90,95,100,80,70,60
                      </div>
                    </td>
                    <td>
                      <div class="danger">
                        -4%
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- End Pie Graph 1 -->
        </div>