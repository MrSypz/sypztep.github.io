<?php
session_start();
include("fetchsql.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $mc_userName = $_POST['mcname'];
    $password = $_POST['password'];

    // Retrieve hashed password from the database based on the username
    $stmt = $conn->prepare("SELECT password FROM mc_users_tb WHERE mc_userName = ?");
    $stmt->bind_param("s", $mc_userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $mc_userName;
            header('Location: ../index.html');
            exit();
        } else {
            echo "Incorrect username or password.";
        }
    } else {
        // User does not exist
        echo "User does not exist.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
