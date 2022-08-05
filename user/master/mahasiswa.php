<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'mahasiswa';
require_once ($host1."/inc/assets/header.php");  
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
                                DATA MAHASISWA
                            </h2>
                        </div>
                        <div class="body table-responsive">
                           <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah" data-target="#form-modal">Tambah Data <i class="material-icons" style="font-size:16px;" >playlist_add</i></button><br><br>

						<div id="view"></div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
            <!-- #END# Basic Examples -->





                            <input type="hidden" id="aks" name="aks" class="form-control" value="">
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
                        <div class="row">
                         <form id="form2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_mahasiswa" name="id_mahasiswa" class="form-control">
                            <input type="hidden" id="tabs1" name="tabs1" class="form-control">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs1">
                                <li role="presentation" class="active"><a id="1" onclick="tabN(1);"  href="#personal" data-toggle="tab">PERSONAL</a></li>
                                <li role="presentation"><a id="2"  href="#perkuliahan" onclick="tabN(2)"   disabled="" data-toggle="tab">PERKULIAHAN</a></li>
                                <li role="presentation"><a id="3"  href="#bank" onclick="tabN(3)"   disabled="" data-toggle="tab">BANK</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="personal">
                                    <div class="col-md-6">
                                    <label for="user">ID User</label>
                                    <div class="form-group">
                                    <select id="id_user" class="form-control" data-live-search="true">
                                        <option value="" disabled="" selected>*Pilih User</option>
                                        <?php
                                        $sql = $con->prepare("SELECT * FROM user WHERE level = 'Mahasiswa'");
                                        $sql->execute();
                                        while($d=$sql->fetch()){            
                                        ?>
                                        <option value="<?php echo $d['id_user']; ?>"><?php echo $d['id_user']. ' - ' .$d['nama_user']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v0"></span>
                                    </div>
                                    <label for="user">Nama Lengkap</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v1"></span>
                                    </div>
                                    <label for="user">No. KTM (Kartu Tanda Mahasiswa)</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="ktm" name="ktm" class="form-control" placeholder="Masukkan No. KTM" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v2"></span>
                                    </div>
                                    <label for="user">No. KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="ktp" name="ktp" class="form-control" placeholder="Masukkan NIK KTP" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v3"></span>
                                    </div>
                                    <label for="user">Tempat Lahir</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="tpl" name="tpl" class="form-control" placeholder="Masukkan Tempat Lahir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v4"></span>
                                    </div>
                                    <label for="user">Tanggal Lahir</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="tgl" name="tgl" class="datepicker form-control" placeholder="Masukkan Tanggal Lahir" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v5"></span>
                                    </div>
                                    <label for="user">Kota Tempat Anda Kuliah</label>
                                    <div class="form-group">
                                        <select id="kota" class="form-control fr" data-live-search="true">
                                            <option value="" disabled="" selected>*Pilih Kota</option>
                                            <?php
                                            $sql = $con->prepare("SELECT * FROM kota");
                                            $sql->execute();
                                            while($d=$sql->fetch()){            
                                            ?>
                                            <option value="<?php echo $d['kota'].'~'.$d['provinsi']; ?>"><?php echo $d['kota']. ' - ' .$d['provinsi']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v6"></span>
                                    </div>
                                <span id="ftu"></span>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Alamat Saat ini</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="alamatS" name="alamatS" class="form-control" placeholder="Masukkan Alamat saat ini" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v7"></span>
                                    </div>
                                    <label for="user">Alamat sesuai KTP</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="alamatKtp" name="alamatKtp" class="form-control" placeholder="Masukkan Alamat sesuai KTP" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v8"></span>
                                    </div>
                                    <label for="user">No. Telpon Mahasiswa</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="telp1" name="telp1" class="form-control" placeholder="Masukkan No. Telp/HP Anda" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v9"></span>
                                    </div>
                                    <label for="user">Nama Ayah</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="ayah" name="ayah" class="form-control" placeholder="Masukkan Nama Ayah" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v10"></span>
                                    </div>
                                    <label for="user">Nama Ibu</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="ibu" name="ibu" class="form-control" placeholder="Masukkan Nama Ibu" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v11"></span>
                                    </div>
                                    <label for="user">Alamat Orang Tua</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="alamatO" name="alamatO" class="form-control" placeholder="Masukkan Alamat Orang Tua/Wali" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v12"></span>
                                    </div>
                                    <label for="user">No. Telepon Orang Tua</label>
                                    <div class="form-group">
                                        <div class="form-line fr">
                                           <input type="text" id="telp2" name="telp2" class="form-control" placeholder="Masukkan No. Telp Ortu/Wali" required>
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v13"></span>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->

                                <div role="tabpanel" class="tab-pane fade" id="perkuliahan">
                                    <div class="col-md-6">
                                        <label for="user">Nama Perguruan Tinggi/Universitas</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="pt" name="pt" class="form-control" required placeholder="Masukkan Nama Perguruan Tinggi/Universitas">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v14"></span>
                                        </div>
                                        <label for="user">Alamat Perguruan Tinggi/Universitas</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="alamatP" name="alamatP" class="form-control" required placeholder="Masukkan alamat lengkap Perguruan Tinggi/Universitas">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v15"></span>
                                        </div>
                                        <label for="user">No. Telepon Perguruan Tinggi/Universitas</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="telp3" name="telp3" class="form-control" required placeholder="Masukkan No. Telepon Perguruan Tinggi/Universitas">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v16"></span>
                                        </div>
                                        <label for="user">Jenjang</label>
                                        <div class="form-group fr1">
                                            <select id="jenjang" class="form-control">
                                                <option value="" disabled=""  selected>*Pilih Jenjang</option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                                     <span style="color:#f00;font-size:12px;" class="vdt" id="v17"></span>
                                        </div>
                                        <label for="user">Angkatan</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="angkatan" name="angkatan" class="form-control" required placeholder="Masukkan Angkatan Masuk Kuliah">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v18"></span>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user">Fakultas</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="fakultas" name="fakultas" class="form-control" required placeholder="Masukkan Fakultas yang diaambil">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;"  class="vdt"id="v19"></span>
                                        </div>
                                        <label for="user">Program Studi</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="ps" name="ps" class="form-control" required placeholder="Masukkan Program Studi yang diambil">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v20"></span>
                                        </div>
                                        <label for="user">Jurusan</label>
                                        <div class="form-group">
                                            <div class="form-line fr1">
                                               <input type="text" id="jurusan" name="jurusan" class="form-control" required placeholder="Masukkan Jurusan yang diambil">
                                            </div>
                                                 <span style="color:#f00;font-size:12px;" class="vdt" id="v21"></span>
                                        </div>
                                        <label for="user">Bidang Keilmuan</label>
                                        <div class="form-group fr1">
                                            <select id="ilmu" class="form-control">
                                                <option value="" disabled="" selected>*Pilih Bidang Ilmu</option>
                                                <option value="1">Eksak (IPA)</option>
                                                <option value="2">Non Eksak (IPS)</option>
                                            </select>
                                                     <span style="color:#f00;font-size:12px;" class="vdt" id="v211"></span>
                                        </div>
                                        
                                    </div>
                                </div> <!-- tutup perkuliahan -->



                                <div role="tabpanel" class="tab-pane fade" id="bank">
                                <div class="col-md-12">
                                    <label for="user">Nama Bank</label>
                                    <div class="form-group">
                                        <div class="form-line fr2">
                                           <input type="text" id="nmbank" name="nmbank" class="form-control" required placeholder="Masukkan Nama Bank">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v22"></span>
                                    </div>
                                    <label for="user">Alamat Bank </label>
                                    <div class="form-group">
                                        <div class="form-line fr2">
                                           <input type="text" id="alamatB" name="alamatB" class="form-control" required placeholder="Masukkan Alamat Bank Cabang">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v23"></span>
                                    </div>
                                    <label for="user">No. Telepon Bank </label>
                                    <div class="form-group">
                                        <div class="form-line fr2">
                                           <input type="text" id="telp4" name="telp4" class="form-control" required placeholder="Masukkan No. Telepon Bank Cabang">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v24"></span>
                                    </div>
                                    <label for="user">No. Rekening </label>
                                    <div class="form-group">
                                        <div class="form-line fr2">
                                           <input type="text" id="norek" name="norek" class="form-control" required placeholder="Masukkan No. Rekening">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v25"></span>
                                    </div>
                                    <label for="user">Nama Pemilik</label>
                                    <div class="form-group">
                                        <div class="form-line fr2">
                                           <input type="text" id="pemilik" name="pemilik" class="form-control" required placeholder="Masukkan Nama Pemilik Sesuai Buku Rekening">
                                        </div>
                                             <span style="color:#f00;font-size:12px;" class="vdt" id="v26"></span>
                                    </div>
                                    
                                </div>
                                </div> <!-- tutup bank -->

                            </div>
                        </div>
                                        <input type="hidden" id="ceklis1" name="ceklis1" class="form-control" value="0" >
                                        <input type="hidden" id="ceklis2" name="ceklis2" class="form-control" value="0" >
                                        <input type="hidden" id="cek-aktivasi" name="cek-aktivasi" class="form-control">
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                        </div>
                             
                        </div>
                      

                        <div class="modal-footer"> 

                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next" style="color:#fff;">SELANJUTNYA</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button> 
                        </div>
                    </div>
                </div>
            </div>

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="mahasiswa.js"></script>

<script type="text/javascript">
</script>