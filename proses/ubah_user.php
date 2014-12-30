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
	$kode = $_GET['kode_user'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama_user = $_POST['nama_user'];
	$email_user = $_POST['email_user'];
	$role = $_POST['role'];
	$row = $database->get_row("SELECT * FROM tb_admin WHERE kode_admin=?",array($kode));
	$pass = "";
	$temp = md5($password);
	if ($row->password_admin == $temp){
		$pass = $row->password_admin;
	}else{
		$pass = $temp;
	}
    $update = array(
                  "username_admin"=>$username,
                  "password_admin"=>$pass,
                  "nama_admin"=>$nama_user,
                  "email_admin"=>$email_user,
                  "level"=>$role,
                   );
    $u_where = array("kode_admin"=>$kode);
    $database->update("tb_admin",$update,$u_where);
	header('location:../main.php?hal=daftar_user&st=1');
}
?>