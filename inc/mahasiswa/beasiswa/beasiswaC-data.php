<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");

$qm = $con->prepare("SELECT id_mahasiswa FROM mahasiswa WHERE id_user='$_SESSION[id]'");
$qm->execute();
$dt = $qm->fetch();
$idm = $dt['id_mahasiswa'];

$qp = $con->prepare("SELECT * FROM set_beasiswa");
$qp->execute();
$dp = $qp->fetch();
$dpr = $dp['periode'];
$dsb = $dp['status_beasiswa'];
$ds = $dp['status_penerimaan'];
$dtp = $dp['tgl_tutup'];
$dpb = $dp['publish'];
?>



                                <table class="table table-bordered table-striped table-hover" id="example3" style="margin-right:0px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">No.</th>
                                            <th style="text-align:center;">Nama Mahasiswa</th>
                                            <th style="text-align:center;">Periode</th>
                                            <th style="text-align:center;">Tanggal</th>
                                            <th style="text-align:center;">IPK</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $periode = @$_GET['prd'];
                                        if ($periode == "") {
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_coass b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_mahasiswa='$idm' ORDER BY b.id_bcs DESC");
                                            $sql->execute(); // Eksekusi querynya                                          
                                        }else{
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_coass b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_mahasiswa='$idm' AND (b.periode='$periode') ORDER BY b.id_bcs DESC");
                                            $sql->execute(); // Eksekusi querynya                                                                                      
                                        }

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $no++;



/*                                        if ($dpr == $d['periode']) { //jika periodenya sama 
                                                if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 1) { //cek status verif nya
                                                        
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#FF9800;" >error_outline</i></a>';
                                                }else if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 2) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#3498db;" >update</i></a>';

                                                }else if ($d['status_verifikasi'] == 2) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#F44336;" >cancel</i></a>';

                                                }else if ($d['status_verifikasi'] == 3) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#4CAF50;" >done_all</i></a>';
                                                }
                                                else{
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >watch_later</i></a>';                                                    
                                                }  

                                            
                                        }else{ //jika periode tidak sama
                                                if ($d['status_verifikasi'] == 3) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#4CAF50;" >done_all</i></a>';
                                                }
                                                else if ($d['status_verifikasi'] == 2) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#F44336;" >cancel</i></a>';
                                                }
                                                else if ($d['status_verifikasi'] == 1) { 
                                                        
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#FF9800;" >error_outline</i></a>';
                                                }
                                                else {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >watch_later</i></a>';
                                                }
 

                                        }

                                                if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 2){
                                                    $dc = 'bg-blue'; 
                                                }
                                                else if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 1) {
                                                    $dc = 'bg-orange';
                                                }
                                                else{
                                                    $dc = 'bg-green';
                                                } 
*/


                                        if ($dpr == $d['periode']) { //jika periodenya sama
                                            if ($dsb == 1) { //jika portal beasiswanya masih dibuka
                                                if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 1) { //cek status verif nya
                                                        
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#FF9800;" >error_outline</i></a>';
                                                }
                                                else if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 2) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >update</i></a>';

                                                }else if ($d['status_verifikasi'] == 3) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#e056fd;" >playlist_add_check</i></a>';
                                                }
                                                else{
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >watch_later</i></a>';                                                    
                                                }
                                            }else{ //jika portal ditutup

                                                if ($d['status_verifikasi'] == 3) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#e056fd;" >playlist_add_check</i></a>';
                                                }
                                                else {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#F44336;" >cancel</i></a>';
                                                }

                                            }



                                                if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 2){
                                                    $dc = 'bg-blue'; 
                                                }
                                                else if ($d['status_verifikasi'] == 1 && $d['status_perbaikan'] == 1) {
                                                    $dc = 'bg-orange';
                                                }
                                                else{
                                                    $dc = 'bg-teal';
                                                } 

                                            
                                        }else{ //jika periode tidak sama
                                                if ($d['status_verifikasi'] == 3) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#4CAF50;" >done_all</i></a>';
                                                }
                                                else if ($d['status_verifikasi'] == 2) {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#F44336;" >cancel</i></a>';
                                                }
                                                else if ($d['status_verifikasi'] == 1) { 
                                                        
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#FF9800;" >error_outline</i></a>';
                                                }
                                                else {
                                                    $sV = '<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >watch_later</i></a>';
                                                }

                                                $dc = 'bg-teal';

                                        }

                                            if ($dpr == $d['periode'] && $ds != 0 && $dtp > date("Y-m-d H:i:s") && $d['status_verifikasi'] < 3) {                                                
                                                $sV1 = '
                                                    <a class="badge bg-teal btnedit3" data-id="'.$no.'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal3" onclick="edit2('.$d['id_bcs'].');"  title="Ubah Data">
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a>  
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus2('.$d['id_bcs'].');"  title="Hapus Data">
                                                    <i class="material-icons" style="font-size:16px;" >delete_forever</i></a>
                                                ';                                                
                                            }else{
                                                $sV1 = '<a class="badge bg-purple viewfile3" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" data-no="'.$no.'" data-target="#form-file13"  onclick="viewfile3('.$d['id_bcs'].');" ><i class=" material-icons" style="font-size:16px;" >search</i></a>';
                                            }

                                            
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge '.$dc.' viewfile3" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" data-no="'.$no.'" data-target="#form-file13" onclick="viewfile3('.$d['id_bcs'].');">'.$d['nama_mahasiswa'].'</a></td>
                                                    <td align="center">'.$d['periode'].'</td>
                                                    <td align="center">'.$d['tgl_permohonan'].'</td>
                                                    <td align="center">'.$d['ipk'].'</td>
                                                    <td align="center">'.$sV.'</td>
                                                    <td align="center">'.$sV1.'</td>
                                                </tr>';

                                                ?>


                                      <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
