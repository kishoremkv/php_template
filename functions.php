<?php 

session_start();

$db = mysqli_connect('localhost','xxx','xxx','ideamagix');
$username ="";
$email = "";
$errors = array();

if(isset($_POST['register_btn']))
{
    register();
}

if(isset($_POST['login_btn']))
{
    login();
}

function register()
{
    global $db,$errors,$username,$email;

    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password_1  =  e($_POST['pass_1']);
    $password_2  =  e($_POST['pass_2']);
    
    if(empty($username))
    {
        array_push($errors,"Username is required");
    }
    if(empty($email))
    {
        array_push($errors,"Email is required");
    }
    if(empty($password_1))
    {
        array_push($errors,"Password is required");
    }
    if($password_1!=$password_2)
    {
        array_push($errors,"The two passwords do not match");
    }

    if(count($errors)==0)
    {
        $password = md5($password_1);

        if(isset($_POST['user_type']))
        {
            $user_type = e($_POST['user_type']);
            $query = "INSERT INTO user_details (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type ', '$password')";
            mysqli_query($db,$query);
            $_SESSION['success'] = "New user successfully created";
            header('location: home.php');
        }
        else
        {
            $query = "INSERT INTO user_details (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			 mysqli_query($db,$query);
            
            $logged_in_user_id = mysqli_insert_id($db);
            $_SESSION['user'] = getUserById($logged_in_user_id);
            $_SESSION['success'] =  "You are now logged in";
            header('location: index.php');
        }
    }
}


function login()
{
    global $db,$username,$errors;

    $username = e($_POST['username']);
    $password = e($_POST['password']);

    if(empty($username))
    {
        array_push($errors, "Username is required");
    }

    if(empty($password))
    {
        array_push($errors,"Password is required");
    }

    if(count($errors)==0)
    {
        $password = md5($password);

        $query = "select * from user_details where username = '$username' and password = '$password' limit 1";
        $results = mysqli_query($db,$query);

        if(mysqli_num_rows($results)==1)
        {
            $logged_in_user = mysqli_fetch_assoc($results);
            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success'] = "You are now logged in";

            if($logged_in_user['user_type']=='admin')
            {
                header('location: admin/home.php');
            }
            else
            {
               header('location:index.php');
            }
        }
        else
        {
            array_push($errors,"Wrong username/password combination");
        }
    }
    
}

function getUserById($id)
{
    global $db;
    $query = "select * from user_details where id = ".$id;
    $result = mysqli_query($db,$query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function e($val)
{
    global $db;
    return mysqli_real_escape_string($db,trim($val));
}


function display_errors()
{
    global $errors;

    if(count($errors)>0)
    {
        echo '<div class = "error">';
        foreach ($errors as $error)
        {
            echo $error.'<br>';
        }
        echo '</div>';
    }
}

function isLoggedIn()
{
    if(isset($_SESSION['user']))
    {
        return true;
    }
    else return false;
}

function isAdmin()
{
    if(isset($_SESSION['user']) && $_SESSION['user']['user_type']=='admin')
        return true;
    else return false;
}



?>
