<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beranda';
require_once ($host1."/inc/assets/header1.php");

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

<div id="view"></div>

    <section class="content" style>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body">
                            <div style="width:100%;margin:0 15% 0 15%;">
                            <div class="image-cropper">
                                <img src="../user/master/foto_user/<?php echo $foto; ?>" alt="User" class="rounded1" />
                            </div>
                            </div>
                            <center style="margin-top:15px;"><b><?php echo $namaU; ?></b> <br> <?php echo $levelU; ?></center>
                            <br>Bergabung Sejak : &nbsp; <?php echo $sinceU; ?>  
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
               <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card" id="card1">
                        <div class="body">
                                <form id="form1" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?php echo $d['foto_user']; ?>" id="fl">
                                    <input type="hidden" value="<?php echo $d['level']; ?>" id="level">

                                    <label for="user">Nama User</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="nama" name="nama" class="form-control" placeholder="<?php echo $d['nama_user']; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v1"></span>
                                    </div>
                                    <label for="user">Email</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo $d['email']; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v2"></span>
                                    </div>
                                    <label for="user">Username</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="username" name="username" class="form-control" placeholder="<?php echo $d['username']; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                    </div>
                                    <label for="password">Password</label>
                                    <div class="form-group" id="cek-password">
                                        <input type="checkbox" id="cek1" class="cek2" name="cek1">
                                        <label for="cek1">Centang jika ingin mengganti password</label>
                                    </div>
                                    <div id="pass">
                                        <div class="form-group">
                                            <div class="form-line fr">
                                               <input type="password" id="passwordA" name="passwordA" class="form-control" placeholder="Masukkan Password Baru">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" id="v4"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line fr">
                                               <input type="password" id="passwordB" name="passwordB" class="form-control" placeholder="Masukkan Ulang Password Baru">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" id="v5"></span>
                                        </div>
                                    </div>
                                        <label for="user">Foto</label>
                                    <div class="form-group" id="cek-foto">
                                        <input type="checkbox" id="cek2" class="cek1" name="cek2">
                                        <label for="cek2">Centang jika ingin mengganti foto</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line  fr">
                                            <input type="file" id="foto" name="foto" class="form-control" placeholder="Cari Foto">
                                        </div>
                                        <span style="color:#f00;font-size:12px;" id="v6"></span>
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



<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="profil.js"></script>

<script type="text/javascript">
$('.cek1').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if(this.checked) // jika di centang
    {
        $("#foto").show(); // tampilkan field foto  
        $("#ceklis1").val('1'); // ubah value textbox ceklis menjadi 1
    }else{
        document.getElementById("v6").innerHTML = '';
        $("#foto").hide(); // jika tidak tercentang sembunyikan field foto
        $("#ceklis1").val('0'); //uah value textbox ceklis menjadi 0
          
    }
});

$('.cek2').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if(this.checked) // jika di centang
    {
        $("#pass").show(); // tampilkan field foto  
        $("#ceklis2").val('1'); // ubah value textbox ceklis menjadi 1
    }else{
        document.getElementById("v4").innerHTML = '';
        document.getElementById("v5").innerHTML = '';
        $("#pass").hide(); // tampilkan field foto  
        $("#ceklis2").val('0'); //uah value textbox ceklis menjadi 0
          
    }
});

</script>

</div>




