<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");

    $sql = $con->prepare("select * from mahasiswa where id_user='$_SESSION[id]'");
    $sql->execute();
    $d = $sql->fetch();

    if ($d['ilmu'] == 1) 
        $ilmu = 'Eksak (IPA)'; else $ilmu = 'Non Eksak (IPS)';
    
?>

                           <button type="button" class="btn btn-success waves-effect m-r-20 pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah" data-target="#form-modal">Ubah Data <i class="material-icons" style="font-size:16px;" >edit</i></button><br><br>

                        <form id="form2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_mahasiswa1" name="id_mahasiswa" class="form-control">
                            <input type="hidden" id="tabs2" name="tabs1" class="form-control">
                           
                        <div class="body" id="tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist" id="ultabs1">
                                <li role="presentation" class="active"><a id="4" onclick="tabN(4);"  href="#personal1" data-toggle="tab">PERSONAL</a></li>
                                <li role="presentation"><a id="5"  href="#perkuliahan1" onclick="tabN(5)"   disabled="" data-toggle="tab">PERKULIAHAN</a></li>
                                <li role="presentation"><a id="6"  href="#bank1" onclick="tabN(6)"   disabled="" data-toggle="tab">BANK</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="personal1">
                                    <div class="col-md-6">
                                    <label for="user">Nama Lengkap</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="nama1" name="nama" value="<?php echo $d['nama_mahasiswa']; ?>" readonly="" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <label for="user">No. KTM (Kartu Tanda Mahasiswa)</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="ktm1" name="ktm" value="<?php echo $d['no_ktm']; ?>" readonly="" class="form-control" placeholder="Masukkan No. KTM" required>
                                        </div>
                                    </div>
                                    <label for="user">No. KTP (Kartu Tanda Penduduk)</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="ktp1" name="ktp" value="<?php echo $d['no_ktp']; ?>" readonly="" class="form-control" placeholder="Masukkan NIK KTP" required>
                                        </div>
                                    </div>
                                    <label for="user">Tempat Lahir</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="tpl1" name="tpl" value="<?php echo $d['tempat_lahir']; ?>" readonly="" class="form-control" placeholder="Masukkan Tempat Lahir" required>
                                        </div>
                                    </div>
                                    <label for="user">Tanggal Lahir</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="tgl1" name="tgl" value="<?php echo $d['tgl_lahir']; ?>" class="datepicker form-control" placeholder="Masukkan Tanggal Lahir" required>
                                        </div>
                                    </div>
                                    <label for="user">Kota Tempat Anda Kuliah</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="kota1" name="kota" value="<?php echo $d['kota']; ?>" data-kota="<?php echo $d['kota'].'~'.$d['daerah']; ?>" readonly="" class="form-control" placeholder="Masukkan Kota saat ini" required>
                                        </div>
                                    </div>
                                    <label for="user">Alamat Saat ini</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="alamatS1" name="alamatS" value="<?php echo $d['alamat_sekarang']; ?>" readonly="" class="form-control" placeholder="Masukkan Alamat saat ini" required>
                                        </div>
                                    </div>
                                       
                                    </div> <!-- tutup col 6 -->


                                    <div class="col-md-6">
                                    <label for="user">Alamat sesuai KTP</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="alamatKtp1" name="alamatKtp" value="<?php echo $d['alamat_ktp']; ?>" readonly="" class="form-control" placeholder="Masukkan Alamat sesuai KTP" required>
                                        </div>
                                    </div>
                                    <label for="user">No. Telpon Mahasiswa</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="telp11" name="telp1" value="<?php echo $d['telp_mahasiswa']; ?>" readonly="" class="form-control" placeholder="Masukkan No. Telp/HP Anda" required>
                                        </div>
                                    </div>
                                    <label for="user">Nama Ayah</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="ayah1" name="ayah1" value="<?php echo $d['nama_ayah']; ?>" readonly="" class="form-control" placeholder="Masukkan Nama Ayah" required>
                                        </div>
                                    </div>
                                    <label for="user">Nama Ibu</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="ibu1" name="ibu1" value="<?php echo $d['nama_ibu']; ?>" readonly="" class="form-control" placeholder="Masukkan Nama Ibu" required>
                                        </div>
                                    </div>
                                    <label for="user">Alamat Orang Tua</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="alamatO1" name="alamatO1" value="<?php echo $d['alamat_ortu']; ?>" readonly="" class="form-control" placeholder="Masukkan Alamat Orang Tua/Wali" required>
                                        </div>
                                    </div>
                                    <label for="user">No. Telepon Orang Tua</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="telp21" name="telp21" value="<?php echo $d['telp_ortu']; ?>" readonly="" class="form-control" placeholder="Masukkan No. Telp Ortu/Wali" required>
                                        </div>
                                    </div>
                                        
                                    </div> <!-- tutup col 6 -->
                                </div> <!-- tutup personal -->

                                <div role="tabpanel" class="tab-pane fade" id="perkuliahan1">
                                    <div class="col-md-6">
                                        <label for="user">Nama Perguruan Tinggi/Universitas</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="pt1" name="pt1" value="<?php echo $d['perguruan_tinggi']; ?>" readonly="" class="form-control" required placeholder="Masukkan Nama Perguruan Tinggi/Universitas">
                                            </div>
                                        </div>
                                        <label for="user">Alamat Perguruan Tinggi/Universitas</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="alamatP1" name="alamatP1" value="<?php echo $d['alamat_pt']; ?>" readonly="" class="form-control" required placeholder="Masukkan alamat lengkap Perguruan Tinggi/Universitas">
                                            </div>
                                        </div>
                                        <label for="user">No. Telepon Perguruan Tinggi/Universitas</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="telp31" name="telp31" value="<?php echo $d['telp_pt']; ?>" readonly="" class="form-control" required placeholder="Masukkan No. Telepon Perguruan Tinggi/Universitas">
                                            </div>
                                        </div>
                                        <label for="user">Jenjang</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="jenjang1" name="jenjang1" value="<?php echo $d['jenjang']; ?>" readonly="" class="form-control" required placeholder="Masukkan Jenjang Pendidikan yang diambil">
                                            </div>
                                        </div>
                                        <label for="user">Angkatan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="angkatan1" name="angkatan1" value="<?php echo $d['angkatan']; ?>" readonly="" class="form-control" required placeholder="Masukkan Angkatan Masuk Kuliah">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user">Fakultas</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="fakultas1" name="fakultas1" value="<?php echo $d['fakultas']; ?>" readonly="" class="form-control" required placeholder="Masukkan Fakultas yang diaambil">
                                            </div>
                                        </div>
                                        <label for="user">Program Studi</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="ps1" name="ps1" value="<?php echo $d['program_studi']; ?>" readonly="" class="form-control" required placeholder="Masukkan Program Studi yang diambil">
                                            </div>
                                        </div>
                                        <label for="user">Jurusan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="jurusan1" name="jurusan1" value="<?php echo $d['jurusan']; ?>" readonly="" class="form-control" required placeholder="Masukkan Jurusan yang diambil">
                                            </div>
                                        </div>
                                        <label for="user">Bidang Keilmuan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" id="ilmu1" name="ilmu1" value="<?php echo $ilmu; ?>" data-ilmu="<?php echo $d['ilmu']; ?>" readonly="" class="form-control" required placeholder="Masukkan Jurusan yang diambil">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> <!-- tutup perkuliahan -->




                                <div role="tabpanel" class="tab-pane fade" id="bank1">
                                    <label for="user">Nama Bank</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="nmbank1" name="nmbank1" value="<?php echo $d['nama_bank']; ?>" readonly="" class="form-control" required placeholder="Masukkan Nama Bank">
                                        </div>
                                    </div>
                                    <label for="user">Alamat Bank </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="alamatB1" name="alamatB1" value="<?php echo $d['alamat_bank']; ?>" readonly="" class="form-control" required placeholder="Masukkan Alamat Bank Cabang">
                                        </div>
                                    </div>
                                    <label for="user">No. Telepon Bank </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="telp41" name="telp41" value="<?php echo $d['telp_bank']; ?>" readonly="" class="form-control" required placeholder="Masukkan No. Telepon Bank Cabang">
                                        </div>
                                    </div>
                                    <label for="user">No. Rekening </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="norek1" name="norek1" value="<?php echo $d['no_rekening']; ?>" readonly="" class="form-control" required placeholder="Masukkan No. Rekening">
                                        </div>
                                    </div>
                                    <label for="user">Nama Pemilik</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="pemilik1" name="pemilik1" value="<?php echo $d['pemilik']; ?>" readonly="" class="form-control" required placeholder="Masukkan Nama Pemilik Sesuai Buku Rekening">
                                        </div>
                                    </div>
                                </div> <!-- tutup bank -->

                            </div>
                        </div>
                            </form>
                            <div class="col-md-12">
                            <button type="button" class="btn bg-teal waves-effect" id="btn-prev1" style="color:#fff;">SEBELUMNYA</button> &nbsp; &nbsp;
                            <button type="button" class="btn bg-teal waves-effect" id="btn-next1" style="color:#fff;">SELAJUTNYA</button>
                                
                            </div>


