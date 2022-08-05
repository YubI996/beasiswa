<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-verifikator.php");
?>



                                <table class="table table-bordered table-striped table-hover" id="example" style="margin-right:0px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">No.</th>
                                            <th style="text-align:center;">Nama</th>
                                            <th style="text-align:center;">Perguruan Tinggi</th>
                                            <th style="text-align:center;">Jenjang</th>
                                            <th style="text-align:center;">Jurusan</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $con->prepare("SELECT m.*, u.foto_user FROM mahasiswa m, user u WHERE m.id_user=u.id_user");
                                        $sql->execute(); // Eksekusi querynya

                                        $no = 0;
                                        while ($d=$sql->fetch()) {
                                            $no++;
                                            echo '
                                                <tr>
                                                    <td align="center">'.$no.'</td>
                                                    <td align="center"><a class="badge bg-brown viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'" onclick="viewfile('.$d['id_mahasiswa'].')" data-no="'.$no.'" data-target="#form-modal" >'.$d['nama_mahasiswa'].'</a></td>
                                                    <td align="center">'.$d['perguruan_tinggi'].'</td>
                                                    <td align="center">'.$d['jenjang'].'</td>
                                                    <td align="center">'.$d['jurusan'].'</td>
                                                    <td align="center">
                                                    <a class="badge bg-teal viewfile" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="view-'.$no.'"  data-target="#form-modal" onclick="viewfile('.$d['id_mahasiswa'].')" title="Lihat Data Permohonan"><i class=" material-icons" style="font-size:16px;" >search</i></a>                                                    
                                                </td>
                                                </tr>';

                                                ?>

                                      <?php
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

// Fungsi ini akan dipanggil ketika tombol edit diklik


</script>
