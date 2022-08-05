<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'periode';
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
                                DATA PERIODE
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





            <!-- Default Size -->
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
                        <form id="form1" method="post" enctype="multipart/form-data">
                                <label for="periode">Periode</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="id_periode" name="id_periode" class="form-control" placeholder="Masukkan periode">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="periode" name="periode" class="required form-control" placeholder="Masukkan periode" required >
                                    </div>
                                    <span style="color:#f00;font-size:12px;" id="v1"></span>
                                </div>
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
  

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="periode.js"></script>

<script type="text/javascript">
    $("#form1").validate();

</script>