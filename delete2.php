
<?php
include"config.php";
$id = $_GET['deleteid'];
$delete = "DELETE FROM users WHERE is ='$id'";
mysqli_query($conn,$delete);           
?>
<html>
<head>
    <title>Delete Data</title>
    <link rel="stylesheet" href="CSS/index.css?v=<?php echo time(); ?>">
</head>
    <body>
    <div id="CPanel2">
            <span onclick="back()">Back</span>
                <div class="wrapper_panel">
                    <h3>Delete Data Client :</h3>
                    <p>Data untuk pengguna dengan ID <?php echo $id?> berhasil dihapus</p>
                </div>
    <script>
        function back(){
            window.location = 'http://localhost/PROJECT/index.php'
        }
    </script>
    </body>
</html>