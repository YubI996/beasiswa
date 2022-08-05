<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");


$sql = $con->prepare("SELECT * FROM user WHERE id_user='$_SESSION[id]'");
$sql->execute();
$d = $sql->fetch();
$foto = $d['foto_user'];
$namaU = $d['nama_user'];
$levelU = $d['level'];
$sinceU = $d['since'];


$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
$sql1->execute();
$d1 = $sql1->fetch();
$periodee = $d1['periode'];
$tglT = tglWaktu($d1['tgl_tutup']);


$sqlm = $con->prepare("SELECT * FROM mahasiswa WHERE id_user='$_SESSION[id]'");
$sqlm->execute();
$dm = $sqlm->fetch();

$norekm = $dm['no_rekening'];

$sqlz1 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='1'");
$sqlz1->execute();
$dz1 = $sqlz1->fetch();

$sqlz2 = $con->prepare("SELECT * FROM beasiswa_ta WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='1'");
$sqlz2->execute();
$dz2 = $sqlz2->fetch();

$sqlz3 = $con->prepare("SELECT * FROM beasiswa_coass WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='1'");
$sqlz3->execute();
$dz3 = $sqlz3->fetch();

if ($sqlz1->rowCount() > 0) {
    $bsw = 'Beasiswa Prestasi'; 
    $tgb = $dz1['tgl_permohonan'];
    $idb = $dz1['id_bp'];
    $kat = 'beasiswa_prestasi';

} else if ($sqlz2->rowCount() > 0) {
    $bsw = 'Beasiswa Tugas Akhir';
    $tgb = $dz2['tgl_permohonan'];
    $idb = $dz2['id_bta'];
    $kat = 'beasiswa_ta';

} else if ($sqlz3->rowCount() > 0) {
    $bsw = 'Beasiswa Coass Kedokteran';
    $tgb = $dz3['tgl_permohonan'];
    $idb = $dz3['id_bcs'];
    $kat = 'beasiswa_coass';
}



$page = $_SESSION['page'];

//--------------------------------- super sub modul -----------------------
if ($page == 'mahasiswa') {
    $pM = ' class="active"';
}else{
    $pM = '';
}
if ($page == 'permohonan') {
    $pPR = ' class="active"';
}else{
    $pPR = '';
}

//-------------------------------------- sub modul -----------------------

//----------------------------------- modul -------------------------------
if ($page == 'beranda' || $page == 'berkasku') {
    $modBR = ' class="active"';
}else{
    $modBR = '';
}
if ($page == 'mahasiswa') {
    $modM = ' class="active"';
}else{
    $modM = '';
}
if ($page == 'permohonan') {
    $modBE = ' class="active"';
}else{
    $modBE = '';
}

if ($page == 'faq') {
    $modF = ' class="active"';
}else{
    $modF = '';
}

if ($page == '') {
    $modBE = '';
    $modM = '';
    $modBR = '';
    $modF = '';
}
?>

<!DOCTYPE html>
<html>
<!--/head-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../inc/images/<?php echo $logo_title; ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="../inc/assets/css/roboto-font.css" rel="stylesheet" type="text/css">
    <link href="../inc/assets/material-icons/material-icons.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../inc/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../inc/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../inc/assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!--WaitMe Css-->
    <link href="../inc/assets/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../inc/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../inc/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../inc/assets/plugins/jquery-datatable/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="../inc/assets/plugins/jquery-datatable/responsive/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../inc/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../inc/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../inc/assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../inc/assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../inc/assets/css/themes/all-themes.css" rel="stylesheet" />
    <!-- scrolling modal -->
    <style type="text/css">
    .modal{
       overflow:auto !important;
    }  


    .image-cropper {
        width: 200px;
        height: 200px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
        border-top:2px solid #cf2031;
        border-right:2px solid #0f7dc8;
        border-bottom:2px solid #2eb31a;
        border-left:2px solid #eab823;
}
    .image-cropper1 {
        width: 50px;
        height: 50px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
    }

    .rounded {
    object-fit: cover;
   width: 50px;
   max-width: auto;
   height: auto;
   min-height: 50px    
}
    .rounded1 {
    object-fit: cover;
   width: 200px;
   max-width: auto;
   height: auto;
   min-height: 200px    
    }

    .dsb{
         pointer-events:none;
         cursor:not-allowed;
         color:#F44336;
         opacity: 0.5;  
    }
</style>

</head>
<body class="">
<input type="hidden" id="tema" value="<?php echo $tema_user; ?>">
<!------------------------------- ANIMASI LOADER HALAMAN (SEBELAH ATAS) ------------------------------- -->
    <!-- Page Loader 
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Mohon Tunggu...</p>
        </div>
    </div>-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars 
    <div class="overlay"></div>-->
    <!-- #END# Overlay For Sidebars -->
<!------------------------------- SELESAI ANIMASI LOADER HALAMAN (SEBELAH ATAS) ------------------------------- -->



<!------------------------------- BAR PENCARIAN (SEBELAH ATAS) ------------------------------- -->
    <!-- Search Bar 
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="APA YANG INGIN ANDA CARI?...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>-->
    <!-- #END# Search Bar -->
<!------------------------------- SELESAI BAR PENCARIAN (SEBELAH ATAS) ------------------------------- -->



