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
                                            <th style="text-align:center;">Tampilkan</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT p.*, u.nama_user FROM pengumuman p, user u WHERE p.author=u.id_user");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $no++;
                                            
                                            if ($d['tampil'] == 1) {
                                                $s = 'checked';
                                            }else{
                                                $s = '';
                                            }

                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge bg-indigo viewfile" onclick="viewfile('.$d['id_pengumuman'].')" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile-'.$no.'" data-target="#modal-file">'.$d['judul_pengumuman'].'</a></td>
                                                    <td align="center">'.$d['waktu_pengumuman'].'</td>
                                                    <td align="center">'.$d['nama_user'].'</td>
                                                    <td align="center">
                                                        <div class="form-group">
                                                            <div class="switch">
                                                                <label><input type="checkbox" data-id="'.$d['id_pengumuman'].'" '.$s.' class="cek3"><span class="lever switch-col-deep-purple"></span></label>
                                                            </div>
                                                        </div>
                                                    </td>                                                    
                                                    <td align="center">
                                                    <a class="badge bg-teal btnedit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal" onclick="edit('.$d['id_pengumuman'].');" id="viewfile1-'.$no.'">
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a> &nbsp;&nbsp; 
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_pengumuman'].');" data-toool="tooltip" data-placement="bottom" title="Hapus Data">
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
 
function edit(id){
    $("#btn-simpan").hide();  
    $("#btn-ubah").show();  
   
     $("#modal-title").html('Form Ubah data');
    
                    var data = new FormData();
                    data.append('id_pengumuman', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'pengumuman-aksi.php', 
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
                            
                                document.getElementById("id_pengumuman").value = id;
                                document.getElementById("judul").value = response.judul;
                                tinyMCE.get('isi').setContent(response.isi); 

                                $('#viewfile1').attr('data-judul', judul); 
                            
                        }
                
                    });


   
}

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
                    data.append('id_pengumuman', id);   
                    data.append('aksi', 'del'); 
                                        
                    $.ajax({
                        url: 'pengumuman-aksi.php', 
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
                            
                             $("#view").load('pengumuman-data.php');

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
                    data.append('id_pengumuman', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'pengumuman-aksi.php', 
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
                            
                            $("#md").html('Lihat pengumuman - '+response.judul);  

                            var vf = '<span style="font-size:11px;"> Admin'+' - '+response.waktu+'</span><br><h2>'+ response.judul +'</h2><br><span style="text-align:justify;">'+response.isi+'</span>'; //jika berekstensi gambar tampilkan sebagai gambar
                            $("#view-file").html(vf);
                            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
                            
                        }
                
                    });

}


$('input.cek3').on('change', function(){ // on change of state
   $('input.cek3').not(this).prop('checked', false);
   var id = $(this).attr('data-id');

                    var data = new FormData();
                    data.append('id_pengumuman', id);  
                    data.append('aksi', 'ushow'); 
                                        
                    $.ajax({
                        url: 'pengumuman-aksi.php', 
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
                            
                            if (response.status == 'ok') {
                                notif('BERHASIL!', 'Data Berhasil disimpan.', 'success', 1700);
                            }else{
                                notif('GAGAL!', 'Data Gagal disimpan.', 'danger', 1700);
                            }
                            
                        }
                
                    });

});

</script>
