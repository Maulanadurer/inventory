<?php
if(isset($_POST['submit'])){
	include"../config/cek_session.php";
	include"../config/koneksi.php";
	echo '1';
	$username = stripslashes($_POST['username']);
	$password = md5(stripslashes($_POST['password']));
	$query = mysql_query("SELECT * FROM tb_user WHERE username_user='".$username."'")or die(mysql_error());
	if(mysql_num_rows($query)>0){
		while($data=mysql_fetch_array($query)){
			echo "2";
			if($data['username_user']==$username&&$data['password_user']==$password){
				$_SESSION['username']=$data['username_user'];
				$_SESSION['admin_id']=$data['kode_user'];
				$_SESSION['kode_cabang'] = $data['kode_cabang'];
				header('location:'.$base_url.'main.php?hal=home');
			}else{
				header('location:index.php');
			}
		}	
	}else{
		header('location:index.php');
	}
}else{header('location:index.php');}

?>