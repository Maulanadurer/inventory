<?php $database = SimplePDO::getInstance();
      $query = $database->get_results( "SELECT * FROM tb_cabang" );?>
        <div class="page-title">
          <h1>
            Daftar Cabang
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <a href="main.php?hal=tambah_cabang" class="btn btn-primary">Tambah</a>
                <a href="" class="btn btn-danger">Hapus</a>
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th class="check-header hidden-xs">
                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                    </th>
                    <th>
                      No
                    </th>
                    <th>
                      Kode Cabang
                    </th>
                    <th class="hidden-xs">
                      Nama Cabang
                    </th>
                    <th class="hidden-xs">
                      Alamat Cabang
                    </th>
                    <th class="hidden-xs">
                      No. Telepon Cabang
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
             <?php $i = 1; foreach ($query as $row) {?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_cabang;?>"><span></span></label>
                      </td>
                      <td>
                      	<?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo $row->kode_cabang;?>
                      </td>
                      <td>
                        <?php echo $row->nama_cabang;?>
                      </td>
                      <td>
                        <?php echo $row->alamat_cabang;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->telepon_cabang;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_cabang&kode=<?php echo $row->kode_cabang;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_cabang.php?kode=<?php echo $row->kode_cabang;?>"><i class="fa fa-trash-o"></i></a>
                        </div>
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