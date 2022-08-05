<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beranda';
require_once ($host1."/inc/assets/header.php");

$sqlx = $con->prepare("SELECT * FROM set_beasiswa");
$sqlx->execute();
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
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
              <!-- Task Info -->
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="info-box bg-light-green hover-expand-effect" style="height:100px;">
                        <div class="icon">
                            <i class="material-icons">query_builder</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS PENERIMAAN</div>
                            <div>
                                <?php 
                                    if ($dx['status_penerimaan'] == 0){
                                        echo 'Telah diTutup';
                                    }else{
                                        echo 'Penerimaan dibuka ';
                                    ?>
                                <br>Sisa Waktu :
                                <div id="sw"><?php echo batasKumpul($dx['tgl_tutup']); ?></div>
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="info-box bg-deep-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">notifications_none</i>
                        </div>
                        <div class="content">
                            <div class="text">NOTIFIKASI PENERIMA</div>
                            <div>
                                <?php 
                                    if ($dx['notifikasi'] == 0){
                                        echo 'Tidak Aktif';
                                    }else{
                                        echo 'Aktif ';
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                    <?php
                        if ($dx['status_penerimaan'] == 1) {
                    ?>
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">publish</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS PUBLISH</div>
                            <div>
                                <?php 
                                    if ($dx['publish'] == 0){
                                        echo 'Belum diPublikasikan, Masih dalam proses penerimaan';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }else if($dx['status_penerimaan'] == 0 && $dx['status_beasiswa'] == 1){
                    ?>
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">publish</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS PUBLISH</div>
                            <div>
                                <?php 
                                    if ($dx['publish'] == 0){
                                        echo 'Belum diPublikasikan';
                                        echo '

                                        ';
                                    }else{
                                        echo 'Sudah diPublikasikan';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <a href="#" id="publish" class="btn btn-circle-lg bg-orange waves-effect" data-trigger="hover" data-container="body" data-toggle="popover"
                    data-placement="right" title="Publish Pengumuman Penerima" data-content="Jika Proses Verifikasi telah selesai, Anda dapat mempublikasikan pengumuman hasil seleksi penerima Beasiswa Pemkot Bontang periode <?php echo $dx['perioe']; ?> .">
                    <i class="material-icons">visibility</i></a>

                    <?php
                        }else if($dx['status_penerimaan'] == 0 && $dx['status_beasiswa'] == 0){
                            ?>
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">publish</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS PUBLISH</div>
                            <div>
                                <?php 
                                        echo 'Sudah dipublish dan sistem telah dimatikan';
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card" id="card1">
                        <div class="header">
                            <h2>
                                PENGATURAN SISTEM
                            </h2>
                        </div>
                        <div class="body">
                                <form id="form1" method="post" enctype="multipart/form-data">
                                    <label for="user">Periode yang digunakan</label>
                                    <div class="form-group">
                                                <select id="periodee1" class="form-control pull-right" data-live-search="true">
                                                    <?php
                                                    $sql = $con->prepare("SELECT * FROM periode");
                                                    $sql->execute();
                                                    while($d=$sql->fetch()){  
                                                            if ($dx['periode'] == $d['periode']) {
                                                                $s = "selected";
                                                            }else{
                                                                $s = '';
                                                            }          
                                                    ?>
                                                    <option value="<?php echo $d['periode']; ?>" <?php echo $s; ?>><?php echo $d['periode']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                    </div><br>
                                    <label for="user">Batas Penerima Beasiswa Prestasi</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="pp" name="pp" class="form-control" placeholder="<?php echo $dx['batas_prestasi']; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v1"></span>
                                    </div>
                                    <label for="user">Batas Penerima Beasiswa Tugas Akhir</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="pta" name="pta" class="form-control" placeholder="<?php echo $dx['batas_ta']; ?>"  value="">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v2"></span>
                                    </div>
                                    <label for="user">Tanggal Buka Penerimaan Beasiswa</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                               <input type="text" id="tglB" name="tglB" class="datetimepicker form-control"  placeholder="<?php echo tglWaktu($dx['tgl_buka']); ?>">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v21"></span>
                                    </div>
                                    <label for="user">Tanggal Tutup Penerimaan Beasiswa</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                               <input type="text" id="tglT" name="tglT" class="datetimepicker form-control"  placeholder="<?php echo tglWaktu($dx['tgl_tutup']); ?>">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                    </div>
                                    <br>
                                    <button type="reset" id="btn-reset"></button>
                                </form>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn-ubah">SIMPAN</button>
                                    <div class="help-info pull-right" style="color:red;">*Ket : Isi form jika ingin mengganti &nbsp;</div>
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
     <!-- Light Gallery Plugin Js -->
    <script src="../inc/assets/plugins/light-gallery/js/lightgallery-all.js"></script>

   <script src="sistem.js"></script>

<script type="text/javascript">
$('[data-toggle="popover"]').popover();
$(function () {

    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        clearButton: true,
        weekStart: 1
    });

});
$('.cek1').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
    var id = $(this).attr("data-h");
    var dv = $(this).attr("data-v");
   if(this.checked) // jika di centang
    {
        $("#"+id).show(); // tampilkan field foto  
    }else{
        document.getElementById(dv).innerHTML = '';
        $("#"+id).hide(); // tampilkan field foto  
          
    }
});


</script>





