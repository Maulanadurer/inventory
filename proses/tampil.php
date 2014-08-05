<?php 
include"../config/koneksi.php";
include"../config/kodefikasi.php";
if(isset($_POST['submit'])){
  require_once '../Excel/reader.php';
  /*$path = $_FILE['path']['tmp_name'];*/
  if ($_FILES["path"]["error"] > 0) {
	echo "Error: " . $_FILES["path"]["error"] . "<br>";
  } else {
	echo "Upload: " . $_FILES["path"]["name"] . "<br>";
	echo "Type: " . $_FILES["path"]["type"] . "<br>";
	echo "Size: " . ($_FILES["path"]["size"] / 1024) . " kB<br>";
	echo "Stored in: " . $_FILES["path"]["tmp_name"] . " kB<br>";
	
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$data->read($_FILES["path"]["tmp_name"]);
  	$kode_cabang = "";
	//error_reporting(E_ALL ^ E_NOTICE);
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		if($i<2){
			echo $data->sheets[0]['cells'][$i][1] ." : ".$data->sheets[0]['cells'][$i][2]."<br>";
			echo $data->sheets[0]['cells'][$i+1][1] ." : ".$data->sheets[0]['cells'][$i+1][2]."<br>";
			$kode_cabang = $data->sheets[0]['cells'][$i+1][2];
			//echo $data->sheets[0]['cells'][$i+1][1] ." : ".$data->sheets[0]['cells'][$i+1][2]."<br>";
		}
		if($i>4){
		  //for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			 $date=explode("/",$data->sheets[0]['cells'][$i][2]);
			 $jenis_transaksi=($data->sheets[0]['cells'][$i][5]=="Tunai")? 'JENJ001':'JENJ002';
			 $query=mysql_query("INSERT INTO tb_penjualan 
			 			  VALUES('".kodefikasi('tb_penjualan','id_transaksi','CPT')."',
						  '".$data->sheets[0]['cells'][$i][1]."',
						  '".$date[2]."-".$date[1]."-".$date[0]."',
						  '".$data->sheets[0]['cells'][$i][3]."',
						  '".$data->sheets[0]['cells'][$i][4]."',
						  '".$kode_cabang."',
						  '".$jenis_transaksi."')") or die(mysql_error());
			 //mysql_query("commit");
			 print_r($query);
			 echo "\"".$data->sheets[0]['cells'][$i-1][2]."\",";
		  //}
		  echo "<br>";
		}
	}
  }
}
?>
<a href="../main.php?hal=import_data">Back</a>