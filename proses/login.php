<?php
if(isset($_POST['submit'])){
    require_once "../config/SimplePDO.php";
     $params = array(
         'host' => 'localhost', 
         'user' => 'root', 
         'password' => '', 
         'database' => 'db_inventory_scm'
     );
     
    //Set the options
    SimplePDO::set_options( $params );
    $database = SimplePDO::getInstance();

	$username = stripslashes($_POST['username']);
	$password = md5(stripslashes($_POST['password']));
    $data = $database->get_row("SELECT * FROM tb_admin WHERE username_admin=?",array($username));
	if($database->num_rows("SELECT COUNT(*) FROM tb_admin WHERE username_admin=?",array($username))>0){
	   if($data->username_admin==$username&&$data->password_admin==$password){
	        session_start();
			$_SESSION['username']=$data->username_admin;
			$_SESSION['admin_id']=$data->kode_admin;
			$_SESSION['level'] = $data->level;
			header('location:../main.php?hal=home');
		}else{
			header('location:../index.php');
		}
	}else{
		header('location:../index.php');
	}
}else{header('location:../index.php');}

?>