<!-- <i class=" material-icons" style="font-size:19px;color:#4CAF50;" >done_all</i> = Berkas Lengkap / Pengajuan Diterima <br>
<i class=" material-icons" style="font-size:19px;color:#F44336;" >cancel</i> = Pengajuan Ditolak <br> 
<i class=" material-icons" style="font-size:19px;color:#FF9800;" >error_outline</i> = Berkas Salah/kurang lengkap <br> 
<i class=" material-icons" style="font-size:19px;color:#3498db;" >update</i> = Menunggu Verifikasi perbaikan berkas <br>
<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >watch_later</i> = Sedang dalam proses verifikasi 
 -->

<i class=" material-icons" style="font-size:19px;color:#4CAF50;" >done_all</i> = Pengajuan Diterima <br>
<i class=" material-icons" style="font-size:19px;color:#F44336;" >cancel</i> = Pengajuan Ditolak <br>
<i class=" material-icons" style="font-size:19px;color:#e056fd;" >playlist_add_check</i> = Berkas Lengkap <br>
<i class=" material-icons" style="font-size:19px;color:#FF9800;" >error_outline</i> = Berkas Salah/kurang lengkap <br> 
<i class=" material-icons" style="font-size:19px;color:#3498db;" >update</i> = Menunggu Verifikasi perbaikan berkas <br>
<i class=" material-icons" style="font-size:19px;color:#9E9E9E;" >watch_later</i> = Sedang dalam proses verifikasi 

<script type="text/javascript">
function filterColumn ( i ) {
    $('#example1').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
    ).draw();
}
$(document).ready(function() {
var t = $('#example3').DataTable( {
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
        /*"createdRow": function( row, data, dataIndex ) {
            if (dataIndex+1 < 2) {
                $(row).css('background-color', '#c1ffd0');
            }else{
                $(row).css('background-color', '#ffc7c1')
            }     
        }*/

    } );
    /*t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
        
    } ).draw();*/
});


