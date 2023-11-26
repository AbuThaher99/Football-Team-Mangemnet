<?php
session_start();
include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $teamId = $_GET['id'];
    echo $teamId;
    $sql = "delete from team where id = :teamid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':teamid', $teamId);
    $stmt->execute();
    $team = $stmt->fetch(PDO::FETCH_ASSOC);

    
    header("Location: Dashboard.php");
    exit;

 
}


?>