<?php $database = SimplePDO::getInstance();
      $query = $database->get_results( "SELECT * FROM tb_supplier" );?>
        <div class="page-title">
          <h1>
            Daftar Supplier
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <a href="main.php?hal=tambah_supplier" class="btn btn-primary">Tambah</a>
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
                      Kode Supplier
                    </th>
                    <th class="hidden-xs">
                      Nama Supplier
                    </th>
                    <th class="hidden-xs">
                      Alamat Supplier
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
             <?php $i = 1; foreach($query as $row){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_supplier;?>"><span></span></label>
                      </td>
                      <td>
                      	<?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo $row->kode_supplier;?>
                      </td>
                      <td>
                        <?php echo $row->nama_supplier;?>
                      </td>
                      <td>
                        <?php echo $row->alamat_supplier;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_supplier&kode=<?php echo $row->kode_supplier;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_supplier.php?kode=<?php echo $row->kode_supplier;?>"><i class="fa fa-trash-o"></i></a>
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