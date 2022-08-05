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
$ds = $dp['status_penerimaan'];
$dsb = $dp['status_beasiswa'];
$dtp = $dp['tgl_tutup'];
$dpb = $dp['publish'];
?>



                                <table class="table table-bordered table-striped table-hover" id="example1" style="margin-right:0px;">
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
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_mahasiswa='$idm' ORDER BY b.id_bp DESC");
                                            $sql->execute(); // Eksekusi querynya                                          
                                        }else{
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_mahasiswa='$idm' AND (b.periode='$periode') ORDER BY b.id_bp DESC");
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
                                                    <a class="badge bg-teal btnedit1" data-id="'.$no.'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#form-modal1" onclick="edit('.$d['id_bp'].');" title="Ubah Data">
                                                    <i class=" material-icons" style="font-size:16px;" >border_color</i></a>  
                                                    <a class="badge bg-deep-orange konfirmasi" data-no="'.$no.'" onclick="hapus('.$d['id_bp'].');" title="Hapus Data">
                                                    <i class="material-icons" style="font-size:16px;" >delete_forever</i></a>
                                                ';                                                
                                            }else{
                                                $sV1 = '<a class="badge bg-red viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'"  onclick="viewfile1('.$d['id_bp'].');"  data-no="'.$no.'" data-target="#form-file11"><i class=" material-icons" style="font-size:16px;" >search</i></a>';
                                            }



                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge '.$dc.' viewfile11" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" data-no="'.$no.'" data-target="#form-file11" onclick="viewfile1('.$d['id_bp'].');">'.$d['nama_mahasiswa'].'</a></td>
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
            <input type="text" id="data-id_bp" style="display:none;">
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
var t = $('#example1').DataTable( {
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
function edit(id){
    $("#btn-simpan1").html('UBAH'); 
    $("#btn-simpan1").hide(); 
    $("#btn-next1").show(); 
    $(".ck1").show(); 
    $(".fc1").hide();  
    $("#aks1").val('edt'); 
    $("#tabs11").val('1');
    $("#fileN1").hide(); 

    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title1").html('Form Ubah data');
    $("#btn-prev1").removeAttr('class');
    $("#btn-prev1").attr('disabled', '');
    $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');
  
    document.getElementById("id_bp").value = id;

                    var data = new FormData();
                    data.append('id_bp', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'beasiswaP-aksi.php', 
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

                                    var pe = document.querySelectorAll('.viewfile11');
                                    pe[0].setAttribute('data-file', response.suratP)
                                    pe[1].setAttribute('data-file', response.suratP)
                                    pe[2].setAttribute('data-file', response.suratAK)
                                    pe[3].setAttribute('data-file', response.khs)
                                    pe[4].setAttribute('data-file', response.suratK)
                                    pe[5].setAttribute('data-file', response.suratB)
                                    pe[6].setAttribute('data-file', response.ktm)
                                    //pe[7].setAttribute('data-file', response.akta)
                                    /*
                                    pe[8].setAttribute('data-file', response.ktp)
                                    pe[9].setAttribute('data-file', response.kk)
                                    pe[10].setAttribute('data-file', response.domisili)
                                    pe[11].setAttribute('data-file', response.suratN)
                                    pe[12].setAttribute('data-file', response.sertifikat1)
                                    pe[13].setAttribute('data-file', response.sertifikat2)
                                    pe[14].setAttribute('data-file', response.sertifikat3)
                                    pe[15].setAttribute('data-file', response.burek)
                                    pe[16].setAttribute('data-file', response.ijazah)*/
                                    pe[7].setAttribute('data-file', response.ktp)
                                    pe[8].setAttribute('data-file', response.kk)
                                    pe[9].setAttribute('data-file', response.domisili)
                                    pe[10].setAttribute('data-file', response.suratN)
                                    pe[11].setAttribute('data-file', response.sertifikat1)
                                    pe[12].setAttribute('data-file', response.sertifikat2)
                                    pe[13].setAttribute('data-file', response.sertifikat3)
                                    pe[14].setAttribute('data-file', response.burek)
                                    pe[15].setAttribute('data-file', response.ijazah)
                            
                                if(response.suratP != ""){
                                    document.getElementById('fileSP1').innerHTML = response.suratP; 
                                }else{
                                document.getElementById('fileSP1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratAK != ""){
                                document.getElementById('fileAK1').innerHTML = response.suratAK; 
                                }else{
                                document.getElementById('fileAK1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.khs != ""){
                                document.getElementById('fileKhs1').innerHTML = response.khs; 
                                }else{
                                document.getElementById('fileKhs1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratK != ""){
                                document.getElementById('fileSK1').innerHTML = response.suratK; 
                                }else{
                                document.getElementById('fileSK1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratB != ""){
                                document.getElementById('fileSB1').innerHTML = response.suratB; 
                                }else{
                                document.getElementById('fileSB1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktm != ""){
                                document.getElementById('fileKtm1').innerHTML = response.ktm; 
                                }else{
                                document.getElementById('fileKtm1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktp != ""){
                                document.getElementById('fileKtp1').innerHTML = response.ktp; 
                                }else{
                                document.getElementById('fileKtp1').innerHTML = 'Tidak ada file '; 
                                }
                                /*if(response.akta != ""){
                                document.getElementById('fileAkta1').innerHTML = response.akta; 
                                }else{
                                document.getElementById('fileAkta1').innerHTML = 'Tidak ada file '; 
                                }*/
                                if(response.kk != ""){
                                document.getElementById('fileKk1').innerHTML = response.kk; 
                                }else{
                                document.getElementById('fileKk1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.domisili != ""){
                                document.getElementById('fileDom1').innerHTML = response.domisili; 
                                }else{
                                document.getElementById('fileDom1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratN != ""){
                                document.getElementById('fileSN1').innerHTML = response.suratN; 
                                }else{
                                document.getElementById('fileSN1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat1 != ""){
                                document.getElementById('fileS11').innerHTML = response.sertifikat1; 
                                }else{
                                document.getElementById('fileS11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat2 != ""){
                                document.getElementById('fileS21').innerHTML = response.sertifikat2; 
                                }else{
                                document.getElementById('fileS21').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat3 != ""){
                                document.getElementById('fileS31').innerHTML = response.sertifikat3; 
                                }else{
                                document.getElementById('fileS31').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.burek != ""){
                                document.getElementById('fileBR1').innerHTML = response.burek; 
                                }else{
                                document.getElementById('fileBR1').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ijazah != ""){
                                document.getElementById('fileIjz1').innerHTML = response.ijazah;
                                }else{
                                document.getElementById('fileIjz1').innerHTML = 'Tidak ada file ';
                                }


                                $("#periode1").removeAttr('placeholder');
                                $("#periode1").attr('placeholder', response.periode);
                                document.getElementById("tgl1").value = response.tglP;
                                document.getElementById("semester1").value = response.semester;
                                document.getElementById("ipk1").value = response.ipk;
                                // document.getElementById("suratP1").value = response.suratP;
                                // document.getElementById("suratAK1").value = response.suratAK;
                                // document.getElementById("khs1").value = response.khs;
                                // document.getElementById("suratK1").value = response.suratK;
                                // document.getElementById("suratB1").value = response.suratB;
                                // document.getElementById("ktm1").value = response.ktm;
                                // document.getElementById("ktp1").value = response.ktp;
                                // //document.getElementById("akta1").value = response.akta;
                                // document.getElementById("kk1").value = response.kk;
                                // document.getElementById("domisili1").value = response.domisili;
                                // document.getElementById("suratN1").value = response.suratN;
                                // document.getElementById("sertifikat11").value = response.sertifikat1;
                                // document.getElementById("sertifikat21").value = response.sertifikat2;
                                // document.getElementById("sertifikat31").value = response.sertifikat3;
                                // document.getElementById("burek1").value = response.burek;
                                // document.getElementById("ijazah1").value = response.ijazah;


                                    //var filedata = data1.substr(-1);

                            
                        }
                
                    });
 
}



// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus(id){

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

                    // Buat variabel data untuk menampung data hasil input dari form
                    var data = new FormData();
                    data.append('id_bp', id); // Ambil data id_berita
                    data.append('aksi', 'del'); // set data aksi = del untuk pembanding aksi
                                        
                    $.ajax({
                        url: 'beasiswaP-aksi.php', // File tujuan
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
                            $("#view1").load('beasiswaP-data.php');

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



function viewfile1(id){
            $('#tabs21').val('5');
            $("#btn-tutup1").hide();  
            $("#btn-next11").show();  
            $("#btn-prev11").show();  
            $("#btn-prev11").removeAttr('class');
            $("#btn-prev11").attr('disabled', '');
            $("#btn-prev11").attr('class', 'btn bg-grey waves-effect');

                    var data = new FormData();
                    data.append('id_bp', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'beasiswaP-aksi.php', 
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

                                $("#md11").html('Lihat Data Permohonan - '+response.nama); //ubah title modal view file

                                    var pe = document.querySelectorAll('.viewfile21');
                                    pe[0].setAttribute('data-file', response.suratP);
                                    pe[1].setAttribute('data-file', response.suratAK);
                                    pe[2].setAttribute('data-file', response.khs);
                                    pe[3].setAttribute('data-file', response.suratK);
                                    pe[4].setAttribute('data-file', response.suratB);
                                    pe[5].setAttribute('data-file', response.ktm);
                                    //pe[6].setAttribute('data-file', response.akta);
                                    /*
                                    pe[8].setAttribute('data-file', response.ktp)
                                    pe[9].setAttribute('data-file', response.kk)
                                    pe[10].setAttribute('data-file', response.domisili)
                                    pe[11].setAttribute('data-file', response.suratN)
                                    pe[12].setAttribute('data-file', response.sertifikat1)
                                    pe[13].setAttribute('data-file', response.sertifikat2)
                                    pe[14].setAttribute('data-file', response.sertifikat3)
                                    pe[15].setAttribute('data-file', response.burek)
                                    pe[16].setAttribute('data-file', response.ijazah)*/
                                    pe[6].setAttribute('data-file', response.kk)
                                    pe[7].setAttribute('data-file', response.ktp)
                                    pe[8].setAttribute('data-file', response.domisili)
                                    pe[9].setAttribute('data-file', response.suratN)
                                    pe[10].setAttribute('data-file', response.sertifikat1)
                                    pe[11].setAttribute('data-file', response.sertifikat2)
                                    pe[12].setAttribute('data-file', response.sertifikat3)
                                    pe[13].setAttribute('data-file', response.burek)
                                    pe[14].setAttribute('data-file', response.ijazah)

                                if(response.suratP != ""){
                                    document.getElementById('fileSP11').innerHTML = response.suratP; 
                                }else{
                                document.getElementById('fileSP11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratAK != ""){
                                document.getElementById('fileAK11').innerHTML = response.suratAK; 
                                }else{
                                document.getElementById('fileAK11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.khs != ""){
                                document.getElementById('fileKhs11').innerHTML = response.khs; 
                                }else{
                                document.getElementById('fileKhs11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratK != ""){
                                document.getElementById('fileSK11').innerHTML = response.suratK; 
                                }else{
                                document.getElementById('fileSK11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratB != ""){
                                document.getElementById('fileSB11').innerHTML = response.suratB; 
                                }else{
                                document.getElementById('fileSB11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktm != ""){
                                document.getElementById('fileKtm11').innerHTML = response.ktm; 
                                }else{
                                document.getElementById('fileKtm11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ktp != ""){
                                document.getElementById('fileKtp11').innerHTML = response.ktp; 
                                }else{
                                document.getElementById('fileKtp11').innerHTML = 'Tidak ada file '; 
                                }
                                /*if(response.akta != ""){
                                document.getElementById('fileAkta11').innerHTML = response.akta; 
                                }else{
                                document.getElementById('fileAkta11').innerHTML = 'Tidak ada file '; 
                                }*/
                                if(response.kk != ""){
                                document.getElementById('fileKk11').innerHTML = response.kk; 
                                }else{
                                document.getElementById('fileKk11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.domisili != ""){
                                document.getElementById('fileDom11').innerHTML = response.domisili; 
                                }else{
                                document.getElementById('fileDom11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.suratN != ""){
                                document.getElementById('fileSN11').innerHTML = response.suratN; 
                                }else{
                                document.getElementById('fileSN11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat1 != ""){
                                document.getElementById('fileS111').innerHTML = response.sertifikat1; 
                                }else{
                                document.getElementById('fileS111').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat2 != ""){
                                document.getElementById('fileS211').innerHTML = response.sertifikat2; 
                                }else{
                                document.getElementById('fileS211').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.sertifikat3 != ""){
                                document.getElementById('fileS311').innerHTML = response.sertifikat3; 
                                }else{
                                document.getElementById('fileS311').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.burek != ""){
                                document.getElementById('fileBR11').innerHTML = response.burek; 
                                }else{
                                document.getElementById('fileBR11').innerHTML = 'Tidak ada file '; 
                                }
                                if(response.ijazah != ""){
                                document.getElementById('fileIjz11').innerHTML = response.ijazah;
                                }else{
                                document.getElementById('fileIjz11').innerHTML = 'Tidak ada file ';
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

                                document.getElementById('imgMhs1').innerHTML = '<img src="../../user/master/foto_user/'+ response.foto +'" style="height:auto; width:100%; ">'; 
                                document.getElementById('dataMhs1').innerHTML = '<table class="table">  <tr>    <td width="40%">Nama Mahasiswa</td>    <td width="60%">: '+response.nama+'</td>  </tr>  <tr>    <td>Perguruan Tinggi/Universitas</td>    <td>: '+response.pt+'</td>  </tr>  <tr>    <td>Jenjang</td>    <td>: '+response.jenjang+'</td>  </tr>  <tr>    <td>Bidang Ilmu</td>    <td>: '+bIlmu+'</td>  </tr>  <tr>    <td>Daerah</td>    <td>: '+bDaerah+'</td>  </tr>  <tr>    <td>Semester</td>    <td>: '+response.semester1+' ('+response.semester+')</td>  </tr>  <tr>    <td>Periode Permohonan</td>    <td>: '+response.periode+'</td>  </tr>  <tr>    <td>Tanggal Permohonan</td>    <td>: '+response.tglP+'</td>  </tr>  <tr>    <td>IP Terakhir</td>    <td>: '+response.ipk+'</td>  </tr></table>'; 
                                                                    
                        }
                
                    });
}

/*        $(".viewfile11").click(function(){ // Ketika tombol view di klik
            $('#tabs21').val('5');
            $("#btn-tutup1").hide();  
            $("#btn-next11").show();  
            $("#btn-prev11").show();  
            $("#btn-prev11").removeAttr('class');
            $("#btn-prev11").attr('disabled', '');
            $("#btn-prev11").attr('class', 'btn bg-grey waves-effect');

            var no = $(this).attr('data-no');  
            var nama = $("#nama1-value-" + no).val(); // Ambil id dari input type hidden
            var pt = $("#pt1-value-" + no).val();  
            var periode = $("#periode1-value-" + no).val();  
            var tgl = $("#tgl1-value-" + no).val();  
            var semester = $("#semester1-value-" + no).val();  
            var ipk = $("#ipk1-value-" + no).val();  
            var suratP = $("#suratP1-value-" + no).val();  
            var suratAK = $("#suratAK1-value-" + no).val();  
            var khs = $("#khs1-value-" + no).val();  
            var suratK = $("#suratK1-value-" + no).val();  
            var suratB = $("#suratB1-value-" + no).val();  
            var ktm = $("#ktm1-value-" + no).val();  
            var ktp = $("#ktp1-value-" + no).val();  
            var akta = $("#akta1-value-" + no).val();  
            var kk = $("#kk1-value-" + no).val();  
            var domisili = $("#domisili1-value-" + no).val();  
            var suratN = $("#suratN1-value-" + no).val();  
            var sertifikat1 = $("#sertifikat11-value-" + no).val();  
            var sertifikat2 = $("#sertifikat21-value-" + no).val();  
            var sertifikat3 = $("#sertifikat31-value-" + no).val();  
            var burek = $("#burek1-value-" + no).val();  
            var ijazah = $("#ijazah1-value-" + no).val();  
            var foto = $("#foto1-value-" + no).val();  

            $("#md11").html('Lihat Data Permohonan - '+nama); //ubah title modal view file

                var pe = document.querySelectorAll('.viewfile21');
                pe[0].setAttribute('data-file', suratP);
                pe[1].setAttribute('data-file', suratAK);
                pe[2].setAttribute('data-file', khs);
                pe[3].setAttribute('data-file', suratK);
                pe[4].setAttribute('data-file', suratB);
                pe[5].setAttribute('data-file', ktm);
                pe[6].setAttribute('data-file', ktp);
                pe[7].setAttribute('data-file', akta);
                pe[8].setAttribute('data-file', kk);
                pe[9].setAttribute('data-file', domisili);
                pe[10].setAttribute('data-file', suratN);
                pe[11].setAttribute('data-file', sertifikat1);
                pe[12].setAttribute('data-file', sertifikat2);
                pe[13].setAttribute('data-file', sertifikat3);
                pe[14].setAttribute('data-file', burek);
                pe[15].setAttribute('data-file', ijazah);

            if(suratP != ""){
                document.getElementById('fileSP11').innerHTML = suratP; 
            }else{
            document.getElementById('fileSP11').innerHTML = 'Tidak ada file '; 
            }
            if(suratAK != ""){
            document.getElementById('fileAK11').innerHTML = suratAK; 
            }else{
            document.getElementById('fileAK11').innerHTML = 'Tidak ada file '; 
            }
            if(khs != ""){
            document.getElementById('fileKhs11').innerHTML = khs; 
            }else{
            document.getElementById('fileKhs11').innerHTML = 'Tidak ada file '; 
            }
            if(suratK != ""){
            document.getElementById('fileSK11').innerHTML = suratK; 
            }else{
            document.getElementById('fileSK11').innerHTML = 'Tidak ada file '; 
            }
            if(suratB != ""){
            document.getElementById('fileSB11').innerHTML = suratB; 
            }else{
            document.getElementById('fileSB11').innerHTML = 'Tidak ada file '; 
            }
            if(ktm != ""){
            document.getElementById('fileKtm11').innerHTML = ktm; 
            }else{
            document.getElementById('fileKtm11').innerHTML = 'Tidak ada file '; 
            }
            if(ktp != ""){
            document.getElementById('fileKtp11').innerHTML = ktp; 
            }else{
            document.getElementById('fileKtp11').innerHTML = 'Tidak ada file '; 
            }
            if(akta != ""){
            document.getElementById('fileAkta11').innerHTML = akta; 
            }else{
            document.getElementById('fileAkta11').innerHTML = 'Tidak ada file '; 
            }
            if(kk != ""){
            document.getElementById('fileKk11').innerHTML = kk; 
            }else{
            document.getElementById('fileKk11').innerHTML = 'Tidak ada file '; 
            }
            if(domisili != ""){
            document.getElementById('fileDom11').innerHTML = domisili; 
            }else{
            document.getElementById('fileDom11').innerHTML = 'Tidak ada file '; 
            }
            if(suratN != ""){
            document.getElementById('fileSN11').innerHTML = suratN; 
            }else{
            document.getElementById('fileSN11').innerHTML = 'Tidak ada file '; 
            }
            if(sertifikat1 != ""){
            document.getElementById('fileS111').innerHTML = sertifikat1; 
            }else{
            document.getElementById('fileS111').innerHTML = 'Tidak ada file '; 
            }
            if(sertifikat2 != ""){
            document.getElementById('fileS211').innerHTML = sertifikat2; 
            }else{
            document.getElementById('fileS211').innerHTML = 'Tidak ada file '; 
            }
            if(sertifikat3 != ""){
            document.getElementById('fileS311').innerHTML = sertifikat3; 
            }else{
            document.getElementById('fileS311').innerHTML = 'Tidak ada file '; 
            }
            if(burek != ""){
            document.getElementById('fileBR11').innerHTML = burek; 
            }else{
            document.getElementById('fileBR11').innerHTML = 'Tidak ada file '; 
            }
            if(ijazah != ""){
            document.getElementById('fileIjz11').innerHTML = ijazah;
            }else{
            document.getElementById('fileIjz11').innerHTML = 'Tidak ada file ';
            }

            document.getElementById('imgMhs1').innerHTML = '<img src="../../user/master/foto_user/'+ foto +'" style="height:auto; width:100%; ">'; 
            document.getElementById('dataMhs1').innerHTML = '<table class="table">  <tr>    <td width="40%">Nama Mahasiswa</td>    <td width="60%">: '+nama+'</td>  </tr>  <tr>    <td>Perguruan Tinggi/Universitas</td>    <td>: '+pt+'</td>  </tr>  <tr>    <td>Semester</td>    <td>: '+semester+'</td>  </tr>  <tr>    <td>Periode Permohonan</td>    <td>: '+periode+'</td>  </tr>  <tr>    <td>Tanggal Permohonan</td>    <td>: '+tgl+'</td>  </tr>  <tr>    <td>IPK Terkhir</td>    <td>: '+ipk+'</td>  </tr></table>'; 





        });
*/
</script>
