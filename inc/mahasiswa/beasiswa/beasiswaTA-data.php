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



                                <table class="table table-bordered table-striped table-hover" id="example2" style="margin-right:0px;">
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
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_mahasiswa='$idm' ORDER BY b.id_bta DESC");
                                            $sql->execute(); // Eksekusi querynya                                          
                                        }else{
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_mahasiswa='$idm' AND (b.periode='$periode') ORDER BY b.id_bta DESC");
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
                                                    <a class="badge bg-teal btnedit2" data-id="'.$no.'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal2" onclick="edit1('.$d['id_bta'].');"  title="Ubah Data">
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a>  
                                                    <a class="badge bg-deep-orange konfirmasi" onclick="hapus1('.$d['id_bta'].');"  title="Hapus Data">
                                                    <i class="material-icons" style="font-size:16px;" >delete_forever</i></a>
                                                ';                                                
                                            }else{
                                                $sV1 = '<a class="badge bg-purple viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" data-no="'.$no.'" data-target="#form-file12"  onclick="viewfile2('.$d['id_bta'].');" ><i class=" material-icons" style="font-size:16px;" >search</i></a>';
                                            }

                                            
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge '.$dc.' viewfile2" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" data-no="'.$no.'" data-target="#form-file12" onclick="viewfile2('.$d['id_bta'].');">'.$d['nama_mahasiswa'].'</a></td>
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
var t = $('#example2').DataTable( {
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
function edit1(id){
    $("#btn-simpan2").html('UBAH'); 
    $("#btn-simpan2").hide(); 
    $("#btn-next2").show(); 
    $(".ck2").show(); 
    $(".fc2").hide();  
    $("#aks2").val('edt'); 
    $("#tabs12").val('7');
    $("#fileN2").hide(); 
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title2").html('Form Ubah data');
    $("#btn-prev2").removeAttr('class');
    $("#btn-prev2").attr('disabled', '');
    $("#btn-prev2").attr('class', 'btn bg-grey waves-effect');
  
        document.getElementById("id_bta").value = id;

                    var data = new FormData();
                    data.append('id_bta', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'beasiswaTA-aksi.php', 
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

                                    var pe = document.querySelectorAll('.viewfile12');
                                    pe[0].setAttribute('data-file', response.suratP);
                                    pe[1].setAttribute('data-file', response.suratAK);
                                    pe[2].setAttribute('data-file', response.suratPN);
                                    pe[3].setAttribute('data-file', response.propPN1);
                                    pe[4].setAttribute('data-file', response.propPN2);
                                    pe[5].setAttribute('data-file', response.suratTA);
                                    pe[6].setAttribute('data-file', response.khs);
                                    pe[7].setAttribute('data-file', response.suratK);
                                    pe[8].setAttribute('data-file', response.suratB);
                                    pe[9].setAttribute('data-file', response.ktm);
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
                                    pe[10].setAttribute('data-file', response.kk);
                                    pe[11].setAttribute('data-file', response.ktp);
                                    pe[12].setAttribute('data-file', response.domisili);
                                    pe[13].setAttribute('data-file', response.suratN);
                                    pe[14].setAttribute('data-file', response.sertifikat1);
                                    pe[15].setAttribute('data-file', response.sertifikat2);
                                    pe[16].setAttribute('data-file', response.sertifikat3);
                                    pe[17].setAttribute('data-file', response.burek);
                                    pe[18].setAttribute('data-file', response.ijazah1);
                                    pe[19].setAttribute('data-file', response.ijazah2);

                                    //var filedata = data1.substr(-1);
                                if(response.suratP != ""){
                                    document.getElementById('fileSP2').innerHTML = response.suratP; 
                                }else{
                                document.getElementById('fileSP2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratAK != ""){
                                document.getElementById('fileAK2').innerHTML = response.suratAK; 
                                }else{
                                document.getElementById('fileAK2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratPN != ""){
                                document.getElementById('fileSPN2').innerHTML = response.suratPN; 
                                }else{
                                document.getElementById('fileSPN2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.propPN1 != ""){
                                document.getElementById('filePR12').innerHTML = response.propPN1; 
                                }else{
                                document.getElementById('filePR12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.propPN2 != ""){
                                document.getElementById('filePR22').innerHTML = response.propPN2; 
                                }else{
                                document.getElementById('filePR22').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratTA != ""){
                                document.getElementById('fileSTA2').innerHTML = response.suratTA; 
                                }else{
                                document.getElementById('fileSTA2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.khs != ""){
                                document.getElementById('fileKhs2').innerHTML = response.khs; 
                                }else{
                                document.getElementById('fileKhs2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratK != ""){
                                document.getElementById('fileSK2').innerHTML = response.suratK; 
                                }else{
                                document.getElementById('fileSK2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratB != ""){
                                document.getElementById('fileSB2').innerHTML = response.suratB; 
                                }else{
                                document.getElementById('fileSB2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktm != ""){
                                document.getElementById('fileKtm2').innerHTML = response.ktm; 
                                }else{
                                document.getElementById('fileKtm2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktp != ""){
                                document.getElementById('fileKtp2').innerHTML = response.ktp; 
                                }else{
                                document.getElementById('fileKtp2').innerHTML = 'Tidak ada file '; 
                                }
                                /*if(response.akta != ""){
                                document.getElementById('fileAkta2').innerHTML = response.akta; 
                                }else{
                                document.getElementById('fileAkta2').innerHTML = 'Tidak ada file '; 
                                }*/
                                if(response.kk != ""){
                                document.getElementById('fileKk2').innerHTML = response.kk; 
                                }else{
                                document.getElementById('fileKk2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.domisili != ""){
                                document.getElementById('fileDom2').innerHTML = response.domisili; 
                                }else{
                                document.getElementById('fileDom2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratN != ""){
                                document.getElementById('fileSN2').innerHTML = response.suratN; 
                                }else{
                                document.getElementById('fileSN2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat1 != ""){
                                document.getElementById('fileS12').innerHTML = response.sertifikat1; 
                                }else{
                                document.getElementById('fileS12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat2 != ""){
                                document.getElementById('fileS22').innerHTML = response.sertifikat2; 
                                }else{
                                document.getElementById('fileS22').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat3 != ""){
                                document.getElementById('fileS32').innerHTML = response.sertifikat3; 
                                }else{
                                document.getElementById('fileS32').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.burek != ""){
                                document.getElementById('fileBR2').innerHTML = response.burek; 
                                }else{
                                document.getElementById('fileBR2').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ijazah1 != ""){
                                document.getElementById('fileIjz12').innerHTML = response.ijazah1;
                                }else{
                                document.getElementById('fileIjz12').innerHTML = 'Tidak ada file ';
                                }
                                if(response.ijazah2 != ""){
                                document.getElementById('fileIjz22').innerHTML = response.ijazah2;
                                }else{
                                document.getElementById('fileIjz22').innerHTML = 'Tidak ada file ';
                                }
                            
                                $("#periode2").removeAttr('placeholder');
                                $("#periode2").attr('placeholder', response.periode);
                                document.getElementById("tgl2").value = response.tglP;
                                document.getElementById("semester2").value = response.semester;
                                document.getElementById("ipk2").value = response.ipk;
                             
                        }
                
                    });

    
    

 
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus1(id){

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
                    data.append('id_bta', id); 
                    data.append('aksi', 'del');  
                                        
                    $.ajax({
                        url: 'beasiswaTA-aksi.php',  
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
                            
                             
                            $("#view2").load('beasiswaTA-data.php');

                             
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


function viewfile2(id){
            $('#tabs22').val('10');
            $("#btn-tutup2").hide();  
            $("#btn-next12").show();  
            $("#btn-prev12").show();  
            $("#btn-prev12").removeAttr('class');
            $("#btn-prev12").attr('disabled', '');
            $("#btn-prev12").attr('class', 'btn bg-grey waves-effect');

                    var data = new FormData();
                    data.append('id_bta', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'beasiswaTA-aksi.php', 
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
                    
                                $("#md12").html('Lihat Data Permohonan - '+response.nama); //ubah title modal view file

                                    var pe = document.querySelectorAll('.viewfile22');
                                    pe[0].setAttribute('data-file', response.suratP);
                                    pe[1].setAttribute('data-file', response.suratAK);
                                    pe[2].setAttribute('data-file', response.suratPN);
                                    pe[3].setAttribute('data-file', response.propPN1);
                                    pe[4].setAttribute('data-file', response.propPN2);
                                    pe[5].setAttribute('data-file', response.suratTA);
                                    pe[6].setAttribute('data-file', response.khs);
                                    pe[7].setAttribute('data-file', response.suratK);
                                    pe[8].setAttribute('data-file', response.suratB);
                                    pe[9].setAttribute('data-file', response.ktm);
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
                                    pe[10].setAttribute('data-file', response.kk);
                                    pe[11].setAttribute('data-file', response.ktp);
                                    pe[12].setAttribute('data-file', response.domisili);
                                    pe[13].setAttribute('data-file', response.suratN);
                                    pe[14].setAttribute('data-file', response.sertifikat1);
                                    pe[15].setAttribute('data-file', response.sertifikat2);
                                    pe[16].setAttribute('data-file', response.sertifikat3);
                                    pe[17].setAttribute('data-file', response.burek);
                                    pe[18].setAttribute('data-file', response.ijazah1);
                                    pe[19].setAttribute('data-file', response.ijazah2);

                                if(response.suratP != ""){
                                    document.getElementById('fileSP12').innerHTML = response.suratP; 
                                }else{
                                document.getElementById('fileSP12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratAK != ""){
                                document.getElementById('fileAK12').innerHTML = response.suratAK; 
                                }else{
                                document.getElementById('fileAK12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratPN != ""){
                                document.getElementById('fileSPN12').innerHTML = response.suratPN; 
                                }else{
                                document.getElementById('fileSPN12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.propPN1 != ""){
                                document.getElementById('filePR112').innerHTML = response.propPN1; 
                                }else{
                                document.getElementById('filePR112').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.propPN2 != ""){
                                document.getElementById('filePR212').innerHTML = response.propPN2; 
                                }else{
                                document.getElementById('filePR212').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratTA != ""){
                                document.getElementById('fileSTA12').innerHTML = response.suratTA; 
                                }else{
                                document.getElementById('fileSTA12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.khs != ""){
                                document.getElementById('fileKhs12').innerHTML = response.khs; 
                                }else{
                                document.getElementById('fileKhs12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratK != ""){
                                document.getElementById('fileSK12').innerHTML = response.suratK; 
                                }else{
                                document.getElementById('fileSK12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratB != ""){
                                document.getElementById('fileSB12').innerHTML = response.suratB; 
                                }else{
                                document.getElementById('fileSB12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktm != ""){
                                document.getElementById('fileKtm12').innerHTML = response.ktm; 
                                }else{
                                document.getElementById('fileKtm12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktp != ""){
                                document.getElementById('fileKtp12').innerHTML = response.ktp; 
                                }else{
                                document.getElementById('fileKtp12').innerHTML = 'Tidak ada file '; 
                                }
                                /*if(response.akta != ""){
                                document.getElementById('fileAkta12').innerHTML = response.akta; 
                                }else{
                                document.getElementById('fileAkta12').innerHTML = 'Tidak ada file '; 
                                }*/
                                if(response.kk != ""){
                                document.getElementById('fileKk12').innerHTML = response.kk; 
                                }else{
                                document.getElementById('fileKk12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.domisili != ""){
                                document.getElementById('fileDom12').innerHTML = response.domisili; 
                                }else{
                                document.getElementById('fileDom12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratN != ""){
                                document.getElementById('fileSN12').innerHTML = response.suratN; 
                                }else{
                                document.getElementById('fileSN12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat1 != ""){
                                document.getElementById('fileS112').innerHTML = response.sertifikat1; 
                                }else{
                                document.getElementById('fileS112').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat2 != ""){
                                document.getElementById('fileS212').innerHTML = response.sertifikat2; 
                                }else{
                                document.getElementById('fileS212').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat3 != ""){
                                document.getElementById('fileS312').innerHTML = response.sertifikat3; 
                                }else{
                                document.getElementById('fileS312').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.burek != ""){
                                document.getElementById('fileBR12').innerHTML = response.burek; 
                                }else{
                                document.getElementById('fileBR12').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ijazah1 != ""){
                                document.getElementById('fileIjz112').innerHTML = response.ijazah1;
                                }else{
                                document.getElementById('fileIjz112').innerHTML = 'Tidak ada file ';
                                }
                                if(response.ijazah2 != ""){
                                document.getElementById('fileIjz212').innerHTML = response.ijazah2;
                                }else{
                                document.getElementById('fileIjz212').innerHTML = 'Tidak ada file ';
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

                                document.getElementById('imgMhs2').innerHTML = '<img src="../../user/master/foto_user/'+ response.foto +'" style="height:auto; width:100%; ">'; 
                                document.getElementById('dataMhs2').innerHTML = '<table class="table">  <tr>    <td width="40%">Nama Mahasiswa</td>    <td width="60%">: '+response.nama+'</td>  </tr>  <tr>    <td>Perguruan Tinggi/Universitas</td>    <td>: '+response.pt+'</td>  </tr>  <tr>    <td>Jenjang</td>    <td>: '+response.jenjang+'</td>  </tr>  <tr>    <td>Bidang Ilmu</td>    <td>: '+bIlmu+'</td>  </tr>  <tr>    <td>Daerah</td>    <td>: '+bDaerah+'</td>  </tr>  <tr>    <td>Semester</td>    <td>: '+response.semester1+' ('+response.semester+')</td>  </tr>  <tr>    <td>Periode Permohonan</td>    <td>: '+response.periode+'</td>  </tr>  <tr>    <td>Tanggal Permohonan</td>    <td>: '+response.tglP+'</td>  </tr>  <tr>    <td>IPK Terakhir</td>    <td>: '+response.ipk+'</td>  </tr></table>'; 

                                                                     
                        }
                
                    });

}


 
</script>
