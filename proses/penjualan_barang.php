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
    $faktur = $_POST['id_permintaan'];
    $jenis_transaksi= $_POST['jenis_transaksi'];
    $kode_cabang= $_POST['kode_cabang'];  
    $tgl_jual= $_POST['tgl_jual'];   
    
    $id_transaksi = kodefikasi('tb_penjualan','id_transaksi','POP');
    $data = array(
                  "id_transaksi"=>$id_transaksi,
                  "kode_cabang"=>$kode_cabang,
                  "tgl_jual"=>$tgl_jual,
                  "kode_admin"=>"ADM001",
                  "kode_jenistransaksijual"=>$jenis_transaksi,
                 );
    $resp = $database->insert("tb_penjualan",$data);
    $i = 0;
    $rows = $database->get_results("SELECT * FROM tb_detail_permintaan WHERE id_permintaan='".$faktur."'");
    foreach($rows as $row){
        $detail = array(
                      "kode_barang"=>$row->kode_barang,
                      "jumlah"=>$row->jumlah,
                      "id_transaksi"=>$id_transaksi
                    );
        $resp = $database->insert("tb_detail_penjualan",$detail);
        $stok = $database->get_row("SELECT * FROM tb_barang WHERE kode_barang=?",array($row->kode_barang));
        $data_baru = array(
                            "num_log"=>null,
                            "tgl_update"=>$tgl_jual,
                            "stok_awal"=>$stok->stok_barang,
                            "stok_akhir"=>$stok->stok_barang+$row->jumlah,
                            "kode_barang"=>$row->kode_barang,
                            "id_transaksi"=>$id_transaksi,
                          );
        $database->insert("tb_logstokjual",$data_baru);
        $u_brg = array("stok_barang"=>$stok->stok_barang-$row->jumlah);
        $w_brg = array("kode_barang"=>$row->kode_barang);
        $database->update("tb_barang", $u_brg, $w_brg, 1);
        $i++;
    }
    $update = array("status"=>1);
    $where = array("id_permintaan"=>$faktur);
    $database->update("tb_permintaan", $update, $where, 1);

    $id_distribusi = kodefikasi('tb_distribusi_brg','id_distribusi','DIS');
    $data = array(
                  "id_distribusi"=>$id_distribusi,
                  "kode_cabang"=>$kode_cabang,
                  "tgl_jual"=>$tgl_jual,
                  "tgl_distribusi"=>"0000-00-00",
                  "status"=>"0",
                 );
    $database->insert("tb_distribusi_brg",$data);
    
    $i = 0;
    foreach($rows as $row){
        $detail = array(
                      "kode_barang"=>$row->kode_barang,
                      "jumlah"=>$row->jumlah,
                      "id_distribusi"=>$id_distribusi,
                    );
        $database->insert("tb_detail_distribusi",$detail);
        $i++;
    }
    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=daftar_permintaan');
    //}
}
?>