<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'VbeasiswaP';
require_once ($host1."/inc/assets/header1.php"); 
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
                                    <td>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah" data-target="#form-modal" style="display:none;">Tambah Data <i class="material-icons" style="font-size:16px;" >playlist_add</i></button>       
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
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                   <select  id="col7_filter" name="status" class="form-control column_filter" data-column="7">
                                                       <option value=''> *Filter Status</option>
                                                       <option value="done_all">Lolos Verif. </option>
                                                       <option value="cancel">Ditolak</option>
                                                       <option value="error_outline">Kurang Lengkap</option>
                                                       <option value="watch_later">Belum di verif.</option>
                                                       <!--
                                                       <option data-content="<i class=' material-icons' style='font-size:19px;color:#4CAF50;' >done_all</i>" value="done_all">asaas </option>
                                                       <option data-content="<i class=' material-icons' style='font-size:19px;color:#F44336;' >cancel</i>" value="cancel">asasas </option>
                                                       <option data-content="<i class=' material-icons' style='font-size:19px;color:#FF9800;' >error_outline</i>" value="error_outline"> ccc</option>
                                                       <option data-content="<i class=' material-icons' style='font-size:19px;color:#9E9E9E;' >watch_later</i>" value="watch_later">cc </option>
                                                       -->
                                                   </select>
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





                            <input type="text" id="aks" name="aks" class="form-control" style="display:none;">
            <!-- Default Size -->
            <div class="modal fade" id="form-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <div class="col-lg-12">

                        <form id="form2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_bp" name="id_bp" class="form-control">
                            <input type="hidden" id="vR" name="vR" class="form-control">
                            <input type="hidden" id="tabs1" name="tabs1" class="form-control">
                            <input type="hidden" id="no" name="no">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs">
                                <li role="presentation" class="active"><a id="1" onclick="tabN(1);"  href="#permohonan" data-toggle="tab">PERMOHONAN</a></li>
                                <li role="presentation"><a id="2"  href="#berkas1" onclick="tabN(2)"   disabled="" data-toggle="tab">BERKAS 1</a></li>
                                <li role="presentation"><a id="3"  href="#berkas2" onclick="tabN(3)"   disabled="" data-toggle="tab">BERKAS 2</a></li>
                                <li role="presentation"><a id="4"  href="#verifikasi" onclick="tabN(4)"   disabled="" data-toggle="tab">VERIFIKASI</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade in active" id="permohonan">
                                        <label for="user">ID Mahasiswa</label>
                                        <div class="form-group">
                                                <select id="id_mahasiswa" disabled="" class="form-control fgh" data-live-search="true">
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
                                        </div>
                                        <label for="user">Periode</label>
                                        <div class="form-group">
                                                <select id="periode"  disabled="" class="form-control fgh" data-live-search="true">
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
                                               <input type="text" disabled="" id="tgl" name="tgl" class="datepicker form-control fgh" required placeholder="Masukkan Tanggal Permohonan">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                        </div>
                                        <label for="user">Semester</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" disabled="" id="semester" name="semester" class="form-control fgh" required placeholder="Masukkan Semester Saat ini">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v4"></span>
                                        </div>
                                        <label for="user">IP (Indeks Prestasi)</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" disabled="" id="ipk" name="ipk" class="form-control fgh" required placeholder="Masukkan IPK Terakhir">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;"  class="vdt"id="v5"></span>
                                        </div>
                                </div> <!-- tutup permohonan -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas1">
                                    <div class="col-md-6">
                                    <label for="user">Surat Permohonan</label>
                                    <div class="form-group ck" id="cekSP">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_surat_permohonan" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSP"></span></a></div>
                                    </div>
                                    <label for="user">Surat Aktif Kuliah</label>
                                    <div class="form-group ck" id="cekAK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_aktif_kuliah" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAK"></span></a></div>
                                    </div>
                                    <label for="user">KHS (Kartu Hasil Studi)</label>
                                    <div class="form-group ck" id="cekKhs">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_khs" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKhs"></span></a></div>
                                    </div>
                                    <label for="user">Surat Pernyataan Non PNS/BUMN/BUMD/Swasta</label>
                                    <div class="form-group ck" id="cekSK">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_non_pekerja" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSK"></span></a></div>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Surat Pernyataan Tidak Sedang/Akan Menerima Beasiswa</label>
                                    <div class="form-group ck" id="cekSB">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_non_beasiswa" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSB"></span></a></div>
                                    </div>
                                    <label for="user">KTM (Kartu Tanda Mahasiswa)</label>
                                     <div class="form-group ck" id="cekKtm">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_ktm" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtm"></span></a></div>
                                    </div>
                                    <!--<label for="user">Akta Kelahiran</label>
                                    <div class="form-group ck" id="cekAkta">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_akta" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileAkta"></span></a></div>
                                    </div>-->
                                    <label for="user">Kartu Keluarga</label>
                                    <div class="form-group ck" id="cekKk">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_kk" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKk"></span></a></div>
                                    </div>
                                    <label for="user">KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group ck" id="cekKtp">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_ktp" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileKtp"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->


                                <div role="tabpanel" class="tab-pane fade" id="berkas2">
                                    <div class="col-md-6">
                                    <label for="user">Surat Domisili</label>
                                    <div class="form-group ck" id="cekDom">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_domisili" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileDom"></span></a></div>
                                    </div>
                                    <label for="user">Surat Bebas Narkoba</label>
                                    <div class="form-group ck" id="cekSN">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_non_narkoba" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileSN"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 1</label>
                                    <div class="form-group ck" id="cekS1">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_sertifikat1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS1"></span></a></div>
                                    </div>
                                    <label for="user">Sertifikat 2</label>
                                    <div class="form-group ck" id="cekS2">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_sertifikat2" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS2"></span></a></div>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Sertifikat 3</label>
                                    <div class="form-group ck" id="cekS3">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_sertifikat3" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileS3"></span></a></div>
                                    </div>
                                    <label for="user">Buku Rekening</label>
                                    <div class="form-group ck" id="cekBurek">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_buku_rekening" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileBR"></span></a></div>
                                    </div>
                                    <label for="user">Ijazah Pendidikan Terakhir</label>
                                    <div class="form-group ck" id="cekIjz">
                                        <div id="idf"><a class="badge bg-blue-grey viewfile1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="vp_ijazah" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat File"><span id="fileIjz"></span></a></div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->


                                <div role="tabpanel" class="tab-pane fade" id="verifikasi"> 
                                        <label for="user">Verifikasi Permohonan</label>
                                        <div class="form-group ck" id="cekV">
                                            <input type="checkbox" id="V" class="vr" value="3" name="checkbox">
                                            <label for="V">Terverifikasi </label> <br>
                                            <input type="checkbox" id="R" class="vr" value="2" name="checkbox">
                                            <label for="R"> Tolak </label> <br>
                                            <input type="checkbox" id="K" class="vr" value="1" name="checkbox">
                                            <label for="K"> Berkas kurang lengkap </label> <br>
                                            <input type="checkbox" id="NV" class="vr" value="0" name="checkbox">
                                            <label for="NV"> Belum terverifikasi</label><br>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="vV"></span>
                                        </div>
                                        <label for="user">Keterangan</label>
                                        <div class="form-group">
                                            <div class="form-line vr1">
                                               <textarea id="keterangan" name="keterangan" class="form-control vr nkri"></textarea>
                                            </div>
                                            <span style="color:#f00;font-size:12px;" class="vdt" id="ket"></span>
                                        </div> 
                                    
                                </div> <!-- tutup verifikasi -->


                            </div>
                        </div>
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                            </div>
                        </div>
                            
                        <div class="modal-footer">

                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next" style="color:#fff;">SELANJUTNYA</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">VERIFIKASI</button>
                        </div>
                    </div>
                </div>
            </div>



<!-- modal file 1 -->
            <div class="modal fade" id="form-file1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md1"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
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
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next1" style="color:#fff;">SELANJUTNYA</button>
                              <button type="button" class="btn btn-danger waves-effect" id="btn-tutup" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Default Size -->
            <div class="modal fade" id="modal-file" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="top:20%;">
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
    <script src="beasiswaP-V.js"></script>

<script type="text/javascript">




$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

</script>