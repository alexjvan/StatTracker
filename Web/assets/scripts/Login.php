<?php
    include 'DB.php';
    class Login {
        public static function isLoggedIn() {
            if(isset($_COOKIE['SNID'])) {
                if(DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
                    $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
                    if(isset($_COOKIE['SNID_'])) {
                        return $userid;
                    } else {
                        $cstrong = True;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                        DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
                        DB::query('DELETE FROM  login_tokens WHERE token=:token', array(':token'=>$_COOKIE['SNID']));
                        setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                        return $userid;
                    }
                }
            }
            return false;
        }

        public static function loginUser($username, $password) {
            if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                if(password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                    $cstrong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    $user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                    DB::query('INSERT INTO login_tokens VALUES (NULL, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                    setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                    return $userid;
                } else {
                    return 'Incorrect Password!';
                }
            } else {
                return 'User not registered!';
            }
        }

        public static function logout($allDevices) {
            if($allDevices == True){
                DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>isLoggedIn()));
            } else {
                if(isset($_COOKIE['SNID'])) {
                    DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                setcookie('SNID_', '1', time()-3600);
            }
        }
    }
?>
