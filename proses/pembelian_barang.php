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
    $faktur = $_POST['kode_pesan'];
    $jenis_transaksi= $_POST['kode_transaksi'];
    $kode_supplier= $_POST['kode_supplier'];   
    
    $kode_pesan = kodefikasi('tb_pembelian','faktur_beli','POB');
    $data = array(
                  "faktur_beli"=>$kode_pesan,
                  "kode_supplier"=>$kode_supplier,
                  "tgl_beli"=>"NOW()",
                  "kode_jenistransaksibeli"=>$jenis_transaksi,
                 );
    $resp = $database->insert("tb_pembelian",$data);
    $i = 0;
    $rows = $database->get_results("SELECT * FROM tb_detail_pemesanan WHERE kode_pesan='".$faktur."'");
    foreach($rows as $row){
        $detail = array(
                      "num_beli"=>null,
                      "kode_barang"=>$row->kode_barang,
                      "qty_beli"=>$row->qty,
                      "faktur_beli"=>$kode_pesan
                    );
        $resp = $database->insert("tb_detailpembelian",$detail);
        $stok = $database->get_row("SELECT * FROM tb_barang WHERE kode_barang=?",array($row->kode_barang));
        $data_baru = array(
                            "num_log"=>null,
                            "tgl_update"=>"NOW()",
                            "stok_awal"=>$stok->stok_barang,
                            "stok_akhir"=>$stok->stok_barang+$row->qty,
                            "kode_barang"=>$row->kode_barang,
                            "kode_admin"=>"ADM001",
                            "faktur_beli"=>$kode_pesan,
                          );
        $database->insert("tb_logstokbeli",$data_baru);
        $u_brg = array("stok_barang"=>$stok->stok_barang+$row->qty);
        $w_brg = array("kode_barang"=>$row->kode_barang);
        $database->update("tb_barang", $u_brg, $w_brg, 1);
        $i++;
    }
    $update = array("status"=>1);
    $where = array("kode_pesan"=>$faktur);
    $database->update("tb_pemesanan", $update, $where, 1);

    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=daftar_pembelian');
    //}
}
?>