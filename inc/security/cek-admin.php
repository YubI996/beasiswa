<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
//include_once ($host1."/inc/security/cek-login.php");
?>
    <?php
if(@$_SESSION['level'] != "Admin") {
echo '';   
    ?>
<script type="text/javascript">
var waktu = 5;
setInterval(function() {
waktu--;
if(waktu < 0) {
window.location = "../inc/security/logout.php";
}else{
document.getElementById("countdown").innerHTML = waktu;
}
}, 1000);
</script>   
<html>
<body>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../inc/images/<?php echo $logo_title; ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../inc/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../inc/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../inc/assets/css/style.css" rel="stylesheet">
</head>

<body class="four-zero-four">
    <div class="four-zero-four-container">
        <div class="error-code">ACCESS DENIED</div>
        <div class="error-message">You'll kick out in : </div>
        <div class="error-code" id="countdown">5</div>
        <div class="button-place">
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../inc/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../inc/assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../inc/assets/plugins/node-waves/waves.js"></script>

</body>

</html>

<?php
'';
die();
}

?>