<script type="text/javascript">
    $(document).ready(function(){

    var dpt = $('#pt1').val();
    var dnb = $('#nmbank1').val();
    var dnr = $('#norek1').val();

    if (dpt === "" || dnb === "" || dnr === "") {
        $('#ber').addClass('dsb');
        $('#bea').addClass('dsb');
        $('#faq').addClass('dsb');
    }else{
        $('#ber').removeClass('dsb');
        $('#bea').removeClass('dsb');        
        $('#faq').removeClass('dsb');        
    }

        $("#tabs2").val('4');

            $("#btn-next1").show(); 
            $("#btn-prev1").show(); 
            $("#btn-prev1").removeAttr('class');
            $("#btn-prev1").attr('disabled', '');
            $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');

        $("#btn-next1").click(function(){ 
            var aktif = $('#tabs2').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs2').val(next);

            if ($('#tabs2').val() == 6) {
            $("#btn-next1").show(); 
                $("#btn-next1").removeAttr('class');
                $("#btn-next1").attr('disabled', '');
                $("#btn-next1").attr('class', 'btn bg-grey waves-effect');
            }           
        });

        $("#btn-prev1").click(function(){ 
            var aktif = $('#tabs2').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs2').val(next);
            $("#btn-next1").show(); 
            $("#btn-simpan").hide(); 
            
            if($('#tabs2').val() == 4){
                $("#btn-simpan").hide(); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").attr('disabled', '');
                $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');
            }
        });


        $("#6").click(function(){  
                $("#tabs2").val(6); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").removeAttr('disabled');
                $("#btn-prev1").attr('class', 'btn bg-teal waves-effect');

                $("#btn-next1").removeAttr('class');
                $("#btn-next1").attr('disabled', '');
                $("#btn-next1").attr('class', 'btn bg-grey waves-effect');
        });
        $("#5").click(function(){ 
                $("#tabs2").val(5); 
                $("#btn-next1").show(); 
                $("#btn-prev1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").removeAttr('disabled');
                $("#btn-prev1").attr('class', 'btn bg-teal waves-effect');
                $("#btn-next1").removeAttr('class');
                $("#btn-next1").removeAttr('disabled');
                $("#btn-next1").attr('class', 'btn bg-teal waves-effect');
        });

        $("#4").click(function(){ 
                $("#tabs2").val(4); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").attr('disabled', '');
                $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');
                $("#btn-next1").removeAttr('class');
                $("#btn-next1").removeAttr('disabled');
                $("#btn-next1").attr('class', 'btn bg-teal waves-effect');
        });


        $("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
    $("#modal-title").html('Form Ubah data');
    $("#btn-simpan").hide();
    $("#btn-next").show();
    $("#tabs1").val('1');
    $("#btn-prev").removeAttr('class');
    $("#btn-prev").attr('disabled', '');
    $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
    $("#aks").val('edt');
    
    var nama1 = $("#nama1").val();  
    var ktm1 = $("#ktm1").val();  
    var ktp1 = $("#ktp1").val();  
    var tpl1 = $("#tpl1").val();  
    var tgl1 = $("#tgl1").val();  
    var kota1 = $("#kota1").data('kota');  
    var ilmu1 = $("#ilmu1").data('ilmu');  
    var alamatS1 = $("#alamatS1").val();  
    var alamatKtp1 = $("#alamatKtp1").val();  
    var telp11 = $("#telp11").val();  
    var ayah1 = $("#ayah1").val();  
    var ibu1 = $("#ibu1").val();  
    var alamatO1 = $("#alamatO1").val();  
    var telp21 = $("#telp21").val();  
    var pt1 = $("#pt1").val();  
    var alamatP1 = $("#alamatP1").val();  
    var telp31 = $("#telp31").val();  
    var jenjang1 = $("#jenjang1").val();  
    var angkatan1 = $("#angkatan1").val();  
    var fakultas1 = $("#fakultas1").val();  
    var ps1 = $("#ps1").val();  
    var jurusan1 = $("#jurusan1").val();  
    var nmbank1 = $("#nmbank1").val();  
    var alamatB1 = $("#alamatB1").val();  
    var telp41 = $("#telp41").val();  
    var norek1 = $("#norek1").val();  
    var pemilik1 = $("#pemilik1").val();  
    
    if (tgl1 === '0000-00-00') {
        $("#tgl").val('');
    }else{
        $("#tgl").val(tgl1);
    }
    
    $("#nama").val(nama1);
    $("#ktm").val(ktm1);
    $("#ktp").val(ktp1);
    $("#tpl").val(tpl1);
    $("#kota").val(kota1).change();
    $("#alamatS").val(alamatS1);
    $("#alamatKtp").val(alamatKtp1);
    $("#telp1").val(telp11);
    $("#ayah").val(ayah1);
    $("#ibu").val(ibu1);
    $("#alamatO").val(alamatO1);
    $("#telp2").val(telp21);
    $("#pt").val(pt1);
    $("#alamatP").val(alamatP1);
    $("#telp3").val(telp31);
    $("#jenjang").val(jenjang1);
    $("#angkatan").val(angkatan1);
    $("#fakultas").val(fakultas1);
    $("#ps").val(ps1);
    $("#jurusan").val(jurusan1);
    $("#ilmu").val(ilmu1).change();
    $("#nmbank").val(nmbank1);
    $("#alamatB").val(alamatB1);
    $("#telp4").val(telp41);
    $("#norek").val(norek1);
    $("#pemilik").val(pemilik1);
        });

    });
</script>