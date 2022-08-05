<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");

$sql = $con->prepare("SELECT * FROM set_beasiswa");
$sql->execute();
$d = $sql->fetch();
$periode = $d['periode'];


?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" >
                            <h1 class="title">Penerima Beasiswa</h1>
                            <p>Pengumuman penerima beasiswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#page-breadcrumb-->
        <section id="company-information" class="choose">
        <div class="container">


<?php
if ($d['status_penerimaan'] == 0 && $d['status_beasiswa'] == 0  && $d['publish'] == 0) {
    echo '<center><p style="font-size:20px;">Maaf pendaftaran penerimaan beasiswa Pemkot Bontang Belum dibuka.</p></center>';
}
else if($d['status_penerimaan'] == 1 && $d['status_beasiswa'] == 1){
    echo '<p>Pendaftaran penerimaan Beasiswa Pemkot Bontang Telah dibuka untuk periode '.$periode.', silakan lengkapi berkas Anda dan segera daftar melalui aplikasi e-Beasiswa</p><br><br>sincerely,<br><a>Administrator e-Beasiswa</a>';
}
else if ($d['status_penerimaan'] == 0 && $d['status_beasiswa'] == 1 && $d['status_publish'] == 0) {
    echo '<p>Sistem Pendaftaran online Telah ditutup dan saat ini semua data pemohon sedang di verifikasi oleh verifikator kami, silakan tunggu pengumuman selanjutnya. <br>Terimakasih.</p><br><br>sincerely,<br><a>Administrator e-Beasiswa</a>';
}
else if ($d['status_penerimaan'] == 0 && $d['status_beasiswa'] == 0 && $d['publish'] == 1) {
?>
        <p>Berdasarkan Hasil verifikasi dan penyeleksian berkas, berikut adalah mahasiswa yang dinyatakan <b>BERHAK</b> untuk menerima dana pendidikan Beasiswa Pemerintah Kota Bontang periode <?php echo $periode; ?></p>
        <br>
        <p style="color: #f00;">NOTE : Untuk melihat data penerima lebih detail, silakan download file pdf pengumuman penerima beasiswa periode  <?php echo $periode; ?> di menu file unduhan</p>
        <br>
        


                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header"> A. PENERIMA BEASISWA PRESTASI PERIODE <?php echo $periode; ?> </h2>
                    </div>
                    <div class="col-md-12">
                        <ul id="tab1" class="nav nav-tabs">
                            <li class="active"><a href="#tab1-item1" data-toggle="tab">Kategori : <b>D3</b></a></li>
                            <li><a href="#tab1-item2" data-toggle="tab">Kategori : <b>D4</b></a></li>
                            <li><a href="#tab1-item3" data-toggle="tab">Kategori : <b>S1</b></a></li>
                            <li><a href="#tab1-item4" data-toggle="tab">Kategori : <b>S2</b></a></li>
                            <li><a href="#tab1-item5" data-toggle="tab">Kategori : <b>S3</b></a></li>
                        </ul>
                        <div class="tab-content scroll" style="border-bottom: 2px dashed #000;"> 
                            <div class="tab-pane fade active in" id="tab1-item1">

 
<?php
 //<!--  ------------------------------------------- D3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ D3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';


?>

<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== --> 


                            </div>
                            <div class="tab-pane fade" id="tab1-item2">
                                
<?php
 //<!--  ------------------------------------------- D4 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ D4 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D4 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D4 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';


?>


                            </div>
                            <div class="tab-pane fade" id="tab1-item3">
                                
<?php


//*********************************************************************************************************************

 //<!--  ------------------------------------------- S1 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ S1 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S1 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S1 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




?>



                            </div>
                            <div class="tab-pane fade" id="tab1-item4">
                                
<?php





//*********************************************************************************************************************

 //<!--  ------------------------------------------- S2 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ S2 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S2 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S2 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';






?>



                            </div>
                            <div class="tab-pane fade" id="tab1-item5">
                                
<?php






//*********************************************************************************************************************

 //<!--  ------------------------------------------- S3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ S3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';


?>
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== --> 


                            </div>
                        </div>
                    </div>
                </div> 


        <br>
        <br>
        <br>
        <br> 








<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->



                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header"> B. PENERIMA BEASISWA TUGAS AKHIR PERIODE <?php echo $periode; ?> </h2>
                    </div>
                    <div class="col-md-12">
                        <ul id="tab1" class="nav nav-tabs">
                            <li class="active"><a href="#tab1-item11" data-toggle="tab">Kategori : <b>D3</b></a></li>
                            <li><a href="#tab1-item21" data-toggle="tab">Kategori : <b>D4</b></a></li>
                            <li><a href="#tab1-item31" data-toggle="tab">Kategori : <b>S1</b></a></li>
                            <li><a href="#tab1-item42" data-toggle="tab">Kategori : <b>S2</b></a></li>
                            <li><a href="#tab1-item52" data-toggle="tab">Kategori : <b>S3</b></a></li>
                        </ul>
                        <div class="tab-content scroll" style="border-bottom: 2px dashed #000;"> 
                            <div class="tab-pane fade active in" id="tab1-item11">

 
<?php
 //<!--  ------------------------------------------- D3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ D3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';


?>

<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== --> 


                            </div>
                            <div class="tab-pane fade" id="tab1-item21">
                                
<?php
 //<!--  ------------------------------------------- D4 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ D4 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D4 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- D4 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';


?>


                            </div>
                            <div class="tab-pane fade" id="tab1-item31">
                                
<?php


//*********************************************************************************************************************

 //<!--  ------------------------------------------- S1 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ S1 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S1 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S1 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




?>



                            </div>
                            <div class="tab-pane fade" id="tab1-item42">
                                
<?php





//*********************************************************************************************************************

 //<!--  ------------------------------------------- S2 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ S2 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S2 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S2 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomS1pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';






?>



                            </div>
                            <div class="tab-pane fade" id="tab1-item52">
                                
<?php






//*********************************************************************************************************************

 //<!--  ------------------------------------------- S3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ S3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';




//<!--  --------------------------------------------- S3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPS)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPS) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';


?>
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== --> 


                            </div>
                        </div>
                    </div>
                </div> 



        <br>
        <br>
        <br>
        <br> 




<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->



                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header"> C. PENERIMA BEASISWA COASS KEDOKTERAN PERIODE <?php echo $periode; ?> </h2>
                    </div>
                    <div class="col-md-12">
                        <ul id="tab1" class="nav nav-tabs">
                            <li class="active"><a href="#tab1-item111" data-toggle="tab">Kategori : <b>COASS KEDOKTERAN</b></a></li> 
                        </ul>
                        <div class="tab-content scroll" style="border-bottom: 2px dashed #000;"> 
                            <div class="tab-pane fade active in" id="tab1-item111">

 
<?php
 //<!--  ------------------------------------------- D3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_coass b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<p style="font-size:15px;text-align:center;">BEASISWA COASS LUAR DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomd3pres.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">BEASISWA COASS LUAR DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





//<!--  ------------------------------------------------ D3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM beasiswa_coass b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periode' AND b.status_verifikasi='3' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo'<br>
                        <p style="font-size:15px;text-align:center;">BEASISWA COASS DALAM DAERAH (IPA)</p>
                                <table class="table table-bordered table-striped table-hover tbl">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:17%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">UANG DITERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                echo '
                                                    <tr>
                                                        <td style="font-size: 10px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 10px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 10px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 10px;" align="right">Rp '.$nomcoass.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo'<p style="font-size:15px;text-align:center;">BEASISWA COASS DALAM DAERAH (IPA) <br><b>TIDAK ADA PENDAFTAR</b></p>';
                                    }

                                    
                                    echo'</tbody>
                                </table> <hr>';





?>
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== -->
<!-- ====================================================================================================================================== --> 


                            </div>
                        </div>
                    </div>
                </div> 

<br><br>sincerely,<br><a>Administrator e-Beasiswa</a>
        </div>
    </section>
<?php
}
?>
    <br>
    <!--/#company-information-->
<?php
require_once ($host1."/home/footer.php");
?>