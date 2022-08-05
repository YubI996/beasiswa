<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'lapPemohon';
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
                                LAPORAN PEMOHON BEASISWA PEMKOT BONTANG
                            </h2>
                        </div>
                        <div class="body">
                            <form>
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
                                                    <option value="P" >Potrait</option>
                                                    <option value="L" selected>Landscape</option>
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
                                                <select id="kertas" class="form-control pull-right" data-v="v4" data-live-search="true">
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
                                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                        <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" id="btn-cetak" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal">EXPORT PDF</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
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
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title">LAPORAN DATA PEMOHON </span></div>

                        </div>
                        <div class="modal-body" id="report">
                        </div>
                    </div>
                </div>
            </div>


<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="lap-pemohon.js"></script>
