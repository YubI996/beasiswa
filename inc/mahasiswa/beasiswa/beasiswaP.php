<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'KbeasiswaP';
require_once ($host1."inc/assets/header2.php");


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
                                DATA PERMOHONAN BEASISWA PRESTASI
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
            <!-- Default Size -->
            <div class="modal fade" id="form-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:#68DFF0; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        </div>
                        <div class="col-lg-12">

                        <form id="form2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_bp" name="id_bp" class="form-control">
                            <input type="hidden" id="tabs1" name="tabs1" class="form-control">
                            <input type="hidden" id="no" name="no">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs">
                                <li role="presentation" class="active"><a id="1" onclick="tabN(1);"  href="#permohonan" data-toggle="tab">PERMOHONAN</a></li>
                                <li role="presentation"><a id="2"  href="#berkas1" onclick="tabN(2)"   disabled="" data-toggle="tab">BERKAS 1</a></li>
                                <li role="presentation"><a id="3"  href="#berkas2" onclick="tabN(3)"   disabled="" data-toggle="tab">BERKAS 2</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="permohonan">
                                        <label for="user">ID Mahasiswa</label>
                                        <div class="form-group">
                                                <select id="id_mahasiswa" class="form-control" data-live-search="true">
                                                    <option value="" disabled="" selected>*Pilih Mahasiswa</option>
                                                    <?php
                                                    $sql1 = $con->prepare("SELECT * FROM mahasiswa");
                                                    $sql1->execute();
                                                    while($d1=$sql1->fetch()){            
                                                    ?>
                                                    <option value="<?php echo $d1['id_mahasiswa']; ?>"><?php echo $d1['id_mahasiswa']. ' - ' .$d1['nama_mahasiswa']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v1"></span>
                                        </div>
                                        <label for="user">Periode</label>
                                        <div class="form-group">
                                                <select id="periode" class="form-control" data-live-search="true">
                                                    <option value="" disabled="" selected>*Pilih Periode</option>
                                                    <?php
                                                    $sql2 = $con->prepare("SELECT * FROM periode");
                                                    $sql2->execute();
                                                    while($d2=$sql2->fetch()){            
                                                    ?>
                                                    <option value="<?php echo $d2['periode']; ?>"><?php echo $d2['periode']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v2"></span>
                                        </div>
                                        <label for="user">Tanggal Permohonan</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="tgl" name="tgl" class="datepicker form-control" required placeholder="Masukkan Tanggal Permohonan">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                        </div>
                                        <label for="user">Semester</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="semester" name="semester" class="form-control" required placeholder="Masukkan Semester Saat ini">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v4"></span>
                                        </div>
                                        <label for="user">IP (Indeks Prestasi)</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="ipk" name="ipk" class="form-control" required placeholder="Masukkan IP Terakhir Sesuai KHS">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;"  class="vdt"id="v5"></span>
                                        </div>
                                </div> <!-- tutup permohonan -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas1">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group ck" id="cekSP">
                                        <input type="checkbox" id="cSP" class="cek1"  data-f="suratP" name="checkbox">
                                        <label for="cSP">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSP"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratP" name="suratP" class="form-control fc" data-no="0" data-v="v6" placeholder="Masukkan Surat Permohonan Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v6"></span>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group ck" id="cekAK">
                                        <input type="checkbox" id="cAK" class="cek1"  data-f="suratAK" name="checkbox">
                                        <label for="cAK">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAK"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratAK" name="suratAK" class="form-control fc" data-no="1" data-v="v7" placeholder="Masukkan Surat Aktif Kuliah" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v7"></span>
                                    </div>
                                    <label for="user">KHS (Kartu Hasil Studi)</label>
                                    <div class="form-group ck" id="cekKhs">
                                        <input type="checkbox" id="cKhs" class="cek1"  data-f="khs" name="checkbox">
                                        <label for="cKhs">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKhs"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="khs" name="khs" class="form-control fc" data-no="2" data-v="v8" placeholder="Masukkan KHS Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v8"></span>
                                    </div>
                                    <label for="user">Surat Pernyataan Tidak Bekerja</label>
                                    <div class="form-group ck" id="cekSK">
                                        <input type="checkbox" id="cSK" class="cek1"  data-f="suratK" name="checkbox">
                                        <label for="cSK">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSK"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratK" name="suratK" class="form-control fc" data-no="3" data-v="v9" placeholder="Masukkan Surat Pernyataan Tidak Bekerja" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v9"></span>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Pernyataan Tidak Menerima Beasiswa</label>
                                    <div class="form-group ck" id="cekSB">
                                        <input type="checkbox" id="cSB" class="cek1"  data-f="suratB" name="checkbox">
                                        <label for="cSB">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSB"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratB" name="suratB" class="form-control fc" data-no="4" data-v="v10" placeholder="Masukkan Surat Pernyataan Tidak Menerima Beasiswa" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v10"></span>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group ck" id="cekKtm">
                                        <input type="checkbox" id="cKtm" class="cek1"  data-f="ktm" name="checkbox">
                                        <label for="cKtm">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtm"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                       <div class="form-line fr">
                                           <input type="file" id="ktm" name="ktm" class="form-control fc" data-no="5" data-v="v11" placeholder="Masukkan Scan KTM Asli" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v11"></span>
                                    </div>
                                    <label for="user">Akta Kelahiran</label>
                                    <div class="form-group ck" id="cekAkta">
                                        <input type="checkbox" id="cAkta" class="cek1"  data-f="akta" name="checkbox">
                                        <label for="cAkta">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAkta"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="akta" name="akta" class="form-control fc" data-no="6" data-v="v12" placeholder="Masukkan Scan Akta Kelahiran" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v12"></span>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group ck" id="cekKtp">
                                        <input type="checkbox" id="cKtp" class="cek1"  data-f="ktp" name="checkbox">
                                        <label for="cKtp">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtp"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="ktp" name="ktp" class="form-control fc" data-no="7" data-v="v13" placeholder="Masukkan Scan KTP" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v13"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas2">
                                    <div class="col-md-6">
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group ck" id="cekKk">
                                        <input type="checkbox" id="cKk" class="cek1"  data-f="kk" name="checkbox">
                                        <label for="cKk">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKk"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="kk" name="kk" class="form-control fc" data-no="8" data-v="v14" placeholder="Masukkan Scan Kartu Keluarga" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v14"></span>
                                    </div>
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group ck" id="cekDom">
                                        <input type="checkbox" id="cDom" class="cek1"  data-f="domisili" name="checkbox">
                                        <label for="cDom">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileDom"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="domisili" name="domisili" class="form-control fc" data-no="9" data-v="v15" placeholder="Masukkan Surat Domisili" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v15"></span>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group ck" id="cekSN">
                                        <input type="checkbox" id="cSN" class="cek1"  data-f="suratN" name="checkbox">
                                        <label for="cSN">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSN"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="suratN" name="suratN" class="form-control fc" data-no="10" data-v="v16" placeholder="Masukkan Surat Bebas Narkoba" >
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v16"></span>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group ck" id="cekS1">
                                        <input type="checkbox" id="cS1" class="cek1"  data-f="sertifikat1" name="checkbox">
                                        <label for="cS1">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS1"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="sertifikat1" name="sertifikat1" class="form-control fc" data-no="11" data-v="v17" placeholder="Masukkan Sertifikat 1 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="v17"></span>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group ck" id="cekS2">
                                        <input type="checkbox" id="cS2" class="cek1"  data-f="sertifikat2" name="checkbox">
                                        <label for="cS2">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS2"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="sertifikat2" name="sertifikat2" class="form-control fc" data-no="12" data-v="v18" placeholder="Masukkan Sertifikat 2 *Jika ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="v18"></span>
                                    </div>
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group ck" id="cekS3">
                                        <input type="checkbox" id="cS3" class="cek1"  data-f="sertifikat3" name="checkbox">
                                        <label for="cS3">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS3"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="sertifikat3" name="sertifikat3" class="form-control fc" data-no="13" data-v="v19" placeholder="Masukkan Sertifikat 3 *Jika Ada" required>
                                        </div>
                                            <div class="help-info">*Sertifikat prestasi/kejuaraan/lomba (Opsional)</div>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="v19"></span>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group ck" id="cekBurek">
                                        <input type="checkbox" id="cBR" class="cek1"  data-f="burek" name="checkbox">
                                        <label for="cBR">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileBR"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="burek" name="burek" class="form-control fc" data-no="14" data-v="v20" placeholder="Masukkan Scan Buku Rekening" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v20"></span>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group ck" id="cekIjz">
                                        <input type="checkbox" id="cIjz" class="cek1"  data-f="ijazah" name="checkbox">
                                        <label for="cIjz">Centang jika ingin mengganti file</label>
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileIjz"></span></a></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="file" id="ijazah" name="ijazah" class="form-control fc" data-no="15" data-v="v21" placeholder="Masukkan Scan Ijazah Pendidikan Terakhir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v21"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->

                            </div>
                        </div>
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                            </div>
                        </div>
                            
                        <div class="modal-footer"> 
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next" style="color:#fff;">SELAJUTNYA</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button>
                            </div>
                    </div>
                </div>
            </div>



<!-- modal file 1 -->
            <div class="modal fade" id="form-file1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:#68DFF0; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md1"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        </div>      
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
                                    <label for="user">KHS (Kartu Hasil Studi)</label>
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
                                    <label for="user">Akta Kelahiran</label>
                                    <div class="form-group" id="cekAkta">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAkta1"></span></a></div>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group" id="cekKtp">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtp1"></span></a></div>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group" id="cekKk">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKk1"></span></a></div>
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
                                    <div class="form-group" id="cekIjz">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileIjz1"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 --></div>
                                    <button type="reset" id="btn-reset"></button>
                                    </div>
                                   </div>
                            </div>
                        </div>


                         
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev1" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next1" style="color:#fff;">SELAJUTNYA</button>
                              <button type="button" class="btn btn-danger waves-effect" id="btn-tutup" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Default Size -->
            <div class="modal fade" id="modal-file" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:#68DFF0; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
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

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="beasiswaP.js"></script>

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
            $("#view").load('beasiswaP-data.php?prd='+prd);
});


$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

</script>