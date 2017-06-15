<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
</head>
<body>
<?php
if (!empty($_GET['user_id']) ) {
    $user_id = $_GET['user_id'];
    //Step 1 - connect to the database
    require('db.php');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // turn on the error handling
    //Step 2 - create the SQL statement
    $sql = "DELETE FROM users
                WHERE user_id = :user_id";
    //Step 3 - prepare and execute the sql statement
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $cmd->execute();
    //Step 4 - disconnect from the DB
    $conn = null;
}
//step 5 - redirect back to the albums.php page
header('location:registeredUsers.php');
?>
</body>
</html>
