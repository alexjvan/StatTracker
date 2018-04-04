<?php
	include('../assets/scripts/Login.php');
	echo 'Started';
	if(Login::isLoggedIn()){
		Login::logout(False);
	}
	header('Location: ../');
?>
