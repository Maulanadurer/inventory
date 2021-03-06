<?php $database = SimplePDO::getInstance();
      $query = $database->get_results("SELECT * FROM tb_penjualan tp JOIN tb_cabang tc ON tc.kode_cabang=tp.kode_cabang JOIN tb_jenistransaksijual tj ON tj.kode_jenistransaksijual=tp.kode_jenistransaksijual");?>
        <div class="page-title">
          <h1>
            Daftar Penjualan 
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
             <?php $i = 1; foreach($query as $row){?>
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
              <?php $i++; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end DataTables Example -->