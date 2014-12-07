<?php $database = SimplePDO::getInstance();
      $query = $database->get_results( "SELECT * FROM tb_barang" );?>
        <div class="page-title">
          <h1>
            Daftar Kategori
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">

              </div>
              <div class="widget-content padded clearfix">
<form action="proses/pemesanan_temp.php" class="form-horizontal" method="post">
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Supplier</label>
                    <div class="col-md-7">
                    <?php $query = $database->get_results("SELECT * FROM tb_supplier");?>
                        <select class="form-control" name="kode_supplier">
                    <?php foreach($query as $row){?>
                          <option value="<?php echo $row->kode_supplier;?>"><?php echo $row->nama_supplier;?></option>
                    <?php }?>
                        </select>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Barang</label>
                    <div class="col-md-7">
                    <?php $query = $database->get_results("SELECT * FROM tb_barang");?>
                        <select class="form-control" name="kode_barang">
                    <?php foreach($query as $row){?>
                          <option value="<?php echo $row->kode_barang.'|'.$row->nama_barang;?>"><?php echo $row->nama_barang;?></option>
                    <?php }?>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Jumlah Barang</label>
                    <div class="col-md-7">
                      <input class="form-control" placeholder="Jumlah Pesanan" type="text" name="jumlah" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">
                      <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
                      <a href="main.php?hal=daftar_stok" class="btn btn-default-outline">Cancel</a>
                    </div>
                  </div>
                </form>
                
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th class="check-header hidden-xs">
                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                    </th>
                    <th>
                      No
                    </th>
                    <th>
                      Kode Kategori
                    </th>
                    <th class="hidden-xs">
                      Nama Kategori
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
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_kategori;?>"><span></span></label>
                      </td>
                      <td>
                      	<?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo $row->kode_kategori;?>
                      </td>
                      <td>
                        <?php echo $row->nama_kategori;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $row->tgl_entry;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_kategori&id=<?php echo $row->kode_kategori;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_kategori.php?id=<?php echo $row->kode_kategori;?>"><i class="fa fa-trash-o"></i></a>
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