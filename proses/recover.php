<?php
if(isset($_POST['submit'])){
    require_once "../config/SimplePDO.php";
require_once "../config/conf_file.php";
 $params = array(
     'host' => host, 
     'user' => user, 
     'password' => password, 
     'database' => database
 );

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = '';                           //password is a string
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = mt_rand(0, $alphaLength);    
        $pass = $pass.$alphabet[$n];      //append a random character
    }
    return (strtolower($pass)); 
}
     
    //Set the options
    SimplePDO::set_options( $params );
    $database = SimplePDO::getInstance();

    $username = stripslashes($_POST['username']);
    $data = $database->get_row("SELECT * FROM tb_admin WHERE email_admin=?",array($username));
    if($database->num_rows("SELECT COUNT(*) FROM tb_admin WHERE email_admin=?",array($username))>0){
       if($data->username_admin==$username&&$data->password_admin==$password){
            $u_where = array("kode_admin"=>$data->kode_admin);
            $new_password = randomPassword();
            $database->update("tb_barang",array("password"=>md5($new_password)),$u_where);
            // Mail them their key
            $mailbody = "Dear user,\n\n
                Password anda telah di reset\n\n
                Berikut username : ".$data->username_admin."\n\n
                Password Baru anda :" . $new_password . "\n\n
                Thanks,\n
                The Administration";
            mail($data->email_admin, "Password Reset", $mailbody);
            
            header('location:../forgot_password.php?sub=1');
        }else{
            header('location:../forgot_password.php?sub=0');
        }
    }else{
       header('location:../forgot_password.php?sub=0');
    }
}else{header('location:../forgot_password.php?sub=0');}

?>