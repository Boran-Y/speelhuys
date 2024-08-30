<?php
class Sessie {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function setUserId($userId) {
        self::start();
        $_SESSION['user_id'] = $userId;
    }

    public static function getUserId() {
        self::start();
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }
}
?>
