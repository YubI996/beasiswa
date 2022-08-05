<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");


$sa = $con->prepare("SELECT  * FROM set_beasiswa");
$sa->execute();
$ds = $sa->fetch();
$periode = $ds['periode'];
$tglB = $ds['tgl_buka'];
$tglT = $ds['tgl_tutup'];
if ($ds['publish'] == 1) 
    $publish = 'checked'; else $publish = '';
if ($ds['notifikasi'] == 1) 
    $notifikasi = 'checked'; else $notifikasi = '';
if ($ds['status_penerimaan'] == 1) 
    $status_penerimaan = 'checked'; else $status_penerimaan = '';
if ($ds['status_beasiswa'] == 1) 
    $sistem_beasiswa = 'checked'; else $sistem_beasiswa = '';


$sql = $con->prepare("SELECT * FROM user WHERE id_user='$_SESSION[id]'");
$sql->execute();
$d = $sql->fetch();
$foto = $d['foto_user'];
$namaU = $d['nama_user'];
$levelU = $d['level'];
$sinceU = $d['since'];


$page = $_SESSION['page'];

//--------------------------------- super sub modul -----------------------
if ($page == 'KbeasiswaP') {
    $beP = ' class="active"';
}else{
    $beP = '';
}
if ($page == 'KbeasiswaTA') {
    $beTA = ' class="active"';
}else{
    $beTA = '';
}
if ($page == 'KbeasiswaC') {
    $beC = ' class="active"';
}else{
    $beC = '';
}
if ($page == 'VbeasiswaP') {
    $vP = ' class="active"';
}else{
    $vP = '';
}
if ($page == 'VbeasiswaTA') {
    $vTA = ' class="active"';
}else{
    $vTA = '';
}
if ($page == 'VbeasiswaC') {
    $vC = ' class="active"';
}else{
    $vC = '';
}
if ($page == 'PbeasiswaP') {
    $pP = ' class="active"';
}else{
    $pP = '';
}
if ($page == 'PbeasiswaTA') {
    $pTA = ' class="active"';
}else{
    $pTA = '';
}
if ($page == 'PbeasiswaC') {
    $pC = ' class="active"';
}else{
    $pC = '';
}
if ($page == 'berita') {
    $pB = ' class="active"';
}else{
    $pB = '';
}
if ($page == 'mahasiswa') {
    $pM = ' class="active"';
}else{
    $pM = '';
}
if ($page == 'pengumuman') {
    $aNc = ' class="active"';
}else{
    $aNc = '';
}
if ($page == 'periode') {
    $pPR = ' class="active"';
}else{
    $pPR = '';
}
if ($page == 'persyaratan') {
    $pPS = ' class="active"';
}else{
    $pPS = '';
}
if ($page == 'unduhan') {
    $pUN = ' class="active"';
}else{
    $pUN = '';
}
if ($page == 'user') {
    $pUS = ' class="active"';
}else{
    $pUS = '';
}
if ($page == 'kontak') {
    $pK = ' class="active"';
}else{
    $pK = '';
}
if ($page == 'kritik') {
    $pK1 = ' class="active"';
}else{
    $pK1 = '';
}
if ($page == 'kriteria') {
    $pK2 = ' class="active"';
}else{
    $pK2 = '';
}
if ($page == 'range') {
    $pK3 = ' class="active"';
}else{
    $pK3 = '';
}
if ($page == 'tentang') {
    $pT = ' class="active"';
}else{
    $pT = '';
}
if ($page == 'lapPemohon') {
    $lpP = ' class="active"';
}else{
    $lpP = '';
}
if ($page == 'lapPenerima') {
    $lpN = ' class="active"';
}else{
    $lpN = '';
}
if ($page == 'beritaAcara') {
    $lBA = ' class="active"';
}else{
    $lBA = '';
}

if ($page == 'daftarRegistrasi') {
    $dreg = ' class="active"';
}else{
    $dreg = '';
}

//-------------------------------------- sub modul -----------------------
if ($page == 'KbeasiswaP' || $page == 'KbeasiswaTA' || $page == 'KbeasiswaC') {
    $smodK = ' class="active"';
}else{
    $smodK = '';    
}
if ($page == 'VbeasiswaP' || $page == 'VbeasiswaTA' || $page == 'VbeasiswaC') {
    $smodV = ' class="active"';
}else{
    $smodV = '';    
}
if ($page == 'PbeasiswaP' || $page == 'PbeasiswaTA' || $page == 'PbeasiswaC') {
    $smodP = ' class="active"';
}else{
    $smodP = '';    
}

