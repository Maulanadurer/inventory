<?php $database = SimplePDO::getInstance();
      $query = $database->get_results("SELECT * FROM tb_distribusi_brg tp JOIN tb_cabang tc ON tc.kode_cabang=tp.kode_cabang");?>
        <div class="page-title">
          <h1>
            Daftar Distribusi Barang 
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
                      No Distribusi
                    </th>
                    <th class="hidden-xs">
                      Tanggal Penjualan
                    </th>
                    <th class="hidden-xs">
                      Tanggal Distribusi
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
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->id_distribusi;?>"><span></span></label>
                      </td>
                      <td>
                          <?php echo $i;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->id_distribusi;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_jual;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_distribusi;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->nama_cabang;?>
                      </td>
                      <td class="hidden-xs">
                        <?php $w_status = ($row->status==0)?"minta":"jual";?>
                        <?php if($w_status=="minta"){?>
                        <a class="btn btn-xs btn-warning" href="main.php?hal=cetak_distribusi&kode=<?php echo $row->id_distribusi;?>">Packaging</a>
                        <?php }else{?>
                        <a class="btn btn-xs btn-success" href="#">Delivered</a>
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