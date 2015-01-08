      <?php $database = SimplePDO::getInstance();?>
      <?php $query = $database->get_row("SELECT p.*,s.* FROM tb_permintaan p JOIN tb_cabang s ON p.kode_cabang=s.kode_cabang WHERE id_permintaan=?", array($_GET['kode']));?>
        <div class="page-title">
          <h1>
            Penjualan Barang
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-bars"></i>Permintaan
              </div>
              <div class="widget-content padded">
                <form action="proses/penjualan_barang.php" class="form-horizontal" method="post">
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Supplier</label>
                    <div class="col-md-7">
                        <input class="form-control" id="disabledInput" type="text" name="kode_cabang" value="<?php echo $query->kode_cabang."|".$query->nama_cabang?>" />
                        <input type="hidden" name="id_permintaan" value="<?php echo $query->id_permintaan;?>" />
                        <input type="hidden" name="kode_cabang" value="<?php echo $query->kode_cabang;?>" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Jenis Transaksi</label>
                    <div class="col-md-7">
                    <?php $q = $database->get_results("SELECT * FROM tb_jenistransaksijual");?>
                        <select class="form-control" name="jenis_transaksi">
                    <?php foreach($q as $row){?>
                          <option value="<?php echo $row->kode_jenistransaksijual;?>"><?php echo $row->jenis_transaksijual;?></option>
                    <?php }?>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Tanggal Permintaan</label>
                    <div class="col-md-7">
                        <input class="form-control" data-date-autoclose="false" data-date-format="yyyy-mm-dd" id="dpd1" placeholder="Start date" type="text" name="tgl_jual" value="<?php echo $query->tgl_jual;?>"/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-7">

                    </div>
                  </div>
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
                  </thead>
                  <tbody>
                    <?php $rows = $database->get_results("SELECT p.*,b.* FROM tb_detail_permintaan p JOIN tb_barang b ON p.kode_barang=b.kode_barang WHERE id_permintaan='".$_GET['kode']."'");
                        if(count($rows)>0){?>
                    <?php $i = 1;
                          foreach($rows as $row){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><input type="hidden" name="kode_barang[]" value="<?php echo $row->kode_barang;?>"/><?php echo $row->kode_barang;?></td>
                        <td><?php echo $row->nama_barang;?></td>
                        <td><input class="form-control" id="disabledInput" type="text" name="jumlah[]" value="<?php echo $row->jumlah;?>"/></td>                        
                    </tr>

                          <?php $i++;}?>
                    <?php }else{?>
                    <td colspan="5">Belum ada data</td>
                    <?php }?>
                  </tbody>
                </table>
                    <button class="btn btn-primary" type="submit" name="submit">Proses Penjualan</button>
                    <a href="main.php?hal=daftar_permintaan" class="btn btn-default-outline">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>