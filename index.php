<?php
	$prefix = "";
	$title = "Index";
	$css = "index.css";
	include $prefix.'assets/scripts/Login.php';
?>
<?php include $prefix.'assets/globals/head.php' ?>
<?php include $prefix.'assets/globals/header.php' ?>

<body>
	<div id="spacer">

	</div>
	<!-- Information -->
	<div class="section" style="text-align: center">
		<script>
			function showResult(str){
				if(str.length == 0) {
					document.getElementById("livesearch").innerHTML="";
					document.getElementById("livesearch").style.border="0px";
					return;
				}
				if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if(this.readyState == 4 && this.status == 200) {
						document.getElementById("livesearch").innerHTML=this.responseText;
						document.getElementById("livesearch").style.border="1px solid #A5ACB2";
					}
				}
				xmlhttp.open("GET", "livesearch.php?q="+str, true);
				xmlhttp.send();
			}
		</script>
		<div class="s-title">
			You can search for a user here:
		</div>
		<div id="search">
			<div id="s-left">
				Search:
			</div>
			<form>
				<input type="text" onkeyup="showResult(this.value)" />
				<div id="livesearch">

				</div>
			</form>
		</div>
	</div>
	<div class="section">
		<!-- GLOBAL HIGH SCORES -->
		<table cellspacing="0">
			<thead>
				<tr>
					<td colspan=6>
						High Scores
					</td>
				</tr>
			</thead>
			<tbody>
				<!-- PLACES -->
				<tr id="table-desc">
					<td>
						Divison
					</td>
					<td>
						#1
					</td>
					<td>
						#2
					</td>
					<td>
						#3
					</td>
					<td>
						#4
					</td>
					<td>
						#5
					</td>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Air Time</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, airtime from stats ORDER BY airtime DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Check Points</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, checkpoints from stats ORDER BY checkpoints DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Deaths</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, deaths from stats ORDER BY deaths DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Games Started</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, gamesstarted from stats ORDER BY gamesstarted DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Lost Games</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, lostgames from stats ORDER BY lostgames DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Run Time</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, runtime from stats ORDER BY runtime DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
				<tr>
					<td style="text-align: right">
						<b>Won Games</b>
					</td>
					<?php
						$top = DB::query('SELECT userid, wongames from stats ORDER BY wongames DESC LIMIT 5');
						foreach($top as $item){
							$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$item[0]))[0][0];
							echo '
								<td>
									<b>'.$username.'</b>
									<br />
									'.$item[1].'
								</td>
							';
						}
					?>
				</tr>
			</tbody>
		</table>
	</div>
</body>

<?php include $prefix.'assets/globals/footer.php' ?>
