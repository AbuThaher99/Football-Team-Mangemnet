<?php
session_start();
include('header.php');

include('db.php');
$pdo = db_connect();

if (!$pdo) {
    error_message(sql_error());
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $teamId = $_GET['id'];
    $sql = "select * from team where id = :teamid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':teamid', $teamId);
    $stmt->execute();
    $team = $stmt->fetch(PDO::FETCH_ASSOC);

    $teamname = $team['teamName'];
    $teamlevel = $team['teamLevel'];
    $gameday = $team['gameday'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $teamName= $_POST['teamName'];
    $teamLevel = $_POST['teamLevel'];
    $gameDay = $_POST['gameDay'];
    $sql = "update team set teamName = :teamname, teamLevel = :teamlevel, gameday = :gameday WHERE id = :teamid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':teamname', $teamName);
    $stmt->bindValue(':teamlevel', $teamLevel);
    $stmt->bindValue(':gameday', $gameDay);
    $stmt->bindValue(':teamid', $teamId);
    if ($stmt->execute()) {
        $Message = "The Team Edited Successful.";
        $teamname = $_POST['teamName'];
        $teamlevel = $_POST['teamLevel'];
        $gameday =  $_POST['gameDay'];

        $flag = true;
    } else {
        $Message = "Error: " . $stmt->errorInfo()[2];
        $flag = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css" />


    <title>Edit Team</title>
</head>

<body>

    <div class="divEdit">

        <?php
        include('navpage.php');

        ?>
        <main class="main">

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data" class="EditForm">
                <fieldset>
                    <legend class="editTeam">Edit Team Form</legend>
                    <input type="text" name="teamName" id="teamname" class="teamname" placeholder="Team Name" value="<?php echo $teamname ?>" required>
                    <br>
                    <input type="number" name="teamLevel" id="teamlevel" class="teamlevel" placeholder="Team Level (1-5)" value="<?php echo $teamlevel ?>" min=1 max=5 required>
                    <br>
                    <select name="gameDay" id="gameday" class="gameday" required>
                        <option value="">Select a Day</option>
                        <option value="Monday" <?php if ($gameday === 'Monday') echo 'selected'; ?>>Monday</option>
                        <option value="Tuesday" <?php if ($gameday === 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                        <option value="Wednesday" <?php if ($gameday === 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                        <option value="Thursday" <?php if ($gameday === 'Thursday') echo 'selected'; ?>>Thursday</option>
                        <option value="Friday" <?php if ($gameday === 'Friday') echo 'selected'; ?>>Friday</option>
                        <option value="Saturday" <?php if ($gameday === 'Saturday') echo 'selected'; ?>>Saturday</option>
                        <option value="Sunday" <?php if ($gameday === 'Sunday') echo 'selected'; ?>>Sunday</option>
                    </select>

                    <br>
                    <input type="submit" name="edit" value="Edit" id="edit" class="edit">
                </fieldset>
            </form>
        </main>
    </div>
    <p><a href="deleteteam.php?id=<?php echo $teamId; ?>">Delete Team</a></p>
    <?php if (!empty($Message)) { ?>
        <?php if ($flag == true) { ?>
            <p class="mn"><?php echo $Message; ?></p>
        <?php } else if ($flag == false) { ?>
            <p class="moha"><?php echo $Message; ?></p>
        <?php } ?>
    <?php } ?>

</body>

</html>

</html>
<?php

include('footer.php');
?>