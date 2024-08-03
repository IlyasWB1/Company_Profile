<?php
    include "config.php";
    session_start();
    $_SESSION = array();
    session_destroy();
    $username = $password = $confirm_password = $param_role = $param_email = "";
    $username_err = $password_err = $confirm_password_err = "";
    if(isset($_POST['submit'])){
            $username = strtolower(stripslashes($_POST['username']));
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
            $param_role =  mysqli_real_escape_string($conn, strtolower($_POST['role']));
            $param_email =  mysqli_real_escape_string($conn,$_POST['email']);
            $param_company =  mysqli_real_escape_string($conn,$_POST['perusahaan']);
            if(empty($username)){
                echo"
                <script>
                    alert('Username kosong');
                </script>
                ";
                exit;
            }
            if(empty($password)){
                echo"
                <script>
                    alert('Password kosong');
                </script>
                ";
                exit;
            }
            if(empty($confirm_password)){
                $confirm_password_err = "Please enter a password.";
                header('Location: registration.php');
                exit;
            }

            if($password !== $confirm_password){
                echo"
                <script>alert('Password tidak sesuai')</script>'
                ";
                exit;
            }

            $sql = "SELECT id FROM users WHERE username = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
        
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
        
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        $username_err = "This username is already taken.";
                        header('Location: registration.php');
                        exit;
                    } else {
                        // Username is available
                        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        
                        $sql = "INSERT INTO users (username,CompanyID,password, role, email) VALUES (?, ?, ?, ?, ?)";
                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_company,$param_password, $param_role, $param_email);
                            $param_username = $username;
                            $param_password = $password_hashed;
        
                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>alert('User successfully added')</script>";
                                if($param_role === 'admin'){
                                    $_SESSION['role'] ='admin';
                                    header('Location: login.php');
                                }else{
                                    $_SESSION['role'] = 'guest';
                                    header('Location: login.php');
                                }
                                header('Location: login.php');
                                exit;
                            } else {
                                echo "<script>alert('Something went wrong. Please try again later.')</script>";
                            }
                        }
                    }
                } else {
                    echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
                }
        
                mysqli_stmt_close($stmt);
            }
    }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/index.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body class="text-light">
    <div class="wrapper" style="height: max-content;">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value='guest'>Guest</option>
                    <option value='admin'>Admin</option>
                </select>
                <span class="invalid-feedback">
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control ">
                <span class="invalid-feedback">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control ">
                <span class="invalid-feedback">
            </div>
            <div class="form-group">
            <label for="perusahaan">Perusahaan</label>
            <select name="perusahaan" id="perusahaan" class="form-control">
                <?php
                    $sql = "SELECT CompanyID, Nama FROM perusahaan";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['CompanyID'] . '">' . $row['Nama'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No companies available</option>';
                    }

                    // Close the connection
                    mysqli_close($conn);
                ?>
            </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
           
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>