//----------------------------------- modul -------------------------------
if ($page == 'beranda') {
    $modBR = ' class="active"';
}else{
    $modBR = '';
}
if ($page == 'berita' || $page == 'mahasiswa' || $page == 'periode' || $page == 'persyaratan' || $page == 'unduhan' || $page == 'user' || $page == 'tentang' || $page == 'kontak' || $page == 'kritik' || $page == 'kriteria' || $page == 'range' || $page == 'pengumuman') {
    $modM = ' class="active"';
}else{
    $modM = '';
}
if ($page == 'KbeasiswaP' || $page == 'KbeasiswaTA' || $page == 'KbeasiswaC' || $page == 'VbeasiswaP' || $page == 'VbeasiswaTA' || $page == 'VbeasiswaC' || $page == 'PbeasiswaP' || $page == 'PbeasiswaTA' || $page == 'PbeasiswaC') {
    $modBE = ' class="active"';
}else{
    $modBE = '';
}
if ($page == 'lapPemohon' || $page == 'lapPenerima' || $page == 'beritaAcara') {
    $modLap = ' class="active"';
}else{
    $modLap = '';
}

if ($page == '') {
    $modBE = '';
    $modM = '';
    $modBR = '';
    $modLap = '';
}
?>

<!DOCTYPE html>
<html>
<!--/head-->
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Beasiswa Pemerintah Kota Bontang">
    <meta name="author" content="Randy Tri Handhoko | Mr. Hand">
    <title><?php echo $title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="/inc/images/<?php echo $logo_title; ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="/inc/assets/css/roboto-font.css" rel="stylesheet" type="text/css">
    <link href="/inc/assets/material-icons/material-icons.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="/inc/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/inc/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/inc/assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!--WaitMe Css-->
    <link href="/inc/assets/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="/inc/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="/inc/assets/plugins/jquery-datatable/datatables.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="/inc/assets/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="/inc/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="/inc/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="/inc/assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/inc/assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/inc/assets/css/themes/all-themes.css" rel="stylesheet" />
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
  </style>

</head>
<body class="">
<input type="hidden" id="tema" value="<?php echo $tema_user; ?>">
<input type="hidden" id="lvlu" value="<?php echo $_SESSION['level']; ?>">
<!------------------------------- ANIMASI LOADER HALAMAN (SEBELAH ATAS) ------------------------------- -->
    <!-- Page Loader -->
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
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
<!------------------------------- SELESAI ANIMASI LOADER HALAMAN (SEBELAH ATAS) ------------------------------- -->



<!------------------------------- BAR PENCARIAN (SEBELAH ATAS) ------------------------------- -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="APA YANG INGIN ANDA CARI?...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
<!------------------------------- SELESAI BAR PENCARIAN (SEBELAH ATAS) ------------------------------- -->



