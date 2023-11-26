<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="header.css" />
</head>
<body>
    <header >
        <div class="logo">
            <img src="./im/cr7.jpg" alt="Logo" class="im">
        </div>
        
        <div class="app-name">
            <h1 class="it">IT Teams</h1>
        </div>
        
        <nav >
            <ul>
              
                <li  ><a href="about.php">About Us</a></li>
                <li>
                    <a href="profile.html">My Profile</a>
                </li>
                <li>
                    <?php
                
                    if (!empty($_SESSION['id'])) {
                        $userName = $_SESSION['username'];
                       
                        ?>
                        <div class="user-account">
                            <span>Welcome, <?php echo $userName; ?></span>
                            
                        </div>
                        <?php
                    } else {
                        ?>
                        <a href="regform.php">Log In</a>
                        <?php
                    }
                    ?>
                </li>
                <li>
                 
                    <?php
                    if (!empty($_SESSION['id'])) {
                        ?>

                <img src="./im/user.png" alt="User Photo" class="user">
                        <?php
                    }
                    ?>
                </li>
                <li><a href="logout.php">Log Out</a></li>
              
            </ul>
        </nav>
    </header>
