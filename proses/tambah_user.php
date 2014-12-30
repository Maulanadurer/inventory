<?php 
require_once "../config/SimplePDO.php";
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
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama_user = $_POST['nama_user'];
	$email_user = $_POST['email_user'];
    $role = $_POST['role'];
    $data = array(
                  "kode_admin"=>kodefikasi('tb_admin','kode_admin','ADM'),
                  "username_admin"=>$username,
                  "password_admin"=>md5($password),
                  "nama_admin"=>$nama_user,
                  "email_admin"=>$email_user,
                  "level"=>$role,
                );
    $database->insert("tb_admin",$data);
    header('location:../main.php?hal=daftar_user&st=1');
}
?>