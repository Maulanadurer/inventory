<?php require_once( 'config/SimplePDO.php' ); 
 $params = array(
     'host' => 'localhost', 
     'user' => 'root', 
     'password' => '', 
     'database' => 'db_inventory_scm'
 );
 
 //Set the options
 SimplePDO::set_options( $params );
 //Initiate the class
 //$database = new SimplePDO();
 //OR...
?>
