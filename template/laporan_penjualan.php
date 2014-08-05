<?php $query = mysql_query("SELECT * FROM tb_penjualan tp JOIN tb_barang tb ON tb.kode_barang=tp.kode_barang JOIN tb_cabang tc ON tc.kode_cabang=tp.kode_cabang JOIN tb_jenistransaksijual tj ON tj.kode_jenistransaksijual=tp.kode_jenistransaksijual WHERE tp.kode_cabang='".$_SESSION['kode_cabang']."' ") or die(mysql_error());?>
        <div class="page-title">
          <h1>
            Daftar Barang 
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
              	<a href="main.php?hal=import_data" class="btn btn-primary">Import</a>
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
                      Kode Barang
                    </th>
                    <th class="hidden-xs">
                      Nama Barang
                    </th>
                    <th class="hidden-xs">
                      Kategori
                    </th>
                    <th class="hidden-xs">
                      Qty
                    </th>
                    <th class="hidden-xs">
                      Nama Cabang
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
             <?php $i = 1; while($row=mysql_fetch_object($query)){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_barang;?>"><span></span></label>
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
                        <?php echo $row->jenis_transaksijual;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->jumlah;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->nama_cabang;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_barang&id=<?php echo $row->kode_barang;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_barang.php?id=<?php echo $row->kode_barang;?>"><i class="fa fa-trash-o"></i></a>
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