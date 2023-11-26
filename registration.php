<?php

session_start();

if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['username']) && isset($_SESSION['id'])){
    header("Location: Dashboard.php");
    exit();
}

include('db.php');
$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usernaem = $_POST['username'];
    $flag = false;
    $confirmPassword = $_POST['confirmPassword'];
    $sql = "select * from users where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match! Please enter the same password in both fields.";
        $flag = false;
    } else {
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $errorMessage = "Email already exists! Please choose a different email.";
            $flag = false;
        } else {
            $sql = "insert into users (email, password ,username) values (:email, :password, :username)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':username', $usernaem);

            if ($stmt->execute()) {
                $errorMessage = "Registration successful! Please login.";
                $flag = true;
            } else {
                $errorMessage = "Error: " . $stmt->errorInfo()[2];
            }
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

    $email = $_POST['email-login'];
    $password = $_POST['password-login'];

    $flag = false;
    $sql = "select * from users where email = :email AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $sql = "select username, id from users where email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $username = $row['username'];
        $id = $row['id'];
        $flag = true;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;


        header("Location: Dashboard.php");
    } else {
        $errorMessage = "Invalid email or password!";
        $flag = false;
    }
}
