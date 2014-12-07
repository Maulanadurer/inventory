<?php require_once "../config/SimplePDO.php";
 $params = array(
     'host' => 'localhost', 
     'user' => 'root', 
     'password' => '', 
     'database' => 'db_inventory_scm'
 );
 
//Set the options
SimplePDO::set_options( $params );
$database = SimplePDO::getInstance();

if(isset($_POST['submit'])){
    require_once "../config/kodefikasi.php";
    $kode_barang = $_POST['kode_barang'];
    $kode_supplier = $_POST['kode_supplier'];
    $jumlah = $_POST['jumlah'];
    $i = 0;
    foreach($kode_barang as $kode_brg){
        $kode_pesan = kodefikasi('tb_pemesanan','kode_pesan','POS');
        $data = array(
                      "kode_pesan"=>$kode_pesan,
                      "kode_suplier"=>$kode_supplier[$i],
                      "tgl_beli"=>"NOW()",
                      "status"=>"0",
                    );
        $resp = $database->insert("tb_pemesanan",$data);
        $detail = array(
                      "kode_pesan"=>$kode_pesan,
                      "kode_barang"=>$kode_barang[$i],
                      "qty"=>$jumlah[$i],
                    );
        $resp = $database->insert("tb_detail_pemesanan",$detail);
    }
    $database->truncate(array("temp_pesan"));
    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=pemesanan_barang');
    //}
}
?>