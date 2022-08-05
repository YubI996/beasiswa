<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'tentang';
require_once ($host1."/inc/assets/header.php");  

    $sqlx = $con->prepare("SELECT * FROM tentang");
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" id="card1">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA TENTANG
                            </h2>
                        </div>
                        <div class="body table-responsive">

						<div id="view1">
                        <div id="view"></div>
                        <form id="form1" method="post" enctype="multipart/form-data">
                                    <label for="user">Video</label>
                                    <div class="form-group" id="cek-video">
                                        <input type="checkbox" id="cek2" class="cek1" name="cek2">
                                        <label for="cek2">Centang jika ingin mengganti video</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line  fr">
                                            <input type="file" id="video" name="video" class="form-control vd" data-v="v1" placeholder="Cari Video">
                                        </div>
                                        <span style="color:#f00;font-size:12px;" id="v1"></span>
                                    </div>
                                <label for="user">Keterangan Video</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="kv" name="kv" class="form-control" placeholder="<?php echo $dx['ket_video']; ?>"></textarea>
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v2"></span>
                                </div>
                                <label for="user">Quote</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="quote" name="quote" class="form-control" placeholder="<?php echo $dx['quote']; ?>">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v3"></span>
                                </div>
                                <label for="user">Author Quote</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="aq" name="aq" class="form-control" placeholder="<?php echo $dx['author_quote']; ?>">
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
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <video width="100%" controls>
                              <source src="../inc/images/<?php echo $dx['video']; ?>">
                              Browser Anda tidak mendukung untuk menampilkan video ini.
                            </video>                            
                        </div>
                    </div>
                </div>
        </div>

</section>
            <!-- #END# Basic Examples -->


  

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="tentang.js"></script>

<script type="text/javascript">

$('.cek1').on('change', function(){ // fungsi ketika dicentang ceklis ubah video
   if(this.checked) // jika di centang
    {
        $("#video").show(); // tampilkan field video  
    }else{
        $("#video").hide(); 
        $("#video").val(''); 
        $("#v1").html(''); 
          
    }
});
//fungsi agar scrolling multiple modal tetap ada
$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});
</script>





