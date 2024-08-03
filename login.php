<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Check if the user is an admin
            header('Location: index.php');
            exit;
    }
    include "config.php";
    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($result) === 1){
            $data = mysqli_fetch_assoc($result);
            if(password_verify($password, $data['password'])){
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = $data['Role'];
                header('Location" index.php');
                exit;
            }else{
                echo"<script>
                alert('Password Salah!');
                </script>";
            }
        }else{
            echo"<script>
            alert('Akun tidak ditemukan!');
            </script>";
        }
    }
    if(isset($_POST['signUp'])){
        header('Location: registration.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/index.css">
    <style>
        body{ font: 14px sans-serif; }
    </style>
</head>
<body class="main">
    <div class="wrapper2">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form class="login" action="" method="post">
            <div class="form-group">
                <label>Username</label><br>
                <input type="text" name="username" class="form-control">
            </div>    
            <div class="form-group">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="submit_button" value="Login" name="login">
            </div>
            <span id="error"style="display: none;">Akun tidak ditemukan</span>
        
        
    </div>
    <div class="wrapper">
        <h2>Want to connect?</h2>
        <hr>
        <p>Don't have an account? <a href="registration.php">Sign up now</a>.</p>
        <div class="form-group">
                <input type="submit" class="submit_button" value="Sign Up" name="signUp">
        </div>
    </div>
    </form>
</body>
</html>