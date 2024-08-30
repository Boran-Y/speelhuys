<?php
include_once "database.php";   // Include the database connection

class Gebruiker {
    private $conn;

    public function __construct() {
        global $connectie;
        $this->conn = $connectie;  // Globale connectie ding idk het werkt
    }

    // Login systeem
    public function validateLogin($username, $password) {
        // Check de login gegevens
        $stmt = $this->conn->prepare("SELECT user_id, user_password FROM users WHERE user_username = ?");
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
    }

    // Haal de gebruikers role (admin/employee)
    public function getUserRole($userId) {
        // Haalt gegevens van uit de database om een role op te halen
        $stmt = $this->conn->prepare("SELECT user_role FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['user_role'];
        }
        return null;
    }
}
?>
