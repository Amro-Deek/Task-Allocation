<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="sign.css">
</head>

<body>
    <header>
        <h1>Sign In</h1>
    </header>
    <section id="signIn">
        <form method="post" action="checkSignIn.php" >
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="submit" class="signIn" value="Sign In" name="signIn">
        </form>
        <form method="post" action="signUp.php">
            <p>Don't have account yet?</p>
            <button id="signUpButton">Sign Up</button>
        </form>
    </section>
    <?php if (isset($_SESSION['errmessage'])): ?>
        <p class="errormsg"><?= $_SESSION['errmessage'] ?></p>
        <?php unset($_SESSION['errmessage']); ?>
    <?php endif; ?>
</body>
</html>
