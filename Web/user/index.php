<?php
	$prefix = "../";
	$title = "User";
	$css = "user.css";
	include $prefix.'assets/scripts/Login.php';
?>
<?php include $prefix.'assets/globals/head.php' ?>
<?php include $prefix.'assets/globals/header.php' ?>
<?php
	$username = "";
	$userid = "";
	if(isset($_GET['u'])){
		$username = $_GET['u'];
		$userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0][0];
	} else {
		if(!Login::isLoggedIn()){
			header('login.php');
		} else {
			$userid = Login::isLoggedIn();
			$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0][0];
		}
	}
	$stats = DB::query('SELECT airtime, checkpoints, deaths, gamesstarted, lostgames, runtime, wongames FROM stats WHERE userid=:userid', array(':userid'=>$userid))[0];
?>


<body>
	<div id="spacer">

	</div>
	<div id="left">
		<!-- USER -->
		<div id="l-user">
			<h2 style="border-bottom: 1px solid black; margin-bottom: 25px; padding-bottom: 1px; margin-top: 1%;">User</h2>
			<div id="userPage">
				<div id="img" style="background-color: black; height: 100px; width: 100px; float: left;">

				</div>
				<div id="info" style="float: right; padding-left: 25px; width: calc(100% - 125px)">
					<div id="name">
						<?php echo $username ?> (<?php echo $userid ?>)
					</div>
				</div>
			</div>
		</div>
		<!-- BADGES -->
		<div id="l-badges">

		</div>
	</div>
	<div id="right">
		<!-- Stats -->
		<h2 style="margin-left: 5%; margin-top: 1%;">Stats</h2>
		<table id="r-table">
			<tr class="r-t-row">
				<td>
					Stat
				</td>
				<td>
					Count
				</td>
			</tr>
			<tr>
				<td>
					Air Time
				</td>
				<td>
					<?php
						echo $stats[0];
					?>
				</td>
			</tr>
			<tr>
				<td>
					Check Points
				</td>
				<td>
					<?php
						echo $stats[1];
					?>
				</td>
			</tr>
			<tr>
				<td>
					Deaths
				</td>
				<td>
					<?php
						echo $stats[2];
					?>
				</td>
			</tr>
			<tr>
				<td>
					Games Started
				</td>
				<td>
					<?php
						echo $stats[3];
					?>
				</td>
			</tr>
			<tr>
				<td>
					Lost Games
				</td>
				<td>
					<?php
						echo $stats[4];
					?>
				</td>
			</tr>
			<tr>
				<td>
					Run Time
				</td>
				<td>
					<?php
						echo $stats[5];
					?>
				</td>
			</tr>
			<tr>
				<td>
					Won Games
				</td>
				<td>
					<?php
						echo $stats[6];
					?>
				</td>
			</tr>
		</table>

		<div id="badges">
			<h2 style="border-bottom: 1px solid black; margin-bottom: 25px; padding-bottom: 1px;">Badges</h2>
			<?php
				if($stats[3] > 0){
					echo '
					<div class="badge" style="background-color: aqua; border: 5px solid blue; border-radius: 100px; width: 100px; height: 100px;">

					</div>';
				}
			?>
		</div>

	</div>
</body>

<?php include $prefix.'assets/globals/footer.php' ?>
