<?php
session_start();
include('header.php');





include('db.php');

$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}
if (!isset($_SESSION['id'])) {
    $teamId = $_GET['id'];
    header("Location: teaminfo.php?id=" . $teamId);
    exit;
}

if (isset($_GET['id'])) {
    $teamId = $_GET['id'];

    if (!empty($_SESSION['id'])) {
        $userids = $_SESSION['id'];
        $sql = "select * from team where id = :teamid AND userid = :userid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':teamid', $teamId);
        $stmt->bindValue(':userid', $userids);
        $stmt->execute();
        $team = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$team) {

            header("Location: teaminfo.php?id=" . $teamId);
            exit;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
        $sql = "select count(*) from players where team_id = :teamid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':teamid', $teamId);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count >= 11) {
            $errorMessage = "You cannot add more than 11 players to a team.";
            $flag = false;
        } else {
            $player = $_POST['player'];
            $sql = "insert into players (Name, team_id) values (:player, :teamid)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':player', $player);
            $stmt->bindValue(':teamid', $teamId);
            if ($stmt->execute()) {
                $errorMessage = "The Player Added Successful.";
                $flag = true;
            } else {
                $errorMessage = "Error: " . $stmt->errorInfo()[2];
                $flag = false;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teamdetiles.css" />

    <title>Team Details</title>

</head>

<body>
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
                        echo "<h2>" . $team['teamName'] . "</h2> ";

                        echo "<p>Team Name: " . "<em>" . $team['teamName'] . "</em>" . "</p> ";
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



                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data" class="teamDit">
                    <fieldset>
                        <legend class="newTeam">Add Player Form</legend>

                        <input type="text" name="player" id="player" class="player" placeholder="Add Player" required>
                        <br>
                        <input type="submit" name="add" value="Add" id="add" class="add">
                    </fieldset>
                </form>
                <br>

            </div>
        </main>
    </div>

    <?php if (!empty($errorMessage)) { ?>
        <?php if ($flag == true) { ?>
            <p class="su"><?php echo $errorMessage; ?></p>
        <?php } else if ($flag == false) { ?>
            <p class="err"><?php echo $errorMessage; ?></p>
        <?php } ?>
    <?php } ?>
    <p><a href="editform.php?id=<?php echo $teamId; ?>">Edit</a></p>
    <p><a href="deleteteam.php?id=<?php echo $teamId; ?>">Delete</a></p>
</body>

</html>

</html>
<?php

include('footer.php');
?>