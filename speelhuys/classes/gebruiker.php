<?php
class Gebruiker
{
    public  $userId;
    public  $userFirstname;
    public  $userLastname;
    public  $userEmail;
    public  $userUSername;
    public  $userPassword;
    public  $userRole;

    public function validateLogin($username, $password) {
        $database = new Database();
        $database->start();

        // Check de login gegevens
        $stmt = $database->connection->prepare("SELECT user_id, user_password FROM users WHERE user_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Debug errors
            error_log("Stored hash: " . $row['user_password']);
            error_log("Provided password: " . $password);

            // Check de wacthwoord
            if ($row['user_password'] === $password) {
                return $row['user_id'];  // Geef de user ID als het wachtwoord klopt
            } else {
                error_log("Password verification failed.");
            }
        } else {
            error_log("No user found with username: " . $username);
        }
        return false;
        $database->close();
    }
    
    public function getUserRole($userId) {

        $database = new Database();
        $database->start();

        // Haalt gegevens van uit de database om een role op te halen
        $stmt = $database->connection->prepare("SELECT user_role FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['user_role'];
    }
    return null;
    $database->close();
}
    public function insert()
    {
        
        $database = new database();
        $database->start();
       
    
    $userId = mysqli_real_escape_string($database->connection, $this->userId);
    $userFirstname = mysqli_real_escape_string($database->connection, $this->userFirstname);
    $userLastname = mysqli_real_escape_string($database->connection, $this->userLastname);
    $userEmail = mysqli_real_escape_string($database->connection, $this->userEmail);
    $userUSername = mysqli_real_escape_string($database->connection, $this->userUSername);
    $userPassword = mysqli_real_escape_string($database->connection, $this->userPassword);
    $userRole = mysqli_real_escape_string($database->connection, $this->userRole);
    
    
    $sql = "INSERT INTO sessions
    (
        user_id,
        user_firstname,
        user_lastname,
        user_email,
        user_username,
        user_password,
        user_role
    )
    VALUES
    (
        '" . $userId . "',
        '" . $userFirstname . "',
        '" . $userLastname . "',
        '" . $userEmail . "',
        '" . $userUSername . "',
        '" . $userPassword . "',
        '" . $userRole . "'
     
    
    )";
    
    
    
    $database->connection->query($sql);
    $database->close();
    
    }


    public static function findByUsernameAndPassword($username , $password )
    {
        include 'connectie.php';

        $username = mysqli_real_escape_string($database->connection, $username);
        $password = mysqli_real_escape_string($database->connection, $password);
    
        $query = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
        $result = $database->connection($query);


        $users = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new Gebruiker();
                $user->userId = $row['user_id'];
                $user->userFirstname = $row['user_firstname'];
                $user->userLastname = $row['user_lastname'];
                $user->userEmail = $row['user_email'];
                $user->userUSername = $row['user_username'];
                $user->userPassword = $row['user_password'];
                $user->userRole = $row['user_role'];
             
                $users[] = $user;
            }
        }
        $database->connection->query($query);
        $database->close();
        
        return $users;


        
    }}
?>