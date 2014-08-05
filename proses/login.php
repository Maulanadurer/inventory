<?php
if(isset($_POST['submit'])){
	include"../config/cek_session.php";
	include"../config/koneksi.php";
	echo '1';
	$username = stripslashes($_POST['username']);
	$password = md5(stripslashes($_POST['password']));
	$query = mysql_query("SELECT * FROM tb_admin WHERE username_admin='".$username."'")or die(mysql_error());
	if(mysql_num_rows($query)>0){
		while($data=mysql_fetch_array($query)){
			echo "2";
			if($data['username_admin']==$username&&$data['password_admin']==$password){
				$_SESSION['username']=$data['username_admin'];
				$_SESSION['admin_id']=$data['kode_admin'];
				$_SESSION['level'] = $data['level'];
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