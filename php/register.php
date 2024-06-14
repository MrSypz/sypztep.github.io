<?php

session_start();
include("fetchsql.php");

function redirect($url) {
    echo "<script>setTimeout(function(){window.location.href = '../$url';}, 3000);</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $mc_userName = $_POST['mcname'];
    $uuid = $_POST['uuid'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password']; // New field for password confirmation

    // Validate form data
    if (empty($mc_userName) || empty($uuid) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        redirect('index.html');
        exit;
    }

    // Check if the password matches the confirmation
    if ($password !== $confirmPassword) {
        echo "Password and confirm password do not match.";
        redirect('index.html');
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the user or UUID already exists
    $stmt = $conn->prepare("SELECT * FROM mc_users_tb WHERE mc_userName = ? OR uuid = ?");
    $stmt->bind_param("ss", $mc_userName, $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['mc_userName'] === $mc_userName) {
            echo "User already exists.";
        } elseif ($row['uuid'] === $uuid) {
            echo "UUID already exists.";
        }
        redirect('index.html');
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO mc_users_tb (mc_userName, uuid, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $mc_userName, $uuid, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        // Redirect to homepage after 3 seconds
        redirect('index.html');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
