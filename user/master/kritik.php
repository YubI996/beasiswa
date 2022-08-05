<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'kritik';
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
                                DATA KRITIK DAN SARAN PENGUNJUNG
                            </h2>
                        </div>
                        <div class="body table-responsive">

						<div id="view"></div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
            <!-- #END# Basic Examples -->





            <!-- Default Size -->
            <div class="modal fade" id="form-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <form id="form1" method="post" enctype="multipart/form-data">
                                
                                        <input type="hidden" id="id_pengumuman" name="id_pengumuman" class="form-control" placeholder="Masukkan pengumuman">
                                        <input type="hidden" id="isipengumuman" name="isipengumuman" />
                                <label for="pengumuman">Judul</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan Judul pengumuman">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v1"></span>
                                </div>
                                <label for="pengumuman">Isi Pengumuman</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="isi" name="isi" required>
                                        </textarea>
                                    </div>
                                    <span style="color:#f00;font-size:12px;" id="v3"></span>
                                </div>
                                        <input type="hidden" id="ceklis" name="ceklis" class="form-control" value="0" placeholder="Masukkan pengumuman">
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                        </div>
                        <div class="modal-footer"> 

                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-ubah">UBAH</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Default Size -->
            <div class="modal fade" id="modal-file" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
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
    <script src="kritik.js"></script>

<script type="text/javascript">

//fungsi agar scrolling multiple modal tetap ada
$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});
</script>