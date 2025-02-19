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
        <h1>Sign Up <br> <small>Fill the Form please.</small> </h1>

    </header>
    <?php if (isset($_SESSION['errmessage'])): ?>
        <p class="errormsg"><?= $_SESSION['errmessage'] ?></p>
        <?php unset($_SESSION['errmessage']); ?>
    <?php endif; ?>

    <section id="signup">

        <form method="post" action="userInfo.php">
            <input type="text" name="fName" id="fName" placeholder="First Name" required>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <input type="email" name="email" id="email" placeholder="Email" required>

            <!-- Address -->
            <input type="text" name="flatNo" id="flatNo" placeholder="Flat/House No" required>
            <input type="text" name="street" id="street" placeholder="Street" required>
            <input type="text" name="city" id="city" placeholder="City" required>
            <input type="text" name="country" id="country" placeholder="Country" required>

            <!-- DOB with validation -->
            <input type="date" name="dob" id="dob" required placeholder="Data Of Birth" max="<?= date('Y-m-d'); ?>">

            
            <input type="text" name="idNumber" id="idNumber" placeholder="ID Number" pattern="\d+"
                title="ID Number must be numeric" required>

            
            <input type="tel" name="telephone" id="telephone" placeholder="Phone Number" required required pattern="\d+"
                title="Telephone Number must be numeric">

            <!-- Role -->
            <select name="role" id="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Manager">Manager</option>
                <option value="Project Leader">Project Leader</option>
                <option value="Team Member">Team Member</option>
            </select>

            
            <input type="text" name="qualification" id="qualification" placeholder="Qualification" required>

            <textarea name="skills" id="skills" placeholder="Skills (comma separated)" required></textarea>

            <input type="submit" class="signUp" value="Proceed" name="signUp">
        </form>
        <form method="post" action="signIn.php">
            <p>Already Have Account?</p>
            <button id="signInButton">Sign In</button>
        </form>
    </section>
</body>
</html>