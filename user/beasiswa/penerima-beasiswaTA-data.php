<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
//require_once ($host1."/inc/assets/headerL.php"); 
$q = $con->prepare("SELECT * FROM set_beasiswa");
$q->execute();
$dq = $q->fetch();
?>

                                <table class="table table-bordered table-striped table-hover" id="example" style="margin-right:0px;">
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
                                    $periode = $dq['periode'];
                                    //    if ($periode == "") {
                                            $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi, m.jenjang FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.status_verifikasi='3' AND b.periode='$periode' ORDER BY b.ipk DESC");
                                            $sql->execute(); // Eksekusi querynya                                          
                                    //    }else{
                                    //        $sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.perguruan_tinggi FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='2') ORDER BY ipk DESC");
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
                                                    <td align="center"> </td>
                                                    <td align="center"><a class="badge bg-green viewfile" data-toggle="modal" id="view-'.$no.'" data-no="'.$no.'" onclick="viewfile('.$d['id_bta'].')" data-target="#form-file1" style="word-wrap: break-word; word-break: break-all; white-space: normal;">'.$d['nama_mahasiswa'].'</a></td>
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
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
        
    } ).draw();

 
    $('.column_filter').on( 'keyup click change', function () {
            filterColumn( $(this).attr('data-column') );
    } );

} );



function viewfile(id){
            $('#tabs2').val('5');
            $("#btn-tutup").hide();  
            $("#btn-next1").show();  
            $("#btn-prev1").show();  
            $("#btn-prev1").removeAttr('class');
            $("#btn-prev1").attr('disabled', '');
            $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');

                    var data = new FormData();
                    data.append('id_bta', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'penerima-beasiswaTA-aksi.php', 
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

                            if (response.statusV == 3) {
                                var statusV = 'Terverifikasi';
                            }else if(response.statusV == 2){
                                var statusV = 'Ditolak';
                            }else if(response.statusV == 1){
                                var statusV = 'Berkas kurang lengkap';
                            }else{
                                var statusV = 'Belum diverifikasi';
                            }
                            
                            if (response.tglV == '0000-00-00 00:00:00') {
                                var tglV = '-'; 
                            }else{
                                var tglV = response.tglV;
                            }
                            
                            if (response.keterangan == "") {
                                var keterangan = '-';
                            }else{
                                var keterangan = response.keterangan;
                            }

                                var verifikator = response.verifikator;


                            $("#md1").html('Lihat Data Permohonan - '+response.nama); //ubah title modal view file

                                var pe = document.querySelectorAll('.viewfile2');
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
                                document.getElementById('fileSP1').innerHTML = response.suratP; 
                            }else{
                            document.getElementById('fileSP1').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratAK != ""){
                            document.getElementById('fileAK1').innerHTML = response.suratAK; 
                            }else{
                            document.getElementById('fileAK1').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratPN != ""){
                            document.getElementById('fileSPN1').innerHTML = response.suratPN; 
                            }else{
                            document.getElementById('fileSPN1').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.propPN1 != ""){
                            document.getElementById('filePR11').innerHTML = response.propPN1; 
                            }else{
                            document.getElementById('filePR11').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.propPN2 != ""){
                            document.getElementById('filePR21').innerHTML = response.propPN2; 
                            }else{
                            document.getElementById('filePR21').innerHTML = 'Tidak ada file '; 
                            }
                            if(response.suratTA != ""){
                            document.getElementById('fileSTA1').innerHTML = response.suratTA; 
                            }else{
                            document.getElementById('fileSTA1').innerHTML = 'Tidak ada file '; 
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
                            document.getElementById('fileIjz11').innerHTML = response.ijazah1;
                            }else{
                            document.getElementById('fileIjz11').innerHTML = 'Tidak ada file ';
                            }
                            if(response.ijazah != ""){
                            document.getElementById('fileIjz21').innerHTML = response.ijazah2;
                            }else{
                            document.getElementById('fileIjz21').innerHTML = 'Tidak ada file ';
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

                                document.getElementById('imgMhs').innerHTML = '<img src="../master/foto_user/'+ response.foto +'" style="height:auto; width:100%; ">'; 
                                document.getElementById('dataMhs').innerHTML = '<table class="table">  <tr>    <td width="40%">Nama Mahasiswa</td>    <td width="60%">: '+response.nama+'</td>  </tr>  <tr>    <td>Perguruan Tinggi/Universitas</td>    <td>: '+response.pt+'</td>  </tr>  <tr>    <td>Jenjang</td>    <td>: '+response.jenjang+'</td>  </tr>  <tr>    <td>Bidang Ilmu</td>    <td>: '+bIlmu+'</td>  </tr>  <tr>    <td>Daerah</td>    <td>: '+bDaerah+'</td>  </tr>  <tr>    <td>Semester</td>    <td>: '+response.semester+'</td>  </tr>  <tr>    <td>Periode Permohonan</td>    <td>: '+response.periode+'</td>  </tr>  <tr>    <td>Tanggal Permohonan</td>    <td>: '+response.tglP+'</td>  </tr>  <tr>    <td>IPK Terakhir</td>    <td>: '+response.ipk+'</td>  </tr>  <tr>    <td>Status Verifikasi</td>    <td>: '+statusV+'</td>  </tr>  <tr>    <td>Tanggal Verifikasi</td>    <td>: '+tglV+'</td>  </tr>  <tr>    <td>Keterangan</td>    <td>: '+keterangan+'</td>  </tr>  <tr>    <td>Verifikator</td>    <td>: '+verifikator+'</td>  </tr></table>'; 
                                                                    
                        }
                
                    });

}

</script>
