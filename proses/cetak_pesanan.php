<?php require_once "../config/SimplePDO.php";
require_once "../config/conf_file.php";
 $params = array(
     'host' => host, 
     'user' => user, 
     'password' => password, 
     'database' => database
 );
 
//Set the options
SimplePDO::set_options( $params );
$database = SimplePDO::getInstance();

if(isset($_POST['submit'])){
    require_once "../config/kodefikasi.php";
    $kode_barang = $_POST['kode_barang'];
    $kode_supplier = $_POST['kode_supplier'];
    $jumlah = $_POST['jumlah'];
    
    
    $kode_pesan = kodefikasi('tb_pemesanan','kode_pesan','POS');
    $data = array(
                  "kode_pesan"=>$kode_pesan,
                  "kode_suplier"=>$kode_supplier[0],
                  "tgl_beli"=>"NOW()",
                  "status"=>"0",
                 );
    $resp = $database->insert("tb_pemesanan",$data);
    $i = 0;
    foreach($kode_barang as $kode_brg){
        $detail = array(
                      "kode_pesan"=>$kode_pesan,
                      "kode_barang"=>$kode_brg,
                      "qty"=>$jumlah[$i],
                    );
        $resp = $database->insert("tb_detail_pemesanan",$detail);
        $i++;
    }
    $database->truncate(array("temp_pesan"));
    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=pemesanan_barang');
    //}
}
?>