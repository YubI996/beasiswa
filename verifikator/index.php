<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beranda';
require_once ($host1."/inc/assets/header1.php");

$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
$sql1->execute();
$d1 = $sql1->fetch();
$periodee = $d1['periode'];

$sql2 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE periode='$periodee'");
$sql2->execute();
$sql2->fetch();
$dC = $sql2->rowCount();
$d2 = $sql2->fetch();

$sql3 = $con->prepare("SELECT * FROM beasiswa_ta WHERE periode='$periodee'");
$sql3->execute();
$sql3->fetch();
$dC1 = $sql3->rowCount();
$d3 = $sql3->fetch();

$sql4 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE status_verifikasi='0' AND  periode='$periodee'");
$sql4->execute();
$sql4->fetch();
$dCa = $sql4->rowCount();
$da = $sql4->fetch();

$sql5 = $con->prepare("SELECT * FROM beasiswa_ta WHERE status_verifikasi='0' AND periode='$periodee'");
$sql5->execute();
$sql5->fetch();
$dCb = $sql5->rowCount();
$db = $sql5->fetch();

$sql6 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND m.daerah='KALIMANTAN TIMUR'");
$sql6->execute();
$sql6->fetch();
$dCc = $sql6->rowCount();
$dc = $sql6->fetch();

$sql7 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND m.daerah='KALIMANTAN TIMUR'");
$sql7->execute();
$sql7->fetch();
$dCd = $sql7->rowCount();
$dd = $sql7->fetch();

$sql61 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND NOT m.daerah='KALIMANTAN TIMUR'");
$sql61->execute();
$sql61->fetch();
$dCc1 = $sql61->rowCount();
$dc1 = $sql61->fetch();

$sql71 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND NOT m.daerah='KALIMANTAN TIMUR'");
$sql71->execute();
$sql71->fetch();
$dCd1 = $sql71->rowCount();
$dd1 = $sql71->fetch();

$kuota_prestasi = $d1['batas_prestasi'];
$kuota_ta = $d1['batas_ta'];

$pendaftar_prestasi = $dC;
$pendaftar_ta = $dC1;

$pendaftar_dalam = $dCc + $dCd;
$pendaftar_luar = $dCc1 + $dCd1;

$tugas_verifikasi_pr = $dCa;
$tugas_verifikasi_ta = $dCb;




?>


<!------------------------------- ISI KONTEN / ISI WEB ------------------------------- -->

    <section class="content">
            <div class="block-header">
                <span style="font-weight:bold; font-size:25px;"><center>SELAMAT DATANG DI APLIKASI <img src="<?php echo $host.'/inc/images/brand.png'; ?>" style="height:45px; width:auto;"> BONTANG</center></span>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div><br>
                        <div class="content">
                            <div class="text">KUOTA PRESTASI<br>PERIODE <?php echo $periodee; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $kuota_prestasi; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">PENDAFTAR BEASISWA<br>PRESTASI <?php echo $d1['periode']; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $pendaftar_prestasi; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">KUOTA TA<br>PERIODE <?php echo $periodee; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $kuota_ta; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">PENDAFTAR BEASISWA<br>TA <?php echo $periodee; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $pendaftar_ta; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div><br>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">PENDAFTAR DARI<br>LUAR</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $pendaftar_luar; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-orange hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">PENDAFTAR DARI<br>DALAM</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $pendaftar_dalam; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">TUGAS VERIFIKASI<br>PRESTASI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $tugas_verifikasi_pr; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">TUGAS VERIFIKASI<br>TA</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $tugas_verifikasi_ta; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>BEASISWA PEMERINTAH KOTA BONTANG</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                            if ($d1['status_penerimaan'] == 0 && $d1['status_beasiswa'] == 0) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#F44336;font-size:30px;">info_outline</i></td><td valign="top">Pendaftaran Penerimaan Beasiswa Pemerintah Kota Bontang Belum Dibuka</td></tr></table></blockquote>';
                            }
                            if ($d1['status_penerimaan'] == 0 && $d1['status_beasiswa'] == 1) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#FF9800;font-size:30px;">info_outline</i></td><td valign="top">Pendaftaran Penerimaan Beasiswa Pemerintah Kota Bontang Periode '.$periodee.' Telah ditutup sejak tanggal '.tglWaktu($d1['tgl_tutup']).'. Anda dapat mulai memverifikasi data pemohon beasiswa.</td></tr></table></blockquote>';
                            }
                            if ($d1['status_penerimaan'] == 1 && $d1['status_beasiswa'] == 1) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#2196F3;font-size:30px;">info_outline</i></td><td valign="top">Pendaftaran Penerimaan Beasiswa Bontang '.$periodee.' Telah Dibuka sejak tanggal '.tglWaktu($d1['tgl_buka']).'</td></tr></table></blockquote>';
                            ?>
                            <hr>
                            <div class="text-center" style="font-size:18px;font-weight:bold;">SISA WAKTU PENDAFTARAN</div>
                            <div id="sisa" style="font-size:25px;" class="text-center bg-blue-grey"><?php echo batasKumpul($d1['tgl_tutup']); ?></div>
                            <?php
                             }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>PERSYARATAN DAN KETENTUAN KHUSUS</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                                $sqld = $con->prepare("SELECT * FROM persyaratan WHERE tampil='1'");
                                $sqld->execute();
                                $dd = $sqld->fetch();

                                echo $dd['persyaratan'];
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->

            </div>
    </section>
<?php
    require_once ($host1."/inc/assets/footer.php");
?>

<!------------------------------- SELESAI ISI KONTEN / ISI WEB------------------------------- -->
<script type="text/javascript">
        $(function () {
    //Widgets count
    $('.count-to').countTo();

    //Sales count to
    $('.sales-count-to').countTo({
        formatter: function (value, options) {
            return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
        }
    });

    //initRealTimeChart();
    //initDonutChart();
    //initSparkline();
});
    var auto_refresh1 = setInterval(
    function () {
        $('#sisa').load('cek-notif.php?cek=batasKumpul');
    }, 1000);

</script>



