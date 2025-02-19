<?php
require_once 'dp.php.inc';
session_start();
$tempData = $_SESSION['user_data_before_confirm'];
$fullName = $tempData['firstName'] . ' ' . $tempData['lastName'];
// insert user data to the database
$insertQuery = "INSERT INTO users (name, email, password, flat_house_no, street, city, country, date_of_birth, id_number, phone, role, qualification, skills, username) 
VALUES (:name, :email, :password, :houseNumber, :street, :city, :country, :dateOfBirth, :idNumber, :telephone, :role, :qualification, :skills, :username)";
$stmt = $pdo->prepare($insertQuery);

// Bind parameters
$stmt->bindValue(':name', $fullName);
$stmt->bindValue(':email', $tempData['email']);
$stmt->bindValue(':password', $_SESSION['password']);
$stmt->bindValue(':houseNumber', $tempData['houseNumber']);
$stmt->bindValue(':street', $tempData['street']);
$stmt->bindValue(':city', $tempData['city']);
$stmt->bindValue(':country', $tempData['country']);
$stmt->bindValue(':dateOfBirth', $tempData['dateOfBirth']);
$stmt->bindValue(':idNumber', $tempData['idNumber']);
$stmt->bindValue(':telephone', $tempData['telephone']);
$stmt->bindValue(':role', $tempData['role']);
$stmt->bindValue(':qualification', $tempData['qualification']);
$stmt->bindValue(':skills', $tempData['skills']);
$stmt->bindValue(':username', $_SESSION['username']);

$stmt->execute();

$sql = "SELECT * FROM users WHERE email = :email";
$stmt3 = $pdo->prepare($sql);
$stmt3->bindValue(':email', $tempData['email']);
$stmt3->execute();
$user = $stmt3->fetch();
$_SESSION['user_id']= $user['user_id'];

// Clear session data after successful confirmation
unset($_SESSION['user_data_before_confirm']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="confirm.css">
</head>

<body>
    <header>
        <h1>
        <?php if ($user): ?>
            <?php echo "Your User ID is: " . $user['user_id']; ?>
        <?php endif; ?>
        </h1>
    </header>
    <a href="signIn.php">Login to your account</a>

</body>

</html>