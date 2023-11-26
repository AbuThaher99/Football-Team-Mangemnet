<?php
session_start();
include('header.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="about.css" />
    <title>About Us</title>
</head>

<body>
    <div class="about-div">
        <?php
        include('navpage.php');
        ?>
        <main class="about-main">
            <form class="about-form">

                <h1>About Us</h1>
                <p>
                    At our college, we are fortunate to have a team of skilled programmers who have developed this website to revolutionize the way we manage teams and facilitate student collaboration. The dedicated programmers behind this platform understand the challenges faced by both the college administration and the students. Their goal was to create a user-friendly interface that empowers the college staff to efficiently handle team-related tasks.
                </p>
                <p>
                    With this website, the college can seamlessly add new teams, delete unnecessary ones, and make necessary edits to team information. The intuitive design and functionality enable staff members to streamline these administrative processes, saving time and effort.
                </p>
                <p>
                    Moreover, the programmers went the extra mile to ensure that the website benefits all students. By incorporating a comprehensive team review system, they have provided a platform for students to assess and evaluate each team's performance. This feature fosters a collaborative environment and encourages students to learn from one another, strengthening their teamwork and critical thinking skills.
                </p>
                <p>
                    The programmers' dedication to improving the college experience for both staff and students is evident in every aspect of this website. They have harnessed their technical expertise to develop a reliable and efficient tool that enhances team management and encourages active engagement among students.
                </p>
            </form>
        </main>
    </div>
</body>

</html>
<?php

include('footer.php');
?>