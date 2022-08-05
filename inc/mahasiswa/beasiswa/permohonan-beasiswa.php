<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'permohonan';
require_once ($host1."/inc/assets/header2.php");



$qm = $con->prepare("SELECT id_mahasiswa FROM mahasiswa WHERE id_user='$_SESSION[id]'");
$qm->execute();
$dt = $qm->fetch();
$idm = $dt['id_mahasiswa'];

    $qs = $con->prepare("SELECT s.*, (SELECT COUNT(id_mahasiswa) FROM beasiswa_prestasi WHERE periode=s.periode AND id_mahasiswa='$idm') AS totbeasiswaP, (SELECT COUNT(id_mahasiswa) FROM beasiswa_ta WHERE periode=s.periode AND id_mahasiswa='$idm') AS totbeasiswaTA , (SELECT COUNT(id_mahasiswa) FROM beasiswa_coass WHERE periode=s.periode AND id_mahasiswa='$idm') AS totbeasiswaC FROM set_beasiswa s");
    $qs->execute();
    $dt = $qs->fetch();
    $stgl = $dt['tgl_tutup'];
    $ssts = $dt['status_penerimaan'];
    $spr = $dt['periode'];
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


    <section class="content">

<!-------------------------------------------------- PERMOHONAN BEASISWA ------------------------------------------- -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                PERMOHONAN BEASISWA
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <?php
                                if ($stgl <= date("Y-m-d H:i:s") || $ssts == 0) {
                            ?>
                            <blockquote>Maaf Pendaftaran Penerimaan Beasiswa Pemerintah Kota Bontang Periode <?php echo $spr; ?> Telah ditutup sejak tanggal <?php echo tglWaktu($stgl); ?> </blockquote>

                            <?php
                                }else{

                                    if ($dt['totbeasiswaP'] > 0 || $dt['totbeasiswaTA'] > 0 || $dt['totbeasiswaC'] > 0) {
                            ?>
                                <blockquote>Anda telah mengajukan Beasiswa pada periode <?php echo $dt['periode']; ?>, data yang telah diverifkasi tidak dapat diubah, silakan periksa kembali data yang Anda ajukan sebelum di verifikasi oleh verifikator.</blockquote>
                            <?php
                                    }else{
                            ?>
                                <blockquote>Sebelum Anda mengajukan permohonan harap membaca persyaratan dan ketentuan yang berlaku, dan pastikan berkas Anda sudah lengkap, jika belum silakan lengkapi berkas Anda terlebih dahulu. Terimakasih.</blockquote>
                                <table style="width:100%;">
                                    <tr>
                                        <td><button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-pilih">Ajukan Permohonan <i class="material-icons" style="font-size:16px;" >insert_drive_file</i></button></td>
                                        <td>    
                                        </td>
                                    </tr>
                                </table>
                            <?php
                                    }
                                }
                            ?>
                           <br><br>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="prestasi">
                            <ol class="breadcrumb"style="background: linear-gradient(to right, #cb3fe6, #15e4fd);"></ol>
                        <div class="header">
                            <h2>
                                DATA PERMOHONAN BEASISWA ANDA
                            </h2>
                        </div>
                        <div class="body table-responsive">


                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#beasiswa1" data-toggle="tab" aria-expanded="false">BEASISWA PRESTASI</a></li>
                                <li role="presentation" class=""><a href="#beasiswa2" data-toggle="tab" aria-expanded="false">BEASISWA TUGAS AKHIR</a></li>
                                <li role="presentation" class=""><a href="#beasiswa3" data-toggle="tab" aria-expanded="false">BEASISWA COASS KEDOKTERAN</a></li> 
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="beasiswa1">


<!-------------------------------------------------- DATA BEASISWA PRESTASI ------------------------------------------- -->
                                        <table style="width:100%;">
                                            <tr>
                                                <td width="65%"></td>
                                                <td>    
                                                            <select id="periode11" class="form-control pull-right" data-live-search="true">
                                                                <option value="" selected>*Semua Periode</option>
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
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                           <br><br>

                                        <div id="view1"></div>


                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="beasiswa2">


