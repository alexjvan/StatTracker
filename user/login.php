<?php
    $prefix = "../";
    include $prefix."assets/scripts/Login.php";

    $error = "";
    if(isset($_POST['logout'])) {
        Login::logout(False);
    } else if(isset($_POST['signup'])){
        header('Location:'.$prefix.' create-account.php');
    } else if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
            if(password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                Login::loginUser($username, $password);
                header('Location: landing.php');
            } else {
                $error = 'Incorrect Password!';
            }
        } else {
            $error = 'User not registered!';
        }
    }
    include $prefix."assets/globals/header.php";
?>
<?php
    $pageName = "Login";
    $css = "login.css";
?>
<?php include $prefix."assets/globals/head.php" ?>
<body>
    <div id="container">
        <div id="outsidewindow">
            <div id="window">
                <div id="newacc">
                    <h1 id="na-title">Login!</h1>
                    <form method="post" id="na-form">
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

                        <?php
                            if(!Login::isLoggedIn()) {
                                echo '<input id="submit" type="submit" name="login" value="Login" /><input id="submit" type="submit" name="signup" value="Signup" />';
                            } else {
                                echo '<div id="cantsubmit"><span id="ili-text">You are already logged in, you can not re-login.</span><input type="submit" name="logout" value="Logout" /></div>';
                            }
                        ?>

                        <div id="error">
                            <?php echo $error ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include $prefix."assets/globals/footer.php" ?>
</body>
