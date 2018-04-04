<?php
?>
<header>
	<div id="h-logo">

	</div>
	<center>
		<div id="h-items">
			<div class="h-i-item">
				<a class="h-i-i-button" href="<?php echo $prefix ?>">
					<span class="h-i-i-b-text">
						Home
					</span>
				</a>
			</div>
		</div>
	</center>
	<div id="h-account">
		<?php
			if(Login::isLoggedIn()){
				$userid = Login::isLoggedIn();
				$username = DB::query('SELECT username FROM users WHERE id=:id', array('id'=>$userid))[0][0];
				echo '
					<div id="h-a-user">
						<div id="h-a-u-username">
							<a id="h-a-u-u-button" href="'.$prefix.'user/">
								<span id="h-a-u-u-b-text">
									'.$username.'
								</span>
							</a>
						</div>
						<div id="h-a-u-logout">
							<a id="h-a-u-l-button" href="'.$prefix.'user/logout.php">
								<span id="h-a-u-l-b-text">
									Logout
								</span>
							</a>
						</div>
					</div>
				';
			} else {
				echo '
					<div id="h-a-lic">
						<div id="h-a-lic-login">
							<a id="h-a-lic-l-button" href="'.$prefix.'user/login.php">
								<span id="h-a-lic-l-b-text">
									Log In
								</span>
							</a>
						</div>
						<div id="h-a-lic-create">
							<a id="h-a-lic-c-button" href="'.$prefix.'user/create-account.php">
								<span id="h-a-lic-c-b-text">
									Create Account
								</span>
							</a>
						</div>
					</div>
				';
			}
		?>
	</div>
</header>
