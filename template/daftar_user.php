<?php $database = SimplePDO::getInstance();
      $query = $database->get_results("SELECT * FROM tb_admin"); ?>
        <div class="page-title">
          <h1>
            Daftar User
          </h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <a href="main.php?hal=tambah_user" class="btn btn-primary">Tambah</a>
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th class="check-header hidden-xs">
                      <label><input id="checkAll" name="checkAll" type="checkbox"/><span></span></label>
                    </th>
                    <th>
                      No
                    </th>
                    <th>
                      ID User
                    </th>
                    <th class="hidden-xs">
                      Username
                    </th>
                    <th class="hidden-xs">
                      Password
                    </th>
                    <th class="hidden-xs">
                      Nama User
                    </th>
                    <th class="hidden-xs">
                      Email User
                    </th>
                    <th>
                      Role
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
             <?php $i = 1; foreach($query as $row){?>
                    <tr>
                      <td class="check hidden-xs">
                        <label><input name="optionsRadios1" type="checkbox" value="<?php echo $row->kode_admin;?>"/><span></span></label>
                      </td>
                      <td>
                      	<?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo $row->kode_admin;?>
                      </td>
                      <td>
                        <?php echo $row->username_admin;?>
                      </td>
                      <td>
                        <?php echo $row->password_admin;?>
                      </td>
                      <td>
                        <?php echo $row->nama_admin;?>
                      </td>
                      <td>
                        <?php echo $row->email_admin;?>
                      </td>
                      <td>
                        <?php echo $row->level;?>
                      </td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href="main.php?hal=ubah_user&kode=<?php echo $row->kode_admin;?>"><i class="fa fa-pencil"></i></a><a class="table-actions" href="proses/hapus_user.php?kode=<?php echo $row->kode_admin;?>"><i class="fa fa-trash-o"></i></a>
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