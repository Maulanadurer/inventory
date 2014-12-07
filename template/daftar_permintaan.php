<?php $database = SimplePDO::getInstance();
      $query = $database->get_results("SELECT * FROM tb_permintaan tp JOIN tb_cabang tc ON tc.kode_cabang=tp.kode_cabang");?>
        <div class="page-title">
          <h1>
            Daftar Permintaan Barang 
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
              	<a href="main.php?hal=input_permintaan" class="btn btn-primary">Input Permintaan</a>
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
                      No Transaksi
                    </th>
                    <th class="hidden-xs">
                      Tanggal Transaksi
                    </th>
                    <th class="hidden-xs">
                      Nama Cabang
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>
                  </thead>
                  <tbody>
             <?php $i = 1; foreach($query as $row){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->id_permintaan;?>"><span></span></label>
                      </td>
                      <td>
                          <?php echo $i;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->id_permintaan;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_jual;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->nama_cabang;?>
                      </td>
                      <td class="hidden-xs">
                        <?php $w_status = ($row->status==0)?"minta":"jual";?>
                        <?php if($w_status=="minta"){?>
                        <a class="btn btn-xs btn-warning" href="main.php?hal=penjualan_barang&kode=<?php echo $row->id_permintaan;?>">Dipesan</a>
                        <?php }else{?>
                        <a class="btn btn-xs btn-success" href="#">Sold Out</a>
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