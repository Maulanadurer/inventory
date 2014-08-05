<?php
	if(!session_start()){
		session_start();
	}
	if(file_exists("config/conf_file.php")){
		include"config/conf_file.php";
	}else{
		include"../config/conf_file.php";
	}
	//if(isset($_SESSION['admin_id'])){header('location:main.php?hal=home');}else{header('location:index.php');}
?>
 