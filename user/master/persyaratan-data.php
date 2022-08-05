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
                                            <th style="text-align:center;">Keterangan</th>
                                            <th style="text-align:center;">Tampilkan</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT * FROM persyaratan");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            if ($d['tampil'] == 1) {
                                                $s = 'checked';
                                            }else{
                                                $s = '';
                                            }

                                            $no++;
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge bg-indigo viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile-'.$no.'" data-target="#modal-file" onclick="viewfile('.$d['id_persyaratan'].')">'.$d['keterangan'].'</a></td>
                                                    <td align="center">
                                                        <div class="form-group">
                                                            <div class="switch">
                                                                <label><input type="checkbox" data-id="'.$d['id_persyaratan'].'" '.$s.' class="cek3"><span class="lever switch-col-deep-purple"></span></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                    <a class="badge bg-teal btnedit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal" onclick="edit('.$d['id_persyaratan'].');">
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_persyaratan'].');">
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
    $("#btn-simpan").hide();  
    $("#btn-ubah").show();  
   
     
    $("#modal-title").html('Form Ubah data');
    
                    var data = new FormData();
                    data.append('id_persyaratan', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'persyaratan-aksi.php', 
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
                            
                            document.getElementById("id_persyaratan").value = response.id;
                            document.getElementById("keterangan").value = response.keterangan;
                            tinyMCE.get('persyaratan').setContent(response.persyaratan);
                            
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
                    data.append('id_persyaratan', id);  
                    data.append('aksi', 'del');  
                                        
                    $.ajax({
                        url: 'persyaratan-aksi.php',  
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
                            
                             
                            $("#view").load('persyaratan-data.php');

                             
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


$('input.cek3').on('change', function(){ // on change of state
   $('input.cek3').not(this).prop('checked', false);
   var id = $(this).attr('data-id');

                    var data = new FormData();
                    data.append('id_persyaratan', id);  
                    data.append('aksi', 'ushow'); 
                                        
                    $.ajax({
                        url: 'persyaratan-aksi.php', 
                        type: 'POST', 
                        data: data,  
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        beforeSend: function(e) {
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        }
                
                    });

});

</script>
