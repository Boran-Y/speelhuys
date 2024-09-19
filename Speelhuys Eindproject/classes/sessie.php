<?php
class Sessions
{
    public int $sessionId;
    public int $sessionUserId;
    public string $sessionKey;
    public string $sessionStart;
    public string $sessionEnd;


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
    
    public function insert()
    {

        $database = new Database();
        $database->start();

        $sessionUserId = mysqli_real_escape_string($database->connection, $this->sessionUserId);
        $sessionKey = mysqli_real_escape_string($database->connection, $this->sessionKey);
        $sessionStart = mysqli_real_escape_string($database->connection, $this->sessionStart);
        $sessionEnd = mysqli_real_escape_string($database->connection, $this->sessionEnd);


        $sql = "INSERT INTO sessions
    (
        session_user_id,
        session_key,
        session_start,
        session_end
    )
    VALUES
    (
      
        '" . $sessionUserId . "',
        '" . $sessionKey . "',
        '" . $sessionStart . "',
        '" . $sessionEnd . "'
    
    )";

    $result = $database->connection->query($sql);
    $database->close();
    }



    public static function findActiveSessions()
    {

        $database = new Database();
        $database->start();

        $sessions = [];
        if (isset($_COOKIE["speelhuys-session"])) {

            $key = mysqli_real_escape_string($database->connection, $_COOKIE["speelhuys-session"]);

            $query = "SELECT * FROM sessions WHERE session_key = '" . $key . "' AND session_end > '" . date("Y-m-d H:i:s") . " ' ";
            $result = $database->connection->query($query);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $session = new sessions();
                    $session->sessionId = $row['session_id'];
                    $session->sessionUserId = $row['session_user_id'];
                    $session->sessionKey = $row['session_key'];
                    $session->sessionStart = $row['session_start'];
                    $session->sessionEnd = $row['session_end'];
                    $sessions[] = $session;
                }

            }
            $database->close();
            return $session;
        }
    }
}
?>