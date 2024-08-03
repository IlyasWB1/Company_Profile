<?php
    session_start();
    include "config.php";
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>
<html>
    <head>
        <title>About Us</title>
        <link rel="stylesheet" type= "text/css" href="CSS/index.css">
    </head>
    <body>
            <div class="header">
                <span>Web Manajemen Perusahaan</span>
                <div style="display: flex;position: absolute; right: 0;top:0;width:  max-content;">
                    <ul class="menu1" style="list-style-type: none;display: flex;">
                        <li>
                            <p><i class="fa-regular fa-user"></i><?php echo $_SESSION['username'];?></p>
                        </li>
                        <li style="padding-left: 10px;place-self: center;">
                            <button value="Logout" name="logout" class="logout_but" onclick="window.location= 'http://localhost/PROJECT/logout.php'">Logout<i class="fa-solid fa-right-from-bracket"></i></button>
                        </li>
                    </ul>
                </div>
                <div class="menu2">
                    <ul>
                        <li><a href="logout.php">Log out</a></li>
                        <li><a href="registration.php">Sign Up</a></li>
                    <ul>
                </div>
            </div>
            <div class="user1">
            <span style="float: left;"><p style="font-size: 20px;" onclick="window.location= 'http://localhost/PROJECT/index.php'"><i class="fa-solid fa-arrow-left"></i>Back</p></span>
                <div class="data" style="padding:20px 10px 20px 10px;">
                    <div class="card">
                        <div class="img_container">
                            <img src="CSS/th.jpeg" width="100%" height="45%">
                        </div>
                        <div>
                            <p>Muhammad Ryan Ardiansyah</p>
                            <p>L200220131</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="img_container">
                            <img src="CSS/th.jpeg" width="100%" height="45%">
                        </div>
                        <div>
                            <p>Muhammad Kholis Affandi</p>
                            <p>L200220131</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="img_container">
                            <img src="CSS/th.jpeg" width="100%" height="45%">
                        </div>
                        <div>
                            <p>Ilyas Wahyu Bharata</p>
                            <p>L200220131</p>
                        </div>
                    </div>
                </div>
                <div class="desc">
                    <center>
                        <h2>About Us</h2>
                    </center>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus cumque porro neque quidem odit fugiat perspiciatis, hic reiciendis voluptate. Itaque dolore magnam laborum ab id adipisci optio odit suscipit tenetur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, laborum magnam? Nam molestiae minus eveniet neque odio asperiores obcaecati quod consectetur voluptatem qui culpa, ipsum ex laborum? Esse, quod vel. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis, vero! Perferendis veritatis quasi cum eius quam assumenda quis quaerat mollitia quae corporis, ea blanditiis harum, minima est maxime provident deserunt.</p>
                </div>
            </div>
            <script>
                /* Set the width of the side navigation to 250px */
                function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                }
    
                /* Set the width of the side navigation to 0 */
                function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                }
            </script>
            <script src="https://kit.fontawesome.com/8974ffcae9.js" crossorigin="anonymous"></script>
    </body>
</html>