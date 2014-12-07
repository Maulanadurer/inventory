<?php
	if(!session_start()){
		session_start();
	}
	#if(isset($_SESSION['admin_id'])){header('location:main.php?hal=home');}else{header('location:index.php');}
?>
 