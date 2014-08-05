        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
            <form action="main.php?hal=laporan_distribusi" class="form-horizontal" id="forecast" method="post">
            	<div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label col-md-5">Nama Cabang</label>
                  <div class="col-md-5">
                   <?php $query=mysql_query("SELECT * FROM tb_cabang") or die(mysql_error());?>
                    <select class="form-control" name="kode_cabang">
                    <?php while($row = mysql_fetch_object($query)){?>
                      <option value="<?php echo $row->kode_cabang;?>"><?php echo $row->nama_cabang;?></option>
                    <?php }?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Nama Barang</label>
                  <div class="col-md-5">
                  <?php $query=mysql_query("SELECT * FROM tb_barang") or die(mysql_error());?>
                    <select class="form-control" name="kode_barang">
                    <?php while($row = mysql_fetch_object($query)){?>
                    	<option value="<?php echo $row->kode_barang;?>"><?php echo $row->nama_barang;?></option>
                    <?php }?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-group">
                  <div class="col-md-5">
                    <input class="form-control" type="text" name="jumlah">
                  </div>
                </div>
              </div>
      			</form>
            </div>
          </div>
        </div>