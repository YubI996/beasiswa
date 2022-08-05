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
                                            <th style="text-align:center;">Judul</th>
                                            <th style="text-align:center;">Waktu</th>
                                            <th style="text-align:center;">Author</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT b.*, u.nama_user AS namaAuthor, u.level FROM berita b, user u WHERE b.author=u.id_user");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $fl = "'".$d['foto']."'";
                                            $no++;
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center" style="word-wrap: break-word; word-break: break-all; white-space: normal;"><a class="badge bg-indigo viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="viewfile('.$d['id_berita'].')" data-target="#modal-file">'.$d['judul'].'</a></td>
                                                    <td align="center">'.$d['waktu_upload'].'</td>
                                                    <td align="center">'.$d['namaAuthor'].' ('.$d['level'].')</td>
                                                    <td align="center">
                                                    <a class="badge bg-teal btnedit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal" onclick="edit('.$d['id_berita'].');" id="viewfile1-'.$no.'" >
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_berita'].','.$fl.');" >
                                                    <i class="material-icons" style="font-size:16px;" >delete_forever</i></a></td>
                                                </tr>
                                        ';
                                        }
                                    ?>
            <input type="text" id="data-fl" value="" style="display:none;">
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
    $("#foto").hide(); // tampilkan cek ubah file  
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title").html('Form Ubah data');
    
                    var data = new FormData();
                    data.append('id_berita', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'berita-aksi.php', 
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
                            
                                $("#data-fl").val(response.foto);  
                                
                                document.getElementById("id_berita").value = id;
                                document.getElementById("judul").value = response.judul;
                                tinyMCE.get('isi').setContent(response.isi);

                                $("#nmfile").html(response.foto); 
                                $('#viewfile1').attr('data-judul', response.judul); 
                                $('#viewfile1').attr('data-foto', response.foto); 
                            
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
                    data.append('id_berita', id); // Ambil data id_berita
                    data.append('fl', fl); // Ambil data file lama
                    data.append('aksi', 'del'); // set data aksi = del untuk pembanding aksi
                                        
                    $.ajax({
                        url: 'berita-aksi.php', // File tujuan
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
                            $("#view").load('berita-data.php');

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


function viewfile(id){

                    var data = new FormData();
                    data.append('id_berita', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'berita-aksi.php', 
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
                            
                            $("#md").html('Lihat Berita - '+response.judul); //ubah title modal view file


                                var vf = '<span style="font-size:11px;"> Admin'+' - '+response.waktu+'</span><br><h2>'+ response.judul +'</h2><br><img src="file_berita/'+ response.foto +'" style="height:auto; width:30%; float:left; margin:0px 10px 0px 0px; "><span style="text-align:justify;">'+response.isi+'</span>'; //jika berekstensi gambar tampilkan sebagai gambar

                            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
                            
                        }
                
                    });

}



</script>
