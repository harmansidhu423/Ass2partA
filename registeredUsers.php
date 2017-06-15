<?php
$pageTitle = 'Users';
require_once('header.php');
?>

<?php
//step 1 - connect to the database
require_once ('db.php');
//step 2 - create a SQL command
$sql = "SELECT * FROM users";
//step 3 - prepare the SQL command
$cmd = $conn->prepare($sql);
//step 4 - execute and store the results
$cmd->execute();
$users = $cmd->fetchAll();
//step 5 - disconnect from the DB
$conn = null;
//create a table and display the results
echo '<table class="table table-striped table-hover">
            <tr><th>email</th>
                <th>user Name</th>';

if(!empty($_SESSION['email'])) {


    echo '<th>Edit</th>
                <th>Delete</th></tr>';

}
foreach($users as $user)
{
    echo '<tr><td>'.$user['email'].'</td>
                      <td>'.$user['username'].'</td>';


    if(!empty($_SESSION['email'])){
        echo    ' <td><a href="registration.php?user_id='.$user['user_id'].'"
                                class="btn btn-primary">Edit</a></td>
                      <td><a href="delete.php?user_id='.$user['user_id'].'" 
                                class="btn btn-danger confirmation">Delete</a></td>';
    }


    echo     ' </tr>';
}
echo '</table>';
?>




<?php require_once('footer.php') ?>
