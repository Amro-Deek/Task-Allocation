<?php
require_once 'dp.php.inc';
session_start();
$tempData = $_SESSION['user_data_before_confirm']; // get data from session
$fullName = $tempData['firstName'] . ' ' . $tempData['lastName']; // concatinate first and last name to store it in one name
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Your Info</title>
    <link rel="stylesheet" href="confirm.css">
</head>

<body>
    <header>
        <h1>Press Confirm to Have an account with below Data.</h1>
    </header>
    <section id="confirm">
        <form method="POST" action="saveUser.php">
            <label class="confirmInfo">Name: <?php echo $fullName; ?></label>

            <label class="confirmInfo">Address:
                <?php echo $tempData['houseNumber'] . ', ' . $tempData['street'] . ', ' . $tempData['city'] . ', ' . $tempData['country']; ?></label>

            <label class="confirmInfo">Date of Birth: <?php echo $tempData['dateOfBirth']; ?></label>

            <label class="confirmInfo">ID Number: <?php echo $tempData['idNumber']; ?></label>

            <label class="confirmInfo">Email : <?php echo $tempData['email']; ?></label>

            <label class="confirmInfo">Role: <?php echo $tempData['role']; ?></label>

            <label class="confirmInfo">Telephone: <?php echo $tempData['telephone']; ?></label>

            <label class="confirmInfo">Qualification: <?php echo $tempData['qualification']; ?></label>

            <label class="confirmInfo">Skills: <?php echo $tempData['skills']; ?></label>

            <label class="confirmInfo">Username: <?php echo $_SESSION['username']; ?></label>

            <input type="submit" class="confirm" value="Confirm" name="confirm">
        </form>
    </section>
</body>

</html>