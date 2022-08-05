<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'user';
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


    <section class="content" style>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA USER
                            </h2>
                        </div>
                        <div class="body table-responsive">
                           <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah" data-target="#form-modal">Tambah Data <i class="material-icons" style="font-size:16px;" >playlist_add</i></button><br><br>

						<div id="view"></div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
            <!-- #END# Basic Examples -->




                                <div id="add">

            <!-- Modal add -->
            <div class="modal fade" id="form-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <form id="form11" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="fl">
                                <label for="user">Nama Lengkap</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="nama1" name="nama1" class="form-control" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v1"></span>
                                </div>
                                <label for="user">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="email" id="email1" name="email1" class="form-control" placeholder="Masukkan Email">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v2"></span>
                                </div>
                                <label for="user">Username</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="username1" name="username1" class="form-control" placeholder="Masukkan Username">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v3"></span>
                                </div>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="password" id="password1" name="password1" class="form-control" placeholder="Masukkan Password">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v4"></span>
                                </div>
                                <label for="user">Level</label>
                                <div class="form-group">
                                        <select class="form-control show-tick" id="level1" name="level1">
                                            <option value="">* Pilih Level User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Verifikator">Verifikator</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                        </select>
                                         <div style="color:#f00;font-size:12px;" id="v5"></div>
                                </div>
                                <div id="datamhs">
                                    <label for="user">No. KTM (Kartu Mahasiswa)</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="ktm1" name="ktm1" class="form-control" placeholder="Masukkan No. Kartu Mahasiswa">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v6"></span>
                                    </div>
                                    <label for="user">No. KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="ktp1" name="ktp1" class="form-control" placeholder="Masukkan No. Kartu Tanda Penduduk">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v7"></span>
                                    </div>
                                </div>
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                        </div>
                        <div class="modal-footer"> 


                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>

                                </div>






            <!-- Modal edit -->
            <div class="modal fade" id="form-modal1" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title1"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <form id="form2" method="post" enctype="multipart/form-data">
                            <input type="text" id="id_user" name="id_user" class="form-control"  style="display: none;">
                            <input type="text" id="ceklis1" name="ceklis1" class="form-control" value="0"  style="display: none;">
                            <input type="text" id="ceklis2" name="ceklis2" class="form-control" value="0"  style="display: none;">
                            <input type="text" id="cek-aktivasi" name="cek-aktivasi" class="form-control" style="display: none;">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs">
                                <li role="presentation" id="tab1" class="active"><a href="#akun" data-toggle="tab">DATA AKUN</a></li>
                                <li role="presentation" id="tab2" ><a href="#keamanan" data-toggle="tab">KEAMANAN</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="akun">
                                    <label for="user">Nama Lengkap</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="nama2" name="nama2" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v8"></span>
                                    </div>
                                    <label for="user">Email</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="email2" name="email2" class="form-control" placeholder="Masukkan Email">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v9"></span>
                                    </div>
                                    <label for="user">Foto User</label>
                                    <div class="form-group" id="cek-foto">
                                        <input type="checkbox" id="checkbox2" class="cek1" name="checkbox2">
                                        <label for="checkbox2">Centang jika ingin mengganti foto</label>
                                        <div id="idf"><a class="badge bg-indigo" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat Foto"><span id="nmfile"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line  fr">
                                            <input type="file" id="foto" name="foto" class="form-control" placeholder="Cari Foto">
                                        </div>
                                        <span style="color:#f00;font-size:12px;" id="v10"></span>
                                    </div>
                                    <label for="user">Level</label>
                                    <div class="form-group">
                                        
                                            <select id="level2" required name="level2" class="form-control lvl">
                                                    <option value="" disabled id="opt1">* Pilih Level User</option>
                                                    <option value="Admin" id="opt2">Admin</option>
                                                    <option value="Mahasiswa" id="opt3" >Mahasiswa</option>
                                                    <option value="Verifikator" id="opt4">Verifikator</option>
                                            </select>
                                                
                                            <div style="color:#f00;font-size:12px;" id="v11"></div>
                                    </div

                                    <label for="user">Aktivasi Akun</label>
                                    <div class="form-group">
                                        <div class="switch">
                                            <label><input type="checkbox" id="aktivasi2" class="cek3"><span class="lever switch-col-deep-purple"></span></label>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="keamanan">
                                    <label for="user">Username</label>
                                    <div class="form-group">
                                        <div class="form-line fr1">
                                           <input type="text" id="username2" name="username2" class="form-control" required placeholder="Masukkan Username">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v14"></span>
                                    </div>
                                <label for="password">Password</label>
                                <div class="form-group" id="cek-password">
                                    <input type="checkbox" id="checkbox1" class="cek2" name="checkbox1">
                                    <label for="checkbox1">Centang jika ingin mengganti password</label>
                                </div>
                                <div id="pass">
                                    <div class="form-group">
                                        <div class="form-line fr1">
                                           <input type="password" id="passwordA" name="passwordA" class="form-control" placeholder="Masukkan Password Baru">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v15"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr1">
                                           <input type="password" id="passwordB" name="passwordB" class="form-control" placeholder="Masukkan Ulang Password Baru">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" id="v16"></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                                    <button type="reset" id="btn-reset1"></button>
                            </form>
                        <div class="modal-footer"> 

                            <button type="button" class="btn btn-primary waves-effect" id="btn-ubah">UBAH</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Default Size -->
            <div class="modal fade" id="modal-file" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md">Lihat Data</span></div>

                        </div>
                        <div class="modal-body">
                        <div class="table-responsive" id="view-file">
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
  

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="user.js"></script>

<script type="text/javascript">
$('.cek1').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if(this.checked) // jika di centang
    {
        $("#foto").show(); // tampilkan field foto  
        $("#ceklis1").val('1'); // ubah value textbox ceklis menjadi 1
    }else{
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
        $("#pass").hide(); // tampilkan field foto  
        $("#ceklis2").val('0'); //uah value textbox ceklis menjadi 0
          
    }
});
$('.cek3').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if (this.checked) // jika di centang
    {
        $("#cek-aktivasi").val('1'); // tampilkan field foto  
    }else{
        $("#cek-aktivasi").val('0'); // jika tidak tercentang sembunyikan field foto
    }
});

$('#level1').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if ($(this).val() == 'Mahasiswa') // jika di centang
    {
        $("#datamhs").show(); // tampilkan field foto  
    }else{
        $("#datamhs").hide(); // jika tidak tercentang sembunyikan field foto
    }
});
/*
$('#level2').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if ($(this).val() == 'Mahasiswa') // jika di centang
    {
        $("#datamhs1").show(); // tampilkan field foto  
    }else{
        $("#datamhs1").hide(); // jika tidak tercentang sembunyikan field foto
    }
});*/



        $("#viewfile1").click(function(){ // Ketika tombol view di klik
            var idview = $(this).attr('id'); //ubah title modal view file
            var data1 = $('#'+idview).attr('data-foto'); //ambil data nama file dari atribut data-file
            $("#md").html('Foto Profil User - '+data1); //ubah title modal view file

                var vf = '<center><img src="foto_user/'+ data1 +'" style="height:auto; width:50%; "></center>'; //jika berekstensi gambar tampilkan sebagai gambar

            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
        });

//fungsi agar scrolling multiple modal tetap ada
$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});
</script>





