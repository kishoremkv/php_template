<?php include('../functions.php'); ?>

<html>
<head>
    <title>Create User</title>
    <link rel = "stylesheet" type = "text/css" href = "../stylesheets/style.css">
    <style>
        .header
        {
            background: #003366
        }
        button[name=register_btn]
        {
            background: #003366;
        }
    </style>
</head>
<body>
        <div class="header">
            <h2>Admin - Create User</h2>
        </div>

        <form method = "post" action = "create_user.php">
            <?php echo display_errors(); ?>

            <div class = "input-group">
                <label>Username</label>
                <input type = "text" name = "username" value = "<?php echo $username;?>">

            </div>
            <div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		        </div>
            <div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="pass_1">
            </div>
            <div class="input-group">
                <label>Confirm password</label>
                <input type="password" name="pass_2">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="register_btn"> + Create user</button>
            </div>
        </form>
</body>
</html>