<!------------------------------- BAR SEBELAH ATAS (BRAND+NOTIF) ------------------------------- -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="#" class="bars"></a>
                <a class="navbar-brand" href=""><img src="/inc/images/<?php echo $logo_user; ?>"></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                <?php /*    <!-- Call Search -->
                    <li><a href="#" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
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
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
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
                        </ul>*/ ?>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="#" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                    <li><a href="/inc/security/logout.php"><i class="material-icons">power_settings_new</i></a></li>
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
            <div id="bgn">
            <input type="text" id="bg" value="<?php echo $background; ?>" style="display:none;">  
            <div class="user-info">
             <button type="button" data-toggle="modal" id="btn-wall" data-target="#modal-wall" style="width:30px; height:30px;padding:2px 0px 0px 2px;" class="btn bg-blue btn-circle waves-effect waves-circle waves-float pull-right">
                                    <i class="material-icons" style="">edit</i>
            </button>
                <div class="">
                            <div class="image-cropper1">
                                <img src="/user/master/foto_user/<?php echo $foto; ?>" alt="User" class="rounded" />
                            </div>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $d['nama_user']; ?></div>
                    <div class="email"><?php echo $_SESSION['level']. ' | ' . $_SESSION['last']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right" style="width:200px;">
                            <li><a href="/user/pengaturan/profil.php"><i class="material-icons">person</i>Profil</a></li>
                            <li role="seperator" class="divider"></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="/user/pengaturan/aplikasi.php"><i class="material-icons">settings_applications</i>Pengaturan Aplikasi</a></li>
                            <li><a href="/user/pengaturan/sistem.php"><i class="material-icons">settings_applications</i>Pengaturan Sistem</a></li>
                            <li><a href="/user/pengaturan/kuotaku.php"><i class="material-icons">settings_applications</i>Pengaturan Kuota</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php echo $modBR; ?>>
                        <a href="/user/">
                            <i class="material-icons">dashboard</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li <?php echo $modM; ?>>
                        <a href="#" class="menu-toggle">
                            <i class="material-icons">folder</i>
                            <span>Master</span>
                        </a>
                        <ul class="ml-menu"> 
                            <li <?php echo $pB; ?>>
                                <a href="/user/master/berita.php"><span>&bull; Berita</span></a>
                            </li>
                            <li <?php echo $pUN; ?>>
                                <a href="/user/master/unduhan.php"><span>&bull; File Unduhan</span></a>
                            </li>
                            <li <?php echo $pK; ?>>
                                <a href="/user/master/kontak.php"><span>&bull; Kontak</span></a>
                            </li>
                            <li <?php echo $pK1; ?>>
                                <a href="/user/master/kritik.php"><span>&bull; Kritik & Saran</span></a>
                            </li>
                            <li <?php echo $pM; ?>>
                                <a href="/user/master/mahasiswa.php"><span>&bull; Mahasiswa</span></a>
                            </li>
                            <li <?php echo $aNc; ?>>
                                <a href="/user/master/pengumuman.php"><span>&bull; Pengumuman</span></a>
                            </li>
                            <li <?php echo $pPR; ?>>
                                <a href="/user/master/periode.php"><span>&bull; Periode</span></a>
                            </li>
                            <li <?php echo $pPS; ?>>
                                <a href="/user/master/persyaratan.php"><span>&bull; Persyaratan</span></a>
                            </li>
                            <li <?php echo $pT; ?>>
                                <a href="/user/master/tentang.php"><span>&bull; Tentang</span></a>
                            </li>
                            <li <?php echo $pUS; ?>>
                                <a href="/user/master/user.php"><span>&bull; User</span></a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo $modBE; ?>>
                        <a href="#" class="menu-toggle">
                            <i class="material-icons">school</i>
                            <span>Beasiswa</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo $smodK; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Data Beasiswa</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo $beP; ?>>
                                        <a href="/user/beasiswa/beasiswaP.php">
                                            <span>&bull; Beasiswa Prestasi</span>
                                        </a>
                                    </li>
                                    <li <?php echo $beTA; ?>>
                                        <a href="/user/beasiswa/beasiswaTA.php">
                                            <span>&bull; Beasiswa Tugas Akhir</span>
                                        </a>
                                    </li>
                                    <li <?php echo $beC; ?>>
                                        <a href="/user/beasiswa/beasiswaC.php">
                                            <span>&bull; Beasiswa Coass </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                       
                            <li <?php echo $smodV; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Verifikasi</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo $vP; ?>>
                                        <a href="/user/beasiswa/beasiswaP-V.php">
                                            <span>&bull; Beasiswa Prestasi</span>
                                        </a>
                                    </li>
                                    <li <?php echo $vTA; ?>>
                                        <a href="/user/beasiswa/beasiswaTA-V.php">
                                            <span>&bull; Beasiswa Tugas Akhir</span>
                                        </a>
                                    </li>
                                    <li <?php echo $vC; ?>>
                                        <a href="/user/beasiswa/beasiswaC-V.php">
                                            <span>&bull; Beasiswa Coass </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                       
                            <li <?php echo $smodP; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Penerima</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo $pP; ?>>
                                        <a href="/user/beasiswa/penerima-beasiswaP.php">
                                            <span>&bull; Beasiswa Prestasi</span>
                                        </a>
                                    </li>
                                    <li <?php echo $pTA; ?>>
                                        <a href="/user/beasiswa/penerima-beasiswaTA.php">
                                            <span>&bull; Beasiswa Tugas Akhir</span>
                                        </a>
                                    </li>
                                    <li <?php echo $pC; ?>>
                                        <a href="/user/beasiswa/penerima-beasiswaC.php">
                                            <span>&bull; Beasiswa Coass </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                       
                        </ul>
                    </li>
                    <li <?php echo $modLap; ?>>
                        <a href="#" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo $lpP; ?>>
                                <a href="/user/laporan/lap-pemohon.php"><span>&bull; Daftar Pemohon Beasiswa</span></a>
                            </li>
                            <li <?php echo $lpN; ?>>
                                <a href="/user/laporan/lap-penerima.php"><span>&bull; Daftar Penerima Beasiswa</span></a>
                            </li>
                            <li <?php echo $lBA; ?>>
                                <a href="/user/laporan/berita-acara-verifikasi.php"><span>&bull; Berita Acara Verifikasi</span></a>
                            </li>
                            <!-- <li <?php echo $dreg; ?>>
                                <a href="/user/laporan/daftar-registrasi.php"><span>&bull; Daftar Registrasi</span></a>
                            </li> -->
                        </ul>
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
                <li role="presentation" class="active"><a href="/inc/assets/#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="/inc/assets/#settings" data-toggle="tab">SETTINGS</a></li>
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
                            <form method="post">
                            <li>
                                <label>Periode</label>
                                <div>
                                    <span><?php echo $periode; ?></span>
                                </div>
                            </li>
                            <li>
                                <label>Tanggal Buka</label>
                                <div>
                                    <span><?php echo tglWaktu($tglB); ?></span>
                                </div>
                            </li>
                            <li>
                                <label>Tanggal Tutup </label>
                                <div>
                                    <span><?php echo tglWaktu($tglT); ?></span>
                                </div>
                            </li>
                            </form>
                        </ul>
                       <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <form method="post">
                            <li>
                                <span>Sistem Beasiswa</span>
                                <div class="switch">
                                    <label><input type="checkbox" class="set" id="sistem" <?php echo $sistem_beasiswa; ?>><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Status Penerimaan</span>
                                <div class="switch">
                                    <label><input type="checkbox" class="set" id="tutup" <?php echo $status_penerimaan; ?>><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Notifikasi Penerima</span>
                                <div class="switch">
                                    <label><input type="checkbox" class="set" id="notif" <?php echo $notifikasi; ?>><span class="lever"></span></label>
                                </div>
                            </li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
