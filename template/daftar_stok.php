<?php $database = SimplePDO::getInstance();
      $query = $database->get_results( "SELECT * FROM tb_barang" );?>
        <div class="page-title">
          <h1>
            Daftar Stok Barang 
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
              	<a href="main.php?hal=pemesanan_barang" class="btn btn-primary">Buat Pemesanan</a>
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
                      Kode Barang
                    </th>
                    <th class="hidden-xs">
                      Nama Barang
                    </th>
                    <th class="hidden-xs">
                      Deskripsi Barang
                    </th>
                    <th class="hidden-xs">
                      Stok Barang
                    </th class="hidden-xs">
                    <th>
                      Status
                    </th>
                  </thead>
                  <tbody>
             <?php $i = 1; foreach($query as $row ){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_barang;?>"/><span></span></label>
                      </td>
                      <td>
                          <?php echo $i;?>
                      </td>
                      <td>
                        <?php echo $row->kode_barang;?>
                      </td>
                      <td>
                        <?php echo $row->nama_barang;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->deskripsi_barang;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->stok_barang;?>
                      </td>
                      <td>
                        <?php if($row->stok_barang<=$row->safety_stock){?>
                        <a class="btn btn-xs btn-warning" href="main.php?hal=pemesanan_barang&kode=<?php echo $row->kode_barang;?>">
                        Stok Menipis</a>
                        <?php }else if(($row->stok_barang-$row->safety_stock)<=50){?>
                        <a class="btn btn-xs btn-danger" href="main.php?hal=pemesanan_barang&kode=<?php echo $row->kode_barang;?>">
                        Stok Kurang</a>
                        <?php }else{?>
                        <a class="btn btn-xs btn-success" href="main.php?hal=pemesanan_barang&kode=<?php echo $row->kode_barang;?>">
                        Stok Aman</a>
                        <?php }?>
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