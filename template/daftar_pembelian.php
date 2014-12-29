<?php $database = SimplePDO::getInstance();
      $query = $database->get_results( "SELECT p.*,s.* FROM tb_pemesanan p JOIN tb_supplier s ON p.kode_suplier=s.kode_supplier" );?>
        <div class="page-title">
          <h1>
            Daftar Pembelian Barang 
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">

              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th class="check-header hidden-xs">
                      <label><input id="checkAll" name="checkAll" type="checkbox"/><span></span></label>
                    </th>
                    <th>
                      No
                    </th>
                    <th>
                      Kode Pemesanan
                    </th>
                    <th class="hidden-xs">
                      Nama Supplier
                    </th>
                    <th class="hidden-xs">
                      Tanggal Pemesanan
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>
                  </thead>
                  <tbody>
             <?php $i = 1; foreach($query as $row ){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_pesan;?>"/><span></span></label>
                      </td>
                      <td>
                          <?php echo $i;?>
                      </td>
                      <td>
                        <?php echo $row->kode_pesan;?>
                      </td>
                      <td>
                        <?php echo $row->nama_supplier;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_beli;?>
                      </td>
                      <td class="hidden-xs">
                          <?php $w_status = ($row->status==0)?"dipesan":"dibeli";?>
                          <?php if($w_status=="dipesan"){?>
                          <a class="btn btn-xs btn-warning" href="main.php?hal=pembelian_barang&kode=<?php echo $row->kode_pesan;?>">Dipesan</a>
                          <?php }else{?>
                          <a class="btn btn-xs btn-success" href="#">Dibeli</a>
                          <?php }?>
                          <a class="btn btn-xs btn-warning" href="main.php?hal=laporan_pemesanan&kode=<?php echo $row->kode_pesan;?>">Dokumen Pemesanan</a>
                      </td>
                    </tr>
              <?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end DataTables Example -->