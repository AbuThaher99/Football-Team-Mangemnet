<?php
session_start();
include('header.php');
include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}
if (!isset($_SESSION['id'])) {
    header("Location: Dashboard.php");
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editnav.css" />
    <title>Edit Page</title>
</head>

<body>
    <div class="edit-div">
        <?php
        include('navpage.php');

        ?>
        <maim class="edit-main">
            <?php
            if (isset($_SESSION['id'])) {
                $userId = $_SESSION['id'];
                $sql = "select * from team where userid = :userid";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':userid', $userId);
                $stmt->execute();
                $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($teams) > 0) {
                    echo "<table class='styled-table' border=1>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>Team Name</th>";
                    echo "<th scope='col'>Team Level</th>";
                    echo "<th scope='col'>Game Day</th>";
                    echo "<th scope='col'>Action</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($teams as $team) {
                        echo "<tr>";
                        echo "<td>" . $team['teamName'] . "</td>";
                        echo "<td>" . $team['teamLevel'] . "</td>";
                        echo "<td>" . $team['gameday'] . "</td>";
                        echo "<td>";

                        echo "<a href='editform.php?id=" . $team['id'] . "' class='btn btn-success'>Edit</a>";

                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<h2 class='erer'>You have not created any teams yet.</h2>";
                }
            }

            ?>
        </maim>
    </div>
</body>
</html>
<?php

include('footer.php');

?>