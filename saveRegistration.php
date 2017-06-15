<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registering User</title>
</head>
<body>
<?php
$user_id= $_POST['user_id'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$username = $_POST['username'];
$ok = true;
//check if the passwords match

if ($password != $confirm)
{
    echo 'The passwords do not match <br />';
    $ok = false;
}
if (strlen($password) < 8)
{
    echo 'The password is too short, must be 8 or more characters
                        <br />';
    $ok = false;
}
if (empty($email))
{
    echo 'You must enter an email address <br />';
    $ok = false;
}
//if the email and password are ok
if ($ok) {
    //connect to the DB and setup the new user
    //Step 1 - connect to the DB
    require_once('db.php');
    //Step 2 - create the SQL command
    if (!empty($user_id)) {
        $sql = "UPDATE users  
                   SET email = :email,
                       username = :username,
                       password = :password
                       WHERE user_id = :user_id";
    } else {

        $sql = "INSERT INTO users (email, username,password)
VALUES (:email, :username, :password)";
    }
    // hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //Step 3 - prepare and execute the SQL
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    if (!empty($user_id))
        $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    try {
        $cmd->execute();

    } catch (Exception $e) {
        if (strpos($e->getMessage(),
                'Integrity constraint violation: 1062') == true
        ) {
            header('location:registration.php?errorMessage=email-already-exists');
            $conn = null;
            exit;
        }
    }
    //Step 4 - disconnect from the DB
    $conn = null;
    //Step 5 - redirect to the login page

    if (!empty($user_id)) {

        header('location:registeredUsers.php');

    } else {
        header('location:login.php');

    }
}
?>
</body>
</html>