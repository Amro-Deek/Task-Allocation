<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm and Submission</title>
    <link rel="stylesheet" href="sign.css">
</head>

<body>
    <header>
        <h1>Set Your Username and Password</h1>
    </header>
    <section id="submitAndConfirm">
        <form method="post" action="step2.php">
            <input type="text" name="username" id="username" required placeholder="user name">
            <input type="password" name="password" id="password" required placeholder="password">
            <input type="password" name="confirmPassword" id="confirmPassword" required placeholder="confirm password">
            <input type="submit" class="confirm" value="Confirm and Submit" name="confirm"></button>
        </form>
    </section>
    <?php if (isset($_SESSION['errmessage'])): ?>
        <p class="errormsg"><?= $_SESSION['errmessage'] ?></p>
        <?php unset($_SESSION['errmessage']); ?>
    <?php endif; ?>
</body>

</html>