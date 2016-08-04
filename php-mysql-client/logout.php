<?php 



if( isset( $_COOKIE[ session_name() ] ) ) {
	//empty the cookie
	setcookie( session_name(), '', time()-8600, '/');
}

session_unset();


session_destroy();
include('includes/header.php');
 ?>

 <h1>Logged out!</h1>

