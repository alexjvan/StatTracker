<?php
	include 'DB.php';
	class FileReader {
		public static function UpdateDB(){
			$files = scandir('/users/');
			foreach($files as $user){
				if(substr($user, -4) == ".txt"){
					$username = substr($user, 0, -4);
				  	$update = fopen('/users/'.$user, 'r');
				  	$contents = fgets($update);
				  	$split = explode($contents, ' ');
				  	$value = $split[0];
				  	$count = $split[1];

					if($value == "Time"){
						$prev = DB::query('SELECT playTime FROM stats WHERE username=:username', array(':username'=>$username));
						$newTime = $prev + $count;
						DB::query('UPDATE stats SET playTime=:newTime WHERE username=:username', array(':newTime'=>$newtime, ':username'=>$username));
					}

					fclose($user);
					unlink('/users'.$user);
				}
			}
		}

		public static function UpdateDB($name){
			$user = fopen('/users/'.$name.'.text') or die("Unable to use file.");
			$username = substr($user, 0, -4);
			$update = fopen('/users'.$user, 'r');
			$contents = fgets($update);
			$split = explode($contents, ' ');
			$value = $split[0];
			$count = $split[1];

			if($value == "Time"){
				$prev = DB::query('SELECT playTime FROM stats WHERE username=:username', array(':username'=>$username));
				$newTime = $prev + $count;
				DB::query('UPDATE stats SET playTime=:newTime WHERE username=:username', array(':newTime'=>$newtime, ':username'=>$username));
			}

			fclose($user);
			unlink('/users'.$user);
		}
	}
?>
