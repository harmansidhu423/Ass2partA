<?php
$pageTitle = 'Registration';
require_once('header.php');
?>

    <main class="container">
        <h1>User Registration</h1>

        <?php
        //check the URL for an car_D to determine if this is a new or edit album
        if (!empty($_GET['user_id']))
            $user_id = $_GET['user_id'];
        else
            $user_id = null;
        $username = null;
        $email = null;
        $password = null;
        $confirm = null;
        //to decide if the file is an edit, we look at the user_id
        if (!empty($user_id))
        {
            //Step 1 connect to the DB
            $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200358428', 'gc200358428', 'j5SmXe7bDI' );
            //Step 2 create the SQL query
            $sql = "SELECT * FROM users WHERE user_id = :user_id";
            //Step 3 prepare and execute the SQL
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            //Step 4 update the variables
            $cmd->execute();
            $users = $cmd->fetch();
            $conn=null;
            $username = $users['username'];
            $email = $users['email'];
            $password = $users['password'];
            //Step 5 close the DB connection

        }
        ?>

        <?php
        if (!empty($_GET['errorMessage']))
            echo '<div class="alert alert-danger" id="message">Email address already exists</div>';
        else
            echo '<div class="alert alert-info" id="message">Please create your account</div>';
        ?>

        <form method="post" action="saveRegistration.php">
            <fieldset class="form-group">
                <label for="email" class="col-sm-2">Email: *</label>
                <input name="email" id="email" type="email" required
                       placeholder="email@email.com"
                       value="<?php echo $email ?>"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="username" class="col-sm-2">User Name: </label>
                <input name="username" id="username" placeholder="your name"
                       value="<?php echo $username ?>"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-2">Password: </label>
                <input name="password" id="password" type="password" placeholder="Password"
                       value="<?php echo $password ?>"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirm" class="col-sm-2">Re-enter Password: </label>
                <input name="confirm" id="confirm" type="password" placeholder="Confirm Password"
                       value="<?php echo $confirm ?>"/>
            </fieldset>
          <input name="user_id" id="user_id" value="<?php echo$user_id ?>" type="hidden"/>
            <button class="btn btn-success col-sm-offset-2">Register</button>
        </form>
    </main>
    </body>

<?php require_once('footer.php') ?>