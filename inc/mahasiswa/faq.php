<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'faq';
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


    <section class="content">
<div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FREQUENTLY ASKED QUESTIONS (FAQ)
                                <small>Pertanyaan yang sering diajukan oleh pemohon kepada Admin e-Beasiswa.</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
<!--                                    <p>Banyak mahasiswa yang mengajukan pertanyaan yang sering diajukan oleh pemohon kepada Admin e-Beasiswa seputar beasiswa Pemkot Bontang, baik melalui email maupun media lainnya, dan dari sekian banyak pertanyaan Admin telah merangkum pertanyaan-pertanyaan yang paling sering diajukan oleh mahasiswa dan Admin juga telah memberukan solusinya. Mungkin Anda juga ingin bertanya seputar beasiswa, namun mungkin pertanyaan Anda sama seperti pertanyaan yang sering diajukan, berikut pertanyaan yang paling sering diajukan. Semoga  dapat membantu (^_^)</p>-->
                                    <b>Pertanyaan yang sering diajukan :</b>
                                    <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingOne_1">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1" class="">
                                                        #1 | min KHS saya semester ini belom keluar, gimana dong? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1" aria-expanded="true" style="">
                                                <div class="panel-body">
                                                    Jika KHS semester saat ini belum juga keluar, silakan gunakan KHS semester sebelumnya dengan disertai surat keterangan bahwa pihak kampus memang benar belum mengeluarkan KHS sampai tanggal keluar yang telah ditentukan yang dikeluarkan oleh pihak kampus. Contoh misalkan Anda saat ini semester 4, namun KHS semester 4 Anda belum keluar, maka Anda dapat menggunakan KHS semester 3 Anda dengan menyertakan surat keterangan bahwa kampus belum mengeluarkan KHS semester 4 Anda.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingTwo_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false" aria-controls="collapseTwo_1">
                                                        #2 | min format Surat pernyataan bukan PNS sama surat pernyataan tidak menerima beasiswa buat sendiri apa sudah disiapin? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Untuk Surat Permohonan, Surat pernyataan bukan PNS atau tidak bekerja di BUMN/BUMD dan surat pernyataan tidak sedang/akan menerima beasiswa dari lembaga manapun, sudah disiapkan oleh Bagian Sosial dan Ekonomi Sekretariat Kota Bontang yang dapat diunduh di halaman website e-Beasiswa Kota Bontang pada menu "Unduh".
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingThree_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false" aria-controls="collapseThree_1">
                                                        #3 | min Beasiswa Prestasi pake IP atau IPK? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Untuk pengisian form beasiswa Prestasi, nilai yang digunakan adalah IP (Indeks Prestasi) yang sesuai dengan KHS Anda, sedangkan untuk pengajuan beasiswa Tugas Akhir menggunakan IPK (Indeks Prestasi Kumulatif) yang sesuai dengan Nilai IPK pada Transkrip Nilai Anda. 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingFour_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFour_1" aria-expanded="false" aria-controls="collapseFour_1">
                                                        #4 | min saya mahasiswa luar Bontang, gimana cara legalisir KTP sama KK? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Silakan mintalah bantuan orang terdekat Anda misal keluarga, kerabat atau teman Anda untuk membantu melegalisir KTP dan KK Anda di Dinas Kependudukan dan Catatan Sipil (Disduk Capil) Kota Bontang.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingFive_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFive_1" aria-expanded="false" aria-controls="collapseFive_1">
                                                        #5 | min saya gagal registrasi? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFive_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Pastikan koneksi internet Anda stabil dan kuat. Jika koneksi internet Anda tidak stabil dan kuat maka proses penyimpanan file Anda ke server akan terganggu dikarenakan waktu untuk menjalankan perintah Anda terlalu lama sehingga melebihi batas waktu eksekusi. Hal ini juga dapat disebabkan oleh banyaknya user yang sedang mengakses server sehingga membuat server sibuk dan harus menerima request dari client. Saran dari kami Adalah silakan cari tempat dengan koneksi yang kuat dan stabil saat proses registrasi, contohnya di warnet dsb.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingSix_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseSix_1" aria-expanded="false" aria-controls="collapseSix_1">
                                                        #6 | min Username sama password saya buat login mana kok gada? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseSix_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Untuk Username dan Password akan dikirimkan melalui email verifikasi yang telah Anda daftarkan pada saat proses registrasi. Silakan buka email Anda dan cari email Admin e-Beasiswa, jika tidak ada pada folder kotak masuk mohon cari di folder SPAM, jika masih tidak ada juga silakan hubungi Admin melalui email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingSeven_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseSeven_1" aria-expanded="false" aria-controls="collapseSeven_1">
                                                        #7 | min kok saya gada nerima email verifikasi? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseSeven_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Pastikan Anda telah mengetik email yang benar pada saat Anda melakukan registrasi, karena besar kecilnya huruf sangat berpengaruh. Jika Anda salah mengetikkan email maka sistem tidak akan mengenali email Anda atau bahkan email verifikasi terkirim ke email yang salah.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingEight_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseEight_1" aria-expanded="false" aria-controls="collapseEight_1">
                                                        #8 | min kok saya gagal Login terus? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEight_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Pastikan Anda telah mengetik username dan password yang benar. Jika Anda belum mengganti username dan password yang diberikan melalui email verifikasi maka Anda dapat mengcopy-paste username dan password yang terdapat pada email verifikasi tersebut untuk mencegah kesalahan pengetikan. Jika Anda telah berhasil login maka segeralah mengganti username dan password Anda yang mudah Anda ingat melalui menu pengaturan akun.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingNine_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseNine_1" aria-expanded="false" aria-controls="collapseNine_1">
                                                        #9 | min berkas softfilenya diupload kemana? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseNine_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Silakan Lengkapi berkas Persyaratan kemudian upload softfile melalui akun e-Beasiswa Anda dengan mengklik menu Beasiswa > klik sub menu Permohonan beasiswa dan klik tombol ajukan permohonan dan pilih salah satu kategori beasiswa kemudian akan muncul form pengajuan beasiswa dan isi form tersebut dengan benar, jika sudah berhasil mengupload berkas segera kirim berkas Asli (Hardfile) Anda ke Bagian Sosial dan Ekonomi Sekretariat Daerah Kota Bontang.

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingTen_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTen_1" aria-expanded="false" aria-controls="collapseTen_1">
                                                        #10 | min kok saya gagal upload berkas terus? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTen_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Pastikan koneksi internet Anda stabil dan kuat. Jika koneksi internet Anda tidak stabil dan kuat maka proses pengunggahan file Anda ke server akan terganggu dikarenakan waktu untuk menjalankan perintah Anda terlalu lama sehingga melebihi batas waktu eksekusi. Hal ini juga dapat disebabkan oleh banyaknya user yang sedang mengakses server sehingga membuat server sibuk dan harus menerima request dari client. Saran dari kami Adalah silakan cari tempat dengan koneksi yang kuat dan stabil saat proses mengupload file berkas beasiswa, contohnya warnet dsb.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingEleven_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseEleven_1" aria-expanded="false" aria-controls="collapseEleven_1">
                                                        #11 | min kok status verifikasi berkas saya "sedang dalam proses verifikasi" Terus sih, kapan berubahnya? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEleven_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Untuk masalah yang satu ini kami hanya bisa memberikan satu saran yaitu "sabar". Memverifikasi data pemohon membutuhkan waktu yang lama dan dapat ditentukan dari jumlah pemohon yang mengajukan berkasnya. Proses verifikasi dilakukan dengan tiga langkah yaitu memverifikasi data di aplikasi kemudian memverifikasi keaslian berkas dan terakhir memverifikasi kecocokan data yang ada pada aplikasi dengan berkas asli yang di kumpulkan. Berkas yang tidak asli maka akan otomatis dinyatakan gugur.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingTwelve_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwelve_1" aria-expanded="false" aria-controls="collapseTwelve_1">
                                                        #12 | min apa maksud dari poin persyaratan "bersedia mengabdi di Kota Bontang? <i class="material-icons" style="float: right; width: 1%;">keyboard_arrow_down</i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwelve_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    Dalam peraturan yang telah dibuat, beasiswa ini memang diberikan khusus kepada Putra-Putri Daerah Kota Bontang saja. Dan ketika kembali ke Kota Bontang, maka sebagai bentuk bengabdian dan rasa cinta kepada Kota Bontang diharapkan mahasiswa/i putra-putri daerah dapat menyalurkan ilmu yang didapat pada saat berkuliah ataupun mengharumkan nama Kota Bontang dengan cara yang lain guna membangun kota Bontang menjadi lebih baik lagi.
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </section>
<?php
    require_once ($host1."/inc/assets/footer.php");
?>

<!------------------------------- SELESAI ISI KONTEN / ISI WEB------------------------------- -->




