</html>
<?php
session_start();
include('header.php');
include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sumbit']) && !empty($_POST['name'])&& !empty($_POST['email'])&& !empty($_POST['message'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $sql = "insert into contact (name, email, message) values (:name, :email, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':message', $message);
    if ($stmt->execute()) {
        $errorMessage = "The Message Sent Successful.";
        $flag = true;
    } else {
        $errorMessage = "Error: " . $stmt->errorInfo()[2];
        $flag = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css" />
    <title>Contact Us</title>
</head>
<body>
    <div class="conant-div">
        <?php
        include('navpage.php');
        ?>
        <main class="conant-main">

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data" class="contant-form">
                <fieldset>
                    <legend class="cont">Contact Us Form</legend>


                    <input type="text" id="name" name="name" placeholder="Name" class="name" required><br><br>


                    <input type="email" id="email" name="email" placeholder="Email" class="email" required><br><br>


                    <textarea id="message" name="message" rows="4" placeholder="Message" class="message" required></textarea><br><br>

                    <input type="submit" value="Submit" name="sumbit" class="submit">
                </fieldset>
            </form>
            
        </main>
    </div>
    <?php if (!empty($errorMessage)) { ?>
                <?php if ($flag) { ?>
                    <p class="success"><?php echo $errorMessage; ?></p>
                <?php } else { ?>
                    <p class="error"><?php echo $errorMessage; ?></p>
                <?php } ?>
            <?php } ?>
</body>

</html>

</html>
<?php

include('footer.php');
?>