// Fungsi ini akan dipanggil ketika tombol edit diklik
function edit2(id){
    $("#btn-simpan3").html('UBAH'); 
    $("#btn-simpan3").hide(); 
    $("#btn-next3").show(); 
    $(".ck3").show(); 
    $(".fc3").hide();  
    $("#aks3").val('edt'); 
    $("#tabs13").val('12');
    $("#fileN3").hide(); 
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title3").html('Form Ubah data');
    $("#btn-prev3").removeAttr('class');
    $("#btn-prev3").attr('disabled', '');
    $("#btn-prev3").attr('class', 'btn bg-grey waves-effect');
  
        document.getElementById("id_bcs").value = id;

                    var data = new FormData();
                    data.append('id_bcs', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'beasiswaC-aksi.php', 
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

                                    var pe = document.querySelectorAll('.viewfile13');
                                    pe[0].setAttribute('data-file', response.suratP);
                                    pe[1].setAttribute('data-file', response.suratAK);
                                    // pe[2].setAttribute('data-file', response.suratPN);
                                    // pe[3].setAttribute('data-file', response.propPN1);
                                    // pe[4].setAttribute('data-file', response.propPN2);
                                    pe[2].setAttribute('data-file', response.suratTA);
                                    pe[3].setAttribute('data-file', response.khs);
                                    pe[4].setAttribute('data-file', response.suratK);
                                    pe[5].setAttribute('data-file', response.suratB);
                                    pe[6].setAttribute('data-file', response.ktm);
                                    //pe[10].setAttribute('data-file', response.akta);
                                    /*
                                    pe[11].setAttribute('data-file', response.ktp);
                                    pe[12].setAttribute('data-file', response.kk);
                                    pe[13].setAttribute('data-file', response.domisili);
                                    pe[14].setAttribute('data-file', response.suratN);
                                    pe[15].setAttribute('data-file', response.sertifikat1);
                                    pe[16].setAttribute('data-file', response.sertifikat2);
                                    pe[17].setAttribute('data-file', response.sertifikat3);
                                    pe[18].setAttribute('data-file', response.burek);
                                    pe[19].setAttribute('data-file', response.ijazah1);
                                    pe[20].setAttribute('data-file', response.ijazah2);*/
                                    pe[7].setAttribute('data-file', response.kk);
                                    pe[8].setAttribute('data-file', response.ktp);
                                    pe[9].setAttribute('data-file', response.domisili);
                                    pe[10].setAttribute('data-file', response.suratN);
                                    pe[11].setAttribute('data-file', response.sertifikat1);
                                    pe[12].setAttribute('data-file', response.sertifikat2);
                                    pe[13].setAttribute('data-file', response.sertifikat3);
                                    pe[14].setAttribute('data-file', response.burek);
                                    pe[15].setAttribute('data-file', response.ijazah1);
                                    pe[16].setAttribute('data-file', response.ijazah2);

                                    //var filedata = data1.substr(-1);
                                if(response.suratP != ""){
                                    document.getElementById('fileSP3').innerHTML = response.suratP; 
                                }else{
                                document.getElementById('fileSP3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratAK != ""){
                                document.getElementById('fileAK3').innerHTML = response.suratAK; 
                                }else{
                                document.getElementById('fileAK3').innerHTML = 'Tidak ada file '; 
                                }
                                // if(response.suratPN != ""){
                                // document.getElementById('fileSPN3').innerHTML = response.suratPN; 
                                // }else{
                                // document.getElementById('fileSPN3').innerHTML = 'Tidak ada file '; 
                                // }
                                // if(response.propPN1 != ""){
                                // document.getElementById('filePR13').innerHTML = response.propPN1; 
                                // }else{
                                // document.getElementById('filePR13').innerHTML = 'Tidak ada file '; 
                                // }
                                // if(response.propPN2 != ""){
                                // document.getElementById('filePR23').innerHTML = response.propPN2; 
                                // }else{
                                // document.getElementById('filePR23').innerHTML = 'Tidak ada file '; 
                                // }
                                if(response.suratTA != ""){
                                document.getElementById('fileSTA3').innerHTML = response.suratTA; 
                                }else{
                                document.getElementById('fileSTA3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.khs != ""){
                                document.getElementById('fileKhs3').innerHTML = response.khs; 
                                }else{
                                document.getElementById('fileKhs3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratK != ""){
                                document.getElementById('fileSK3').innerHTML = response.suratK; 
                                }else{
                                document.getElementById('fileSK3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratB != ""){
                                document.getElementById('fileSB3').innerHTML = response.suratB; 
                                }else{
                                document.getElementById('fileSB3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktm != ""){
                                document.getElementById('fileKtm3').innerHTML = response.ktm; 
                                }else{
                                document.getElementById('fileKtm3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktp != ""){
                                document.getElementById('fileKtp3').innerHTML = response.ktp; 
                                }else{
                                document.getElementById('fileKtp3').innerHTML = 'Tidak ada file '; 
                                }
                                /*if(response.akta != ""){
                                document.getElementById('fileAkta3').innerHTML = response.akta; 
                                }else{
                                document.getElementById('fileAkta3').innerHTML = 'Tidak ada file '; 
                                }*/
                                if(response.kk != ""){
                                document.getElementById('fileKk3').innerHTML = response.kk; 
                                }else{
                                document.getElementById('fileKk3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.domisili != ""){
                                document.getElementById('fileDom3').innerHTML = response.domisili; 
                                }else{
                                document.getElementById('fileDom3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratN != ""){
                                document.getElementById('fileSN3').innerHTML = response.suratN; 
                                }else{
                                document.getElementById('fileSN3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat1 != ""){
                                document.getElementById('fileS13').innerHTML = response.sertifikat1; 
                                }else{
                                document.getElementById('fileS13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat2 != ""){
                                document.getElementById('fileS23').innerHTML = response.sertifikat2; 
                                }else{
                                document.getElementById('fileS23').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat3 != ""){
                                document.getElementById('fileS33').innerHTML = response.sertifikat3; 
                                }else{
                                document.getElementById('fileS33').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.burek != ""){
                                document.getElementById('fileBR3').innerHTML = response.burek; 
                                }else{
                                document.getElementById('fileBR3').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ijazah1 != ""){
                                document.getElementById('fileIjz13').innerHTML = response.ijazah1;
                                }else{
                                document.getElementById('fileIjz13').innerHTML = 'Tidak ada file ';
                                }
                                if(response.ijazah2 != ""){
                                document.getElementById('fileIjz23').innerHTML = response.ijazah2;
                                }else{
                                document.getElementById('fileIjz23').innerHTML = 'Tidak ada file ';
                                }
                            
                                $("#periode3").removeAttr('placeholder');
                                $("#periode3").attr('placeholder', response.periode);
                                document.getElementById("tgl3").value = response.tglP;
                                document.getElementById("semester3").value = response.semester;
                                document.getElementById("ipk3").value = response.ipk;
                             
                        }
                
                    });

    
    

 
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus2(id){

        //tampilkan pesan konfirmasi dengan sweetalert
        swal({
        title: "Apakah Anda yakin ingin membatalkan pengajuan Permohonan ini?",
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
                    data.append('id_bcs', id); 
                    data.append('aksi', 'del');  
                                        
                    $.ajax({
                        url: 'beasiswaC-aksi.php',  
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
                            
                             
                            $("#view3").load('beasiswaC-data.php');

                             
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


function viewfile3(id){
            $('#tabs23').val('10');
            $("#btn-tutup3").hide();  
            $("#btn-next13").show();  
            $("#btn-prev13").show();  
            $("#btn-prev13").removeAttr('class');
            $("#btn-prev13").attr('disabled', '');
            $("#btn-prev13").attr('class', 'btn bg-grey waves-effect');

                    var data = new FormData();
                    data.append('id_bcs', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'beasiswaC-aksi.php', 
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
                    
                                $("#md13").html('Lihat Data Permohonan - '+response.nama); //ubah title modal view file

                                    var pe = document.querySelectorAll('.viewfile23');
                                    pe[0].setAttribute('data-file', response.suratP);
                                    pe[1].setAttribute('data-file', response.suratAK);
                                    // pe[2].setAttribute('data-file', response.suratPN);
                                    // pe[3].setAttribute('data-file', response.propPN1);
                                    // pe[4].setAttribute('data-file', response.propPN2);
                                    pe[2].setAttribute('data-file', response.suratTA);
                                    pe[3].setAttribute('data-file', response.khs);
                                    pe[4].setAttribute('data-file', response.suratK);
                                    pe[5].setAttribute('data-file', response.suratB);
                                    pe[6].setAttribute('data-file', response.ktm);
                                    //pe[10].setAttribute('data-file', response.akta);
                                    /*
                                    pe[11].setAttribute('data-file', response.ktp);
                                    pe[12].setAttribute('data-file', response.kk);
                                    pe[13].setAttribute('data-file', response.domisili);
                                    pe[14].setAttribute('data-file', response.suratN);
                                    pe[15].setAttribute('data-file', response.sertifikat1);
                                    pe[16].setAttribute('data-file', response.sertifikat2);
                                    pe[17].setAttribute('data-file', response.sertifikat3);
                                    pe[18].setAttribute('data-file', response.burek);
                                    pe[19].setAttribute('data-file', response.ijazah1);
                                    pe[20].setAttribute('data-file', response.ijazah2);*/
                                    pe[7].setAttribute('data-file', response.kk);
                                    pe[8].setAttribute('data-file', response.ktp);
                                    pe[9].setAttribute('data-file', response.domisili);
                                    pe[10].setAttribute('data-file', response.suratN);
                                    pe[11].setAttribute('data-file', response.sertifikat1);
                                    pe[12].setAttribute('data-file', response.sertifikat2);
                                    pe[13].setAttribute('data-file', response.sertifikat3);
                                    pe[14].setAttribute('data-file', response.burek);
                                    pe[15].setAttribute('data-file', response.ijazah1);
                                    pe[16].setAttribute('data-file', response.ijazah2);

                                if(response.suratP != ""){
                                    document.getElementById('fileSP13').innerHTML = response.suratP; 
                                }else{
                                document.getElementById('fileSP13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratAK != ""){
                                document.getElementById('fileAK13').innerHTML = response.suratAK; 
                                }else{
                                document.getElementById('fileAK13').innerHTML = 'Tidak ada file '; 
                                }
                                // if(response.suratPN != ""){
                                // document.getElementById('fileSPN13').innerHTML = response.suratPN; 
                                // }else{
                                // document.getElementById('fileSPN13').innerHTML = 'Tidak ada file '; 
                                // }
                                // if(response.propPN1 != ""){
                                // document.getElementById('filePR113').innerHTML = response.propPN1; 
                                // }else{
                                // document.getElementById('filePR113').innerHTML = 'Tidak ada file '; 
                                // }
                                // if(response.propPN2 != ""){
                                // document.getElementById('filePR213').innerHTML = response.propPN2; 
                                // }else{
                                // document.getElementById('filePR213').innerHTML = 'Tidak ada file '; 
                                // }
                                if(response.suratTA != ""){
                                document.getElementById('fileSTA13').innerHTML = response.suratTA; 
                                }else{
                                document.getElementById('fileSTA13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.khs != ""){
                                document.getElementById('fileKhs13').innerHTML = response.khs; 
                                }else{
                                document.getElementById('fileKhs13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratK != ""){
                                document.getElementById('fileSK13').innerHTML = response.suratK; 
                                }else{
                                document.getElementById('fileSK13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratB != ""){
                                document.getElementById('fileSB13').innerHTML = response.suratB; 
                                }else{
                                document.getElementById('fileSB13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktm != ""){
                                document.getElementById('fileKtm13').innerHTML = response.ktm; 
                                }else{
                                document.getElementById('fileKtm13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktp != ""){
                                document.getElementById('fileKtp13').innerHTML = response.ktp; 
                                }else{
                                document.getElementById('fileKtp13').innerHTML = 'Tidak ada file '; 
                                }
                                /*if(response.akta != ""){
                                document.getElementById('fileAkta13').innerHTML = response.akta; 
                                }else{
                                document.getElementById('fileAkta13').innerHTML = 'Tidak ada file '; 
                                }*/
                                if(response.kk != ""){
                                document.getElementById('fileKk13').innerHTML = response.kk; 
                                }else{
                                document.getElementById('fileKk13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.domisili != ""){
                                document.getElementById('fileDom13').innerHTML = response.domisili; 
                                }else{
                                document.getElementById('fileDom13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratN != ""){
                                document.getElementById('fileSN13').innerHTML = response.suratN; 
                                }else{
                                document.getElementById('fileSN13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat1 != ""){
                                document.getElementById('fileS113').innerHTML = response.sertifikat1; 
                                }else{
                                document.getElementById('fileS113').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat2 != ""){
                                document.getElementById('fileS213').innerHTML = response.sertifikat2; 
                                }else{
                                document.getElementById('fileS213').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat3 != ""){
                                document.getElementById('fileS313').innerHTML = response.sertifikat3; 
                                }else{
                                document.getElementById('fileS313').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.burek != ""){
                                document.getElementById('fileBR13').innerHTML = response.burek; 
                                }else{
                                document.getElementById('fileBR13').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ijazah1 != ""){
                                document.getElementById('fileIjz113').innerHTML = response.ijazah1;
                                }else{
                                document.getElementById('fileIjz113').innerHTML = 'Tidak ada file ';
                                }
                                if(response.ijazah2 != ""){
                                document.getElementById('fileIjz213').innerHTML = response.ijazah2;
                                }else{
                                document.getElementById('fileIjz213').innerHTML = 'Tidak ada file ';
                                }


                                if (response.ilmu == '1') {
                                    var bIlmu = 'IPA';
                                }else{
                                    var bIlmu = 'IPS';
                                }
                                if (response.daerah === 'KALIMANTAN TIMUR') {
                                    var bDaerah = 'Dalam';
                                }else{
                                    var bDaerah = 'Luar';
                                }

                                document.getElementById('imgMhs3').innerHTML = '<img src="../../user/master/foto_user/'+ response.foto +'" style="height:auto; width:100%; ">'; 
                                document.getElementById('dataMhs3').innerHTML = '<table class="table">  <tr>    <td width="40%">Nama Mahasiswa</td>    <td width="60%">: '+response.nama+'</td>  </tr>  <tr>    <td>Perguruan Tinggi/Universitas</td>    <td>: '+response.pt+'</td>  </tr>  <tr>    <td>Jenjang</td>    <td>: '+response.jenjang+'</td>  </tr>  <tr>    <td>Bidang Ilmu</td>    <td>: '+bIlmu+'</td>  </tr>  <tr>    <td>Daerah</td>    <td>: '+bDaerah+'</td>  </tr>  <tr>    <td>Semester</td>    <td>: '+response.semester1+' ('+response.semester+')</td>  </tr>  <tr>    <td>Periode Permohonan</td>    <td>: '+response.periode+'</td>  </tr>  <tr>    <td>Tanggal Permohonan</td>    <td>: '+response.tglP+'</td>  </tr>  <tr>    <td>IPK Terakhir</td>    <td>: '+response.ipk+'</td>  </tr></table>'; 

                                                                     
                        }
                
                    });

}


 
</script>
