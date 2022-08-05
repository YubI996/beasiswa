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
                                            <th style="text-align:center; width: 5%">No.</th> 
                                            <th style="text-align:center; width: 20%">Nama</th>
                                            <th style="text-align:center; width: 20%">Level</th>
                                            <th style="text-align:center; width: 20%">Last Login</th>
                                            <th style="text-align:center; width: 20%">Status</th>
                                            <th style="text-align:center; width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT * FROM user");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $fl = "'".$d['foto_user']."'";
                                            $no++;
                                            if ($d['status_aktivasi'] == '0') {
                                                $da = "red";
                                            }else{
                                                $da = "cyan";
                                            }

                                            if ($d['online'] == '0') {
                                                $on = '<div class="badge bg-grey"> </div>';
                                            }else{
                                                $on = '<div class="badge bg-green"> </div>';
                                            }

                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td> 
                                                    <td align="left">
                                                        <a class="badge bg-'.$da.' viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile-'.$no.'" data-target="#modal-file" onclick="viewfile('.$d['id_user'].')">'.$d['nama_user'].'</a> </td>
                                                    <td align="center">'.($d['level'] == "" ? "-" : $d['level']).'</td>
                                                    <td align="center">'.($d['last_login'] == "" ? "-" : $d['last_login']).'</td>
                                                    <td align="center">'.$on.'</td>
                                                    <td align="center">
                                                        <a class="badge bg-teal btnedit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal1" onclick="edit('.$d['id_user'].');" id="viewfile1-'.$no.'">
                                                        <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                        <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_user'].', '.$fl.');">
                                                        <i class="material-icons" style="font-size:16px;" >delete_forever</i></a> </td>
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
        "deferRender": true,
        "iDisplayLength": 10,
        "language": {
            "search": "Filter data:",
            "emptyTable":     "Belum ada data dalam database!",
            "zeroRecords":    "Tidak ditemukan data yang sesuai dengan kata kunci!",
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

function edit(id){
    $("#btn-ubah").show();  
    $("#cek-foto").show();  
    $("#foto").hide();  
    $("#cek-password").show(); 
    $("#pass").hide();  
   
    $("#modal-title1").html('Form Ubah data');
    
                    var data = new FormData();
                    data.append('id_user', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'user-aksi.php', 
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

                            document.getElementById("fl").value = response.foto;
                            document.getElementById("id_user").value = response.id;
                            document.getElementById("nama2").value =  response.nama;
                            document.getElementById("email2").value =  response.email;
                            document.getElementById("username2").value =  response.username;

                            var data1 = response.foto;  
                            var data2 = response.level; 
                            var data3 = response.statusA;

                            $('#viewfile1').attr('data-foto', data1);  
                            document.getElementById('nmfile').innerHTML = data1; 
                            $(".lvl").val(''+data2+'').change();
                            $('#cek-aktivasi').val(data3);
                            if (data3 == "0"){
                            document.getElementById("aktivasi2").checked = false;
                            document.getElementById("cek-aktivasi").value = '0';

                            }else{
                            document.getElementById("aktivasi2").checked = true;
                            document.getElementById("cek-aktivasi").value = '1';
                            }
                            
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
                    data.append('id_user', id); // Ambil data id_user
                    data.append('fl', fl); // Ambil data file lama
                    data.append('aksi', 'del'); // set data aksi = del untuk pembanding aksi
                                        
                    $.ajax({
                        url: 'user-aksi.php', // File tujuan
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
                            $("#view").load('user-data.php');

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
