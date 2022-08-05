<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beranda';
require_once ($host1."/inc/assets/header.php");

$sqlx = $con->prepare("SELECT * FROM user");
$sqlx->execute();
$sqlx->fetch();
$dU = $sqlx->rowCount();
$dx = $sqlx->fetch();

$sqlm = $con->prepare("SELECT * FROM user WHERE level='Mahasiswa'");
$sqlm->execute();
$sqlm->fetch();
$dM = $sqlm->rowCount();
$dy = $sqlm->fetch();

$sqlv = $con->prepare("SELECT * FROM user WHERE level='Verifikator'");
$sqlv->execute();
$sqlv->fetch();
$dV = $sqlv->rowCount();
$dz = $sqlv->fetch();

$sqlo = $con->prepare("SELECT * FROM user WHERE online='1'");
$sqlo->execute();
$sqlo->fetch();
$dO = $sqlo->rowCount();
$di = $sqlo->fetch();


$total_user = $dU;
$total_mahasiswa = $dM;
$total_verifikator = $dV;
$online = $dO;

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

$sql4 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE NOT status_verifikasi='0' AND  periode='$periodee'");
$sql4->execute();
$sql4->fetch();
$dCa = $sql4->rowCount();
$da = $sql4->fetch();

$sql5 = $con->prepare("SELECT * FROM beasiswa_ta WHERE NOT status_verifikasi='0' AND periode='$periodee'");
$sql5->execute();
$sql5->fetch();
$dCb = $sql5->rowCount();
$db = $sql5->fetch();

$sql6 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND m.daerah  LIKE '%KALIMANTAN TIMUR%'");
$sql6->execute();
$sql6->fetch();
$dCc = $sql6->rowCount();
$dc = $sql6->fetch();

$sql7 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND m.daerah  LIKE '%KALIMANTAN TIMUR%'");
$sql7->execute();
$sql7->fetch();
$dCd = $sql7->rowCount();
$dd = $sql7->fetch();

$sql61 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND NOT m.daerah  LIKE '%KALIMANTAN TIMUR%'");
$sql61->execute();
$sql61->fetch();
$dCc1 = $sql61->rowCount();
$dc1 = $sql61->fetch();

$sql71 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodee' AND NOT m.daerah  LIKE '%KALIMANTAN TIMUR%'");
$sql71->execute();
$sql71->fetch();
$dCd1 = $sql71->rowCount();
$dd1 = $sql71->fetch();

$kuota_prestasi = $d1['batas_prestasi'];
$kuota_ta = $d1['batas_ta'];

$pendaftar_prestasi = $dC;
$pendaftar_ta = $dC1;

$pendaftar_dalam1 = $dCc;
$pendaftar_dalam2 = $dCd;

