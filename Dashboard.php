<?php
session_start();
include('header.php');
include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}

if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="dashboard.css" rel="stylesheet" />


    <title>Dashboard</title>


</head>

<body class="n">
    <div class="m">
        <?php

        include('navpage.php');

        ?>
        <main class="main">

            <?php
            $sql = "SELECT * FROM team";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($teams) > 0) {
                echo "<table border=1 class='styled-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Team Name</th>";
                echo "<th>Team Level</th>";
                echo "<th>Game Day</th>";
                echo "<th>Number of Players</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($teams as $team) {
                    $teamid = $team['id'];
                    $sql = "select count(*) from players where team_id =:teamid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':teamid', $teamid);
                    $stmt->execute();
                    $count = $stmt->fetchColumn();

                    echo "<tr>";
                    echo "<td><a href='TeamDetiles.php?id={$team['id']}'>{$team['teamName']}</a></td>";
                    echo "<td>" . $team['teamLevel'] . "</td>";
                    echo "<td>" . $team['gameday'] . "</td>";
                    echo "<td>" . $count . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No teams found.</p>";
            }
            ?>
            <br>
        </main>
    </div>
    <form action=createform.php method="post">
        <input type="submit" name="create" value="Create New Team" id="create" class="create">
    </form>

</body>

</html>
<?php

include('footer.php');
?>