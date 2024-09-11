<?php
class sessions
{
    public int $sessionId;
    public int $sessionUserId;
    public string $sessionKey;
    public string $sessionStart;
    public string $sessionEnd;



    public function insert()
    {

        include 'connectie.php';

        $sessionUserId = mysqli_real_escape_string($conn, $this->sessionUserId);
        $sessionKey = mysqli_real_escape_string($conn, $this->sessionKey);
        $sessionStart = mysqli_real_escape_string($conn, $this->sessionStart);
        $sessionEnd = mysqli_real_escape_string($conn, $this->sessionEnd);


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

    $conn->query($sql);

        $conn->close();
    }



    public static function findActiveSessions()
    {
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

                $conn->close();
            }

            return $sessions;
        }
    }
}
?>
