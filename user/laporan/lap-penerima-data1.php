<?php 
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

        $periodeL = $_GET['periode'];
        $kategori = $_GET['kategori'];
        

        $judul = ($kategori == 'beasiswa_prestasi' ? 'BEASISWA PRESTASI' : ($kategori == 'beasiswa_ta' ? 'BEASISWA TUGAS AKHIR' :  'BEASISWA COASS'));
        $namafile = ($kategori == 'beasiswa_prestasi' ? 'Prestasi' : ($kategori == 'beasiswa_ta' ? 'TA' :  'COASS'));
       
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Laporan-Data-Penerima-Beasiswa-".$namafile."_$periodeL.xls");//ganti nama sesuai keperluan
        header("Pragma: no-cache");
        header("Expires: 0");

 

 


           echo '<table cellpadding="0" cellspacing="0" style="border:0px; width:100%; padding:0px;">
           <tr>
           <td width="100%" colspan="12" style="border:none;text-align:center;"><h2>DATA PENERIMA STIMULAN '.$judul.'</h2></td>
           </tr>
           <tr>
           <td colspan="12" style="border:none;" align="center"><h3>PERIODE '. $periodeL.'</h3></td>
           </tr>
           </table>
           ';
//<img src="'.$host.'/inc/assets/images/border.jpg" style="width:100%; height:5px;">
 //<!--  ------------------------------------------- D1 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D1' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  ------------------------------------------------ D1 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D1' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D1 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D1' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D1 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D1' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';



 //<!--  ------------------------------------------- D2 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D2' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  ------------------------------------------------ D2 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D2' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D2 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D2' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D2 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D2' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';



 //<!--  ------------------------------------------- D3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  ------------------------------------------------ D3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';



 //<!--  ------------------------------------------- D4 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    

                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  ------------------------------------------------ D4 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D4 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- D4 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  --------------------------------------------- S1 LUAR IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- S1 DALAM IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- S1 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';



//<!--  --------------------------------------------- S1 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  --------------------------------------------- S2 LUAR IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- S2 DALAM IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- S2 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';



//<!--  --------------------------------------------- S2 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





//<!--  --------------------------------------------- S3 LUAR IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- S3 DALAM IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPA)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';




//<!--  --------------------------------------------- S3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';



//<!--  --------------------------------------------- S3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND b.status_verifikasi='3' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        echo '<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPS)</p>
                                <table class="table1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; font-size: 11px; width:2%;">#</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA LENGKAP</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">PERGURUAN TINGGI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">KOTA</th>
                                            <th style="text-align:center; font-size: 11px; width:10%;">PROGRAM STUDI</th>
                                            <th style="text-align:center; font-size: 11px; width:6%;">SEMESTER</th>
                                            <th style="text-align:center; font-size: 11px; width:5%;">KHS</th>
                                            <th style="text-align:center; font-size: 11px; width:7%;">NIM</th>
                                            <th style="text-align:center; font-size: 11px; width:13%;">NAMA BANK</th>
                                            <th style="text-align:center; font-size: 11px; width:14%;">NAMA SESUAI REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. REKENING</th>
                                            <th style="text-align:center; font-size: 11px; width:8%;">NO. TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                     
                                            $kata = ["KOTA ", "KABUPATEN "];
                                            $ganti   = ["", ""];

                                            $no = 0;
                                            while ($d=$sql->fetch()) {
                                                $no++;
                                                $telp = "'".$d['telp_mahasiswa'];
                                                echo  '
                                                    <tr>
                                                        <td style="font-size: 9px;" align="center">'.$no.'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['nama_mahasiswa']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['perguruan_tinggi']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.str_replace($kata, $ganti, $d['kota']).'</td>
                                                        <td style="font-size: 9px;" align="left">'.strtoupper($d['jurusan']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['semester'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['ipk'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_ktm'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['nama_bank']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.strtoupper($d['pemilik']).'</td>
                                                        <td style="font-size: 9px;" align="center">'.$d['no_rekening'].'</td>
                                                        <td style="font-size: 9px;" align="center">'.$telp.'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        echo '';
                                    }

                                    
                                    echo '</tbody>
                                </table>';





?>