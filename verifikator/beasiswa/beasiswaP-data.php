<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-verifikator.php");
?>

<style type="text/css">
    .text_filter { 
        max-width: 100px; 
    }
</style>

                                <table class="table table-bordered table-hover" id="example" style="margin-right:0px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">No.</th>
                                            <th style="text-align:center;">Nama Mahasiswa</th>
                                            <th style="text-align:center;">Daerah</th>
                                            <th style="text-align:center;">Bidang</th>
                                            <th style="text-align:center;">Jenjang</th>
                                            <th style="text-align:center;">Periode</th>
                                            <th style="text-align:center;">IPK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //$periode = @$_GET['prd'];
                                    //    if ($periode == "") {
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.daerah, m.ilmu, m.jenjang FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa");
                                            $sql->execute(); // Eksekusi querynya                                          
                                    //    }else{
                                    //        $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.daerah, m.ilmu, m.jenjang FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode')");
                                    //        $sql->execute(); // Eksekusi querynya                                                                                      
                                    //    }

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            if ($d['daerah'] == 'KALIMANTAN TIMUR') {
                                                $daerah = 'Dalam';
                                            }else{
                                                $daerah = 'Luar';
                                            }
                                            if ($d['ilmu'] == '1') {
                                                $ilmu = 'IPA';
                                            }else{
                                                $ilmu = 'IPS';
                                            }

                                            $no++;
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge bg-purple viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" data-no="'.$no.'" onclick="viewfile('.$d['id_bp'].')" data-target="#form-file1" style="word-wrap: break-word; word-break: break-all; white-space: normal;">'.$d['nama_mahasiswa'].'</a></td>
                                                    <td align="center">'.$daerah.'</td>
                                                    <td align="center">'.$ilmu.'</td>
                                                    <td align="center">'.$d['jenjang'].'</td>
                                                    <td align="center">'.$d['periode'].'</td>
                                                    <td align="center">'.$d['ipk'].'</td>
                                                </tr>';

                                                ?>

                                      <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>

<script type="text/javascript">
function filterColumn ( i ) {
    $('#example').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
    ).draw();
}
$(document).ready(function() {
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

 
    $('input.column_filter').on( 'keyup click', function () {
            filterColumn( $(this).attr('data-column') );
    } );

} );