$pendaftar_luar1 = $dCc1;
$pendaftar_luar2 = $dCd1;

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
                            <div class="text">TOTAL USER</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_user; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text" >TOTAL MAHASISWA</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_mahasiswa; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <div class="content">
                            <div class="text" >TOTAL VERIFIKATOR</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_verifikator; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" >USER ONLINE</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $online; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-brown">
                            <h5>
                                PERBANDINGAN KUOTA DAN PENDAFTAR PERIODE <?php echo $periodee; ?> 
                            </h5>
                        </div>
                        <div class="body">
                            <ul class="dashboard-stat-list" style="margin-top:0px;">
                                <li>
                                    <u>Beasiswa</u>
                                    <span class="pull-right"><u>Pendaftar | Kuota</u></span>
                                </li>
                                <li>
                                    Prestasi
                                    <span class="pull-right"><b><span class="count-to" data-from="0" data-to="<?php echo $pendaftar_prestasi; ?>" data-speed="1000" data-fresh-interval="20"></span> dari <span class="count-to" data-from="0" data-to="<?php echo $kuota_prestasi; ?>" data-speed="1000" data-fresh-interval="20"></span></b> <small>org</small></span>
                                </li>
                                <li>
                                    Tugas Akhir
                                    <span class="pull-right"><b><span class="count-to" data-from="0" data-to="<?php echo $pendaftar_ta; ?>" data-speed="1000" data-fresh-interval="20"></span> dari <span class="count-to" data-from="0" data-to="<?php echo $kuota_ta; ?>" data-speed="1000" data-fresh-interval="20"></span></b> <small>org</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h5>
                                PERBANDINGAN PENDAFTAR DARI LUAR DAN DALAM PERIODE <?php echo $periodee; ?> 
                            </h5>
                        </div>
                        <div class="body">
                            <ul class="dashboard-stat-list" style="margin-top:0px;">
                                <li>
                                    <u>Beasiswa</u>
                                    <span class="pull-right"><u>Luar | Dalam</u></span>
                                </li>
                                <li>
                                    Prestasi
                                    <span class="pull-right"><b><span class="count-to" data-from="0" data-to="<?php echo $pendaftar_luar1; ?>" data-speed="1000" data-fresh-interval="20"></span> | <span class="count-to" data-from="0" data-to="<?php echo $pendaftar_dalam1; ?>" data-speed="1000" data-fresh-interval="20"></span></b> <small>org</small></span>
                                </li>
                                <li>
                                    Tugas Akhir
                                    <span class="pull-right"><b><span class="count-to" data-from="0" data-to="<?php echo $pendaftar_luar2; ?>" data-speed="1000" data-fresh-interval="20"></span> | <span class="count-to" data-from="0" data-to="<?php echo $pendaftar_dalam2; ?>" data-speed="1000" data-fresh-interval="20"></span></b> <small>org</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect" style="height:109px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:13px; font-weight:bold;">BERKAS TER-VERIFIKASI<br>BEASISWA PRESTASI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $tugas_verifikasi_pr; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect" style="height:109px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:13px; font-weight:bold;">BERKAS TER-VERIFIKASI<br>BEASISWA TA</div>
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
                                    <h2>SISTEM PENDAFTARAN ONLINE BEASISWA PEMERINTAH KOTA BONTANG</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                            if ($d1['status_penerimaan'] == 0 && $d1['status_beasiswa'] == 0) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#F44336;font-size:30px;">info_outline</i></td><td valign="top">Sistem Pendaftaran Online Penerimaan Beasiswa Pemerintah Kota Bontang Belum Diaktifkan</td></tr></table></blockquote>';
                            }
                            if ($d1['status_penerimaan'] == 0 && $d1['status_beasiswa'] == 1) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#FF9800;font-size:30px;">info_outline</i></td><td valign="top">Sistem Pendaftaran Online Penerimaan Beasiswa Pemerintah Kota Bontang Periode '.$periodee.' Telah ditutup sejak tanggal '.tglWaktu($d1['tgl_tutup']).'. Menunggu proses verifikasi untuk melanjutkan proses pengumuman.</td></tr></table></blockquote>';
                            }
                            if ($d1['status_penerimaan'] == 1 && $d1['status_beasiswa'] == 1) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#2196F3;font-size:30px;">info_outline</i></td><td valign="top">Sistem Pendaftaran Online Penerimaan Beasiswa Bontang '.$periodee.' Telah Dibuka sejak tanggal '.tglWaktu($d1['tgl_buka']).'</td></tr></table></blockquote>';
                            ?>
                            <hr>
                            <div class="text-center" style="font-size:18px;font-weight:bold;">SISA WAKTU PENDAFTARAN</div>
                            <div id="sisa" style="font-size:25px;" class="text-center bg-blue"><?php echo batasKumpul($d1['tgl_tutup']); ?></div>
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
                                <div class="col-xs-12 col-sm-12">
                                    <h2>GRAFIK PENDAFTAR BEASISWA PEMKOT BONTANG</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div id="line_chart1" class="graph"></div>
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
                                <div class="col-xs-12 col-sm-12">
                                    <h2>GRAFIK PENDAFTAR LUAR DAN DALAM DAERAH BEASISWA PEMKOT BONTANG</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            A. Pendaftar Beasiswa Prestasi
                            <div id="line_chart2" class="graph"></div>

                            <br>
                            <br>
                            A. Pendaftar Beasiswa Tugas Akhir
                            <div id="line_chart3" class="graph"></div>
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
                                <div class="col-xs-12 col-sm-12">
                                    <h2>GRAFIK RATA-RATA IPK PENDAFTAR BEASISWA PEMKOT BONTANG</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div id="line_chart4" class="graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->

            </div>
    </section>
<?php
    require_once ($host1."/inc/assets/footer.php");
    include_once ("graph.php");
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





