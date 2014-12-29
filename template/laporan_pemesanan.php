      <?php $database = SimplePDO::getInstance();
      $row = $database->get_row( "SELECT ts.*, tp.* FROM tb_pemesanan tp JOIN tb_supplier ts ON ts.kode_supplier=tp.kode_suplier WHERE tp.kode_pesan = ? ", array($_GET['kode']) );?>
        <div class="page-title">
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-bars"></i>Daftar Pemesanan
              </div>
              <div class="widget-content padded">
                
                  <div class="form-group">
                    <div class="col-md-9">
                      <label class="control-label col-md-9"><h2><?php echo $row->nama_supplier;?></h2></label>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-md-9">
                      <label class="control-label col-md-9"><h5><?php echo $row->alamat_supplier;?></h5></label>
                    </div>
                  </div>
                  <br />
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
                    <?php $rows = $database->get_results("SELECT tdp.*, tb.* FROM tb_detail_pemesanan AS tdp JOIN tb_barang tb ON tb.kode_barang=tdp.kode_barang WHERE tdp.kode_pesan='".$_GET['kode']."'");
                        if(count($rows)>0){?>
                    <?php $i = 1;
                          foreach($rows as $row){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row->kode_barang;?></td>
                        <td><?php echo $row->nama_barang;?></td>
                        <td><?php echo $row->qty;?></td>
                    </tr>

                          <?php $i++;}?>
                    <?php }else{?>
                    <td colspan="4">Belum ada data</td>
                    <?php }?>
                  </tbody>
                </table>
                <a class="btn btn-danger" href="#">Kembali</a>
                <a class="btn btn-success" href="template/docs.php?kode=<?php echo $_GET['kode']; ?>" target="_blank">Cetak Pemesanan</a>
              </div>
            </div>
          </div>
        </div>