<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
$qs = $con->prepare("SELECT * FROM kontak");
$qs->execute();
$dk = $qs->fetch();

$qs1 = $con->prepare("SELECT * FROM tentang");
$qs1->execute();
$dk1 = $qs1->fetch();

$qs2 = $con->prepare("SELECT * FROM aplikasi");
$qs2->execute();
$dk2 = $qs2->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Beasiswa Pemerintah Kota Bontang">
    <meta name="author" content="Randy Tri Handhoko | Mr. Hand">
    <title><?php echo $dk2['title'] ?></title>
    <link href="css/font1.css" rel="stylesheet">
    <link href="css/font2.css" rel="stylesheet">
    <link href="css/font3.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet"> 
    <link href="css/lightbox.css" rel="stylesheet"> 
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="../inc/images/<?php echo $dk2['logo_title']; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <!-- JQuery DataTable Css -->
    <link href="../inc/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../inc/assets/plugins/jquery-datatable/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="../inc/assets/plugins/jquery-datatable/responsive/css/responsive.bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    .modal{
       overflow:auto !important;
    }  


    .image-cropper {
        width: 100%;
        position: relative;
        overflow: hidden;
    }
    .image-cropper1 {
        width: 66px;
        height: 66px;
        margin-right: 5px;
        position: relative;
        overflow: hidden;
    }
    .rectangle {
        position: relative;
        top: -50px;
        display: inline;
        margin: 0 auto;
        height: auto;
        width: 100%;
    }
    .rectangle1 {
        position: relative;
        top: 0px;
        display: inline;
        margin: 0 auto;
        height: 66px;
        min-width: 66px;
        max-width: 90px;
    }

    @media (min-width: 767px){
           hr.style-six {
                padding: 0;
                border: none;
                height: 1px;
                background-image: -webkit-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                background-image:    -moz-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                background-image:     -ms-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                background-image:      -o-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                color: #333;
                text-align: center;
            }
            hr.style-six:after {
                content:"        ";
                display: inline-block;
                position: absolute; 
                top: -0.2em;
                left: 45%;
                font-size: 1.5em;
                padding: 19px 1.4em;
                background: url(../home/images/imgg1.png) no-repeat scroll center;
                background-size: 43px 35px;
                background-position: 8px;
                height: 50px;
            }
    }
    @media (max-width: 767px){
           hr.style-six {
                padding: 0;
                border: none;
                height: 1px;
                background-image: -webkit-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                background-image:    -moz-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                background-image:     -ms-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                background-image:      -o-linear-gradient(left, rgba(13,120,152,0), rgba(13,120,152,0.75), rgba(13,120,152,0)); 
                color: #333;
                text-align: center;
            }
            hr.style-six:after {
                content:"        ";
                display: inline-block;
                position: absolute; 
                top: -1.1em;
                left: 40%;
                font-size: 1.5em;
                padding: 19px 1.4em;
                background: url(../home/images/beasiswa/logo2.png) no-repeat scroll center;
                background-size: 43px 35px;
                background-position: 8px;
                height: 50px;
            }
    }
/*  Images between <hr> tag 

div.style-six {
height: 75px;
background: #fff url(../home/images/beasiswa/logo2.png) no-repeat scroll left;
background-size: 80px 75px;
margin-left: -40px;
}
hr.style-six
{
width: 95%;
margin-top: -40px;
border: 0;
border-bottom: 1px dashed black;
background: #70A8FF;
}*/
          </style>
<!--/head-->
</head>

<body>
  <header id="header">      
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow" style="visibility:hidden;">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div> 
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.php">
                      <h1><img src="../inc/images/<?php echo $dk2['logo_front']; ?>" alt="logo" style="width:240px; height:auto;"></h1>
                    </a>
                    
                </div>
                <?php
                $hal = @$_GET['hal'];
                  if ($hal == "" || $hal == "detail") {
                      $link = 'class="active"';
                  }else{
                      $link = '';
                  }
                  if ($hal == "tentang") {
                      $link1 = 'class="active"';
                  }else{
                      $link1 = '';
                  }
                  if ($hal == "unduhan") {
                      $link2 = 'class="active"';
                  }else{
                      $link2 = '';
                  }
                  if ($hal == "persyaratan" || $hal == "penerima-beasiswa") {
                      $link3 = 'active';
                  }else{
                      $link3 = '';
                  }
                  if ($hal == "faq") {
                      $link4 = 'class="active"';
                  }else{
                      $link4= '';
                  }
                  if ($hal == "kritik" || $hal == "kontak") {
                      $link5 = 'active';
                  }else{
                      $link5 = '';
                  }
                ?>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo $link; ?>><a href="../home/">Beranda</a></li>
                        <li <?php echo $link1; ?>><a href="tentang.php?hal=tentang">Tentang</a></li>
                        <li <?php echo $link2; ?>><a href="unduhan.php?hal=unduhan">Unduh</a></li>
                        <li class="dropdown <?php echo $link3 ?>"><a href="#">Beasiswa Bontang <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="persyaratan.php?hal=persyaratan">Persyaratan</a></li>
                                <li><a href="penerima-beasiswa.php?hal=penerima-beasiswa">Pengumuman Penerima Beasiswa</a></li>
                            </ul>
                        </li>                    
                        <li <?php echo $link4; ?>><a href="faq.php?hal=faq">FAQ</a></li>                    
                        <li class="dropdown <?php echo $link5; ?>"><a href="#">Hubungi Kami <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="kontak.php?hal=kontak">Kontak</a></li>
                                <li><a href="kritik.php?hal=kritik">Kritik & Saran</a></li>
                            </ul>
                        </li>                                      
                        <li><a href="login-register.php">Login-Registrasi</a></li>                    
                    </ul>
                </div>
                <div class="search">
                    <form role="form" id="carii" method="post" action="search.php">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" class="search-form" autocomplete="off" name="keyword" placeholder="Cari...">
                            <input type="submit" style="display:none;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header-->


<div id="isi">
