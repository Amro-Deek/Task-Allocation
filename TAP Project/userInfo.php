<?php
session_start();
require_once 'dp.php.inc';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signUp'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $houseNumber = $_POST['flatNo'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $dateOfBirth = $_POST['dob'];
    $idNumber = $_POST['idNumber'];
    $telephone = $_POST['telephone'];
    $role = $_POST['role'];
    $qualification = $_POST['qualification'];
    $skills = $_POST['skills'];

    // Validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($houseNumber) || empty($street) || empty($city) || empty($country) || empty($dateOfBirth) || empty($idNumber) || empty($telephone) || empty($role) || empty($qualification) || empty($skills)) {
        echo "All fields are required!";
        exit();
    }

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    //binding parameters
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['errmessage'] = "Email Address Already Exists!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Check if id exists
        $sql2 = "SELECT * FROM users WHERE id_number=:id";
        $stmt2 = $pdo->prepare($sql2);
        //binding parameters
        $stmt2->bindValue(':id', $idNumber);
        $stmt2->execute();
        $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        if ($user2) {
            $_SESSION['errmessage'] = "ID Number Already Exists!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        // Store form data temporarily in the session

        $_SESSION['user_data_before_confirm'] = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'houseNumber' => $houseNumber,
            'street' => $street,
            'city' => $city,
            'country' => $country,
            'dateOfBirth' => $dateOfBirth,
            'idNumber' => $idNumber,
            'telephone' => $telephone,
            'role' => $role,
            'qualification' => $qualification,
            'skills' => $skills
        ];
        // Redirect to confirmAndSubmission.html
        header("Location: E-AccountCreation.php");
        exit();
    }
}
?>