<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>e-Beasiswa Bontang</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet"> 
    <link href="css/lightbox.css" rel="stylesheet"> 
  <link href="css/login-form.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
    <!--WaitMe Css-->
    <link href="../inc/assets/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/beasiswa/logo2.png">
    <link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
<style type="text/css">
  body.modal-open .login-form{
    -webkit-filter: blur(4px);
    -moz-filter: blur(4px);
    -o-filter: blur(4px);
    -ms-filter: blur(4px);
    filter: blur(4px);   
filter:progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');
}





/* Tooltip */
.form-group span {
  display:block;
  position:relative;
  bottom:100%;
  left:0px;
  margin-top:0.2em;
  font-size:11px;
  font-weight:bold;
  color:white;
  white-space:nowrap;
  line-height:normal;
  padding:.6em 1em;
  background-color:#F44336;
  -webkit-border-radius:3px;
  -moz-border-radius:3px;
  border-radius:3px;
  /*visibility:hidden;
  opacity:0;
  /* Transition effect */
  -webkit-transition:all .2s ease-out;
  -moz-transition:all .2s ease-out;
  -ms-transition:all .2s ease-out;
  -o-transition:all .2s ease-out;
  transition:all .2s ease-out;
}

/* Tooltip arrow */
.form-group span:after {
  content:"";
  display:block;
  width:0;
  height:0;
  border-bottom: 8px solid #F44336;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
  position:absolute;
  bottom:100%;
  left:2em;
  border-top-color:#F44336;
}
</style>
</head><!--/head-->

<body>
<div class="login-form">
<div class="col-md-4"></div>
                <div class=" col-sm-12 col-md-4">
                        <center>
                        <a href="index.php"><img src="images/beasiswa/logo11.png" style="width: 85%;"></center></a>
                    <div class="contact-form bottom login-box" id="card1">
                        <div class="login-title"><b>Silakan Log in</b> ke akun Anda</div>
                        <form id="login-form" method="post" >
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" required placeholder="Username">
                                <span id="v1" style="background:#F44336;color:#fff;border-radius:5px 5px 5px 5px; display:none;">*Harus Diisi!<a href="#" class="btc" style="color:#fff;float:right;margin-top:-13px;">X</a></span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
                                <span id="v2" style="background:#F44336;color:#fff;border-radius:5px 5px 5px 5px; display:none;">*Harus Diisi!<a href="#" class="btc" style="color:#fff;float:right;margin-top:-13px;">X</a></span>
                            </div>
                            <button type="reset" class="btn btn-danger" id="btn-reset" style="display:none;">reset</button>
                        </form>
                            <div class="form-group">
                                <button type="submit" id="btn-login" name="submit" class="btn btn-submit">LOGIN</button>
                            </div>
                            <a href="#" data-target="#modalUser1" data-toggle="modal"   data-backdrop="static" data-keyboard="false">Lupa password ?</a>

                        <div class="login-or">| |</div>
                    <div class="form-group">
                            <a href="#" class="btn btn-register" data-target="#modalUser" data-toggle="modal"   data-backdrop="static" data-keyboard="false" > REGISTRASI</a>
                    </div>


                    </div>
                </div>
  
<div class="col-md-4"></div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; 2017 Diskominfo Bontang | e-Beasiswa Bontang - Created by Cyber Creative Team</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->
<!------------------------------------------- FORM REGISTRASI MAHASISWA ---------------------------------------------------->
<div id="modalUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" style="background:url('../home/images/404-bg1.png') no-repeat; background-size:cover; color:#0D7898;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text"></i>&nbsp;&nbsp;<b>Registrasi User</b></h4>
        </div>

        <div class="modal-body">
         <form name="modal_popup" enctype="multipart/form-data" method="POST" id="card2">
            
                <div class="form-group" id="kG" >
                  <label for="Kode Grup">No. KTM (Kartu Tanda Mahasiswa)</label>
                  <input type="text" name="ktm" id="ktm1"  class="form-control" placeholder="No. KTM" required/>
                    <div style="color:#f00;font-size:12px;" id="v3"></div>
                </div>

                <div class="form-group" id="kG" >
                  <label for="Kode Grup">No. KTP (Kartu Tanda Penduduk)</label>
                  <input type="text" name="ktp" id="ktp1"  class="form-control" placeholder="No. KTP" required/>
                    <div style="color:#f00;font-size:12px;" id="v4"></div>
                </div>

                <div class="form-group" >
                  <label for="Modal Name">Nama Lengkap</label>
                  <input type="text" name="nama" id="nama1"  class="form-control" placeholder="Nama Lengkap" required/>
                    <div style="color:#f00;font-size:12px;" id="v5"></div>
                </div>

                <div class="form-group" >
                  <label for="Description">Email</label>
                  <input type="text" name="email" id="email1"  class="form-control" placeholder="Email" required />
                    <div style="color:#f00;font-size:12px;" id="v6"></div>
                </div> 
            </div>
              <div class="modal-footer">
              <input type="reset" id="btn-reset1" style="display: none;">
              </form>
                  <button type="submit" class="btn btn-success" type="submit" id="btn-register">Simpan</button>
                  <button type="reset" class="btn btn-danger"   data-dismiss="modal"   aria-hidden="true" id="btl">
                    Batal
                  </button>
              </div>
           
        </div>
    </div>
</div>


<!------------------------------------------- FORM RESET PASSWORD ---------------------------------------------------->
<div id="modalUser1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content" id="card3">

      <div class="modal-header" style="background:url('../home/images/404-bg1.png') no-repeat; background-size:cover; color:#0D7898;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text"></i>&nbsp;&nbsp;<b>Reset Password</b></h4>
        </div>

         <form name="modal_popup1" id="respasswd" method="POST"> 
        <div class="modal-body">
                <div class="form-group" >
                  <label for="Description">Email</label>
                  <input type="email" name="email2" id="email2"  class="form-control" placeholder="Masukkan email yang terdaftar di aplikasi" required />
                    <div style="color:#f00;font-size:12px;" id="v61"></div>
                </div> 
            </div>
              <div class="modal-footer">
              <input type="reset" id="btn-reset1" style="display: none;">
                  <button type="submit" class="btn btn-success" type="submit" id="respass">Kirim</button>
                  <button type="reset" class="btn btn-danger"   data-dismiss="modal"   aria-hidden="true" id="btl1">
                    Batal
                  </button>
              </div>
              </form>
           
        </div>
    </div>
</div>




<script src="../home/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="../home/js/jquery.js"></script>
    <script type="text/javascript" src="../home/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../home/js/lightbox.min.js"></script>
    <script type="text/javascript" src="../home/js/wow.min.js"></script>
    <script type="text/javascript" src="../home/js/main.js"></script>   
  <script type="text/javascript" src="../home/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Wait Me Plugin Js -->
    <script src="../inc/assets/plugins/waitme/waitMe.js"></script>
    <script type="text/javascript" src="login-register.js"></script>   
</div>


</body>
</html>
<!--$('#myModal').modal({
    backdrop: 'static',
    keyboard: false
}) -->