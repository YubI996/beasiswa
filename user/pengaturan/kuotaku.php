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


    <section class="content" style>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA KUOTA BEASISWA
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
                            <input type="text" name="" id="id_kuota" style="display: none;">
                                <label for="periode">Kategori</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option></option>
                                            <option value="beasiswa_pr">Beasiswa Prestasi</option>
                                            <option value="beasiswa_ta">Beasiswa Tugas Akhir</option>
                                            <option value="beasiswa_coass">Beasiswa Coass</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="periode">Jenjang</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="jenjang" id="jenjang">
                                            <option></option>
                                            <option value="d3">D3</option>
                                            <option value="d4">D4</option>
                                            <option value="s1">S1</option>
                                            <option value="s2">S2</option> 
                                        </select>
                                    </div>
                                </div>
                                <label for="periode">Daerah</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="daerah" id="daerah"> 
                                            <option></option>
                                            <option value="luar">Luar Daerah</option>
                                            <option value="dalam">Dalam Daerah</option>
                                        </select>
                                    </div>
                                </div>  
                                <label for="periode">Kuota IPA</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kuota_ipa" name="kuota_ipa" class="form-control" placeholder="Masukkan batas kuota IPA">
                                    </div>
                                </div>
                                <label for="periode">Kuota IPS</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kuota_ips" name="kuota_ips" class="form-control" placeholder="Masukkan batas kuota IPS">
                                    </div>
                                </div> 
                                <label for="periode">Kuota Defaults</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kuota_default" name="kuota_default" class="form-control" placeholder="Masukkan batas kuota IPS">
                                    </div>
                                </div> 
                                <label for="periode">IPK IPA</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="ipk_ipa" name="ipk_ipa" class="form-control" placeholder="Masukkan batas minimum IP/IPK">
                                    </div>
                                </div>
                                <label for="periode">IPK IPS</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="ipk_ips" name="ipk_ips" class="form-control" placeholder="Masukkan batas minimum IP/IPK">
                                    </div>
                                </div> 
                                <label for="periode">IPK Default</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="ipk_default" name="ipk_default" class="form-control" placeholder="Masukkan batas minimum IP/IPK">
                                    </div>
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
    <script src="kuotaku.js"></script>

<script type="text/javascript"> 

</script>