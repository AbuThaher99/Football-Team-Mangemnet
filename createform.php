<?php
include('createTeam.php');

include('header.php');

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
    <link rel="stylesheet" href="create.css" />

    <title>New Team</title>
</head>

<body>
    <div class="creatediv">
        <?php

        include('navpage.php');

        ?>
        <main class="main">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data" class="creteform">
                <fieldset>
                    <legend class="newTeam">New Team Form</legend>
                    <input type="text" name="teamname" id="teamname" class="teamname" placeholder="Team Name" required>
                    <br>

                    <input type="number" name="teamlevel" id="teamlevel" class="teamlevel" placeholder="Team Level (1-5) " min=1 max=5 required>
                    <br>
                    <select name="gameDay" id="gameday" class="gameday" required>
                        <option value="">Select a Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    <br>

                    <input type="submit" name="create" value="Create" id="create" class="create">
                </fieldset>

            </form>
        </main>
    </div>
    <?php if (!empty($Message)) { ?>
        <?php if ($flag==TRUE) { ?>
            <p class="success"><?php echo $Message; ?></p>
        <?php } else if($flag==false) { ?>
            <p class="error"><?php echo $Message; ?></p>
        <?php } ?>
    <?php } ?>
</body>

</html>

</html>
<?php

include('footer.php');
?>