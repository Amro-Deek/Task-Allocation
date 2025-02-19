<?php
require_once("dp.php.inc");
session_start(); // Start the session
// Check if a session already exists for the user

if (isset($_SESSION['user_id'])) {
    if ($_POST['email']==$_SESSION['email']&&$_POST['password']==$_SESSION['password']){
    header("Location: dashboard.php");
    exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // query using prepared statemnet
    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindValue(':email', $email); // binding values
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // store user data in session in case we need to use them
        $_SESSION['id_number'] = $user['id_number'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['flat_house_no'] = $user['flat_house_no'];
        $_SESSION['street'] = $user['street'];
        $_SESSION['city'] = $user['city'];
        $_SESSION['country'] = $user['country'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['date_of_birth'] = $user['date_of_birth'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['qualification'] = $user['qualification'];
        $_SESSION['skills'] = $user['skills'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];

        header("Location: dashboard.php"); // redirect to the dashboard
        exit();

    } else { // wrong email or password
        $_SESSION['errmessage'] = 'Invalid email or password.';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