<!------------------------------- BAR SEBELAH ATAS (BRAND+NOTIF) ------------------------------- -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="#" class="bars"></a>
                <a class="navbar-brand" href="#"><img src="../inc/images/<?php echo $logo_user; ?>"></a>
            </div>
           
           <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
 <?php
            /*  TUTUP SEMENTARA                    <!-- Call Search -->
                    <li><a href="#" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    
                    <!-- Notifications -->
                    <li class="dropdown" style="visibility: hidden;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count" id="jn">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFIKASI</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View All Notifications</a>
                            </li>
                        </ul>
                    </li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count" id="jn">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFIKASI</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View All Notifications</a>
                            </li>
                        </ul>
                    </li> 
                    <!-- #END# Notifications -->
                    
                    /*
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="#">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="#" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                */ ?>
                    <li><a href="../mahasiswa/pengaturan/profil.php" title="Profil"><i class="material-icons">account_circle</i></a></li>               
                    <li><a href="../inc/security/logout.php" title="Keluar Aplikasi"><i class="material-icons">power_settings_new</i></a></li>               
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
<!------------------------------- SELESAI BAR SEBELAH ATAS (BRAND+NOTIF) ------------------------------- -->



<!-------------------------------  SIDE BAR SEBELAH KIRI (MENU) ------------------------------- -->

    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <input type="text" id="bg" value="<?php echo $background; ?>" style="display:none;">  
            <div class="user-info">
                <div class="">
                            <div class="image-cropper1">
                                <img src="../user/master/foto_user/<?php echo $foto; ?>" alt="User" class="rounded" />
                            </div>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $d['nama_user']; ?></div>
                    <div class="email"><?php echo $_SESSION['level']. ' | ' . $_SESSION['last']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../mahasiswa/pengaturan/profil.php"><i class="material-icons">person</i>Profil</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php echo $modBR; ?>>
                        <a href="../mahasiswa/" id="ber" class="">
                            <i class="material-icons">dashboard</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li <?php echo $modM; ?>>
                        <a href="#" class="menu-toggle">
                            <i class="material-icons">folder</i>
                            <span>Mahasiswa</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo $pM; ?>>
                                <a href="../mahasiswa/master/mahasiswa.php"><span>&bull; Data Mahasiswa</span></a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo $modBE; ?>>
                        <a href="#" class="menu-toggle" id="bea">
                            <i class="material-icons">school</i>
                            <span>Beasiswa</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo $pPR; ?>>
                                <a href="../mahasiswa/beasiswa/permohonan-beasiswa.php"><span>&bull; Permohonan Beasiswa</span></a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo $modF; ?>>
                        <a href="../mahasiswa/faq.php" id="faq" class="">
                            <i class="material-icons">question_answer</i>
                            <span>FAQ</span>
                        </a>
                    </li>


                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <?php echo $owner; ?> | <a href="#"><?php echo $title; ?></a>
                </div>
                <div class="version">
                    <b>Version: </b> <?php echo $versi; ?>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
<!------------------------------- SELESAI SIDE BAR SEBELAH KIRI (MENU) ------------------------------- -->







<!------------------------------- SIDE BAR SEBELAH KANAN (ATUR WARNA) ------------------------------- -->
       <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="../inc/assets/#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="../inc/assets/#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
<!------------------------------- SELESAI SIDE BAR SEBELAH KANAN ------------------------------- -->
   
    </section>


       
<!-------------------------- MODAL NOTIFIKASI --------------- -->

                <div class="modal fade" id="modalNotif1" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="top:15%;z-index:99999;">
                    <div class="modal-content">
                        <div class="modal-header" style="background:#f39c12;">
                            <h4 class="modal-title" id="defaultModalLabel">Pemberitahuan</h4>
                        </div>
                        <input type="text" id="ses" value="<?php echo $_SESSION['page']; ?>" style="display:none ; float: right;">
                        <input type="text" id="sbw1" value="<?php echo $dz1['status_verifikasi']; ?>" style="display:none ; float: right;">
                        <input type="text" id="sbw11" value="<?php echo $dz1['status_perbaikan']; ?>" style="display:none ; float: right;">
                        <input type="text" id="sbw2" value="<?php echo $dz2['status_verifikasi']; ?>" style="display:none ; float: right;">
                        <input type="text" id="sbw22" value="<?php echo $dz2['status_perbaikan']; ?>" style="display:none ; float: right;">
                        <input type="text" id="sbw3" value="<?php echo $dz3['status_verifikasi']; ?>" style="display:none ; float: right;">
                        <input type="text" id="sbw33" value="<?php echo $dz3['status_perbaikan']; ?>" style="display:none ; float: right;">
                        <div class="modal-body">
                            Hallo, <span id="namam"></span><?php echo $namaU; ?><br>
                            Berkas pengajuan <span id="bsw"></span> <?php echo $bsw; ?> Anda pada tanggal <span id="tgb"></span> <?php echo tglWaktu($tgb); ?>  telah di verifikasi, namun terdapat kesalahan dalam berkas Anda sebagai berikut : <br><br>
                            <div style="background:#f5f5f5; border-radius: 5px; border: 3px dashed #3498db; padding: 15px;">
                                 <span id="keter"></span>
                                 <?php echo @$dz1['keterangan']; ?>
                                <?php echo @$dz2['keterangan']; ?>
                                <?php echo @$dz3['keterangan']; ?>
                            </div>
                            <br>Mohon segera lengkapi/perbaiki berkas yang dimaksud tersebut sebelum tanggal <?php echo $tglT; ?>.<br> <br>Terimakasih. (^_^)<br><br>
                            Sincerely,<br>
                            Administrator e-Beasiswa
                        </div>
                        <div class="modal-footer" style="background:#ecf0f1;">
                            <a  href="../mahasiswa/beasiswa/berkasku.php?idb=<?php echo $idb; ?>&kat=<?php echo $kat; ?>" class="btn btn-link waves-effect">LENGKAPI BERKAS >> </a>
                        </div>
                    </div>
                </div>
            </div>
