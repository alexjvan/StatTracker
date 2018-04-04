<?php
	include '../assets/scripts/DB.php';
	// CHECK IF POSTED TO
	$username = $_GET['name'];
	$value = $_GET['value'];
	$adding = $_GET['adding'];
	// IF USER EXISTS
	if(DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))){
		$userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0][0];
		if(DB::query('SELECT '.$value.' FROM stats WHERE userid=:userid', array(':userid'=>$userid))){
			$prevVal = DB::query('SELECT '.$value.' FROM stats WHERE userid=:userid', array(':userid'=>$userid))[0][0];
			$newVal = floatval($prevVal) + floatval($adding);

			// UPDATE QUERY
			DB::query('UPDATE stats SET '.$value.' = '.$newVal.' WHERE userid=:userid', array(':userid'=>$userid));
			echo 'Done';
		} else {
			echo 'Value '.$value.' not found';
		}
	} else {
		echo 'Player not found';
	}
?>
