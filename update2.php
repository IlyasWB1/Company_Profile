<html>

<head>
    <title>Update Client</title>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<?php
    include "config.php";
   // Fetch data based on updateid from URL parameter
    $id_url = $_GET['updateid'];
    $hasil_cari = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id_url'");
    $data = mysqli_fetch_assoc($hasil_cari);

    // Handle form submission
    if(isset($_POST['submit2'])) {
        $updates = array();

        // Check if each field is set and not empty, then add to updates array
        if(isset($_POST['username']) && !empty($_POST['username'])) {
            $username = $_POST['username'];
            $updates[] = "username = '$username'";
        }

        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];
            $updates[] = "email = '$email'";
        }

        if(isset($_POST['role']) && !empty($_POST['role'])) {
            $role = $_POST['role'];
            $updates[] = "role = '$role'";
        }

        if(isset($_POST['password']) && !empty($_POST['password'])) {
            $password = $_POST['password'];
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $updates[] = "password = '$password_hashed'";
        }

        // Build the SQL query based on the updates array
        if(!empty($updates)) {
            $update_values = implode(', ', $updates);
            $update_query = "UPDATE users SET $update_values WHERE id = '$id_url'";
            
            if(mysqli_query($conn, $update_query)) {
                echo "Data updated successfully.";
                header("Location: index.php");
            } else {
                echo "Error updating data: " . mysqli_error($conn);
            }
        } else {
            echo "No fields provided for update.";
        }
    }
?>


<body>
    <div id="CPanel2">
        <span style="position:absolute;padding-left: 15px;" onclick="window.location='http://localhost/PROJECT/index.php'">Back</span>
        <div class="wrapper_panel" style="padding-left: 65px;">
            <h3>Update Data Client</h3>
            
                <form method='POST' action="" >
                <div class="form-group">
                                <label>Perusahaan</label><br>
                                <select name="company" class="form-control">
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
                                        mysqli_close($conn);
                                    ?>
                                </select>
                </div> 
                <div class="form-group">
                                <label>Role</label><br>
                                <select name="role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="guest">Guest</option>
                                </select>
                </div>     
                <div class="form-group">
                                <label>Username</label><br>
                                <input type="text" name="username" class="form-control">
                </div>   
                <div class="form-group">
                                <label>Email</label><br>
                                <input type="text" name="email" class="form-control">
                </div>   
                <div class="form-group">
                                <label>Password</label><br>
                                <input type="password" name="password" class="form-control">
                </div>   
            <div class="form-group">
                <input type="submit" class="add_button" value="Update" name="submit2">
            </div>
        </div>
        <div class="wrapper_panel" style="float:right">
            <img src="CSS/gFplPnM.png" width="70%" height="100%" style="float: right;">
        </div>
    </div>
</form>
