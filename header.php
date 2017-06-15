<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.min.css"
    <!-- Optional theme -->
    <link rel="stylesheet" href=CSS/bootstrap-theme.min.css
</head>
<body>

<nav class="nav navbar-inverse">
    <ul class=" nav navbar-nav">
        <li><a href="default.php" class="navbar-brand"><img src="thumbs-up-emoji.png" alt="emojii" height="50" width="45" /></a></li>

        <?php
        //public links

        session_start();
        if (empty($_SESSION['email']))
        {

            echo'<li><a href="registration.php">Register</a></li>
       <li><a href="login.php">Login</a></li>';
        }



        else{
        //private links / logged links
            echo ' <li><a href="registeredUsers.php">Users</a></li>
        <li><a href="logout.php">Logout</a></li>';
        }

        ?>



    </ul>
</nav>

