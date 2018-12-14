<?php
	include 'assets/scripts/DB.php';

	$q = $_GET['q'];

	if(strlen($q) > 0){
		$hint = "";
		$users = DB::query('SELECT username FROM users WHERE username LIKE "%'.$q.'%"', array());
		foreach($users as $user){
			$hint .= '<a href="user/index.php?u='.
			$user[0].'">'.
			$user[0].'</a>';
		}
	}

	if($hint == ""){
		$response = "no suggestion";
	}
	else {
		$response = $hint;
	}

	echo $response;
?>