<!------------------------------- SELESAI SIDE BAR SEBELAH KANAN ------------------------------- -->
   
    </section>


                <div class="modal fade" id="modal-wall" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" id="mdb">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('/inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">image</i> <span style="position:relative; top:-5px;" id="modal-titlex">User Image Background</span></div>

                        </div>
                        <div class="modal-body">
                        <form id="form1" method="post" enctype="multipart/form-data">
                            <div class="col-md-6" align="center">
                                <div style="background:url('/inc/assets/images/bg1.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg1" class="bg filled-in" name="bg1">
                                    <label for="bg1"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg2.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg2" class="bg filled-in" name="bg2">
                                    <label for="bg2"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg3.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg3" class="bg filled-in" name="bg3">
                                    <label for="bg3"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg4.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg4" class="bg filled-in" name="bg4">
                                    <label for="bg4"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg5.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg5" class="bg filled-in" name="bg5">
                                    <label for="bg5"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                            </div>
                            <div class="col-md-6" align="center">
                                <div style="background:url('/inc/assets/images/bg6.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg6" class="bg filled-in" name="bg6">
                                    <label for="bg6"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg7.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg7" class="bg filled-in" name="bg7">
                                    <label for="bg7"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg8.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg8" class="bg filled-in" name="bg8">
                                    <label for="bg8"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg9.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg9" class="bg filled-in" name="bg9">
                                    <label for="bg9"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                                <div style="background:url('/inc/assets/images/bg10.jpg') no-repeat; background-size:300px 135px; width:300px; height:135px;">
                                    <input type="checkbox" id="bg10" class="bg filled-in" name="bg10">
                                    <label for="bg10"><img src="/inc/assets/images/bgT.png" style="width:270px; height:135px;"></label>                                
                                </div> <br>
                            </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>