<?php
    session_start();
    include "config.php";
    // Check if the user is logged in, if not then redirect him to login page
    if($_SESSION["loggedin"] === false){
        // if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        //     header('Location: index.php');
        //     exit;
        // }
        header("Location: login.php");
    }

    if(isset($_POST["tambah_data"])){
        $companyid = $_POST['companyID'];
        $companyname = $_POST['companyName'];
        $alamatP = $_POST['alamatP'];
        $data = array(
            $companyid => 1234567890// This value is fetched from your database
        );
        if (ctype_digit($data[$companyid])) {
            $sql = mysqli_query($conn, "INSERT INTO perusahaan(CompanyID, Nama, Alamat) VALUES('$companyid','$companyname','$alamatP')");
            if($sql){
                echo'<script>alert("Berhasil")</script>';
            }
        } else {
            echo "Invalid companyID format"; // Handle invalid format
        }
        
    }
?>
<html>
    <head>
        <title>Menu</title>
        <link rel="stylesheet" href="CSS/index.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="CSS/dashboard.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="CSS/perusahaan.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="CSS/menu.css?v=<?php echo time(); ?>">
        
        <script src="https://kit.fontawesome.com/8974ffcae9.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="header" style="position: relative;padding-top: 5px;padding-bottom:2px;width:100%;">
                <span onclick = "openNav()" id="Menu_button"><i class="fa-solid fa-bars"></i></span>
                    <span onclick="window.location= 'http://localhost/PROJECT/index.php'" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">JAVA MEDIA</span>
                <div style="display: flex;position: absolute; right: 0;top:0;width:  max-content;">
                    <ul class="menu1" style="list-style-type: none;display: flex;">
                        <li onclick="openSetting()">
                            <p><i class="fa-regular fa-user"></i><?php echo $_SESSION['username'];?></p>
                        </li>
                        <li style="padding-left: 10px;place-self: center;">
                            <button value="Logout" name="logout" class="logout_but" onclick="window.location= 'http://localhost/PROJECT/logout.php'">Logout<i class="fa-solid fa-right-from-bracket"></i></button>
                        </li>
                    </ul>
                    <div class="profile_setting">
                        <div class="profile_option">
                            <p>Setting</p>
                        </div>
                    </div>
                </div>
                <div class="menu2">
                    <ul>
                        <li><a href="logout.php">Log out</a></li>
                        <li><a href="registration.php">Sign Up</a></li>
                    <ul>
                </div>
        </div>
        <div class="content" id="content">
            <div id = "section1" class="content-section sortable">
            <span><h2 style="color: black;">Profil Perusahaan</h2></span>
            <p style="padding-top:10px;">
            <div class="company_con">
                            <p style="font-size: 25px;"><i class="fa-solid fa-house-user"></i>Perusahaan :
                            <?php
                                $sql = "SELECT COUNT(*) as count FROM perusahaan";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['count'];
                            ?>
                            </p>          
            </div>
            <hr>
            <?php
            if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                echo"<span onclick='openCPanel()'><button name='insert_button'  style='background-color: green;border-radius: 5px;font-weight: bold;font-size: 18px;font-family: monospace;color: white;padding: 5px;margin-left: 10px;text-align: center;cursor: pointer;'>+Tambah</button></span>";
            }
            ?>
            <i class="fa-regular fa-magnifying-glass"></i><input type="text" id="myInput" onkeyup="search_data()" placeholder="Search for names..">
            <table style="margin:5% auto;width=980px" class="redTable" >
                <thead>
                <tr class="row1" colspan="3">
                    <td class="data1" onclick="sortTable(1)">ID</td>
                    <td onclick="sortTable(2)">Nama Perusahaan</td>
                    <td onclick="sortTable(3)">Alamat</td>
                    <td onclick="sortTable(4)">Tanggal Jadi</td>
                    <td onclick="sortTable(5)">Tanggal Update</td>
                    <td onclick="sortTable(6)">ACTION</td>
                </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM perusahaan";
                    $result = mysqli_query($conn, $sql);
                    while($data = mysqli_fetch_row($result)){
                        $id = $data[0];
                        $nama = $data[1];
                        $alamat = $data[2];
                        $created = $data[3];
                        $updated = $data[4];
                        $ubah = "";
                        $delete = "";
                        if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                            $ubah = "<form method = 'post' action=update.php?updateid=$data[0]><input type=submit value='Update' style='background-color: green;border-radius: 5px;font-weight: bold;font-size: 15px;font-family: monospace;color: white;padding: 1px;margin-left: 10px;text-align: center;cursor: pointer;'></input></form>";
                            $delete = "<form method = 'post' action=delete.php?deleteid=$data[0]><input type=submit value='Delete' style='background-color: red;border-radius: 5px;font-weight: bold;font-size: 15px;font-family: monospace;color: white;padding: 1px;margin-left: 10px;text-align: center;cursor: pointer;'></input></form>";
                        }else{
                            $ubah = "Akses Admin";
                        }
                        echo"
                        <tr>
                        <td width='20%'>$id</td>
                        <td width='30%'>$nama</td>
                        <td width='10%'>$alamat</td>
                        <td width='20%'>$created</td>
                        <td width='30%'>$updated</td>
                        <td width='15%'>
                                $ubah
                                $delete
                        </td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
            </div>
            <div id="section2" class="content-section" style="margin: 45px auto;">
                <div class="dashboard">
                    <h4>Dashboard Aplikasi</h4>
                    <div style="background-color: rgb(12, 12, 12);">
                        <h3>Hai <?php echo $_SESSION['username']?></h3>
                        <hr>
                        <p>Selamat datang di website Java Media. Website ini digunakan untuk mengecek profil perusahaan</p>
                    </div>
                    <div class="stat_con">
                        <div class="stat_con1">
                            <p><i class="fa-regular fa-address-card"></i>Staff :
                            <?php
                                $sql = "SELECT COUNT(*) as count FROM users WHERE Role = 'admin'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['count'];
                            ?></p>
                        </div>
                        <div class="stat_con2">
                            <p><i class="fa-solid fa-building"></i>Clients :
                            <?php
                                $sql = "SELECT COUNT(*) as count FROM users WHERE Role = 'guest'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['count'];
                            ?></p>
                        </div>
                        <div class="stat_con3">

                            <p><i class="fa-solid fa-house-user"></i>Perusahaan :
                            <?php
                                $sql = "SELECT COUNT(*) as count FROM perusahaan";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['count'];
                            ?>
                        </p>          
                        </div>
                    </div>
                </div>
            </div>
            <div id = "section3" class="content-section">
            <span><h2 style="color: black;">Data Pengguna</h2></span>
            <p>
                <div class="company_con">
                            <p style="font-size: 25px;"><i class="fa-solid fa-house-user"></i>Client :
                            <?php
                                $sql = "SELECT COUNT(*) as count FROM users where Role = 'guest'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['count'];
                            ?>
                            </p>          
                    </div>
            <hr>
            <i class="fa-regular fa-magnifying-glass"></i><input type="text" id="myInput2" onkeyup="search_data2()" placeholder="Search for names..">
            <table style="margin:5% auto;width=980px" class="redTable2">
                <thead>
                <tr class="row1" colspan="3">
                    <td class="data1">ID</td>
                    <td>Perusahaan</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM users WHERE Role = 'guest'";
                    $result = mysqli_query($conn, $sql);
                    while($data = mysqli_fetch_row($result)){
                        $id = $data[0];
                        $company = $data[1];
                        $username = $data[2];
                        $email = $data[4];
                        $ubah = "";
                        $delete = "";
                        if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                        $ubah = "<form method = 'post'  action=update2.php?updateid=$data[0]><input type=submit value='Update' style='background-color: green;border-radius: 5px;font-weight: bold;font-size: 15px;font-family: monospace;color: white;padding: 1px;margin-left: 10px;text-align: center;cursor: pointer;'></input></form>";
                        $delete = "<form method = 'post' action=delete.php?deleteid=$data[0]><input type=submit value='Delete' style='background-color: red;border-radius: 5px;font-weight: bold;font-size: 15px;font-family: monospace;color: white;padding: 1px;margin-left: 10px;text-align: center;cursor: pointer;'></input></form>";
                        }else{
                            $ubah = "Akses Admin";
                        }
                        echo"
                        <tr>
                        <td width='20%'>$id</td>
                        <td width='30%'>$company</td>
                        <td width='10%'>$username</td>
                        <td width='20%'>$email</td>
                        <td width='15%'>
                                $ubah
                                $delete
                        </td>
                        </tr>";;
                    }
                ?>
                </tbody>
            </table>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: black;">JAVA MEDIA</p>
            <hr>
            <p style="padding-top: 0;padding-bottom: 0;"><?php echo $_SESSION['username'];?></p>
            <hr>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="menu_container"><a onclick="loadContent('section2')">Dashboard</a></div>
            <div class="menu_container"><a onclick="loadContent('section3')"><i class="fa-solid fa-building"></i>  Clients</a></div>
            <div class="menu_container"><a onclick="loadContent('section1')"><i class="fa-solid fa-house-user"></i>  Profil Perusahaan</a></div>
            <div class="menu_container"><a href="about.php"><i class="fa-regular fa-circle-info"></i>About Us</a></div>
            <div class="menu_container"><a href="#">Staff and Team</a></div>
        </div>
            <div id="CPanel">
                <span onclick="openCPanel()">X</span>
                <div class="wrapper_panel">
                    <form method="POST" action="">
                            <div>
                                <h2>Tambah Data Perusahaan</h2>
                            </div>
                            <div class="form-group">
                                <label>ID Perusahaan</label><br>
                                <input type="text" name="companyID" class="form-control">
                            </div>    
                            <div class="form-group">
                                <label>Nama Perusahaan</label><br>
                                <input type="text" name="companyName" class="form-control">
                            </div>  
                            <div class="form-group">
                                <label>Alamat Perusahaan</label><br>
                                <input type="text" name="alamatP" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="add_button" value="Tambah" name="tambah_data">
                            </div>
                    </form>
                </div>
                <div class="wrapper_panel">
                    <img src="CSS/gFplPnM.png" height="100%" width="100%">
                </div>
            <div class="blur">

            </div>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
            function openSetting() {
                var profileSetting = document.querySelector('.profile_setting');
                var profileOption = document.querySelector('.profile_option');
                if (profileSetting.style.height === "0px" || profileSetting.style.height === "") {
                    profileSetting.style.height = "35px";
                    profileOption.style.display = "block";
                } else {
                    profileSetting.style.height = "0";
                    profileOption.style.display = "none";
                }
            }
            /* Set the width of the side navigation to 250px */
            function openNav() {
                var sidenav = document.getElementById("mySidenav");
                if (sidenav.style.width === "0px" || sidenav.style.width === "") {
                    sidenav.style.width = "250px";
                } else {
                    sidenav.style.width = "0";
                }
            }

            function openCPanel() {
                var CPanel = document.getElementById("CPanel");
                if (CPanel.style.display === "none" || CPanel.style.display === "") {
                    CPanel.style.display = "flex";
                    CPanel.style.position = "fixed";
                } else {
                    CPanel.style.display = "none";
                }
            }

            /* Set the width of the side navigation to 0 */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }

            function loadContent(sectionId) {
                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => {
                    section.style.display = 'none';
                });
                const selectedSection = document.getElementById(sectionId);
                if (selectedSection) {
                    selectedSection.style.display = 'block';
                }
            }

            // Hide all sections except the first one by default
            document.addEventListener("DOMContentLoaded", function() {
                const sections = document.querySelectorAll('.content-section');
                sections.forEach((section, index) => {
                    if (index !== 0) {
                        section.style.display = 'none';
                    }
                });
            });

            function search_data() {
                const input = document.getElementById('myInput');
                const filter = input.value.toLowerCase();
                const table = document.querySelector('.redTable tbody');
                const tr = table.getElementsByTagName('tr');

                for (let i = 0; i < tr.length; i++) {
                    let visible = false;
                    const td = tr[i].getElementsByTagName('td');
                    for (let j = 0; j < td.length; j++) {
                        if (td[j]) {
                            const textValue = td[j].textContent || td[j].innerText;
                            if (textValue.toLowerCase().indexOf(filter) > -1) {
                                visible = true;
                                break;
                            }
                        }
                    }
                    tr[i].style.display = visible ? '' : 'none';
                }
            }

            function search_data2() {
                const input = document.getElementById('myInput2');
                const filter = input.value.toLowerCase();
                const table = document.querySelector('.redTable2 tbody');
                const tr = table.getElementsByTagName('tr');

                for (let i = 0; i < tr.length; i++) {
                    let visible = false;
                    const td = tr[i].getElementsByTagName('td');
                    for (let j = 0; j < td.length; j++) {
                        if (td[j]) {
                            const textValue = td[j].textContent || td[j].innerText;
                            if (textValue.toLowerCase().indexOf(filter) > -1) {
                                visible = true;
                                break;
                            }
                        }
                    }
                    tr[i].style.display = visible ? '' : 'none';
                }
            }

            function sortTable(n) {
                const table = document.querySelector('.redTable tbody');
                let rows = Array.from(table.rows);
                const isAscending = table.getAttribute('data-sort-asc') === 'true';
                
                rows.sort((a, b) => {
                    const cellA = a.cells[n].innerText.toLowerCase();
                    const cellB = b.cells[n].innerText.toLowerCase();

                    if (cellA < cellB) return isAscending ? -1 : 1;
                    if (cellA > cellB) return isAscending ? 1 : -1;
                    return 0;
                });

                // Toggle the sorting order
                table.setAttribute('data-sort-asc', !isAscending);

                // Append sorted rows back to the table body
                rows.forEach(row => table.appendChild(row));
            }
        </script>
        <script src="https://kit.fontawesome.com/8974ffcae9.js" crossorigin="anonymous"></script>
    </body>
</html>