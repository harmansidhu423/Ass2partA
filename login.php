<?php
$pageTitle = 'Login Here';
require_once ('header.php');
?>


<main class="container">
    <h1>Login</h1>
    <?php
    if (!empty($_GET['invalid']))
        echo '<div class="alert alert-danger" id="message">Invalid user name or password</div>';
    else
        echo '<div class="alert alert-info" id="message">Please log into your account</div>';
    ?>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="email" class="col-sm-1">Email:</label>
            <input name="email" id="email" required type="email" placeholder="Email" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-1">Password:</label>
            <input type="password" name="password" id="password"   required />
        </fieldset>
        <button class="btn btn-success col-sm-offset-1">Login</button>
    </form>
</main>
<?php
require_once ('footer.php');
?>