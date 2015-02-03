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
    $status = $_POST['status'];
    $kode = $_POST['id_distribusi'];
    $tanggal = $_POST['tgl_distribusi'];
    $kode_cabang = $_POST['kode_cabang'];
  
    $update = array("status"=>$status, "tgl_distribusi"=>$tanggal);
    $where = array("id_distribusi"=>$kode);
    $database->update("tb_distribusi_brg", $update, $where, 1);
    if ($status==2) {
        $rows = $database->get_results("SELECT * FROM tb_detail_distribusi WHERE id_distribusi='".$kode."'");
        foreach ($rows as $row) {
            $brg = $database->get_row("SELECT * FROM tb_stok_cabang WHERE kode_barang=?",array($row->kode_barang));
            // print_r(count($brg));
            if (strlen($brg->kode_barang)>0){
                $update = array("stok_barang"=>($row->jumlah+$brg->stok_barang));
                $where = array("kode_barang"=>$row->kode_barang);
                $database->update("tb_stok_cabang", $update, $where, 1);
            }else{
                $data = array(
                              "kode_stok"=>NULL,
                              "kode_barang"=>$row->kode_barang,
                              "kode_cabang"=>$kode_cabang,
                              "stok_cabang"=>$row->jumlah,
                             );        
                $database->insert("tb_stok_cabang",$data);  
                // print_r($database->affected());
            }

        }

    }
    header('location:../main.php?hal=daftar_distribusi');
}
?>