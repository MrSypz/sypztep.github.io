<?php
session_start();

// Check if the session variable is set
if (isset($_SESSION['username'])) {
    // If the user is logged in, return loggedIn: true
    echo json_encode(array("loggedIn" => true));
} else {
    // If the user is not logged in, return loggedIn: false
    echo json_encode(array("loggedIn" => false));
}
?>
