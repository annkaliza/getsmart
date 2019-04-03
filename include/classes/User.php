<?php

class User
{

    private $row;
    function __construct($row)

    {
        $this->row = $row;
    }
    function __toString()
    {
        return $this->row['username'];
    }
    //this function is finding if user exists.
    public static function isUser($username)
    {
        $pdo = $GLOBALS['pdo'];
        $query = $pdo->prepare('SELECT userId FROM user WHERE username = ?');
        $query->execute([$username]);

        if (!empty($query->rowCount())) {
            return true;
        }
        return false;
    }


    //this is creating new user if doesnt exist.
    public static function create($username, $pass)
    {
        $pdo = $GLOBALS['pdo'];
        //if user exists
        // if(user::isuser($username)) this is to call for static function to see if exists
        // if (true) {
        if (user::isuser($username)) {


            // return array('status' => true, 'message' => "user <em>$username</em> already exists!");
            return array('status' => false, 'message' => "user <em>$username</em> already exists!");
        } else { //if does not exist
            $passHash = password_hash($pass, PASSWORD_BCRYPT); //generate password  hash

            $query = $pdo->prepare('INSERT INTO user(username,passHash) VALUES(?,?)');
            $query->execute([$username, $passHash]);

            if (!empty($query->rowcount())) {

                return array('status' => true, 'message' => "user <em>$username</em> created!");
            }
        }
    }
    //varifies if is actual login
    public static function loginWithPassword($username, $pass)
    {
        $pdo = $GLOBALS['pdo'];

        $query = $pdo->prepare('SELECT * FROM user WHERE username = ?');
        $query->execute([$username]);

        if (!empty($query->rowCount())) {

            $row = $query->fetch();
            if (password_verify($pass, $row['passHash'])) {

                $Cookie = mt_rand(0, 999999999999999999);
                $CookieHash = password_hash($Cookie, PASSWORD_BCRYPT);

                $query = $pdo->prepare('UPDATE user SET CookieHash = ? WHERE userId = ?');
                $query->execute([$CookieHash, $row['userId']]);

                return array('status' => true, 'user' => $row, 'cookie' => $Cookie);
            }
        }
        return array('status' => false, 'message' => 'login invalid');
    }


    public static function loginWithCookies($username, $code)
    {
        $pdo = $GLOBALS['pdo'];

        $query = $pdo->prepare('SELECT * FROM user WHERE username = ?');
        $query->execute([$username]);

        if (!empty($query->rowCount())) {

            $row = $query->fetch();
            if (password_verify($code, $row['cookieHash'])) {
                return array('status' => true, 'user' => $row, );
            }
        }
        return array('status' => false, 'message' => 'login invalid');
    }
}
