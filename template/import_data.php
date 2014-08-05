<?php 

if(isset($_POST['submit'])){
  require_once 'Excel/reader.php';
  $path = $_POST['path'];
  $data = new Spreadsheet_Excel_Reader();
  $data->setOutputEncoding('CP1251');
  $data->read($path);

  error_reporting(E_ALL ^ E_NOTICE);
  for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	  for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		  echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
	  }
	  echo "<br>";
  
  }
  
}
?>
<div class="page-title">
  <h1>
    Input Data Penjualan
  </h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height">
      <div class="heading tabs">
        <i class="fa fa-cloud-upload"></i>Tabs  
        <ul class="nav nav-tabs pull-right" data-tabs="tabs" id="tabs">
          <li class="active">
            <a data-toggle="tab" href="#tab1"><i class="fa fa-cloud-upload"></i><span>Import Data</span></a>
          </li>
          <li>
            <a data-toggle="tab" href="#tab2"><i class="fa fa-edit"></i><span>Input Data Manual</span></a>
          </li>
        </ul>
      </div>
      <div class="tab-content padded" id="my-tab-content">
        <div class="tab-pane active" id="tab1">
          <h3>
            Overview
          </h3>
          <form action="proses/tampil.php" class="form-horizontal" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label class="control-label col-md-2">Custom File Upload</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-group">
                  <div class="form-control">
                    <i class="fa fa-file fileupload-exists"></i><span class="fileupload-preview"></span>
                  </div>
                  <div class="input-group-btn">
                    <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="path"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
          	<div class="col-md-4">
            	<input class="btn btn-primary" type="submit" value="Import" name="submit">
            </div>
          </div>
          
        </form>
        </div>
        <div class="tab-pane" id="tab2">
          <h3>
            Profile
          </h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque imperdiet auctor purus, non imperdiet sapien dapibus non. Phasellus pretium rutrum elit in cursus. Donec ullamcorper nec massa vel mattis. Curabitur eros metus, dapibus quis est et, dapibus imperdiet dolor.
          </p>
        </div>
 
      </div>
    </div>
  </div>
</div>










