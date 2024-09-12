<?php
class Sessions
{
    public int $sessionId;
    public int $sessionUserId;
    public string $sessionKey;
    public string $sessionStart;
    public string $sessionEnd;



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

        if (isset($_COOKIE["steptember-session"])); {
            include "database.php";

            $key = mysqli_real_escape_string($conn, $_COOKIE["keukenprins-session"]);

            $query = "SELECT * FROM sessions WHERE session_key = '" . $key . "' AND session_end > '" . date("Y-m-d H:i:s") . " ' ";
            $result = $conn->query($query);


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
            return $sessions;
        }
    }
}
?>
