<?php

require_once 'dp.php.inc';
session_start(); //start session

// Check if session data exists
if (!isset($_SESSION['user_data_before_confirm'])) {
    header("Location:signUp.php ");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    // Check if user name exists
    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $pdo->prepare($sql);
    //binding parameters
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['errmessage'] = "User Name Already Exists!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $_SESSION['errmessage'] = "please fill all fields !";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $_SESSION['errmessage'] = "Username must contain only letters and numbers.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    if (strlen($password) < 8 || strlen($password) > 12 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $_SESSION['errmessage'] = "Password must be 8-12 characters and include both letters and numbers.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    if ($password !== $confirmPassword) {
        $_SESSION['errmessage'] = "Passwords must be the same!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    unset($_SESSION['errmessage']);
    $_SESSION['password'] = $password;
    $_SESSION['username'] = $username;
    header("Location: confirm.php");
    exit();
}
?>