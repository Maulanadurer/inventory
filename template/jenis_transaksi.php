<?php $query = mysql_query("SELECT * FROM tb_jenistransaksi") or die(mysql_error());?>
        <div class="page-title">
          <h1>
            Jenis Transaksi
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <a href="main.php?hal=tambah_jenis_transaksi" class="btn btn-primary">Tambah</a>
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
                      ID Jenis Transaksi
                    </th>
                    <th class="hidden-xs">
                      Jenis Transaksi
                    </th>
                    <th class="hidden-xs">
                      Tgl Entry
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
             <?php $i = 1; while($row=mysql_fetch_object($query)){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->id_jenistransaksi;?>"><span></span></label>
                      </td>
                      <td>
                      	<?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo $row->id_jenistransaksi;?>
                      </td>
                      <td>
                        <?php echo $row->jenis_transaksi;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_entry;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_jenis_transaksi&id=<?php echo $row->id_jenistransaksi;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_jenis_transaksi.php?id=<?php echo $row->id_jenistransaksi;?>"><i class="fa fa-trash-o"></i></a>
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