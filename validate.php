
<?php
$email = $_POST['email'];
$password = $_POST['password'];

// connect to the db
require('db.php');


// build the sql command
$sql = "SELECT * FROM users WHERE email = :email";

// bind the parameters
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
$cmd->execute();
$user = $cmd->fetch();


//  validate the user
if(password_verify($password, $user['password'])){
    //we have a valid password
    session_start();
    $_SESSION['email'] = $user['email'];
    $_SESSION['userName'] = $user['userName'];
    header ('location:registeredUsers.php');

}
else{
    //user was not found or did not have a valid password
    header('location:login.php?invalid=true');
    exit();
}
//disconnect from the db
$conn=null;


?>

