<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

?>



                                <table class="table table-bordered table-hover" id="example" style="margin-right:0px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; width: 5%;">No.</th>
                                            <th style="text-align:center; width: 70%;">Kritik / Saran</th>
                                            <th style="text-align:center; width: 5%;">Suka</th>
                                            <th style="text-align:center; width: 10%;">Tampilkan</th>
                                            <th style="text-align:center; width: 10%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT * FROM kritik ORDER BY id_kritik DESC");
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
                                                    <td align="left">'.$d['kritik'].'<br><hr>'.tglWaktu($d['tgl_kritik']).'<br>'.$d['nama'].'<br>'.$d['email'].'<br></td>
                                                    <td align="center">'.$d['suka'].'</td>
                                                    <td align="center">
                                                        <div class="form-group">
                                                            <div class="switch">
                                                                <label><input type="checkbox" data-id="'.$d['id_kritik'].'" '.$s.' class="cek3"><span class="lever switch-col-indigo"></span></label>
                                                            </div>
                                                        </div>
                                                    </td>                                                    
                                                    <td align="center">
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus('.$d['id_kritik'].');" data-toool="tooltip" data-placement="bottom" title="Hapus Data">
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
                    data.append('id_kritik', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'kritik-aksi.php', 
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
                            
                                document.getElementById("id_kritik").value = id;
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
                    data.append('id_kritik', id);   
                    data.append('aksi', 'del'); 
                                        
                    $.ajax({
                        url: 'kritik-aksi.php', 
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
                            
                             $("#view").load('kritik-data.php');

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
                    data.append('id_kritik', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'kritik-aksi.php', 
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
   var id = $(this).attr('data-id');
   if ($(this).is(':checked') == true) {
        var tampil = 1;
   }else{
        var tampil = 0;
   }
                    var data = new FormData();
                    data.append('id_kritik', id);  
                    data.append('tampil', tampil);  
                    data.append('aksi', 'ushow'); 
                                        
                    $.ajax({
                        url: 'kritik-aksi.php', 
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
