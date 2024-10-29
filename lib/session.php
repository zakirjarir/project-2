<?php
class session {

    public static function init() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }


    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }


    public static function cheaksession() {
        self::init();
        if (self::get("login") == false) {
            header("location:login.php");
        }
    }

    public function destroy() {
        session_unset();
        session_destroy();
        header("location:login.php");
    }
}
?>

