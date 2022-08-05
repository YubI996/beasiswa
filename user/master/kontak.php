<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'kontak';
require_once ($host1."/inc/assets/header.php"); 

    $sqlx = $con->prepare("SELECT * FROM kontak");
    $sqlx->execute(); // Eksekusi querynya
    $dx = $sqlx->fetch();
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
                    <div class="card" id="card1">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA KONTAK
                            </h2>
                        </div>
                        <div class="body table-responsive">

						<div id="view1">
                        <div id="view"></div>
                        <form id="form1" method="post" enctype="multipart/form-data">
                                <label for="user">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo $dx['email']; ?>">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v1"></span>
                                </div>
                                <label for="user">No. Telepon</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="telp" name="telp" class="form-control" placeholder="<?php echo $dx['no_telp']; ?>">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v2"></span>
                                </div>
                                <label for="user">Fax</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="fax" name="fax" class="form-control" placeholder="<?php echo $dx['fax']; ?>">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v3"></span>
                                </div>
                                <label for="user">Alamat</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <textarea id="alamat" name="alamat" class="form-control" placeholder="<?php echo $dx['alamat']; ?>"></textarea>
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v4"></span>
                                </div>
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                        </div> 
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button>
                            

                        </div>
                    </div>
                </div>
            </div>
    </section>
            <!-- #END# Basic Examples -->



<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="kontak.js"></script>

<script type="text/javascript">

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





