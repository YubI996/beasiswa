<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

?>



                                <table class="table table-bordered table-striped table-hover" id="example" style="margin-right:0px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">No.</th>
                                            <th style="text-align:center;">Foto</th>
                                            <th style="text-align:center;">Nama</th>
                                            <th style="text-align:center;">Perguruan Tinggi</th>
                                            <th style="text-align:center;">Jenjang</th>
                                            <th style="text-align:center;">Jurusan</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT m.*, u.foto_user FROM mahasiswa m, user u WHERE m.id_user=u.id_user");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $no++;

                                            $fotou = (file_exists($host.'/user/master/foto_user/'.$d['foto_user']) ? $d['foto_user'] : 'default.png');
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><img src="'.$host.'/user/master/foto_user/'.$d['foto_user'].'" style="width:40px; height:auto;" /></td>
                                                    <td align="center"><a class="badge bg-brown viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" onclick="viewfile('.$d['id_mahasiswa'].')" data-no="'.$no.'" data-target="#form-modal" >'.$d['nama_mahasiswa'].'</a></td>
                                                    <td align="center">'.$d['perguruan_tinggi'].'</td>
                                                    <td align="center">'.$d['jenjang'].'</td>
                                                    <td align="center">'.$d['jurusan'].'</td>
                                                    <td align="center">
                                                    <a class="badge bg-teal btnedit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal" onclick="edit('.$d['id_mahasiswa'].');" >
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_mahasiswa'].');" >
                                                    <i class="material-icons" style="font-size:16px;" >delete_forever</i></a></td>
                                                </tr>';

                                                ?>

                                      <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>

<script type="text/javascript">
var t = $('#example').DataTable( {
        responsive: true,
        "autoWidth": false,
        "language": {
            "search": "Filter data:",
            "emptyTable":     "<center>Belum ada data dalam database!</center>",
            "zeroRecords":    "<center>Tidak ditemukan data yang sesuai dengan kata kunci!</center>",
            "lengthMenu":     "Tampilkan _MENU_ entri",
            "info":           "Menampilkan _START_ - _END_ / _TOTAL_ entri",
            "infoEmpty":      "Menampilkan 0 - 0 dari 0 entri",
            "infoFiltered":   "(difilter dari _MAX_ total entri)",
            "paginate": {
                "first":      "Awal",
                "last":       "Akhir",
                "next":       "Selanjutnya",
                "previous":   "Sebelumnya"
            },
        },
    } );

// Fungsi ini akan dipanggil ketika tombol edit diklik
function edit(id){
    $("#btn-simpan").html('UBAH');  
    $("#btn-simpan").show();  
    $("#btn-next").show();  
    $("#tabs1").val('1');
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title").html('Form Ubah data');
    $("#btn-prev").removeAttr('class');
    $("#btn-prev").attr('disabled', '');
    $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
    $("#aks").val('edt');
    
                    var data = new FormData();
                    data.append('id_mahasiswa', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'mahasiswa-aksi.php', 
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

                            if (response.tgl == '0000-00-00') {
                                document.getElementById("tgl").value = '';
                            }else{
                                document.getElementById("tgl").value = response.tgl;
                            }
                            
                            document.getElementById("id_mahasiswa").value = id;
                            $("#id_user").val(response.idusr).change();
                            $("#kota").val(response.kota+'~'+response.daerah).change();
                            $("#jenjang").val(response.jenjang).change();
                            $("#ilmu").val(response.ilmu).change();
                            document.getElementById("nama").value = response.nama;
                            document.getElementById("ktm").value = response.ktm;
                            document.getElementById("ktp").value = response.ktp;
                            document.getElementById("tpl").value = response.tpl;
                            document.getElementById("alamatS").value = response.alamatS;
                            document.getElementById("alamatKtp").value = response.alamatKtp;
                            document.getElementById("telp1").value = response.telp1;
                            document.getElementById("ayah").value = response.ayah;
                            document.getElementById("ibu").value = response.ibu;
                            document.getElementById("alamatO").value = response.alamatO;
                            document.getElementById("telp2").value = response.telp2;
                            document.getElementById("pt").value = response.pt;
                            document.getElementById("alamatP").value = response.alamatP;
                            document.getElementById("telp3").value = response.telp3;
                            document.getElementById("angkatan").value = response.angkatan;
                            document.getElementById("fakultas").value = response.fakultas;
                            document.getElementById("ps").value = response.ps;
                            document.getElementById("jurusan").value = response.jurusan;
                            document.getElementById("nmbank").value = response.nmbank;
                            document.getElementById("alamatB").value = response.alamatB;
                            document.getElementById("telp4").value = response.telp4;
                            document.getElementById("norek").value = response.norek;
                            document.getElementById("pemilik").value = response.pemilik;
                            
                        }
                
                    });

    
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus(id){

        //tampilkan pesan konfirmasi dengan sweetalert
        swal({
        title: "Apakah Anda yakin ingin menghapus data ini?",
        text: "Data akan dihapus permanen dari sistem!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        //closeOnCancel: false
    },
    function(){ //jika di konfirmasi = Ya

                    // Buat variabel data untuk menampung data hasil input dari form
                    var data = new FormData();
                    data.append('id_mahasiswa', id);  
                    data.append('aksi', 'del');  
                                        
                    $.ajax({
                        url: 'mahasiswa-aksi.php',  
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
                            
                            // Ganti isi dari div view dengan view yang diambil dari proses_hapus.php
                            $("#view").load('mahasiswa-data.php');

                            //tampilkan loading dan pesan berhasil dihapus dengan sweetalert
                            setTimeout(function () {
                            swal({
                                title: 'Berhasil!',
                                text:  'Data berhasil dihapus!',
                                type: 'success',
                                timer: 1800,
                                showConfirmButton: false
                            });
                            }, 1200);     
                            
                        },
                        error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error

                            //tampilkan pesan error dengan sweetalert
                            setTimeout(function () {
                            swal({
                                title: 'Gagal!',
                                text:  'Data gagal dihapus! \n Error : ' +xhr.responseText,
                                type: 'error',
                                html: true,
                                showConfirmButton: true
                            });
                            }, 1200);      
                        }
                
                    });
    });

}

