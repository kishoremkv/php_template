<?php include('functions.php') ?>

<html>
    <head>
        <title>Sign Up</title>
        <link rel = "stylesheet" href = "stylesheets/style.css">
    </head>
    <body>
        <div class = "header">
            <h2>Register</h2>
        </div>
        <form method = "POST" action = "register.php">
            <?php echo display_errors();?>
            <div class = "input-group">
                <label>Username</label>
                <input type = "text" name = "username" value = "<?php echo $username;?>">
            </div>

            <div class = "input-group">
                <label>Email</label>
                <input type = "email" name = "email" value = "<?php echo $email; ?>">
            </div>

            <div class = "input-group">
                <label>Password</label>
                <input type = "password" name = "pass_1">
            </div>

            <div class = "input-group">
                <label>Confirm password</label>
                <input type = "password" name = "pass_2">
            </div>

            <div class = "input-group">
                <button type = "submit" class = "btn" name = "register_btn">Sign Up</button>
            </div>

            <p>
                Already a member? <a href= "login.php">Sign in</a>
            </p>

        </form>
    </body>
</html>