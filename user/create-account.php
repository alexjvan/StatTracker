<?php
    $title = "Create Account";
    $prefix = "../";
    $css = "create-account.css";
	include $prefix.'assets/scripts/Login.php';
?>
<?php
        $error = "";
        if(isset($_POST['logout'])) {
            Login::logout(False);
        } else if(isset($_POST['login'])) {
            header('Location: login.php');
        } else if(isset($_POST['createaccount'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            if($username != '' && $password != '' && $email != '') {
                if(!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                    if(strlen($username) >= 3 && strlen($username) <= 32)
                    {
                        if(preg_match('/[a-zA-Z0-9_]+/', $username)) {
                            if(strlen($password) >= 6 && strlen($password) <= 60) {
                                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    if(!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
										$date = date('m-d-Y');
										DB::query('INSERT INTO users VALUES (NULL, :username, :password, :email, :curDate)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email, ':curDate'=>$date));
										$userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0][0];
										DB::query('INSERT INTO stats VALUES (NULL, :userid, 0, 0, 0, 0, 0, 0, 0, 0)', array(':userid'=>$userid));
                                        // SUCCESS
                                        Login::loginUser($username, $password);
                                        header('Location: index.php');
                                    } else {
                                        $error = 'Email in use!';
                                    }
                                } else {
                                    $error =  'Invalid email!';
                                }
                            } else {
                                $error =  'Invalid password!';
                            }
                        } else {
                            $error =  'Invalid username!';
                        }
                    } else {
                        $error =  'Invalid username!';
                    }
                } else {
                    $error =  "User already exists!";
                }
            } else {
                $error = "Not all fields were filled out!";
            }
        }
    ?>
<?php include $prefix."assets/globals/head.php" ?>
<body>
    <?php include $prefix."assets/globals/header.php" ?>

    <div id="container">
        <div id="outsidewindow">
            <div id="window">
                <div id="newacc">
                    <h1 id="na-title">Create a new Account!</h1>
                    <form action="create-account.php" method="post" id="na-form">
                        <div id="username">
                            <div>
                                Username
                            </div>
                            <input type="text" name="username" value="" placeholder="" style="padding: 3px;" />
                        </div>
                        <div id="password">
                            <div>
                                Password
                            </div>
                            <input type="password" name="password" value="" placeholder="" style="padding: 3px;" />
                        </div>
                        <div id="email">
                            <div>
                                Email
                            </div>
                            <input type="email" name="email" value="" placeholder="" style="padding: 3px;"/>
                        </div>

                        <!--SUBMIT BUTTON-->
                        <?php
                            if(!Login::isLoggedIn()) {
                                echo '
								<div id="buttons">
									<input class="submit" type="submit" name="createaccount" value="Create Account" />
									<input class="submit" type="submit" name="login" value="Go Login" />
								</div>';
                            } else {
                                echo '<div id="cantsubmit"><span id="ili-text">You are already logged in, you can not re-login.</span><form action="login.php" method="post"><input type="submit" name="logout" value="Logout" /></form></div>';
                            }
                        ?>
                        <div>
                            <?php echo $error ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include $prefix."assets/globals/footer.php" ?>
</body>
