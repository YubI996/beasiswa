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
                                            <th style="text-align:center; width: 80%">Periode</th>
                                            <th style="text-align:center; width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT * FROM periode");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $no++;
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center">'.$d['periode'].'</td>
                                                    <td align="center">
                                                    <a class="badge bg-teal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal" onclick="edit('.$d['id_periode'].');" >
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_periode'].');">
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
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title").html('Form Ubah data');
    
                    var data = new FormData();
                    data.append('id_periode', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'periode-aksi.php', 
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
                            
                            document.getElementById("id_periode").value = response.id;
                            document.getElementById("periode").value = response.periode;
                            
                        }
                
                    });
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus(id){

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

                    var data = new FormData();
                    data.append('id_periode', id);  
                    data.append('aksi', 'del');  
                                        
                    $.ajax({
                        url: 'periode-aksi.php',  
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
                            
                             
                            $("#view").load('periode-data.php');

                             
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
                        error: function (xhr, ajaxOptions, thrownError) {  

                             
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