// Fungsi ini akan dipanggil ketika tombol edit diklik
function edit(id){
    $("#fileN1").hide(); 
    $("#btn-simpan").html('UBAH'); 
    $("#btn-simpan").hide(); 
    $("#btn-next").show(); 
    $(".ck").show(); 
    $(".fc").hide();  
    $("#aks").val('edt'); 
    $("#tabs1").val('1');
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#modal-title").html('Form Ubah data');
    $("#btn-prev").removeAttr('class');
    $("#btn-prev").attr('disabled', '');
    $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
  
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
                            
                            if(response.suratP != ''){
                                $("#fileSP").html(response.suratP);
                                document.getElementById('fileSP').innerHTML = response.suratP; 
                            }else{
                            document.getElementById('fileSP').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratAK != ""){
                            document.getElementById('fileAK').innerHTML = response.suratAK; 
                            }else{
                            document.getElementById('fileAK').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.khs != ""){
                            document.getElementById('fileKhs').innerHTML = response.khs; 
                            }else{
                            document.getElementById('fileKhs').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratK != ""){
                            document.getElementById('fileSK').innerHTML = response.suratK; 
                            }else{
                            document.getElementById('fileSK').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratB != ""){
                            document.getElementById('fileSB').innerHTML = response.suratB; 
                            }else{
                            document.getElementById('fileSB').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.ktm != ""){
                            document.getElementById('fileKtm').innerHTML = response.ktm; 
                            }else{
                            document.getElementById('fileKtm').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.ktp != ""){
                            document.getElementById('fileKtp').innerHTML = response.ktp; 
                            }else{
                            document.getElementById('fileKtp').innerHTML = 'Tidak ada file '; 
                            }
                            /*if(response.akta != ""){
                            document.getElementById('fileAkta').innerHTML = response.akta; 
                            }else{
                            document.getElementById('fileAkta').innerHTML = 'Tidak ada file '; 
                            }*/
                            if(response.kk != ""){
                            document.getElementById('fileKk').innerHTML = response.kk; 
                            }else{
                            document.getElementById('fileKk').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.domisili != ""){
                            document.getElementById('fileDom').innerHTML = response.domisili; 
                            }else{
                            document.getElementById('fileDom').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratN != ""){
                            document.getElementById('fileSN').innerHTML = response.suratN; 
                            }else{
                            document.getElementById('fileSN').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.sertifikat1 != ""){
                            document.getElementById('fileS1').innerHTML = response.sertifikat1; 
                            }else{
                            document.getElementById('fileS1').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.sertifikat2 != ""){
                            document.getElementById('fileS2').innerHTML = response.sertifikat2; 
                            }else{
                            document.getElementById('fileS2').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.sertifikat3 != ""){
                            document.getElementById('fileS3').innerHTML = response.sertifikat3; 
                            }else{
                            document.getElementById('fileS3').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.burek != ""){
                            document.getElementById('fileBR').innerHTML = response.burek; 
                            }else{
                            document.getElementById('fileBR').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.ijazah != ""){
                            document.getElementById('fileIjz').innerHTML = response.ijazah;
                            }else{
                            document.getElementById('fileIjz').innerHTML = 'Tidak ada file ';
                            }
                                var pe = document.querySelectorAll('.viewfile1');
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

                            $("#id_mahasiswa").val(response.idmhs).change();
                            $("#periode").val(response.periode).change();
                            
                            document.getElementById("tgl").value = response.tglP;
                            document.getElementById("semester").value = response.semester;
                            document.getElementById("ipk").value = response.ipk;





                                //var filedata = data1.substr(-1);
                            
                        }
                
                    });
 
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus(id){
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


                    var data = new FormData();
                    data.append('id_bp', id);  
                    data.append('aksi', 'del');  
                                        
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
                             
                            $("#view").load('beasiswaP-data.php');

                             
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

function viewfile(id){
            $('#tabs2').val('5');
            $("#btn-tutup").hide();  
            $("#btn-next1").show();  
            $("#btn-prev1").show();  
            $("#btn-prev1").removeAttr('class');
            $("#btn-prev1").attr('disabled', '');
            $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');

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

                                $("#md1").html('Lihat Data Permohonan - '+response.nama); //ubah title modal view file

                                    var pe = document.querySelectorAll('.viewfile2');
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

                                document.getElementById('imgMhs').innerHTML = '<img src="../../user/master/foto_user/'+ response.foto +'" style="height:auto; width:100%; ">'; 
                                document.getElementById('dataMhs').innerHTML = '<table class="table">  <tr>    <td width="40%">Nama Mahasiswa</td>    <td width="60%">: '+response.nama+'</td>  </tr>  <tr>    <td>Perguruan Tinggi/Universitas</td>    <td>: '+response.pt+'</td>  </tr>  <tr>    <td>Jenjang</td>    <td>: '+response.jenjang+'</td>  </tr>  <tr>    <td>Bidang Ilmu</td>    <td>: '+bIlmu+'</td>  </tr>  <tr>    <td>Daerah</td>    <td>: '+bDaerah+'</td>  </tr>  <tr>    <td>Semester</td>    <td>: '+response.semester1+' ('+response.semester+')</td>  </tr>  <tr>    <td>Periode Permohonan</td>    <td>: '+response.periode+'</td>  </tr>  <tr>    <td>Tanggal Permohonan</td>    <td>: '+response.tglP+'</td>  </tr>  <tr>    <td>IPK Terakhir</td>    <td>: '+response.ipk+'</td>  </tr></table>'; 
                                                                    
                        }
                
                    });

}




/*var table = $('#example').dataTable({
    responsive: true,
    "autoWidth": false,
});

table.columnFilter({
    sPlaceHolder : 'head:after',
    aoColumns: [ {  },
                 { type: "text","sWidth": "10px", "sTitle": "ID"},
                 { type: "text"},
                 { type: "text"},
                 { type: "text"},
                 { type: "text"},
                 {  }
               ] 
});
*/

</script>
