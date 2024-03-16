<?php
include("config.php");
session_start();

if(isset($_POST['login'])){
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

   
    if(mysqli_num_rows($result) < 1){
        header("location: login.php?notmatch");
        exit(); 
    }
    else{
        
        $row = mysqli_fetch_assoc($result);
        
       
        $_SESSION['un'] = $row['username'];
        $_SESSION['pw'] = $row['password'];
        
    
        header("location: homepage.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 4%;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border: 5px solid #ccc; 
            max-width: 200px; 
            width: 100%; 
            height: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .email,
        .pass {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            
        }
        .btn {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

.btn:hover {
    background-color: #45a049;
}
        input[type="submit"]:hover {
            background-color: #45a049;
        }

        
        
        .fp{
            text-align: right;
            font-size: smaller;
            margin-top: -10px;
            padding-bottom: 20px;
        }
        .Agri {
            color: transparent;
            background: url('https://scontent.fcrk1-2.fna.fbcdn.net/v/t1.15752-9/423542002_1440720523466643_3164275802440292165_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeGhDGxLDM0yVcnfFsPmp3T2Sfn5IslgpdlJ-fkiyWCl2TPMSuL1Ig9oGHarXzH0FzIc4xbZurpXg59qXArpZnam&_nc_ohc=2uGicAWWZsUAX88cvzk&_nc_ht=scontent.fcrk1-2.fna&oh=03_AdR3I-FMjCOqu0nOXugIvUV8-cqJ8otjuWpwptbLA8I3-Q&oe=661A1FDE');
            background-size: contain;
            -webkit-background-clip: text;
            background-clip: text;
        }
        .sup{
            text-align: center;
        }
        p,a{
            padding-top: 5%;
            font-size: small;
        }
    </style>
</head>
<body>

<form method="post">
    <div>
    <h1><span class="Agri">Agri</span>Learn</h1>
    </div>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" required class="email" placeholder="example@gmail.com">
    </div>
    
    <div>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required class="pass" placeholder="********">
    </div>
    <div class="fp">
        <a href="">Forgot Password?</a>
    </div>
    <div>
        <input type="submit" value="Login" class="btn" name="login">
    </div>
    <?php 
                    if(isset($_GET['notmatch'])){ ?>
                    <div style="color: crimson; font-size: small; text-align: center; padding-top: 10%;">
                        Username and Password did not match
                    </div> 
                        
                        <?php
                            }
                ?>

<div class="sup">
        <p> Don't have an account?<a href=""> Sign Up!</a> </p>
    </div>

</form>

<?php
if(isset($_POST['login'])){
    $username = $_POST['email'];
    $password = $_POST['password'];

    $username = sanval($username);

    if($username === false) {
        header("location: login.php?invalidemail");
        exit();
    }

    $passwordValid = valpass($password);

    if(!$passwordValid) {
        header("location: login.php?invalidpass");
        exit();
    }
}

function sanval($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return false;
    }
}

function valpass($password) {
    if (strlen($password) >= 8 && strlen($password) <= 20) {
        return true;
    } else {
        return false;
    }
}
?>



</body>
</html>
