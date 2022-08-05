<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beritaAcara';
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
                                BERITA ACARA VERIFIKASI DATA
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal1"><i class="material-icons">settings</i>Atur Tampilan</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <div class="body">
                            <form>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                                <select id="dataT" class="form-control pull-right" data-v="vv41" data-live-search="true">
                                                    <option value="" disabled="">*Pilih Data yang akan ditampilkan</option>
                                                    <option value="4">Keseluruhan</option>
                                                    <option value="3"  selected>Penerima</option>
                                                    <option value="2" >Ditolak</option>
                                                    <option value="1" >Custom</option>
                                                </select>
                                                <span style="color:#f00;font-size:12px;" class="vdt" id="vv41"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                                        <div class="form-group form-float" id="fnama">
                                                <select id="cnama" class="form-control pull-right" data-v="v11" data-live-search="true">
                                                    <option value="" disabled selected>*Pilih Mahasiswa</option>
                                                    <?php
                                                    $sqlm = $con->prepare("SELECT m.id_mahasiswa, m.nama_mahasiswa, m.perguruan_tinggi, m.jurusan, u.id_user FROM mahasiswa m, user u WHERE m.id_user=u.id_user");
                                                    $sqlm->execute();
                                                    while($dm=$sqlm->fetch()){            
                                                    ?>
                                                    <option value="<?php echo $dm['id_mahasiswa']; ?>"><?php echo $dm['nama_mahasiswa'].' - '.$dm['perguruan_tinggi'].' ('.$dm['jurusan'].')'; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="v11"></span>
                                    </div>
                                </div>

                                <div class="row clearfix">                                
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                                <select id="periode" class="form-control pull-right" data-v="v1" data-live-search="true">
                                                    <option value="" selected>*Pilih Periode</option>
                                                    <?php
                                                    $sql = $con->prepare("SELECT * FROM periode");
                                                    $sql->execute();
                                                    while($d=$sql->fetch()){            
                                                    ?>
                                                    <option value="<?php echo $d['periode']; ?>"><?php echo $d['periode']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span style="color:#f00;font-size:12px;" class="vdt" id="v1"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                                <select id="kategori" class="form-control pull-right" data-v="v2" data-live-search="true">
                                                    <option value="" selected>*Pilih Kategori</option>
                                                    <option value="beasiswa_prestasi" >Beasiswa Prestasi</option>
                                                    <option value="beasiswa_ta" >Beasiswa TA</option>
                                                    <option value="beasiswa_coass" >Beasiswa Coass</option>
                                               </select>
                                                <span style="color:#f00;font-size:12px;" class="vdt" id="v2"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group form-float" id="layout1">
                                                <select id="layout" class="form-control" data-v="v3">
                                                    <option value="" >*Pilih Orientasi Halaman</option>
                                                    <option value="P" selected >Potrait</option>
                                                    <option value="L">Landscape</option>
                                                </select>
                                                <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                        </div>
                                        <div class="form-group form-float" id="layout2">
                                                <select class="form-control" data-v="v3" disabled>
                                                    <option value="" >*Custom</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                                <select id="kertas" class="form-control pull-right" data-v="vv4" data-live-search="true">
                                                    <option value="" >*Pilih Ukuran Kertas</option>
                                                    <option value="A4" selected>A4</option>
                                                    <option value="Legal" >Legal</option>
                                                    <option value="Letter" >Letter</option>
                                                    <option value="A3" >A3</option>
                                                    <option value="custom" >Custom</option>
                                                </select>
                                                <span style="color:#f00;font-size:12px;" class="vdt" id="v4"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right">
                                        <div class="form-group form-float" id="uk">
                                            <div class="col-sm-6 form-line"><input type="text" id="lebar" class="form-control" placeholder="Lebar Kertas (mm)"></div>
                                            <div class="col-sm-6 form-line"><input type="text" id="tinggi" class="form-control" placeholder="Tinggi Kertas (mm)"></div>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="v8"></span>
                                        </div>
                                    </div>
                                    <button type="reset" id="btn-reset" style="display:none;"></button>
                            </form>



                        </div>
                            <div class="row">
                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                        <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" id="btn-cetak" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal">EXPORT PDF</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                        <button type="button" class="btn bg-indigo btn-lg m-l-15 waves-effect" id="btn-cetak2">EXPORT WORD</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                        <button type="button" class="btn btn-success btn-lg m-l-15 waves-effect" id="btn-cetak1">EXPORT EXCEL</button>
                                        </div>
                                    </div>
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
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title">LAPORAN DATA PENERIMA</span></div>

                        </div>
                        <div class="modal-body" id="report">
                        </div>
                    </div>
                </div>
            </div>
        </div>



            <div class="modal fade" id="form-modal1" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title"></span></div>

                        </div>
                        <div class="modal-body">
                            <?php 
                                $sqlk = $con->prepare("SELECT * FROM set_berita_acara");
                                $sqlk->execute();
                                $dk = $sqlk->fetch();
                            ?>
                                <form id="form1" method="post" enctype="multipart/form-data">
                                        <label for="periode">Judul</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="judul" name="judul" class="form-control" value="<?php echo $dk['judul']; ?>">
                                            </div>

                                        </div>
                                        <label for="periode">Isi</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea id="isi" name="isi" class="form-control" placeholder="" ><?php echo $dk['atas']; ?></textarea>
                                            </div>

                                        </div>
                                        <label for="periode">Penutup</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea id="penutup" name="penutup" class="form-control" placeholder="" ><?php echo $dk['isi']; ?></textarea>
                                            </div>

                                        </div>
                                        <label for="periode">Mengetahui</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="mengetahui" name="mengetahui" class="form-control" value="<?php echo $dk['mengetahui']; ?>" >
                                            </div>

                                        </div>
                                        <label for="periode">Penandatangan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="penandatangan" name="penandatangan" class="form-control" value="<?php echo $dk['penandatangan']; ?>" >
                                            </div>

                                        </div>
                                        <label for="periode">NIP</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nip" name="nip" class="form-control" value="<?php echo $dk['nip']; ?>" >
                                            </div>

                                        </div>
                                    </form>
                                
                        </div>
                        <div class="modal-footer"> 
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="berita-acara-verifikasi.js"></script>

<script type="text/javascript">
    $(function () {
tinymce.init({
    selector: "textarea",
    theme: "modern",
    menubar:false,
    paste_data_images: true,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",

    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../inc/assets/plugins/tinymce';
});

</script>