      <?php $database = SimplePDO::getInstance();?>
      <?php $query = $database->get_row("SELECT p.*,s.* FROM tb_pemesanan p JOIN tb_supplier s ON p.kode_suplier=s.kode_supplier WHERE kode_pesan=?", array($_GET['kode']));?>
        <div class="page-title">
          <h1>
            Pembelian Barang
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-bars"></i>Pemesanan
              </div>
              <div class="widget-content padded">
                <form action="proses/pembelian_barang.php" class="form-horizontal" method="post">
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Supplier</label>
                    <div class="col-md-7">
                        <input class="form-control" id="disabledInput" type="text" name="kode_supplier" value="<?php echo $query->kode_supplier."|".$query->nama_supplier?>" />
                        <input type="hidden" name="kode_pesan" value="<?php echo $query->kode_pesan;?>" />
                        <input type="hidden" name="kode_supplier" value="<?php echo $query->kode_supplier;?>" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Jenis Transaksi</label>
                    <div class="col-md-7">
                    <?php $q = $database->get_results("SELECT * FROM tb_jenistransaksibeli");?>
                        <select class="form-control" name="kode_transaksi">
                    <?php foreach($q as $row){?>
                          <option value="<?php echo $row->kode_jenistransaksibeli;?>"><?php echo $row->jenis_transaksibeli;?></option>
                    <?php }?>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Tanggal Pemesanan</label>
                    <div class="col-md-7">
                        <input class="form-control" data-date-autoclose="false" data-date-format="yyyy-mm-dd" id="dpd1" placeholder="Start date" type="text" name="tgl_pesan" value="<?php echo $query->tgl_beli;?>"/>
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
                    <?php $rows = $database->get_results("SELECT p.*,b.* FROM tb_detail_pemesanan p JOIN tb_barang b ON p.kode_barang=b.kode_barang AND p.kode_pesan='".$_GET['kode']."'");
                        if(count($rows)>0){?>
                    <?php $i = 1;
                          foreach($rows as $row){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><input type="hidden" name="kode_barang[]" value="<?php echo $row->kode_barang;?>"/><?php echo $row->kode_barang;?></td>
                        <td><?php echo $row->nama_barang;?></td>
                        <td><input class="form-control" id="disabledInput" type="text" name="jumlah[]" value="<?php echo $row->qty;?>"/></td>                        
                    </tr>

                          <?php $i++;}?>
                    <?php }else{?>
                    <td colspan="5">Belum ada data</td>
                    <?php }?>
                  </tbody>
                </table>
                    <button class="btn btn-primary" type="submit" name="submit">Proses Pembelian</button>
                    <a href="main.php?hal=daftar_stok" class="btn btn-default-outline">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>