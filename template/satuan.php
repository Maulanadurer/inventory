<?php $query = mysql_query("SELECT * FROM tb_satuan") or die(mysql_error());?>
        <div class="page-title">
          <h1>
            Daftar Satuan
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <a href="main.php?hal=tambah_satuan" class="btn btn-primary">Tambah</a>
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
                      Kode Satuan
                    </th>
                    <th class="hidden-xs">
                      Nama Satuan
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
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_satuan;?>"><span></span></label>
                      </td>
                      <td>
                      	<?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo $row->kode_satuan;?>
                      </td>
                      <td>
                        <?php echo $row->nama_satuan;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_entry;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_satuan&id=<?php echo $row->kode_satuan;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_satuan.php?id=<?php echo $row->kode_satuan;?>"><i class="fa fa-trash-o"></i></a>
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