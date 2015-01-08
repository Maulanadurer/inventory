      <?php $database = SimplePDO::getInstance();?>
        <div class="page-title">
          <h1>
            Form Permintaan Barang
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-bars"></i>Permintaan
              </div>
              <div class="widget-content padded">
                <form action="proses/permintaan_temp.php" class="form-horizontal" method="post">
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Cabang</label>
                    <div class="col-md-7">
                    <?php $query = $database->get_results("SELECT * FROM tb_cabang");?>
                        <select class="form-control" name="kode_cabang">
                    <?php foreach($query as $row){?>
                          <option value="<?php echo $row->kode_cabang;?>"><?php echo $row->nama_cabang;?></option>
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
                    <label class="control-label col-md-2">Tanggal Permintaan</label>
                    <div class="col-md-7">
                        <input class="form-control" data-date-autoclose="false" data-date-format="yyyy-mm-dd" id="dpd1" placeholder="Start date" type="text" name="tgl_permintaan" value=""/>
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
                <form action="proses/cetak_permintaan.php" class="" method="post">
                <table class="table table-bordered table-striped">
                  <thead>
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
                      Jumlah Barang
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php $rows = $database->get_results("SELECT * FROM temp_permintaan");
                        if(count($rows)>0){?>
                    <?php $i = 1;
                          foreach($rows as $row){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><input type="hidden" name="kode_barang[]" value="<?php echo $row->kode_barang;?>"/><?php echo $row->kode_barang;?></td>
                        <td><input type="hidden" name="kode_cabang[]" value="<?php echo $row->kode_cabang;?>"/><?php echo $row->nama_barang;?></td>
                        <td><input type="hidden" name="tgl_permintaan" value="<?php echo $row->tanggal;?>"/><input type="text" name="jumlah[]" value="<?php echo $row->jumlah;?>"/></td>
                        <td><a href="proses/hapus_permintaan.php?kode=<?php echo $row->kode;?>"><i class="fa fa-cut"></i></a></td>
                    </tr>

                          <?php $i++;}?>
                    <?php }else{?>
                    <td colspan="5">Belum ada data</td>
                    <?php }?>
                  </tbody>
                </table>
                <button class="btn btn-danger" type="submit" name="submit">Cetak Permintaan</button>
                </form>
              </div>
            </div>
          </div>
        </div>