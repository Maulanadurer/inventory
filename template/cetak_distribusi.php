      <?php $database = SimplePDO::getInstance();?>
      <?php $query = $database->get_row("SELECT p.*,s.* FROM tb_distribusi_brg p JOIN tb_cabang s ON p.kode_cabang=s.kode_cabang WHERE id_distribusi=?", array($_GET['kode']));?>
        <div class="page-title">
          <h1>
            Distribusi Barang
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-bars"></i>Distribusi
              </div>
              <div class="widget-content padded">
                <form action="proses/proses_distribusi.php" class="form-horizontal" method="post">
                
                  <div class="form-group">
                    <label class="control-label col-md-2">Nama Cabang</label>
                    <div class="col-md-7">
                        <input class="form-control" id="disabledInput" type="text" name="kode_cabang" value="<?php echo $query->kode_cabang."|".$query->nama_cabang?>" />
                        <input type="hidden" name="id_distribusi" value="<?php echo $query->id_distribusi;?>" />
                        <input type="hidden" name="kode_cabang" value="<?php echo $query->kode_cabang;?>" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Jenis Transaksi</label>
                    <div class="col-md-7">
                        <select class="form-control" name="status">
                        <?php $q = array("Packaging","On Progress","Delivered")?>
                    <?php foreach($q as $key => $row){?>
                          <option value="<?php echo $key;?>" <?php echo ($key==$query->status)?"selected":""?>><?php echo $row;?></option>
                    <?php }?>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Tanggal Penjaualan</label>
                    <div class="col-md-7">
                        <input class="form-control" id="disabledInput" type="text" name="tgl_jual" value="<?php echo $query->tgl_jual;?>"/>
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
                    <?php $rows = $database->get_results("SELECT p.*,b.* FROM tb_detail_distribusi p JOIN tb_barang b ON p.kode_barang=b.kode_barang WHERE id_distribusi='".$_GET['kode']."'");
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
                    <button class="btn btn-primary" type="submit" name="submit">Proses Distribusi</button>
                    <a class="btn btn-success" href="template/doc_distribusi.php?kode=<?php echo $_GET['kode']; ?>" target="_blank">Cetak Dokumen</a>
                    <a href="main.php?hal=daftar_distribusi" class="btn btn-default-outline">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>