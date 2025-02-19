<?php
require_once 'dp.php.inc';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="confirm.css">
</head>

<body>
    <header>
        <h1>User Profile</h1>
    </header>
    <section id="profile">
        <form method="POST" >
            <label class="confirmInfo">Name: <?php echo $_SESSION['name']; ?></label>

            <label class="confirmInfo">Address:
                <?php echo $_SESSION['flat_house_no'] . ', ' . $_SESSION['street'] . ', ' . $_SESSION['city'] . ', ' . $_SESSION['country']; ?></label>

            <label class="confirmInfo">Date of Birth: <?php echo $_SESSION['date_of_birth']; ?></label>

            <label class="confirmInfo">ID Number: <?php echo $_SESSION['id_number']; ?></label>

            <label class="confirmInfo">Email : <?php echo $_SESSION['email']; ?></label>

            <label class="confirmInfo">Role: <?php echo $_SESSION['role']; ?></label>

            <label class="confirmInfo">Telephone: <?php echo $_SESSION['phone']; ?></label>

            <label class="confirmInfo">Qualification: <?php echo $_SESSION['qualification']; ?></label>

            <label class="confirmInfo">Skills: <?php echo $_SESSION['skills']; ?></label>

            <label class="confirmInfo">Username: <?php echo $_SESSION['username']; ?></label>

        </form>
    </section>
</body>

</html>