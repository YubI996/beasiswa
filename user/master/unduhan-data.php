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
                                            <th style="text-align:center;">Nama File</th>
                                            <th style="text-align:center;">Keterangan</th>
                                            <th style="text-align:center;">Waktu</th>
                                            <th style="text-align:center;">Author</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT d.*, u.nama_user AS namaAuthor, u.level FROM download d, user u WHERE d.author=u.id_user");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $fl = "'".$d['nama_file']."'";
                                            $no++;
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><span id="ffile"><a class="badge bg-indigo viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile-'.$no.'" style="word-wrap: break-word; word-break: break-all; white-space: normal;" onclick="viewfile('.$fl.')" data-target="#modal-file">'.$d['nama_file'].'</a></span></td>
                                                    <td align="left">'.$d['keterangan_file'].'</td>
                                                    <td align="center">'.$d['waktu_upload'].'</td>
                                                    <td align="center">'.$d['namaAuthor'].' ('.$d['level'].')</td>
                                                    <td align="center">
                                                    <a class="badge bg-teal btnedit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal" onclick="edit('.$d['id_file'].');" id="viewfile1-'.$no.'">
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_file'].','.$fl.');" data-toool="tooltip" data-placement="bottom" title="Hapus Data">
                                                    <i class="material-icons" style="font-size:16px;" >delete_forever</i></a></td>
                                                </tr>
                                        ';
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
    $("#btn-simpan").hide(); // Sembunyikan tombol simpan
    $("#btn-ubah").show(); // tampilkan tombol ubah  
    $("#cek-file").show(); // tampilkan cek ubah file  
    $("#unduhan").hide(); // tampilkan cek ubah file  
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title").html('Form Ubah data');
    
                    var data = new FormData();
                    data.append('id_file', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'unduhan-aksi.php', 
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
                            
                            $("#nmfile").html(response.nama); 
                            $("#viewfile1").attr('onclick', 'viewfile('+response.nama+')'); 
                            document.getElementById("id_unduhan").value = response.id;
                            document.getElementById("keterangan").value = response.keterangan; 
                            
                        }
                
                    });


    
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus(id, fl){


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
                    data.append('id_unduhan', id); // Ambil data id_unduhan
                    data.append('fl', fl); // Ambil data file lama
                    data.append('aksi', 'del'); // set data aksi = del untuk pembanding aksi
                                        
                    $.ajax({
                        url: 'unduhan-aksi.php', // File tujuan
                        type: 'POST', // Tentukan type nya POST atau GET
                        data: data, // Set data yang akan dikirim
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        beforeSend: function(e) {
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        },
                        success: function(response){ // Ketika proses pengiriman berhasil
                            
                            // Ganti isi dari div view dengan view yang diambil dari proses_hapus.php
                            $("#view").load('unduhan-data.php');

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




</script>
