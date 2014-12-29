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
    $kode_cabang = $_POST['kode_cabang'];
    $jumlah = $_POST['jumlah'];
    
    
    $id_permintaan = kodefikasi('tb_permintaan','id_permintaan','POI');
    $data = array(
                  "id_permintaan"=>$id_permintaan,
                  "kode_cabang"=>$kode_cabang[0],
                  "tgl_jual"=>"NOW()",
                  "status"=>"0",
                 );
    $resp = $database->insert("tb_permintaan",$data);


    $i = 0;
    foreach($kode_barang as $kode_brg){
        $detail = array(
                      "id_permintaan"=>$id_permintaan,
                      "kode_barang"=>$kode_brg,
                      "jumlah"=>$jumlah[$i],
                    );
        $resp = $database->insert("tb_detail_permintaan",$detail);
        $i++;
    }
    $database->truncate(array("temp_permintaan"));

    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=daftar_permintaan');
    //}
}
?>