<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beranda';
require_once ($host1."/inc/assets/header.php");
 
?>
   <div class="page-loader-wrapper" id="loading">
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

    <!-- Light Gallery Plugin Css -->
    <link href="../inc/assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

    <section class="content" style>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                LOGO APLIKASI
                            </h2>
                        </div>
                        <div class="body">
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="../inc/images/<?php echo $logo_title; ?>" data-sub-html="Logo Title">
                                        <img class="img-responsive thumbnail" src="../inc/images/<?php echo $logo_title; ?>">
                                    </a>
                                    <center>Logo Title</center>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="../inc/images/<?php echo $logo_front; ?>" data-sub-html="Logo Halaman Depan">
                                        <img class="img-responsive thumbnail" src="../inc/images/<?php echo $logo_front; ?>">
                                    </a>
                                    <center>Logo Halaman Depan</center>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="../inc/images/<?php echo $logo_user; ?>" data-sub-html="Logo Halaman User">
                                        <img class="img-responsive thumbnail" src="../inc/images/<?php echo $logo_user; ?>">
                                    </a>
                                    <center>Logo Logo Halaman User</center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
               <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" id="card1">
                        <div class="body">
                                <form id="form1" method="post" enctype="multipart/form-data">
                                    <label for="user">Title Aplikasi</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="title" name="title" class="form-control" placeholder="<?php echo $title; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v1"></span>
                                    </div>
                                    <label for="user">Judul Tag Halaman Depan</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="jft" name="jft" class="form-control" placeholder="<?php echo $judul_tag_front; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v2"></span>
                                    </div>
                                    <label for="user">Tag Halaman Depan</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                            <textarea class="form-control" id="tf" name="tf" placeholder="<?php echo $tag_front; ?>"></textarea>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v21"></span>
                                    </div>
                                    <label for="user">Versi Aplikasi</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="versi" name="versi" class="form-control" placeholder="<?php echo $versi; ?>"  value="">
                                        </div>
                                            <div class="help-info">MAJOR . MINOR . PATCH</div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                    </div>
                                    <label for="user">Owner</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="owner" name="owner" class="form-control" placeholder="<?php echo $owner; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v4"></span>
                                    </div>
                                    <label for="password">Logo Title</label>
                                    <div class="form-group" id="cek-foto1">
                                        <input type="checkbox" id="cek1" class="cek1" data-h="logoT" data-v="v5"  name="cek1">
                                        <label for="cek1">Centang jika ingin mengganti Logo Title</label>
                                    </div>
                                    <div id="logoT">
                                        <div class="form-group">
                                            <div class="form-line fr">
                                               <input type="file" id="logo1" name="logo1" class="form-control" >
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" id="v5"></span>
                                        </div>
                                    </div>
                                    <label for="user">Logo Halaman Depan</label>
                                    <div class="form-group" id="cek-foto2">
                                        <input type="checkbox" id="cek2" class="cek1" data-h="logoF" data-v="v6" name="cek2">
                                        <label for="cek2">Centang jika ingin mengganti Logo Halaman Depan</label>
                                    </div>
                                    <div id="logoF">
                                        <div class="form-group">
                                            <div class="form-line  fr">
                                                <input type="file" id="logo2" name="logo2" class="form-control" >
                                            </div>
                                            <span style="color:#f00;font-size:12px;" id="v6"></span>
                                        </div>
                                    </div>
                                    <label for="user">Logo Halaman User</label>
                                    <div class="form-group" id="cek-foto3">
                                        <input type="checkbox" id="cek3" class="cek1" data-h="logoU" data-v="v7" name="cek3">
                                        <label for="cek3">Centang jika ingin mengganti Logo Halaman User</label>
                                    </div>
                                    <div id="logoU">
                                        <div class="form-group">
                                            <div class="form-line  fr">
                                                <input type="file" id="logo3" name="logo3" class="form-control" >
                                            </div>
                                            <span style="color:#f00;font-size:12px;" id="v7"></span>
                                        </div>
                                    </div>
                                    <button type="reset" id="btn-reset"></button>
                                </form>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn-ubah">SIMPAN</button>
                                    <div class="help-info pull-right" style="color:#f00;">*Ket : Isi form jika ingin mengganti &nbsp;</div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
                </div>
            </div>
        </section>



<?php
    require_once ($host1."/inc/assets/footer.php");
?>
     <!-- Light Gallery Plugin Js -->
    <script src="../inc/assets/plugins/light-gallery/js/lightgallery-all.js"></script>

   <script src="aplikasi.js"></script>

<script type="text/javascript">
$('.cek1').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
    var id = $(this).attr("data-h");
    var dv = $(this).attr("data-v");
   if(this.checked) // jika di centang
    {
        $("#"+id).show(); // tampilkan field foto  
    }else{
        document.getElementById(dv).innerHTML = '';
        $("#"+id).hide(); // tampilkan field foto  
          
    }
});


</script>

</div>




