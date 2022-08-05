<?php 
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");




        $periodeL = $_GET['periode'];
        $kategori = $_GET['kategori'];
        $tampil = $_GET['tampil'];
        $mhs = $_GET['mhs'];
        


        if ($tampil == '4') {
            $tsql = '';
        }
        if ($tampil == '3') {
            $tsql = " AND (b.status_verifikasi='3' AND periode='".$periodeL."')";
        }
        if ($tampil == '2') {
            $tsql = " AND (b.status_verifikasi='2' AND periode='".$periodeL."')";
        }
        if ($tampil == '1') {
            $tsql = " AND (b.id_mahasiswa='".$mhs."' AND periode='".$periodeL."')";
        }

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




?>
<html>

<head>
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<link rel="icon" href="../inc/images/<?php echo $logo_title; ?>">

<script src="../inc/assets/plugins/jquery/jquery.min.js"></script>
<script src="../inc/assets/plugins/googoose/jquery.googoose.js"></script>

<style type="text/css">
    #googoose-footer {
        position: absolute;
        text-align: center; 
    }
table {
  font-family: Bookman Old Style; 
}

table tr td {
  vertical-align: top;
  font-size: 12px;
  height: 28px;
  line-height: 25px;
}
  
</style>
</head>
<body>
<div class='googoose-wrapper' align="center">

<?php

        $q = "SELECT m.nama_mahasiswa, m.perguruan_tinggi, m.jurusan, m.jenjang, m.nama_bank, m.pemilik, m.no_rekening, m.ilmu, m.daerah, m.telp_mahasiswa, b.semester, b.ipk, b.verifikator, b.keterangan, u.nama_user 
              FROM mahasiswa m, $kategori b, user u WHERE m.id_mahasiswa=b.id_mahasiswa AND b.verifikator=u.id_user $tsql";
        $sqlm = $con->prepare($q);
        $sqlm->execute();

        $sqlk = $con->prepare("SELECT * FROM set_berita_acara");
        $sqlk->execute();
        $dk = $sqlk->fetch();
        
        $atas = $dk['atas'];

        $n = $sqlm->rowCount();
        $no = 0;      

    while ($dm = $sqlm->fetch()) {
        $no++;


        if ($dm['daerah'] != 'KALIMANTAN TIMUR') {
            $daerah = 'LUAR';
        }else{
            $daerah = 'DALAM';
        }
        if ($dm['ilmu'] != '1') {
            $ilmu = 'IPS';
        }else{
            $ilmu = 'IPA';
        }
        if ($dm['keterangan'] != '') {
            $keterangan = $dm['keterangan'];
        }else{
            $keterangan = '-';
        }

?>

<table width="640" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td valign="top" colspan="7" align="center" style="vertical-align:top; font-size:16px; font-weight:bold;" width="160"><u><?php echo strtoupper($dk["judul"]); ?>       
    </u><br><br></td>
  </tr>
  <tr>
    <td valign="top" colspan="7" width="160" style="padding-bottom: 15px;"><?php echo $atas; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;" width="200">Nama Lengkap</td>
    <td valign="top" style="vertical-align:top;" width="9">:</td>
    <td valign="top" style="vertical-align:top;" width="200"><?php echo $dm["nama_mahasiswa"]; ?></td>
    <td valign="top" style="vertical-align:top;" width="20">&nbsp;</td>
    <td valign="top" style="vertical-align:top;" width="220">Jenjang</td>
    <td valign="top" style="vertical-align:top;" width="9">:</td>
    <td valign="top" style="vertical-align:top;" width="326"><?php echo $dm["jenjang"]; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">No. Telpon</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["telp_mahasiswa"]; ?></td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Semester</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["semester"]; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Nama Bank</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["nama_bank"]; ?></td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">KHS/Transkrip</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["ipk"]; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Nama Pemilik</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["pemilik"]; ?></td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Kategori</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $daerah.' ('.$ilmu.')'; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">No. Rekening</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["no_rekening"]; ?></td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Verifikator</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["nama_user"]; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Perguruan Tinggi</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["perguruan_tinggi"]; ?></td>
    <td>&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Keterangan Verifikator</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $keterangan; ?></td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Jurusan</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;"><?php echo $dm["jurusan"]; ?></td>
    <td>&nbsp;</td>
    <td valign="top" style="vertical-align:top;"> </td>
    <td valign="top" style="vertical-align:top;"> </td>
    <td valign="top" style="vertical-align:top;"> </td>
  </tr>
  <tr>
    <td valign="top" colspan="7" width="160" style="padding-top: 15px; text-align: justify;"><?php echo $dk['isi']; ?></td>
  </tr>
  <tr>
    <td valign="top" colspan="4" width="160"></td>
    <td valign="top" colspan="3" width="160"><br>
        <div style="float:left; position:relative; right:-70px;">
            <span style="text-align:center;">
            Mengetahui,<br>
            <?php echo $dk["mengetahui"]; ?>,
            <br><br><br><br>
            <u><?php echo $dk["penandatangan"]; ?></u>
            <br>
            NIP. <?php echo $dk["nip"]; ?>
            </span>
        </div>
     </td>
  </tr>
</table>

<?php
if ($no != $n) 
    echo   '<div class="googoose break"></div>'; else echo  '';

         }                                    
                                            

?>

    <div class='googoose footer'>
        <span class='googoose currentpage'></span>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $(document).googoose({
        download: true,
        zoom: 100,
        size: '8.27in 12.99in',
        margins: '.5in 1.0in 1.0in 1.0in',
        filename: 'Berita Acara Verifikasi Beasiswa-<?php echo $periodeL; ?>.doc'
    });
});
</script>
</body>
</html>