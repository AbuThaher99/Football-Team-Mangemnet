<?php
session_start();
include('header.php');

include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <link rel="stylesheet" href="teamdetiles.css" />
    <title>Team Details</title>

</head>

<body>
    <body class="bof">
        <div class="container">
            <div class="nav">
                <?php include('navpage.php'); ?>
            </div>
            <main class="main">
                <div class="team-div">

                    <?php

                    if (isset($_GET['id'])) {
                        $teamId = $_GET['id'];


                        $sql = "select * from team where id = :teamid";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':teamid', $teamId);
                        $stmt->execute();
                        $team = $stmt->fetch(PDO::FETCH_ASSOC);
                        if (count($team) > 0) {
                            echo "<h2>" . $team['teamName'] . "</h2>";

                            echo "<p>Team Name: " . "<em>" . $team['teamName'] . "</em>" . "</p>";
                            echo "<p>Team Level: " . $team['teamLevel'] . "</p>";
                            echo "<p>Game Day: " . $team['gameday'] . "</p>";

                            $sql = "select * from players where team_id = :teamid";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':teamid', $teamId);
                            $stmt->execute();
                            $players = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($players) > 0) {
                                echo "<strong>Players :</strong>";

                                foreach ($players as $player) {

                                    echo "<p>" . $player['Name'] . "</p>";
                                }
                            } else {
                                echo "<p>No players in this team.</p>";
                            }
                        } else {
                            echo "<p>Team not found.</p>";
                        }
                    } else {
                        echo "<p>Invalid team ID.</p>";
                    }
                    ?>



                </div>
            </main>
        </div>



    </body>

</html>

</html>
<?php

include('footer.php');
?>