<!-------------------------------------------------- DATA BEASISWA TUGAS AKHIR ------------------------------------------- -->
                                    <table style="width:100%;">
                                        <tr>
                                            <td width="65%"></td>
                                            <td>    
                                                        <select id="periode22" class="form-control pull-right" data-live-search="true">
                                                            <option value="" selected>*Semua Periode</option>
                                                            <?php
                                                            $sql1 = $con->prepare("SELECT * FROM periode");
                                                            $sql1->execute();
                                                            while($d1=$sql1->fetch()){            
                                                            ?>
                                                            <option value="<?php echo $d1['periode']; ?>"><?php echo $d1['periode']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                       <br><br>

                                    <div id="view2"></div>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="beasiswa3">

<!-------------------------------------------------- DATA BEASISWA COASS ------------------------------------------- -->
                                    <table style="width:100%;">
                                        <tr>
                                            <td width="65%"></td>
                                            <td>    
                                                        <select id="periode33" class="form-control pull-right" data-live-search="true">
                                                            <option value="" selected>*Semua Periode</option>
                                                            <?php
                                                            $sql1 = $con->prepare("SELECT * FROM periode");
                                                            $sql1->execute();
                                                            while($d1=$sql1->fetch()){            
                                                            ?>
                                                            <option value="<?php echo $d1['periode']; ?>"><?php echo $d1['periode']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                       <br><br>

                                    <div id="view3"></div>

                                </div> 
                            </div>




                        </div>
                    </div>
                </div>
            </div>

 


<!-------------------------------------------------- PILIH BEASISWA ------------------------------------------- -->
            <div class="modal fade" id="modal-pilih" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="top:10%;">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn-close">×</button>
                            <div class="modal-title"><i class="material-icons">directions</i> <span style="position:relative; top:-5px;" id="md">Pilih Permohonan Beasiswa</span></div>

                        </div>
                        <div class="modal-body">
                            <div class="row" style="margin: 20px;">
                                <div class="col-md-4">
                                    <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah1" data-target="#form-modal1" style="text-decoration: none;">
                                    <div class="info-box-4 bg-orange hover-expand-effect" style="height: 250px;cursor: pointer !important;">
                                        <div class="icon">
                                            <img src="../home/images/beasiswa/cewe1.png" style="margin-bottom: 15px; opacity: 0.5;"> 
                                        </div>
                                        <div class="content" style="position: absolute;bottom: 0;">
                                            <div class="text">BEASISWA</div> 
                                            <div class="number">PRESTASI</div>
                                        </div>
                                    </div>                                    
                                    </a> 
                                </div>

                                <div class="col-md-4">
                                    <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah2" data-target="#form-modal2" style="text-decoration: none;">
                                    <div class="info-box-4 bg-pink hover-expand-effect" style="height: 250px;cursor: pointer !important;">
                                        <div class="icon">
                                            <img src="../home/images/beasiswa/cowo1.png" style="margin-bottom: 15px; opacity: 0.5;"> 
                                        </div>
                                        <div class="content" style="position: absolute;bottom: 0;">
                                            <div class="text">BEASISWA</div> 
                                            <div class="number">TUGAS AKHIR</div>
                                        </div>
                                    </div>                                    
                                    </a>  
                                </div>

                                <div class="col-md-4">
                                    <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah3" data-target="#form-modal3" style="text-decoration: none;">
                                    <div class="info-box-4 bg-light-blue hover-expand-effect" style="height: 250px;cursor: pointer !important;">
                                        <div class="icon">
                                            <img src="../home/images/beasiswa/koas.png" style="margin-bottom: 15px; opacity: 0.5"> 
                                        </div>
                                        <div class="content" style="position: absolute;bottom: 0;">
                                            <div class="text">BEASISWA</div> 
                                            <div class="number">COASS KEDOKTERAN</div>
                                        </div>
                                    </div>                                    
                                    </a>  
                                </div>
                            </div>
                        <center>
                              
                              
                              
                        </center>
                        </div>
                    </div>
                </div>
            </div>

</div></section>


<!-------------------------------------------------- FORM BEASISWA PRESTASI ------------------------------------------- -->

                            <input type="text" id="aks1" name="aks" class="form-control" style="display:none;">
            <!-- Default Size -->
            <div class="modal fade" id="form-modal1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title1"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <div class="col-lg-12">

                        <form id="form2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_bp" name="id_bp" class="form-control">
                            <input type="hidden" id="tabs11" name="tabs1" class="form-control">
                            <input type="hidden" id="no1" name="no">
                            <input type="hidden" id="err1" name="err1">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs1">
                                <li role="presentation" class="active"><a id="1" onclick="tabN1(1);"  href="#permohonan1" data-toggle="tab">PERMOHONAN</a></li>
                                <li role="presentation"><a id="2"  href="#berkas11" onclick="tabN1(2)"   disabled="" data-toggle="tab">BERKAS 1</a></li>
                                <li role="presentation"><a id="3"  href="#berkas21" onclick="tabN1(3)"   disabled="" data-toggle="tab">BERKAS 2</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="permohonan1">
                                        <label for="user">Periode</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="periode1" name="periode1" class="form-control" disabled="" placeholder="<?php echo $spr; ?>">
                                                 <span style="color:#f00;font-size:12px;" class="vdt1" id="v2"></span>
                                            </div>
                                        </div>
                                        <label for="user">Tanggal Permohonan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="tgl1" name="tgl" class="form-control" disabled="" placeholder="<?php echo date("Y-m-d H:i:s"); ?>">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt1" id="v3"></span>
                                        </div>
                                        <label for="user">Semester</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="semester1" name="semester" class="form-control" required placeholder="Masukkan Semester Saat ini">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt1" id="v4"></span>
                                        </div>
                                        <label for="user">IP (Indeks Prestasi)</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="ipk1" name="ipk" class="form-control" required placeholder="Masukkan IP Terakhir Sesuai KHS">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;"  class="vdt1"id="v5"></span>
                                        </div>
                                </div> <!-- tutup permohonan -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas11">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group ck1" id="cekSP">
                                        <input type="checkbox" id="cSP1" class="cek1"  data-f="suratP1" name="checkbox">
                                        <label for="cSP1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileSP1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratP1" name="suratP" class="form-control fc1" data-no="0" data-v="v6" placeholder="Masukkan Surat Permohonan Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v6"></span>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group ck1" id="cekAK">
                                        <input type="checkbox" id="cAK1" class="cek1"  data-f="suratAK1" name="checkbox">
                                        <label for="cAK1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileAK1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratAK1" name="suratAK" class="form-control fc1" data-no="1" data-v="v7" placeholder="Masukkan Surat Aktif Kuliah" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v7"></span>
                                    </div>
                                    <label for="user">KHS (Kartu Hasil Studi)</label>
                                    <div class="form-group ck1" id="cekKhs">
                                        <input type="checkbox" id="cKhs1" class="cek1"  data-f="khs1" name="checkbox">
                                        <label for="cKhs1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileKhs1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="khs1" name="khs" class="form-control fc1" data-no="2" data-v="v8" placeholder="Masukkan KHS Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v8"></span>
                                    </div>
                                    <label for="user">Surat Pernyataan Non PNS/BUMN/BUMD/Swasta</label>
                                    <div class="form-group ck1" id="cekSK">
                                        <input type="checkbox" id="cSK1" class="cek1"  data-f="suratK1" name="checkbox">
                                        <label for="cSK1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileSK1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratK1" name="suratK" class="form-control fc1" data-no="3" data-v="v9" placeholder="Masukkan Surat Pernyataan Tidak Bekerja" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v9"></span>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group ck1" id="cekSB">
                                        <input type="checkbox" id="cSB1" class="cek1"  data-f="suratB1" name="checkbox">
                                        <label for="cSB1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileSB1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratB1" name="suratB" class="form-control fc1" data-no="4" data-v="v10" placeholder="Masukkan Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v10"></span>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group ck1" id="cekKtm">
                                        <input type="checkbox" id="cKtm1" class="cek1"  data-f="ktm1" name="checkbox">
                                        <label for="cKtm1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileKtm1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                       <div class="form-line fr">
                                           <input type="file" id="ktm1" name="ktm" class="form-control fc1" data-no="5" data-v="v11" placeholder="Masukkan Scan KTM Asli" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v11"></span>
                                    </div>

                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group ck1" id="cekKk">
                                        <input type="checkbox" id="cKk1" class="cek1"  data-f="kk1" name="checkbox">
                                        <label for="cKk1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileKk1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="kk1" name="kk" class="form-control fc1" data-no="6" data-v="v14" placeholder="Masukkan Scan Kartu Keluarga" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v14"></span>
                                    </div>

                                    <!--<label for="user">Akta Kelahiran</label>
                                    <div class="form-group ck1" id="cekAkta">
                                        <input type="checkbox" id="cAkta1" class="cek1"  data-f="akta1" name="checkbox">
                                        <label for="cAkta1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileAkta1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="akta1" name="akta" class="form-control fc1" data-no="6" data-v="v12" placeholder="Masukkan Scan Akta Kelahiran" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v12"></span>
                                    </div>-->
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group ck1" id="cekKtp">
                                        <input type="checkbox" id="cKtp1" class="cek1"  data-f="ktp1" name="checkbox">
                                        <label for="cKtp1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileKtp1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="ktp1" name="ktp" class="form-control fc1" data-no="7" data-v="v13" placeholder="Masukkan Scan KTP" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v13"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas21">
                                    <div class="col-md-6">
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group ck1" id="cekDom">
                                        <input type="checkbox" id="cDom1" class="cek1"  data-f="domisili1" name="checkbox">
                                        <label for="cDom1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileDom1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="domisili1" name="domisili" class="form-control fc1" data-no="8" data-v="v15" placeholder="Masukkan Surat Domisili" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v15"></span>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group ck1" id="cekSN">
                                        <input type="checkbox" id="cSN1" class="cek1"  data-f="suratN1" name="checkbox">
                                        <label for="cSN1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileSN1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratN1" name="suratN" class="form-control fc1" data-no="9" data-v="v16" placeholder="Masukkan Surat Bebas Narkoba" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v16"></span>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group ck1" id="cekS1">
                                        <input type="checkbox" id="cS11" class="cek1"  data-f="sertifikat11" name="checkbox">
                                        <label for="cS11">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileS11"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="sertifikat11" name="sertifikat1" class="form-control fc1" data-no="10" data-v="v17" placeholder="Masukkan Sertifikat 1 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt1" id="v17"></span>
                                    </div>
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group ck1" id="cekS2">
                                        <input type="checkbox" id="cS21" class="cek1"  data-f="sertifikat21" name="checkbox">
                                        <label for="cS21">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileS21"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="sertifikat21" name="sertifikat2" class="form-control fc1" data-no="11" data-v="v18" placeholder="Masukkan Sertifikat 2 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt1" id="v18"></span>
                                    </div> 

                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">

                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group ck1" id="cekS3">
                                        <input type="checkbox" id="cS31" class="cek1"  data-f="sertifikat31" name="checkbox">
                                        <label for="cS31">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileS31"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="sertifikat31" name="sertifikat3" class="form-control fc1" data-no="12" data-v="v19" placeholder="Masukkan Sertifikat 3 *Jika Ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt1" id="v19"></span>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group ck1" id="cekBurek">
                                        <input type="checkbox" id="cBR1" class="cek1"  data-f="burek1" name="checkbox">
                                        <label for="cBR1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileBR1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="burek1" name="burek" class="form-control fc1" data-no="13" data-v="v20" placeholder="Masukkan Scan Buku Rekening" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v20"></span>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group ck1" id="cekIjz">
                                        <input type="checkbox" id="cIjz1" class="cek1"  data-f="ijazah1" name="checkbox">
                                        <label for="cIjz1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#modal-file1" title="Lihat File"><span id="fileIjz1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="ijazah1" name="ijazah" class="form-control fc1" data-no="14" data-v="v21" placeholder="Masukkan Scan Ijazah Pendidikan Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt1" id="v21"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->

                            </div>
                        </div>
                                    <button type="reset" id="btn-reset1"></button>
                            </form>
                            </div>
                        </div>
                            
                        <div class="modal-footer">
                            <div class="text-left pull-left" style="color:#f00;" id="fileN1">
                                *Silakan gunakan file kosong untuk mengganti <br> surat bebas narkoba & pernyataan tdk menerima <br> beasiswa. Download file di <br> http://e-beasiswa.bontangkota.go.id/home/unduhan.php?hal=unduhan<BR>
                                    *Format file yang diterima : PDF <br>
                                    *Maks. ukuran file 5 MB
                            </div>                         
                            
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev1" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next1" style="color:#fff;">SELANJUTNYA</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan1">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>



<!-- modal file 1 -->
            <div class="modal fade" id="form-file11" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md11"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>      
                            <div class="table-responsive">
                               <input type="hidden" id="tabs21" name="tabs2" class="form-control">


                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs11">
                                <li role="presentation" class="active"><a id="5" onclick="tabN1(5);"  href="#pemohon1" data-toggle="tab">PEMOHON</a></li>
                                <li role="presentation"><a id="6"  href="#berkass1" onclick="tabN1(6)"   disabled="" data-toggle="tab">BERKAS</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="pemohon1">
                                    <div class="col-md-2" id="imgMhs1"></div>
                                    <div class="col-md-10" id="dataMhs1"></div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="berkass1">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group" id="cekSP">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileSP11"></span></a></div>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group" id="cekAK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileAK11"></span></a></div>
                                    </div>
                                    <label for="user">KHS (Kartu Hasil Studi)</label>
                                    <div class="form-group" id="cekKhs">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileKhs11"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Non PNS/BUMN/BUMD/Swasta</label>
                                    <div class="form-group" id="cekSK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileSK11"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group" id="cekSB">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileSB11"></span></a></div>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group" id="cekKtm">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileKtm11"></span></a></div>
                                    </div>


                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group" id="cekKk">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileKk11"></span></a></div>
                                    </div>
                                    <!--<label for="user">Akta Kelahiran</label>
                                    <div class="form-group" id="cekAkta">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileAkta11"></span></a></div>
                                    </div>-->



                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group" id="cekKtp">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileKtp11"></span></a></div>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group" id="cekDom">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileDom11"></span></a></div>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group" id="cekSN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileSN11"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group" id="cekS1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileS111"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group" id="cekS2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileS211"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group" id="cekS3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileS311"></span></a></div>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group" id="cekBurek">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileBR11"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group" id="cekIjz">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile21" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile21" data-target="#modal-file1" title="Lihat File"><span id="fileIjz11"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 --></div>
                                    </div>
                                   </div>
                            </div>
                        </div>


                         
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev11" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next11" style="color:#fff;">SELANJUTNYA</button>
                              <button type="button" class="btn btn-danger waves-effect" id="btn-tutup1" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Default Size -->
            <div class="modal fade" id="modal-file1" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="top:15%;">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md1"></span></div>

                        </div>
                        <div class="modal-body">
                        <div class="table-responsive" id="view-file1"></div>
                        <div class="modal-footer">

                              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>















<!-------------------------------------------------- FORM BEASISWA TUGAS AKHIR ------------------------------------------- -->

            <!-- Default Size -->
            <div class="modal fade" id="form-modal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" disabled>
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title2"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <div class="col-lg-12">
                            
                            <input type="text" id="aks2" name="aks2" class="form-control" style="display:none;">
                        
                        <form id="form21" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_bta" name="id_bta" class="form-control">
                            <input type="hidden" id="tabs12" name="tabs1" class="form-control">
                            <input type="hidden" id="no2" name="no">
                            <input type="hidden" id="err2" name="no">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs2">
                                <li role="presentation" class="active"><a id="7" onclick="tabN2(7);"  href="#permohonan2" data-toggle="tab">PERMOHONAN</a></li>
                                <li role="presentation"><a id="8"  href="#berkas12" onclick="tabN2(8)"   disabled="" data-toggle="tab">BERKAS 1</a></li>
                                <li role="presentation"><a id="9"  href="#berkas22" onclick="tabN2(9)"   disabled="" data-toggle="tab">BERKAS 2</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="permohonan2">
                                        <label for="user">Periode</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="periode2" name="periode2" class="form-control" disabled="" placeholder="<?php echo $spr; ?>">
                                                 <span style="color:#f00;font-size:12px;" class="vdt2" id="vv2"></span>
                                            </div>
                                        </div>
                                        <label for="user">Tanggal Permohonan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="tgl2" name="tgl" class="form-control" disabled="" placeholder="<?php echo date("Y-m-d H:i:s"); ?>">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt2" id="vv3"></span>
                                        </div>
                                        <label for="user">Semester</label>
                                        <div class="form-group">
                                            <div class="form-line fr2">
                                               <input type="text" id="semester2" name="semester" class="form-control" required placeholder="Masukkan Semester Saat ini">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt2" id="vv4"></span>
                                        </div>
                                        <label for="user">IPK (Indeks Prestasi Kumulatif)</label>
                                        <div class="form-group">
                                            <div class="form-line fr2">
                                               <input type="text" id="ipk2" name="ipk" class="form-control" required placeholder="Masukkan IPK Terakhir Sesuai Transkrip Nilai">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;"  class="vdt2"id="vv5"></span>
                                        </div>
                                </div> <!-- tutup permohonan -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas12">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group ck2" id="cekSP">
                                        <input type="checkbox" id="cSP2" class="cek2"  data-f="suratP2" name="checkbox">
                                        <label for="cSP2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileSP2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratP2" name="suratP" class="form-control fc2" data-no="0" data-v="vv6" placeholder="Masukkan Surat Permohonan Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv6"></span>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group ck2" id="cekAK">
                                        <input type="checkbox" id="cAK2" class="cek2"  data-f="suratAK2" name="checkbox">
                                        <label for="cAK2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileAK2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratAK2" name="suratAK" class="form-control fc2" data-no="1" data-v="vv7" placeholder="Masukkan Surat Aktif Kuliah" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv7"></span>
                                    </div>
                                    <label for="user">Surat Keterangan Penelitian (Asli)</label>
                                    <div class="form-group ck2" id="cekSPN">
                                        <input type="checkbox" id="cSPN2" class="cek2"  data-f="suratPN2" name="checkbox">
                                        <label for="cSPN2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileSPN2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratPN2" name="suratPN" class="form-control fc2" data-no="2" data-v="vv71" placeholder="Masukkan Surat Ketrangan Penelitian" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv71"></span>
                                    </div>
                                    <label for="user">Proposal Penelitan Asli</label>
                                    <div class="form-group ck2" id="cekPR1">
                                        <input type="checkbox" id="cPR12" class="cek2"  data-f="propPN12" name="checkbox">
                                        <label for="cPR12">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="filePR12"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="propPN12" name="propPN1" class="form-control fc2" data-no="3" data-v="vv72" placeholder="Masukkan Proposal Penelitian Asli" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv72"></span>
                                    </div>
                                    <label for="user">Lembar Pengesahan Pembimbing (Asli)</label>
                                    <div class="form-group ck2" id="cekPR2">
                                        <input type="checkbox" id="cPR22" class="cek2"  data-f="propPN22" name="checkbox">
                                        <label for="cPR22">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="filePR22"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="propPN22" name="propPN2" class="form-control fc2" data-no="4" data-v="vv73" placeholder="Masukkan Proposal Penelitian Yang Disetujui Pembimbing" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv73"></span>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Keterangan TA</label>
                                    <div class="form-group ck2" id="cekSTA">
                                        <input type="checkbox" id="cSTA2" class="cek2"  data-f="suratTA2" name="checkbox">
                                        <label for="cSTA2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileSTA2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratTA2" name="suratTA" class="form-control fc2" data-no="5" data-v="vv74" placeholder="Masukkan Surat Keterangan Telah TA" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv74"></span>
                                    </div>
                                    <label for="user">Transkrip Nilai Terakhir</label>
                                    <div class="form-group ck2" id="cekKhs">
                                        <input type="checkbox" id="cKhs2" class="cek2"  data-f="khs2" name="checkbox">
                                        <label for="cKhs2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileKhs2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="khs2" name="khs" class="form-control fc2" data-no="6" data-v="vv8" placeholder="Masukkan KHS Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv8"></span>
                                    </div>
                                    <label for="user">Surat Pernyataan Non PNS/BUMN/BUMD/Swasta</label>
                                    <div class="form-group ck2" id="cekSK">
                                        <input type="checkbox" id="cSK2" class="cek2"  data-f="suratK2" name="checkbox">
                                        <label for="cSK2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileSK2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratK2" name="suratK" class="form-control fc2" data-no="7" data-v="vv9" placeholder="Masukkan Surat Pernyataan Non PNS/BUMN/BUMD/Swasta" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv9"></span>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group ck2" id="cekSB">
                                        <input type="checkbox" id="cSB2" class="cek2"  data-f="suratB2" name="checkbox">
                                        <label for="cSB2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileSB2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratB2" name="suratB" class="form-control fc2" data-no="8" data-v="vv10" placeholder="Masukkan Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv10"></span>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group ck2" id="cekKtm">
                                        <input type="checkbox" id="cKtm2" class="cek2"  data-f="ktm2" name="checkbox">
                                        <label for="cKtm2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileKtm2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                       <div class="form-line frr">
                                           <input type="file" id="ktm2" name="ktm" class="form-control fc2" data-no="9" data-v="vv11" placeholder="Masukkan Scan KTM Asli" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv11"></span>
                                    </div>

                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->



                                <div role="tabpanel" class="tab-pane fade" id="berkas22">
                                    <div class="col-md-6">
                                    <!--
                                    <label for="user">Akta Kelahiran</label>
                                    <div class="form-group ck2" id="cekAkta">
                                        <input type="checkbox" id="cAkta2" class="cek2"  data-f="akta2" name="checkbox">
                                        <label for="cAkta2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileAkta2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="akta2" name="akta" class="form-control fc2" data-no="10" data-v="vv12" placeholder="Masukkan Scan Akta Kelahiran" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv12"></span>
                                    </div>-->
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group ck2" id="cekKk">
                                        <input type="checkbox" id="cKk2" class="cek2"  data-f="kk2" name="checkbox">
                                        <label for="cKk2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileKk2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="kk2" name="kk" class="form-control fc2" data-no="10" data-v="vv14" placeholder="Masukkan Scan Kartu Keluarga" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv14"></span>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group ck2" id="cekKtp">
                                        <input type="checkbox" id="cKtp2" class="cek2"  data-f="ktp2" name="checkbox">
                                        <label for="cKtp2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileKtp2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="ktp2" name="ktp" class="form-control fc2" data-no="11" data-v="vv13" placeholder="Masukkan Scan KTP" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv13"></span>
                                    </div>
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group ck2" id="cekDom">
                                        <input type="checkbox" id="cDom2" class="cek2"  data-f="domisili2" name="checkbox">
                                        <label for="cDom2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileDom2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="domisili2" name="domisili" class="form-control fc2" data-no="12" data-v="vv15" placeholder="Masukkan Surat Domisili" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv15"></span>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group ck2" id="cekSN">
                                        <input type="checkbox" id="cSN2" class="cek2"  data-f="suratN2" name="checkbox">
                                        <label for="cSN2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileSN2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="suratN2" name="suratN" class="form-control fc2" data-no="13" data-v="vv16" placeholder="Masukkan Surat Bebas Narkoba" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv16"></span>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group ck2" id="cekS1">
                                        <input type="checkbox" id="cS12" class="cek2"  data-f="sertifikat12" name="checkbox">
                                        <label for="cS12">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileS12"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="sertifikat12" name="sertifikat1" class="form-control fc2" data-no="14" data-v="vv17" placeholder="Masukkan Sertifikat 1 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt2" id="vv17"></span>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group ck2" id="cekS2">
                                        <input type="checkbox" id="cS22" class="cek2"  data-f="sertifikat22" name="checkbox">
                                        <label for="cS22">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileS22"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="sertifikat22" name="sertifikat2" class="form-control fc2" data-no="15" data-v="vv18" placeholder="Masukkan Sertifikat 2 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt2" id="vv18"></span>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group ck2" id="cekS3">
                                        <input type="checkbox" id="cS32" class="cek2"  data-f="sertifikat32" name="checkbox">
                                        <label for="cS32">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileS32"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="sertifikat32" name="sertifikat3" class="form-control fc2" data-no="16" data-v="vv19" placeholder="Masukkan Sertifikat 3 *Jika Ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt2" id="vv19"></span>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group ck2" id="cekBurek">
                                        <input type="checkbox" id="cBR2" class="cek2"  data-f="burek2" name="checkbox">
                                        <label for="cBR2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileBR2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="burek2" name="burek" class="form-control fc2" data-no="17" data-v="vv20" placeholder="Masukkan Scan Buku Rekening" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv20"></span>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group ck2" id="cekIjz1">
                                        <input type="checkbox" id="cIjz12" class="cek2"  data-f="ijazah12" name="checkbox">
                                        <label for="cIjz12">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileIjz12"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="ijazah12" name="ijazah1" class="form-control fc2" data-no="18" data-v="vv21" placeholder="Masukkan Scan Ijazah Pendidikan Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv21"></span>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Perguruan Tinggi Sebelumnya</label>
                                    <div class="form-group ck2" id="cekIjz2">
                                        <input type="checkbox" id="cIjz22" class="cek2"  data-f="ijazah22" name="checkbox">
                                        <label for="cIjz22">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile12" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile12" data-target="#modal-file2" title="Lihat File"><span id="fileIjz22"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frr">
                                           <input type="file" id="ijazah22" name="ijazah2" class="form-control fc2" data-no="19" data-v="vv22" placeholder="Masukkan Scan Ijazah Pendidikan Terakhir" required>
                                        </div>
                                            <div class="help-info">*Khusus S2 dan S3</div>
                                             <span style="color:#f00;font-size:12px;" class="vdt2" id="vv22"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->

                            </div>
                        </div>
                                    <button type="reset" id="btn-reset2"></button>
                            </form>
                            </div>
                        </div>
                            
                        <div class="modal-footer">
                            <div class="text-left pull-left" style="color:#f00;" id="fileN2">
                                *Silakan gunakan file kosong untuk mengganti <br> surat bebas narkoba & pernyataan tdk menerima <br> beasiswa. Download file di <br> http://e-beasiswa.bontangkota.go.id/home/unduhan.php?hal=unduhan<BR>
                                    *Format file yang diterima : PDF <br>
                                    *Maks. ukuran file 5 MB
                            </div>                        
                            <div id="loading-simpan2" class="pull-left">
                                <img src="../inc/assets/images/loader.gif" style="width:30px;">
                                    <b> Sedang menyimpan...</b>
                            </div>

                            <div id="loading-ubah2" class="pull-left">
                                <img src="../inc/assets/images/loader.gif" style="width:30px;">
                                    <b> Sedang mengubah...</b>
                            </div>

                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev2" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next2" style="color:#fff;">SELANJUTNYA</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan2">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>

















<!-- modal file 1 -->
            <div class="modal fade" id="form-file12" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md12"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>      
                            <div class="table-responsive">
                               <input type="hidden" id="tabs22" name="tabs2" class="form-control">


                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs22">
                                <li role="presentation" class="active"><a id="10" onclick="tabN2(10);"  href="#pemohon2" data-toggle="tab">PEMOHON</a></li>
                                <li role="presentation"><a id="11"  href="#berkass2" onclick="tabN2(11)"   disabled="" data-toggle="tab">BERKAS</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="pemohon2">
                                    <div class="col-md-2" id="imgMhs2"></div>
                                    <div class="col-md-10" id="dataMhs2"></div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="berkass2">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group" id="cekSP">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileSP12"></span></a></div>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group" id="cekAK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileAK12"></span></a></div>
                                    </div>
                                    <label for="user">Surat Keterangan Penelitian</label>
                                    <div class="form-group" id="cekSPN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileSPN12"></span></a></div>
                                    </div>
                                    <label for="user">Proposal Penelitian Asli (Legalisir)</label>
                                    <div class="form-group" id="cekPR1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="filePR112"></span></a></div>
                                    </div>
                                    <label for="user">Lembar Pengesahan Pembimbing (Asli)</label>
                                    <div class="form-group" id="cekPR2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="filePR212"></span></a></div>
                                    </div>
                                    <label for="user">Surat Keterangan TA</label>
                                    <div class="form-group" id="cekSTA">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileSTA12"></span></a></div>
                                    </div>
                                    <label for="user">Transkrip Nilai Terakhir</label>
                                    <div class="form-group" id="cekKhs">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileKhs12"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Bekerja</label>
                                    <div class="form-group" id="cekSK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileSK12"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group" id="cekSB">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileSB12"></span></a></div>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group" id="cekKtm">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileKtm12"></span></a></div>
                                    </div>
                                                                        <!--
                                    <label for="user">Akta Kelahiran</label>
                                    <div class="form-group" id="cekAkta">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileAkta12"></span></a></div>
                                    </div> -->
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group" id="cekKk">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileKk12"></span></a></div>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group" id="cekKtp">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileKtp12"></span></a></div>
                                    </div>

                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group" id="cekDom">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileDom12"></span></a></div>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group" id="cekSN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileSN12"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group" id="cekS1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileS112"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group" id="cekS2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileS212"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group" id="cekS3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileS312"></span></a></div>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group" id="cekBurek">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileBR12"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group" id="cekIjz1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileIjz112"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Perguruan Tinggi Sebelumnya</label>
                                    <div class="form-group" id="cekIjz2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile22" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile22" data-target="#modal-file2" title="Lihat File"><span id="fileIjz212"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 --></div>
                                   </div>
                                   </div>
                            </div>
                        </div>


                         
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev12" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next12" style="color:#fff;">SELANJUTNYA</button>
                              <button type="button" class="btn btn-danger waves-effect" id="btn-tutup2" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>










            <!-- Default Size -->
            <div class="modal fade" id="modal-file2" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="top:15%;">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md2"></span></div>

                        </div>
                        <div class="modal-body">
                            <div class="table-responsive" id="view-file2"></div>
                            <div class="modal-footer">

                                  <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

















<!-------------------------------------------------- FORM BEASISWA COASS ------------------------------------------- -->
            <!-- Default Size -->
            <div class="modal fade" id="form-modal3" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title3"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <div class="col-lg-12">
                            
                            <input type="text" id="aks3" name="aks3" class="form-control" style="display:none;">
                        
                        <form id="form21" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_bcs" name="id_bcs" class="form-control">
                            <input type="hidden" id="tabs13" name="tabs1" class="form-control">
                            <input type="hidden" id="no3" name="no">
                            <input type="hidden" id="err3" name="no">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs2">
                                <li role="presentation" class="active"><a id="12" onclick="tabN3(12);"  href="#permohonan3" data-toggle="tab">PERMOHONAN</a></li>
                                <li role="presentation"><a id="13"  href="#berkas13" onclick="tabN3(13)"   disabled="" data-toggle="tab">BERKAS 1</a></li>
                                <li role="presentation"><a id="14"  href="#berkas23" onclick="tabN3(14)"   disabled="" data-toggle="tab">BERKAS 2</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="permohonan3">
                                        <label for="user">Periode</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="periode3" name="periode3" class="form-control" disabled="" placeholder="<?php echo $spr; ?>">
                                                 <span style="color:#f00;font-size:12px;" class="vdt3" id="vv21"></span>
                                            </div>
                                        </div>
                                        <label for="user">Tanggal Permohonan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="tgl3" name="tgl" class="form-control" disabled="" placeholder="<?php echo date("Y-m-d H:i:s"); ?>">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt3" id="vv31"></span>
                                        </div>
                                        <label for="user">Semester</label>
                                        <div class="form-group">
                                            <div class="form-line fr3">
                                               <input type="text" id="semester3" name="semester" class="form-control" required placeholder="Masukkan Semester Saat ini">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt3" id="vv41"></span>
                                        </div>
                                        <label for="user">IPK (Indeks Prestasi Kumulatif)</label>
                                        <div class="form-group">
                                            <div class="form-line fr3">
                                               <input type="text" id="ipk3" name="ipk" class="form-control" required placeholder="Masukkan IPK Terakhir Sesuai Transkrip Nilai">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;"  class="vdt3" id="vv51"></span>
                                        </div>
                                </div> <!-- tutup permohonan -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas13">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group ck3" id="cekSP">
                                        <input type="checkbox" id="cSP3" class="cek3"  data-f="suratP3" name="checkbox">
                                        <label for="cSP3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSP3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratP3" name="suratP" class="form-control fc3" data-no="0" data-v="vv61" placeholder="Masukkan Surat Permohonan Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv61"></span>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group ck3" id="cekAK">
                                        <input type="checkbox" id="cAK3" class="cek3"  data-f="suratAK3" name="checkbox">
                                        <label for="cAK3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileAK3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratAK3" name="suratAK" class="form-control fc3" data-no="1" data-v="vv71x" placeholder="Masukkan Surat Aktif Kuliah" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv71x"></span>
                                    </div>
<!--                                     <label for="user">Surat Keterangan Penelitian (Asli)</label>
                                    <div class="form-group ck3" id="cekSPN">
                                        <input type="checkbox" id="cSPN3" class="cek3"  data-f="suratPN3" name="checkbox">
                                        <label for="cSPN3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSPN3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratPN3" name="suratPN" class="form-control fc3" data-no="3" data-v="vv711" placeholder="Masukkan Surat Ketrangan Penelitian" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv711"></span>
                                    </div>
                                    <label for="user">Proposal Penelitan Asli</label>
                                    <div class="form-group ck3" id="cekPR1">
                                        <input type="checkbox" id="cPR13" class="cek3"  data-f="propPN13" name="checkbox">
                                        <label for="cPR13">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="filePR13"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="propPN13" name="propPN1" class="form-control fc3" data-no="3" data-v="vv731" placeholder="Masukkan Proposal Penelitian Asli" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv731"></span>
                                    </div>
                                    <label for="user">Lembar Pengesahan Pembimbing (Asli)</label>
                                    <div class="form-group ck3" id="cekPR3">
                                        <input type="checkbox" id="cPR23" class="cek3"  data-f="propPN23" name="checkbox">
                                        <label for="cPR23">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="filePR23"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="propPN23" name="propPN3" class="form-control fc3" data-no="4" data-v="vv7311" placeholder="Masukkan Proposal Penelitian Yang Disetujui Pembimbing" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv7311"></span>
                                    </div>
 -->                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Keterangan Coass</label>
                                    <div class="form-group ck3" id="cekSTA">
                                        <input type="checkbox" id="cSTA3" class="cek3"  data-f="suratTA3" name="checkbox">
                                        <label for="cSTA3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSTA3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratTA3" name="suratTA" class="form-control fc3" data-no="5" data-v="vv741" placeholder="Masukkan Surat Keterangan Coass" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv741"></span>
                                    </div>
                                    <label for="user">Transkrip Nilai Terakhir</label>
                                    <div class="form-group ck3" id="cekKhs">
                                        <input type="checkbox" id="cKhs3" class="cek3"  data-f="khs3" name="checkbox">
                                        <label for="cKhs3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileKhs3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="khs3" name="khs" class="form-control fc3" data-no="6" data-v="vv81" placeholder="Masukkan KHS Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv81"></span>
                                    </div>
                                    <label for="user">Surat Pernyataan Non PNS/BUMN/BUMD/Swasta</label>
                                    <div class="form-group ck3" id="cekSK">
                                        <input type="checkbox" id="cSK3" class="cek3"  data-f="suratK3" name="checkbox">
                                        <label for="cSK3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSK3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratK3" name="suratK" class="form-control fc3" data-no="7" data-v="vv91" placeholder="Masukkan Surat Pernyataan Non PNS/BUMN/BUMD/Swasta" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv91"></span>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group ck3" id="cekSB">
                                        <input type="checkbox" id="cSB3" class="cek3"  data-f="suratB3" name="checkbox">
                                        <label for="cSB3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSB3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratB3" name="suratB" class="form-control fc3" data-no="8" data-v="vv101" placeholder="Masukkan Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv101"></span>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group ck3" id="cekKtm">
                                        <input type="checkbox" id="cKtm3" class="cek3"  data-f="ktm3" name="checkbox">
                                        <label for="cKtm3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileKtm3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                       <div class="form-line frrr">
                                           <input type="file" id="ktm3" name="ktm" class="form-control fc3" data-no="9" data-v="vv111" placeholder="Masukkan Scan KTM Asli" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv111"></span>
                                    </div>

                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->



                                <div role="tabpanel" class="tab-pane fade" id="berkas23">
                                    <div class="col-md-6">
                                    <!--
                                    <label for="user">Akta Kelahiran</label>
                                    <div class="form-group ck3" id="cekAkta">
                                        <input type="checkbox" id="cAkta3" class="cek3"  data-f="akta3" name="checkbox">
                                        <label for="cAkta3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileAkta3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="akta3" name="akta" class="form-control fc3" data-no="10" data-v="vv131" placeholder="Masukkan Scan Akta Kelahiran" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv131"></span>
                                    </div>-->
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group ck3" id="cekKk">
                                        <input type="checkbox" id="cKk3" class="cek3"  data-f="kk3" name="checkbox">
                                        <label for="cKk3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileKk3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="kk3" name="kk" class="form-control fc3" data-no="10" data-v="vv141" placeholder="Masukkan Scan Kartu Keluarga" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv141"></span>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group ck3" id="cekKtp">
                                        <input type="checkbox" id="cKtp3" class="cek3"  data-f="ktp3" name="checkbox">
                                        <label for="cKtp3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileKtp3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="ktp3" name="ktp" class="form-control fc3" data-no="11" data-v="vv131" placeholder="Masukkan Scan KTP" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv131"></span>
                                    </div>
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group ck3" id="cekDom">
                                        <input type="checkbox" id="cDom3" class="cek3"  data-f="domisili3" name="checkbox">
                                        <label for="cDom3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileDom3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="domisili3" name="domisili" class="form-control fc3" data-no="13" data-v="vv151" placeholder="Masukkan Surat Domisili" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv151"></span>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group ck3" id="cekSN">
                                        <input type="checkbox" id="cSN3" class="cek3"  data-f="suratN3" name="checkbox">
                                        <label for="cSN3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSN3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratN3" name="suratN" class="form-control fc3" data-no="13" data-v="vv161" placeholder="Masukkan Surat Bebas Narkoba" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv161"></span>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group ck3" id="cekS1">
                                        <input type="checkbox" id="cS13" class="cek3"  data-f="sertifikat13" name="checkbox">
                                        <label for="cS13">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileS13"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="sertifikat13" name="sertifikat1" class="form-control fc3" data-no="14" data-v="vv171" placeholder="Masukkan Sertifikat 1 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt3" id="vv171"></span>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group ck3" id="cekS3">
                                        <input type="checkbox" id="cS23" class="cek3"  data-f="sertifikat23" name="checkbox">
                                        <label for="cS23">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileS23"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="sertifikat23" name="sertifikat3" class="form-control fc3" data-no="15" data-v="vv181" placeholder="Masukkan Sertifikat 2 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt3" id="vv181"></span>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group ck3" id="cekS3">
                                        <input type="checkbox" id="cS33" class="cek3"  data-f="sertifikat33" name="checkbox">
                                        <label for="cS33">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileS33"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="sertifikat33" name="sertifikat3" class="form-control fc3" data-no="16" data-v="vv191" placeholder="Masukkan Sertifikat 3 *Jika Ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt3" id="vv191"></span>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group ck3" id="cekBurek">
                                        <input type="checkbox" id="cBR3" class="cek3"  data-f="burek3" name="checkbox">
                                        <label for="cBR3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileBR3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="burek3" name="burek" class="form-control fc3" data-no="17" data-v="vv201" placeholder="Masukkan Scan Buku Rekening" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv201"></span>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group ck3" id="cekIjz1">
                                        <input type="checkbox" id="cIjz13" class="cek3"  data-f="ijazah13" name="checkbox">
                                        <label for="cIjz13">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileIjz13"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="ijazah13" name="ijazah1" class="form-control fc3" data-no="18" data-v="vv211" placeholder="Masukkan Scan Ijazah Pendidikan Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv211"></span>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Perguruan Tinggi Sebelumnya</label>
                                    <div class="form-group ck3" id="cekIjz3">
                                        <input type="checkbox" id="cIjz23" class="cek3"  data-f="ijazah23" name="checkbox">
                                        <label for="cIjz23">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileIjz23"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="ijazah23" name="ijazah3" class="form-control fc3" data-no="19" data-v="vv231" placeholder="Masukkan Scan Ijazah Pendidikan Terakhir" required>
                                        </div>
                                            <div class="help-info">*Khusus S2 dan S3</div>
                                             <span style="color:#f00;font-size:12px;" class="vdt3" id="vv231"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->

                            </div>
                        </div>
                                    <button type="reset" id="btn-reset3"></button>
                            </form>
                            </div>
                        </div>
                            
                        <div class="modal-footer">
                            <div class="text-left pull-left" style="color:#f00;" id="fileN3">
                                *Silakan gunakan file kosong untuk mengganti <br> surat bebas narkoba & pernyataan tdk menerima <br> beasiswa. Download file di <br> http://e-beasiswa.bontangkota.go.id/home/unduhan.php?hal=unduhan<BR>
                                    *Format file yang diterima : PDF <br>
                                    *Maks. ukuran file 5 MB
                            </div>                        
                            <div id="loading-simpan3" class="pull-left">
                                <img src="../inc/assets/images/loader.gif" style="width:30px;">
                                    <b> Sedang menyimpan...</b>
                            </div>

                            <div id="loading-ubah3" class="pull-left">
                                <img src="../inc/assets/images/loader.gif" style="width:30px;">
                                    <b> Sedang mengubah...</b>
                            </div>

                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev3" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next3" style="color:#fff;">SELANJUTNYA</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan3">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>













<!-- modal file 1 -->
            <div class="modal fade" id="form-file13" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md13"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>      
                            <div class="table-responsive">
                               <input type="hidden" id="tabs33" name="tabs3" class="form-control" value="15">


                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs33">
                                <li role="presentation" class="active"><a id="15" onclick="tabN3(15);"  href="#pemohon3" data-toggle="tab">PEMOHON</a></li>
                                <li role="presentation"><a id="16"  href="#berkass3" onclick="tabN3(16)"   disabled="" data-toggle="tab">BERKAS</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="pemohon3">
                                    <div class="col-md-3" id="imgMhs3"></div>
                                    <div class="col-md-10" id="dataMhs3"></div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="berkass3">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group" id="cekSP">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileSP13"></span></a></div>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group" id="cekAK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileAK13"></span></a></div>
                                    </div>
<!--                                     <label for="user">Surat Keterangan Penelitian</label>
                                    <div class="form-group" id="cekSPN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileSPN13"></span></a></div>
                                    </div>
                                    <label for="user">Proposal Penelitian Asli (Legalisir)</label>
                                    <div class="form-group" id="cekPR1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="filePR113"></span></a></div>
                                    </div>
                                    <label for="user">Lembar Pengesahan Pembimbing (Asli)</label>
                                    <div class="form-group" id="cekPR3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="filePR213"></span></a></div>
                                    </div>
 -->                                    <label for="user">Surat Keterangan Coass</label>
                                    <div class="form-group" id="cekSTA">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileSTA13"></span></a></div>
                                    </div>
                                    <label for="user">Transkrip Nilai Terakhir</label>
                                    <div class="form-group" id="cekKhs">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileKhs13"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Bekerja</label>
                                    <div class="form-group" id="cekSK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileSK13"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group" id="cekSB">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileSB13"></span></a></div>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group" id="cekKtm">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileKtm13"></span></a></div>
                                    </div>
                                                                        <!--
                                    <label for="user">Akta Kelahiran</label>
                                    <div class="form-group" id="cekAkta">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileAkta13"></span></a></div>
                                    </div> -->
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group" id="cekKk">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileKk13"></span></a></div>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group" id="cekKtp">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileKtp13"></span></a></div>
                                    </div>

                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group" id="cekDom">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileDom13"></span></a></div>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group" id="cekSN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileSN13"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group" id="cekS1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileS113"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group" id="cekS3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileS213"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group" id="cekS3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileS313"></span></a></div>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group" id="cekBurek">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileBR13"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group" id="cekIjz1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileIjz113"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Perguruan Tinggi Sebelumnya</label>
                                    <div class="form-group" id="cekIjz3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile23" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile23" data-target="#modal-file3" title="Lihat File"><span id="fileIjz213"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 --></div>
                                   </div>
                                   </div>
                            </div>
                        </div>


                         
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev13" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next13" style="color:#fff;">SELANJUTNYA</button>
                              <button type="button" class="btn btn-danger waves-effect" id="btn-tutup3" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>










            <!-- Default Size -->
            <div class="modal fade" id="modal-file3" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="top:15%;">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md3"></span></div>

                        </div>
                        <div class="modal-body">
                            <div class="table-responsive" id="view-file3"></div>
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
    <script src="beasiswaP.js"></script>
    <script src="beasiswaTA.js"></script> 
    <script src="beasiswaC.js"></script> 

<script type="text/javascript">
$('.cek1').on('change', function(){ // on change of state
   var id = $(this).attr('data-f');
   if(this.checked) // if changed state is "CHECKED"
    {
        $("#"+id).show(); // tampilkan tombol ubah  
    }else{
        $("#"+id).val(''); // tampilkan tombol ubah
        $("#"+id).hide(); // tampilkan tombol ubah
        $(".vdt1").html(''); // tampilkan tombol ubah
          
    }
});

$('#periode11').on('change', function(){ // on change of state
            var prd = $('#periode11').val();

                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['lightBlue'];

                        var $loading = $('#prestasi').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });


            $("#view1").load('beasiswaP-data.php?prd='+prd);

                        setTimeout(function () {
                            //Loading hide
                            $loading.waitMe('hide');
                        }, 1000);

});



