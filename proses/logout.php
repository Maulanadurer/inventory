<?php
include"../config/conf_file.php";
include"../config/cek_session.php";
include"../config/koneksi.php";
	session_destroy();
	header('location:'.$base_url.'index.php');
?>