<?php

session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $_SESSION['username'] = $username;

    // Validate username and password
    if (empty($username) || empty($password)) {
        echo "username and password are required.";
        exit;
    }

    if($_POST['submit'] == 'register') {
        // Register the user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        
        if ($stmt->execute()) {
            echo "User registered successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        header('Location: /');
    }
    else if($_POST['submit'] == 'login') {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['id']=$result->fetch_assoc()['id'];
            header('Location: /');
            exit;
        } else {
            echo "Invalid username or password.";
        }
    }
}

?>