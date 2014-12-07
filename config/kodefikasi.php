<?php 
function kodefikasi($nama_tbl, $nama_field, $prefix){
     $params = array(
         'host' => 'localhost', 
         'user' => 'root', 
         'password' => '', 
         'database' => 'db_inventory_scm'
     );
     
    //Set the options
    SimplePDO::set_options( $params );
    $database = SimplePDO::getInstance();

	$kode = "";$num = 0;
    $row = $database->get_row("SELECT MAX(".$nama_field.") AS kode FROM ".$nama_tbl."");
	if(count($row) != 0){
		$num = (int) substr($row->kode,-3);
		$num++;
		$kode = $prefix . sprintf("%03s", $num);
	}else{
		$kode = $prefix."001";
	}
	return $kode;
}
?>