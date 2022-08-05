<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'KbeasiswaTA';
require_once ($host1."/inc/assets/header2.php");


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
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA PERMOHONAN BEASISWA TUGAS AKHIR
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table style="width:100%;">
                                <tr>
                                    <td><button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah" data-target="#form-modal">Tambah Data <i class="material-icons" style="font-size:16px;" >playlist_add</i></button></td>
                                    <td>    
                                                <select id="periode1" class="form-control pull-right" data-live-search="true">
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

                        <div id="view"></div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->





                            <input type="text" id="aks" name="aks" class="form-control" style="display:none;">

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
                            
                            <input type="text" id="aks2" name="aks2" class="form-control" style="display:none;">
                        
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
                                    <label for="user">Surat Keterangan Penelitian (Asli)</label>
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
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Keterangan TA</label>
                                    <div class="form-group ck3" id="cekSTA">
                                        <input type="checkbox" id="cSTA3" class="cek3"  data-f="suratTA3" name="checkbox">
                                        <label for="cSTA3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile13" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile13" data-target="#modal-file3" title="Lihat File"><span id="fileSTA3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line frrr">
                                           <input type="file" id="suratTA3" name="suratTA" class="form-control fc3" data-no="5" data-v="vv741" placeholder="Masukkan Surat Keterangan Telah TA" required>
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
                               <input type="hidden" id="tabs33" name="tabs3" class="form-control">


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
                                    <label for="user">Surat Keterangan Penelitian</label>
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
                                    <label for="user">Surat Keterangan TA</label>
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
    <script src="beasiswaTA.js"></script>

<script type="text/javascript">
$('.cek1').on('change', function(){ // on change of state
   var id = $(this).attr('data-f');
   if(this.checked) // if changed state is "CHECKED"
    {
        $("#"+id).show(); // tampilkan tombol ubah  
    }else{
        $("#"+id).val(''); // tampilkan tombol ubah
        $("#"+id).hide(); // tampilkan tombol ubah
        $(".vdt").html(''); // tampilkan tombol ubah
          
    }
});

$('#periode1').on('change', function(){ // on change of state
            var prd = $('#periode1').val();
            $("#view").load('beasiswaTA-data.php?prd='+prd);
});


$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

</script>