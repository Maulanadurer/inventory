      <?php $database = SimplePDO::getInstance();?>
        <div class="page-title">
          <h1>
            Laporan Penjualan Barang
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-bars"></i>Laporan
              </div>
              <div class="widget-content padded">
                <form action="main.php?hal=laporan_jual" class="form-horizontal" method="post">
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Tanggal</label>
                    <div class="col-md-7">
                        <div class="col-sm-4">
                          <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd1" placeholder="Start date" type="text" name="sdate">
                        </div>
                        <div class="col-sm-4">
                          <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd2" placeholder="End date" type="text" name="edate">
                        </div>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Barang</label>
                    <div class="col-md-7">
                    <?php $query = $database->get_results("SELECT * FROM tb_barang");?>
                        <select class="form-control" name="kode_barang">
                          <option value="all">Semua Barang</option>
                    <?php foreach($query as $row){?>
                          <option value="<?php echo $row->kode_barang.'|'.$row->nama_barang;?>"><?php echo $row->nama_barang;?></option>
                    <?php }?>
                        </select>
                    </div>
                  </div>
                                   
                  <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                      <button class="btn btn-primary" type="submit" name="submit">Lihat</button>
                      <a href="main.php?hal=laporan_jual" class="btn btn-default-outline">Cancel</a>
                    </div>
                  </div>
                </form>
                <table class="table table-bordered table-striped">
                  <thead>
                    <th class="check-header hidden-xs">
                      <label><input id="checkAll" name="checkAll" type="checkbox"/><span></span></label>
                    </th>
                    <th>
                      No
                    </th>
                    <th>
                      No Transaksi
                    </th>
                    <th class="hidden-xs">
                      Tanggal Transaksi
                    </th>
                    <th class="hidden-xs">
                      Jenis Transaksi
                    </th>
                    <th class="hidden-xs">
                      Nama Cabang
                    </th>
                  </thead>
                  <tbody>
                  <?php if(isset($_POST['submit'])){?>
                    <?php
                      $startdate = $_POST['sdate'];
                      $enddate = $_POST['edate'];
                      $sdate = substr($startdate, 6,4)."-".substr($startdate, 3,2)."-".substr($startdate, 0,2);
                      $edate = substr($enddate, 6,4)."-".substr($enddate, 3,2)."-".substr($enddate, 0,2); 
                      $rows = $database->get_results("SELECT * FROM tb_penjualan tp JOIN tb_cabang tc ON tc.kode_cabang=tp.kode_cabang 
                                                      JOIN tb_jenistransaksijual tj ON tj.kode_jenistransaksijual=tp.kode_jenistransaksijual 
                                                      WHERE tp.tgl_jual BETWEEN '".$sdate."' AND '".$edate."'");?>
                    <?php if(count($rows)>0){?>
                    <?php $i = 1;
                          foreach($rows as $row){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->id_transaksi;?>"><span></span></label>
                      </td>
                      <td>
                          <?php echo $i;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->id_transaksi;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_jual;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->jenis_transaksijual;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->nama_cabang;?>
                      </td>
                    </tr>

                          <?php $i++;}?>
                    <?php }else{?>
                    <td colspan="5">Belum ada data</td>
                    <?php }?>
                  <?php }?>
                  </tbody>
                </table>
                <button class="btn btn-danger" type="submit" name="submit">Cetak Laporan</button>
              </div>
            </div>
          </div>
        </div>