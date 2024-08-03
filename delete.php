
<?php
include"config.php";
$companyID = $_GET['deleteid'];
$delete = "DELETE FROM perusahaan WHERE CompanyID ='$companyID'";
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
                    <h3>Delete Data Gudang :</h3>
                    <p>Data untuk perusahaan dengan ID <?php echo $companyID?> berhasil dihapus</p>
                </div>
    <script>
        function back(){
            window.location = 'http://localhost/PROJECT/index.php'
        }
    </script>
    </body>
</html>