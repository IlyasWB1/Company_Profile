<html>

<head>
    <title>Update Perusahaan</title>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<?php
    include "config.php";
   // Fetch data based on updateid from URL parameter
    $id_url = $_GET['updateid'];
    $hasil_cari = mysqli_query($conn, "SELECT * FROM perusahaan WHERE CompanyID = '$id_url'");
    $data = mysqli_fetch_assoc($hasil_cari);

    // Handle form submission
    if(isset($_POST['submit2'])) {
        $updates = array();

        // Check if each field is set and not empty, then add to updates array
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $updates[] = "CompanyID = '$id'";
        }

        if(isset($_POST['nama']) && !empty($_POST['nama'])) {
            $nama = $_POST['nama'];
            $updates[] = "Nama = '$nama'";
        }

        if(isset($_POST['alamat']) && !empty($_POST['alamat'])) {
            $alamat = $_POST['alamat'];
            $updates[] = "Alamat = '$alamat'";
        }

        $updates[] = "UpdatedAt = CURRENT_TIMESTAMP";

        // Build the SQL query based on the updates array
        if(!empty($updates)) {
            $update_values = implode(', ', $updates);
            $update_query = "UPDATE perusahaan SET $update_values WHERE CompanyID = '$id_url'";
            
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
            <h3>Update Data Perusahaan :</h3>
            
                <form method='POST' action="" >
                <div class="form-group">
                                <label>ID Perusahaan</label><br>
                                <input type="text" name="id" class="form-control">
                </div>   
                <div class="form-group">
                                <label>Nama Perusahaan</label><br>
                                <input type="text" name="nama" class="form-control">
                </div>   
                <div class="form-group">
                                <label>Alamat Perusahaan</label><br>
                                <input type="text" name="alamat" class="form-control">
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