/*        $(".viewfile").click(function(){ // Ketika tombol view di klik
            var no = $(this).attr('data-no'); //ubah title modal view file
            var id = $("#id-value-" + no).val(); // Ambil id dari input type hidden
            var id_user = $("#id_user-value-" + no).val();  
            var nama = $("#nama-value-" + no).val();  
            var ktm = $("#ktm-value-" + no).val();  
            var ktp = $("#ktp-value-" + no).val();  
            var tpl = $("#tpl-value-" + no).val();  
            var tgl = $("#tgl-value-" + no).val();  
            var kota = $("#kota-value-" + no).val();  
            var alamatS = $("#alamatS-value-" + no).val();  
            var alamatKtp = $("#alamatKtp-value-" + no).val();  
            var telp1 = $("#telp1-value-" + no).val();  
            var email = $("#email-value-" + no).val();  
            var ayah = $("#ayah-value-" + no).val();  
            var ibu = $("#ibu-value-" + no).val();  
            var alamatO = $("#alamatO-value-" + no).val();  
            var telp2 = $("#telp2-value-" + no).val();  
            var pt = $("#pt-value-" + no).val();  
            var alamatP = $("#alamatP-value-" + no).val();  
            var telp3 = $("#telp3-value-" + no).val();  
            var jenjang = $("#jenjang-value-" + no).val();  
            var angkatan = $("#angkatan-value-" + no).val();  
            var fakultas = $("#fakultas-value-" + no).val();  
            var ps = $("#ps-value-" + no).val();  
            var jurusan = $("#jurusan-value-" + no).val();  
            var nmbank = $("#nmbank-value-" + no).val();  
            var alamatB = $("#alamatB-value-" + no).val();  
            var telp4 = $("#telp4-value-" + no).val();  
            var norek = $("#norek-value-" + no).val();  
            var pemilik = $("#pemilik-value-" + no).val();  
            var foto = $("#foto-value-" + no).val();  

            $("#md").html('Lihat Mahasiswa - '+nama); //ubah title modal view file


                var vf = '<div class="col-md-10"><table class="table table-striped">  <tr>    <td>ID Mahasiswa</td>    <td >: '+id+'</td>  </tr>  <tr>    <td>ID User</td>    <td>: '+id_user+'</td>  </tr>  <tr>    <td>Nama Mahasiswa</td>    <td>: '+nama+'</td>  </tr>  <tr>    <td>No. KTM</td>    <td>: '+ktm+'</td>  </tr>  <tr>    <td>No. KTP</td>    <td>: '+ktp+'</td>  </tr>  <tr>    <td>Tempat, Tanggal Lahir</td>    <td>: '+tpl+', '+tgl+'</td>  </tr>  <tr>    <td>Kota Saat ini</td>    <td>: '+kota+'</td>  </tr>  <tr>    <td>Alamat KTP</td>    <td>: '+alamatKtp+'</td>  </tr>  <tr>    <td>Alamat Sekarang</td>    <td>: '+alamatS+'</td>  </tr>  <tr>    <td>No. Telepon Mahasiswa</td>    <td>: '+telp1+'</td>  </tr>  <tr>    <td>Email</td>    <td>: '+email+'</td>  </tr> <tr>    <td>Nama Ayah</td>    <td>: '+ayah+'</td>  </tr>  <tr>    <td>Nama Ibu</td>    <td>: '+ibu+'</td>  </tr>  <tr>    <td>Alamat Ortu/ Wali</td>    <td>: '+alamatO+'</td>  </tr>  <tr>    <td>No. Telepon Ortu/Wali</td>    <td>: '+telp2+'</td>  </tr>  <tr>    <td>Nama Perguruan Tinggi/Universitas</td>    <td>: '+pt+'</td>  </tr>  <tr>    <td>No. Telepon Perguruan Tinggi/Universitas</td>    <td>: '+telp3+'</td>  </tr>  <tr>    <td>Jenjang</td>    <td>: '+jenjang+'</td>  </tr>  <tr>    <td>Angkatan</td>    <td>: '+angkatan+'</td>  </tr>  <tr>    <td>Fakultas</td>    <td>: '+fakultas+'</td>  </tr>  <tr>    <td>Program Studi</td>    <td>: '+ps+'</td>  </tr>  <tr>    <td>Jurusan</td>    <td>: '+jurusan+'</td>  </tr>  <tr>    <td>Nama Bank</td>    <td>: '+nmbank+'</td>  </tr>  <tr>    <td>Alamat Bank</td>    <td>: '+alamatB+'</td>  </tr>  <tr>    <td>No. Telepon Bank</td>    <td>: '+telp4+'</td>  </tr>  <tr>    <td>No. Rekening</td>    <td>: '+norek+'</td>  </tr>  <tr>    <td>Nama Pemilik</td>    <td>: '+pemilik+'</td>  </tr></table></div><div class="col-md-2"><img src="foto_user/'+ foto +'" style="height:auto; width:100%; margin:0px 10px 5px 0px; "></div>';

            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
        });
*/

</script>