$("#modal-file1").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

</script>


<script type="text/javascript">
$('.cek2').on('change', function(){ // on change of state
   var id = $(this).attr('data-f');
   if(this.checked) // if changed state is "CHECKED"
    {
        $("#"+id).show(); // tampilkan tombol ubah  
    }else{
        $("#"+id).val(''); // tampilkan tombol ubah
        $("#"+id).hide(); // tampilkan tombol ubah
        $(".vdt2").html(''); // tampilkan tombol ubah
          
    }
});

$('#periode22').on('change', function(){ // on change of state
            var prd = $('#periode22').val();
                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['orange'];

                        var $loading = $('#t_akhir').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });

            $("#view2").load('beasiswaTA-data.php?prd='+prd);
                        
                        setTimeout(function () {
                            //Loading hide
                            $loading.waitMe('hide');
                        }, 1000);
});


$("#modal-file2").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

    var dpt = $('#pt').val();
    var dnb = $('#nmbank').val();
    var dnr = $('#norek').val();

    if (dpt === "" || dnb === "" || dnr === "") {
        $('#ber').addClass('dsb');
        $('#bea').addClass('dsb');
    }else{
        $('#ber').removeClass('dsb');
        $('#bea').removeClass('dsb');        
    }
</script>


<script type="text/javascript">
$('.cek3').on('change', function(){ // on change of state
   var id = $(this).attr('data-f');
   if(this.checked) // if changed state is "CHECKED"
    {
        $("#"+id).show(); // tampilkan tombol ubah  
    }else{
        $("#"+id).val(''); // tampilkan tombol ubah
        $("#"+id).hide(); // tampilkan tombol ubah
        $(".vdt2").html(''); // tampilkan tombol ubah
          
    }
});

$('#periode33').on('change', function(){ // on change of state
            var prd = $('#periode33').val();
                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['orange'];

                        var $loading = $('#t_akhir').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });

            $("#view3").load('beasiswaC-data.php?prd='+prd);
                        
                        setTimeout(function () {
                            //Loading hide
                            $loading.waitMe('hide');
                        }, 1000);
});


$("#modal-file3").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

    var dpt = $('#pt').val();
    var dnb = $('#nmbank').val();
    var dnr = $('#norek').val();

    if (dpt === "" || dnb === "" || dnr === "") {
        $('#ber').addClass('dsb');
        $('#bea').addClass('dsb');
        $('#faq').addClass('dsb');
    }else{
        $('#ber').removeClass('dsb');
        $('#bea').removeClass('dsb');        
        $('#faq').removeClass('dsb');        
    }
</script>