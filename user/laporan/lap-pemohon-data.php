<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");
include_once ($host1."/inc/mpdf/mpdf.php");

        $periodeL = $_GET['periode'];
        $kategori = $_GET['kategori'];
        

       

        if ($_GET['kertas'] == 'custom') {
            //if ($_GET['layout'] == 'P') {
                $kertas = array($_GET['lebar'], $_GET['tinggi']);
            //}else{
            //    $kertas = array($_GET['tinggi'], $_GET['lebar']);
            //}
        }else{
            $kertas = $_GET['kertas'].'-'.$_GET['layout'];
        }

        $judul = ($kategori == 'beasiswa_prestasi' ? 'BEASISWA PRESTASI' : ($kategori == 'beasiswa_ta' ? 'BEASISWA TUGAS AKHIR' :  'BEASISWA COASS'));
        $namafile = ($kategori == 'beasiswa_prestasi' ? 'Prestasi' : ($kategori == 'beasiswa_ta' ? 'TA' :  'COASS'));



                                        
           $html ='<table cellpadding="0" cellspacing="0" style="border:0px; width:100%; padding:0px;">
           <tr><td style="border:none;" align="left" valign=top><img src="logokota1.jpg" width="50"></td>
           <td width="100%" style="border:none;text-align:center;"><h2>DATA PENGAJUAN PERMOHONAN '.$judul.'</h2><h3>PERIODE '. $periodeL.'</h3></td>
           <td style="border:none;" align="left" width="60"></td>
           </tr>
           <tr>
                <td colspan="3" style="border:none;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                        <tr>                        
                            <td style=" border:0px; width:100%; border-left:none; padding:1px; border-right:none; border-bottom:3px solid #000; border-top:1px solid #000;"></td>
                        </tr>
                    </table>
                </td>
           </tr>
           </table>
           ';
//border-bottom:6px double #000;<img src="'.$host.'/inc/assets/images/border.jpg" style="width:100%; height:5px;">
 //<!--  ------------------------------------------- D1 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D1' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';





//<!--  ------------------------------------------------ D1 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D1' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D1 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D1' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D1 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D1' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA I DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';



 //<!--  ------------------------------------------- D2 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D2' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';





//<!--  ------------------------------------------------ D2 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D2' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D2 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D2' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D2 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D2' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA II DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';



 //<!--  ------------------------------------------- D3 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';





//<!--  ------------------------------------------------ D3 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA III DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';



 //<!--  ------------------------------------------- D4 LUAR IPA ---------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';





//<!--  ------------------------------------------------ D4 DALAM IPA ------------------------------------------------ -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D4' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D4 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- D4 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='D4' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN DIPLOMA IV DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S1 LUAR IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S1 DALAM IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S1' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S1 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';



//<!--  --------------------------------------------- S1 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S1' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S1 DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';





//<!--  --------------------------------------------- S2 LUAR IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S2 DALAM IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S2' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S2 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';



//<!--  --------------------------------------------- S2 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S2' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S2 DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';





//<!--  --------------------------------------------- S3 LUAR IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S3 DALAM IPA ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S3' AND m.ilmu='1' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPA)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';




//<!--  --------------------------------------------- S3 LUAR IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah!='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 LUAR DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';



//<!--  --------------------------------------------- S3 DALAM IPS ----------------------------------------------- -->

  
        $query = "SELECT b.ipk, b.semester, m.no_ktm, m.ilmu, m.nama_mahasiswa, m.perguruan_tinggi, m.kota, m.jurusan, m.nama_bank, m.pemilik, m.no_rekening, m.telp_mahasiswa FROM $kategori b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND (b.periode='$periodeL' AND m.jenjang='S3' AND m.ilmu='2' AND m.daerah='KALIMANTAN TIMUR')";

        $sql = $con->prepare($query);
        $sql->execute(); 
        $n = $sql->rowCount();
        if ($n > 0) {

                        $html .='<br>
                        <p style="font-size:15px;text-align:center;">JENJANG PENDIDIKAN S3 DALAM DAERAH (IPS)</p>
                                <table class="table1">
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
                                                $html .= '
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
                                                        <td style="font-size: 9px;" align="center">'.$d['telp_mahasiswa'].'</td>
                                                    </tr>
                                            ';
                                            }  
                                    }else{
                                        $html .='';
                                    }

                                    
                                    $html .='</tbody>
                                </table>';









/*$sq = $con->prepare("SELECT * FROM aplikasi");
$sq->execute();
$dt = $sq->fetch();
$content = ob_get_clean();
*/

$mpdf = new mPDF("utf-8", $kertas, 0, "", 5, 5, 5, 1, 1, 1, 'P');
$mpdf->showImageErrors = true;
$header = '';
 
$footer = '<table cellpadding=0 cellspacing=0 style="border:none; width:100%; font-size:10px;">
           <tr><td style="margin-right:-5px;border:none;" align="left">
           Dicetak: '.date("Y-m-d H:i").'</td>
           <td style="margin-right:-5px;border:none;text-align:right;">
           Halaman: {PAGENO} / {nb}</td></tr></table>';  


try {
    $mpdf->SetTitle('Laporan '.$namafile. ' Periode '.$periodeL);
    //$mpdf->setHTMLHeader($header);
    $mpdf->setHTMLFooter($footer);
    $stylesheet = file_get_contents('tabel.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output('Laporan Data Pengajuan Permohonan '.$namafile. ' Periode '.$periodeL.'.pdf','I');
} catch(Exception $e) {
    echo $e;
    exit;
}?>