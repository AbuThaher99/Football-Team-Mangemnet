<?php
session_start();
include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && !empty($_POST['teamname'])) {

    $teamname = $_POST['teamname'];
    $teamlevel = $_POST['teamlevel'];
    $gameday = $_POST['gameDay'];
    $email = $_SESSION['email'];
    $flag = false;

    $sql1 = "select teamName from team where teamName = :teamname";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindValue(':teamname', $teamname);
    
    if ($stmt1->execute() && $stmt1->rowCount() > 0) {
        $flag = false;
        $Message = "Team Name already exists";
        
        
    }else{

    $sql = "select id from users where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userid = $row['id'];

    $sql = "insert into team (teamName, teamLevel, gameday, userid) values (:teamname, :teamlevel, :gameday, :userid)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':teamname', $teamname);
    $stmt->bindValue(':teamlevel', $teamlevel);
    $stmt->bindValue(':gameday', $gameday);
    $stmt->bindValue(':userid', $userid);
    if ($stmt->execute()) {
        $Message = "Team Created Successfully";
        $flag = true;
    } else {
        $Message = "Error: " . $stmt->errorInfo()[2];
        $flag = false;
    }
}
}
