<?php
include('registration.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css" />

    <title> Registration</title>


</head>

<body>
<h1>Welcome</h1>
<?php if (!empty($errorMessage)) { ?>
        <?php if ($flag) { ?>
            <p class="success"><?php echo $errorMessage; ?></p>
        <?php } else { ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php } ?>
    <?php } ?>
    <main class="main">
    
        <div class="form-container">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data" class="re-form">
                <fieldset class="fil">
                    <legend class="reg">Registration Form</legend>

                    <input type="text" name="username" id="username" class="username" placeholder="Username" required>
                    <br>
                    <input type="email" name="email" id="email" class="email" placeholder="Email" required>
                    <br>
                    <input type="password" name="password" id="password" class="password" placeholder="Password" minlength="8" required>
                    <br>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="Re-Password" placeholder="Confirm Password" required>
                    <br>

                    <input type="submit" name="registration" value="Sign Up" id="registration" class="registration">

                </fieldset>
            </form>


            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data " class="login-form">
                <fieldset>
                    <legend class="Login">Login Form</legend>
                    <input type="email" name="email-login" id="email-login" class="email" placeholder="Email" required>
                    <br>
                    <input type="password" name="password-login" id="password-login" class="password" placeholder="Password" required>
                    <br>
                    <input type="submit" name="login" value="Login" id="login" class="login">
                </fieldset>
            </form>
        </div>
    </main>
    
</body>

</html>
