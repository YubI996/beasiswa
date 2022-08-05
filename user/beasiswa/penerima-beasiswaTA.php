<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'PbeasiswaTA';
require_once ($host1."/inc/assets/header.php");   


$qp = $con->prepare("SELECT * FROM set_beasiswa");
$qp->execute();
$dp = $qp->fetch();
$dpr = $dp['periode'];
$bpr = $dp['batas_ta'];

$ql = $con->prepare("SELECT penetapan FROM periode WHERE periode='$dpr'");
$ql->execute();
$dl = $ql->fetch();
 
?>

<style type="text/css">
    .lolos {
        background: #cedcf5 !important;
    }
    .tolak {
        background: #fde1e1 !important;
    } 
    
</style>
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


<input type="text" id="bpr" value="<?php echo $bpr; ?>" name="" style="display: none;">
<input type="text" id="dpr" value="<?php echo $dpr; ?>" name="" style="display: none;">
    <section class="content">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA PENERIMA BEASISWA TUGAS AKHIR <?php echo $dpr; ?>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table style="width:100%;">
                                <tr>
                                    <td>
                                        <div class="col-md-2">       
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                            </div>                                       
                                        </div>                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                   <input type="text" id="col2_filter" name="daerah" class="form-control column_filter" data-column="2" placeholder="Filter Daerah">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                   <input type="text" id="col3_filter" name="bidang" class="form-control column_filter" data-column="3" placeholder="Filter Bidang Ilmu">
                                                </div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                   <input type="text" id="col4_filter" name="jenjang" class="form-control column_filter" data-column="4" placeholder="Filter Jenjang">
                                                </div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                   <input type="text" id="col5_filter" name="periode" class="form-control column_filter" data-column="5" placeholder="Filter Periode">
                                                </div>
                                            </div>                                       
                                        </div>
                                    </td>
                                    <!--<td>  
                                                <select id="periode1" class="form-control pull-right select-filter" data-live-search="true">
                                                    <option value="" selected>*Semua Periode</option>
                                                    <?php
                                                    /*
                                                    $sql = $con->prepare("SELECT * FROM periode");
                                                    $sql->execute();
                                                    while($d=$sql->fetch()){            
                                                    ?>
                                                    <option value="<?php echo $d['periode']; ?>"><?php echo $d['periode']; ?></option>
                                                    <?php
                                                    }*/
                                                    ?>
                                                </select>
                                        
                                    </td> -->
                                </tr>
                            </table>
 
                            <div id="view"></div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
            <!-- #END# Basic Examples -->







<!-- modal file 1 -->
            <div class="modal fade" id="form-file1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md1"></span></div>

                        </div>
                        <div class="modal-body">      
                            <div class="table-responsive">
                               <input type="hidden" id="tabs2" name="tabs2" class="form-control">


                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs">
                                <li role="presentation" class="active"><a id="5" onclick="tabN(5);"  href="#pemohon" data-toggle="tab">PEMOHON</a></li>
                                <li role="presentation"><a id="6"  href="#berkas" onclick="tabN(6)"   disabled="" data-toggle="tab">BERKAS</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="pemohon">
                                    <div class="col-md-2" id="imgMhs"></div>
                                    <div class="col-md-10" id="dataMhs"></div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="berkas">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group" id="cekSP">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSP1"></span></a></div>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group" id="cekAK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAK1"></span></a></div>
                                    </div>
                                    <label for="user">Surat Keterangan Penelitian</label>
                                    <div class="form-group" id="cekSPN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSPN1"></span></a></div>
                                    </div>
                                    <label for="user">Proposal Penelitian Asli </label>
                                    <div class="form-group" id="cekPR1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="filePR11"></span></a></div>
                                    </div>
                                    <label for="user">Lembar Pengesahan Pembimbing (Asli)</label>
                                    <div class="form-group" id="cekPR2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="filePR21"></span></a></div>
                                    </div>
                                    <label for="user">Surat Keterangan TA</label>
                                    <div class="form-group" id="cekSTA">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSTA1"></span></a></div>
                                    </div>
                                    <label for="user">Transkrip Nilai Terakhir</label>
                                    <div class="form-group" id="cekKhs">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKhs1"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Bekerja</label>
                                    <div class="form-group" id="cekSK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSK1"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Menerima Beasiswa</label>
                                    <div class="form-group" id="cekSB">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSB1"></span></a></div>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group" id="cekKtm">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtm1"></span></a></div>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <!--<label for="user">Akta Kelahiran</label>
                                    <div class="form-group" id="cekAkta">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAkta1"></span></a></div>
                                    </div>-->
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group" id="cekKk">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKk1"></span></a></div>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group" id="cekKtp">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtp1"></span></a></div>
                                    </div>
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group" id="cekDom">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileDom1"></span></a></div>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group" id="cekSN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSN1"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group" id="cekS1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS11"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group" id="cekS2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS21"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group" id="cekS3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS31"></span></a></div>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group" id="cekBurek">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileBR1"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group" id="cekIjz1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileIjz11"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Perguruan Tinggi Sebelumnya</label>
                                    <div class="form-group" id="cekIjz2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileIjz21"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 --></div>
                                    <button type="reset" id="btn-reset"></button>
                                   </div>
                                   </div>
                            </div>
                        </div>


                         
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev1" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next1" style="color:#fff;">SELANJUTNYA</button>
                              <button type="button" class="btn btn-danger waves-effect" id="btn-tutup" data-dismiss="modal">TUTUP</button>
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
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md"></span></div>

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
    <script src="penerima-beasiswaTA.js"></script>

<script type="text/javascript">

$('input.vr').on('change', function(){ // on change of state
   $('input.vr').not(this).prop('checked', false);
   $('.vdt').html('');
   var vR = $(this).attr('value');
   $("#vR").val(vR);
});

$('#periode1').on('change', function(){ // on change of state
            var prd = $('#periode1').val();
            $("#view").load('penerima-beasiswaTA-data.php?prd='+prd);
});


$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

</script>