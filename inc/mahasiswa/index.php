<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'beranda';
require_once ($host1."/inc/assets/header2.php");


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

$penerima = $d1['batas_prestasi']+$d1['batas_ta'];



?>

<!------------------------------- ISI KONTEN / ISI WEB ------------------------------- -->
                <div class="modal fade" id="modalNotif" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="top:25%;">
                    <div class="modal-content modal-col-light-blue">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Pemberitahuan</h4>
                        </div>
                        <input type="text" id="dpt" value="<?php echo $dm['perguruan_tinggi']; ?>" style="display:none;">
                        <input type="text" id="dnb" value="<?php echo $dm['nama_bank']; ?>" style="display:none;">
                        <input type="text" id="dnr" value="<?php echo $dm['no_rekening']; ?>" style="display:none;">
                        <div class="modal-body">
                            Hallo, <?php echo $dm['nama_mahasiswa']; ?><br>
                            Data Anda belum lengkap, Silakan lengkapi data diri Anda terlebih dahulu.<br>
                            Terimakasih. (^_^)<br><br>
                            Sincerely,<br>
                            Administrator e-Beasiswa
                        </div>
                        <div class="modal-footer">
                            <a  href="../mahasiswa/master/mahasiswa.php" class="btn btn-link waves-effect">LENGKAPI DATA >> </a>
                        </div>
                    </div>
                </div>
            </div>
            
                <div class="modal fade" id="modalNotif2" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-col-light-blue"> 
                        <div class="modal-body">
                            <center><h3>[ P E N G U M U M A N ]</h3></center><br>
                            Berdasarkan hasil keputusan tim verifikasi beasiswa Pemkot Bontang, maka sistematika/alur pendaftaran beasiswa dirubah sebagai berikut:<br>
                            <ol>
                                <li>Pemohon beasiswa WAJIB melengkapi berkas persyaratan sesuai kategori beasiswa yang akan diajukan</li>
                                <li>Surat Permohonan yang digunakan adalah surat permohonan yang ada di halaman Dashboard aplikasi yanng dapat diunduh di halaman Dashboard aplikasi, Surat permohonan selain dari sumber tersebut TIDAK DITERIMA. Bagi yang sudah mengupload berkas silakan update/reupload data permohonannya khusus surat permohonannya saja.</li>
                                <li>Semua pemohon WAJIB melakukan registrasi dan mengupload file persyaratan ke dalam aplikasi </li>
                                <li>Untuk kategori Beasiswa Prestasi menggunakan nilai IP semester terakhir </li>
                                <li>Untuk kategori Beasiswa Tugas Akhir dan Coass menggunakan nilai IPK </li> 
                                <li>Berkas Asli dikumpulkan SETELAH DINYATAKAN PENGAJUAN DITERIMA, yang artinya hanya pemohon yang DINYATAKAN DITERIMA saja yang WAJIB mengumpulkan berkas </li>
                                <li>Namun jika hasil verifikasi berkas Asli pemohon tersebut terdapat kecurangan (dalam hal apapun) maka hak pemohon tersebut dinyatakan GUGUR dan akan digantikan oleh Pemohon lain yang telah ditentukan oleh tim verifikator.</li>
                            </ol>
                            Terimakasih. (^_^)<br><br>
                            Sincerely,<br>
                            Administrator e-Beasiswa
                        </div>
                        <div class="modal-footer">
                            <a  href="#" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</a>
                        </div>
                    </div>
                </div>
            </div>
            
 

    <section class="content">
            <div class="block-header">
                <span style="font-weight:bold; font-size:25px;"><center>SELAMAT DATANG DI APLIKASI <img src="<?php echo $host.'/inc/images/brand.png'; ?>" style="height:45px; width:auto;"> BONTANG</center></span>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">done_all</i>
                        </div><br>
                        <div class="content">
                            <div class="text">AKUN ANDA TELAH</div>
                            <div style="font-size:20px;"><b>TERAKTIVASI</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">KUOTA PENERIMA<br>PERIODE <?php echo $d1['periode']; ?> </div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $penerima; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">PENDAFTAR BEASISWA<br>PRESTASI <?php echo $d1['periode']; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $dC; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect" style="height:90px;">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px; font-weight:bold;">PENDAFTAR BEASISWA<br>TA <?php echo $d1['periode']; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $dC1; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12">
                                    <h2>BEASISWA PEMERINTAH KOTA BONTANG</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                            if ($d1['status_penerimaan'] == 0 && $d1['status_beasiswa'] == 0) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#F44336;font-size:30px;">info_outline</i></td><td valign="top">Maaf Pendaftaran Penerimaan Beasiswa Pemerintah Kota Bontang Belum Dibuka</td></tr></table></blockquote>';
                            }
                            if ($d1['status_penerimaan'] == 0 && $d1['status_beasiswa'] == 1) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#FF9800;font-size:30px;">info_outline</i></td><td valign="top">Maaf Pendaftaran Penerimaan Beasiswa Pemerintah Kota Bontang Periode '.$periodee.' Telah ditutup sejak tanggal '.tglWaktu($d1['tgl_tutup']).'. Saat ini data permohonan sedang di verifikasi.</td></tr></table></blockquote>';
                            }
                            if ($d1['status_penerimaan'] == 1 && $d1['status_beasiswa'] == 1) {
                            echo '<blockquote><table><tr><td valign="top" width="40"><i class="material-icons" style="color:#2196F3;font-size:30px;">info_outline</i></td><td valign="top">Pendaftaran Penerimaan Beasiswa Bontang '.$periodee.' Telah Dibuka sejak tanggal '.tglWaktu($d1['tgl_buka']).'</td></tr></table></blockquote>';
                            ?>
                            <hr>
                            <div class="text-center" style="font-size:18px;font-weight:bold;">SISA WAKTU PENDAFTARAN</div>
                            <div id="sisa" style="font-size:25px;" class="text-center bg-indigo"><?php echo batasKumpul($d1['tgl_tutup']); ?></div><br>
                            <center><a href="surat-permohonan.php?ktg=pr" target="_new" class="btn btn-info"><i class="material-icons">assignment</i> DOWNLOAD SURAT PERMOHONAN BEASISWA PRESTASI</a></center><br>
                            <center><a href="surat-permohonan.php?ktg=ta" target="_new" class="btn btn-success"><i class="material-icons">assignment</i> DOWNLOAD SURAT PERMOHONAN BEASISWA TUGAS AKHIR</a></center><br>
                            <center><a href="surat-permohonan.php?ktg=cs" target="_new" class="btn btn-danger"><i class="material-icons">assignment</i> DOWNLOAD SURAT PERMOHONAN BEASISWA COASS</a></center>
                            <?php
                             }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12">
                                    <label class="label label-danger pull-right" style="position: relative; top:-30px; right:-5px; font-size: 16px;">Terbaru</label>
                                    <h2 >PENGUMUMAN </h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                                $sqlA = $con->prepare("SELECT judul_pengumuman, isi_pengumuman FROM pengumuman WHERE tampil='1'");
                                $sqlA->execute();
                                $dA = $sqlA->fetch();
                                $n = $sqlA->rowCount();
                                if ($n > 0) {
                            ?>
                                <div style="text-align: justify;border:3px dashed #f39c12; font-size: 16px; padding: 10px;">
                                <b><u><?php echo $dA['judul_pengumuman']; ?></u></b><br>
                                <?php echo $dA['isi_pengumuman']; ?>    
                                </div>
                            
                            <?php
                            }else{
                                echo '<center>Tidak ada pengumuman terbaru</center>';
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

    var dpt = $('#dpt').val();
    var dnb = $('#dnb').val();
    var dnr = $('#dnr').val();

    if (dpt === "" || dnb === "" || dnr === "") {
        $('#modalNotif').fadeIn(900);
        $('#ber').addClass('dsb');
        $('#bea').addClass('dsb');
        $('#faq').addClass('dsb');
        $('#modalNotif').modal({backdrop: 'static', keyboard: false}); 
    }else{
        $('#ber').removeClass('dsb');
        $('#bea').removeClass('dsb');        
        $('#faq').removeClass('dsb');        
        $('#modalNotif').hide();
    }

    var auto_refresh1 = setInterval(
    function () {
        $('#sisa').load('cek-notif.php?cek=batasKumpul');
    }, 1000);







 $(document).ready(function() {

                    var data = new FormData();
                    data.append('cek', 'cekLengkap');

                    $.ajax({
                        url: 'https://e-beasiswa.bontangkota.go.id/mahasiswa/cek-notif.php', 
                        type: 'POST', 
                        data: data,  
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        beforeSend: function(e) {
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        },
                        success: function(response){  

                            if (response.status == 'acc') { 
                                swal({
                                        title: "Hai, " + response.nama + '!',
                                        text: "Berkas Anda telah diverifikasi dan dinyatakan <b>LENGKAP</b>. Mohon untuk mengirimkan <b>BERKAS ASLI</b> permohonan beasiswa Anda ke Bagian Sosial Ekonomi Sekretariat Daerah Lantai III Bontang Lestari.",
                                        imageUrl: "https://e-beasiswa.bontangkota.go.id/inc/assets/images/logo2.png",
                                        html: true
                                    });                            
                            }
 
                            
                        }
                
                    });
});

</script>
<!------------------------------- SELESAI ISI KONTEN / ISI WEB------------------------------- -->




