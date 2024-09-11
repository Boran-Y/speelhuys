<?php
class User
{
    public int $userId;
    public string $userFirstname;
    public string $userLastname;
    public string $userEmail;
    public string $userUSername;
    public string $userPassword;
    public string $userRole;
  
    
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
                $user = new User();
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