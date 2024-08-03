<?php
    $conn = mysqli_connect("localhost","root","","projek");
    if(!$conn){
        die("Koneksi gagal terhubung".mysqli_connect_error());
    }
?>