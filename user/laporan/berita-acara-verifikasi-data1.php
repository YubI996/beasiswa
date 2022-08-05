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
        
        $judul = ($kategori == 'beasiswa_prestasi' ? 'BEASISWA PRESTASI' : ($kategori == 'beasiswa_ta' ? 'BEASISWA TUGAS AKHIR' :  'BEASISWA COASS'));
        $namafile = ($kategori == 'beasiswa_prestasi' ? 'Prestasi' : ($kategori == 'beasiswa_ta' ? 'TA' :  'COASS'));

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Berita-Acara-Verifikasi-Beasiswa-".$namafile."_$periodeL.xls");//ganti nama sesuai keperluan
        header("Pragma: no-cache");
        header("Expires: 0");

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







        $q = "SELECT m.nama_mahasiswa, m.perguruan_tinggi, m.jurusan, m.jenjang, m.nama_bank, m.pemilik, m.no_rekening, m.ilmu, m.daerah, m.telp_mahasiswa, b.semester, b.ipk, b.verifikator, b.keterangan, u.nama_user 
              FROM mahasiswa m, $kategori b, user u WHERE m.id_mahasiswa=b.id_mahasiswa AND b.verifikator=u.id_user $tsql";
        $sqlm = $con->prepare($q);
        $sqlm->execute();

        $sqlk = $con->prepare("SELECT * FROM set_berita_acara");
        $sqlk->execute();
        $dk = $sqlk->fetch();
        
        $atas = $dk['atas']."<br>
           ";

        $n = $sqlm->rowCount();
        $no = 0;      

    while ($dm = $sqlm->fetch()) {
        $no++;

        echo '<h3 style="text-align:center;"><u>'.strtoupper($dk["judul"]).'</u></h3>';
    echo  $atas;
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


echo '
<table width="100%" border="0" style="border:0px;" cellspacing="0" cellpadding="5" style="font-size:17px;">
  <tr>
    <td valign="top" style="vertical-align:top;" width="160">Nama Lengkap</td>
    <td valign="top" style="vertical-align:top;" width="9">:</td>
    <td valign="top" style="vertical-align:top;" width="295">'.$dm["nama_mahasiswa"].'</td>
    <td valign="top" style="vertical-align:top;" width="27">&nbsp;</td>
    <td valign="top" style="vertical-align:top;" width="196">Jenjang</td>
    <td valign="top" style="vertical-align:top;" width="9">:</td>
    <td valign="top" style="vertical-align:top;" width="326">'.$dm["jenjang"].'</td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">No. Telpon</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">\''.$dm["telp_mahasiswa"].'</td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Semester</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$dm["semester"].'</td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Nama Bank</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$dm["nama_bank"].'</td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">KHS/Transkrip</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">\''.$dm["ipk"].'</td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Nama Pemilik</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$dm["pemilik"].'</td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Kategori</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$daerah.' ('.$ilmu.')</td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">No. Rekening</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">\''.$dm["no_rekening"].'</td>
    <td valign="top" style="vertical-align:top;">&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Verifikator</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$dm["nama_user"].'</td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Perguruan Tinggi</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$dm["perguruan_tinggi"].'</td>
    <td>&nbsp;</td>
    <td valign="top" style="vertical-align:top;">Keterangan Verifikator</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$keterangan.'</td>
  </tr>
  <tr>
    <td valign="top" style="vertical-align:top;">Jurusan</td>
    <td valign="top" style="vertical-align:top;">:</td>
    <td valign="top" style="vertical-align:top;">'.$dm["jurusan"].'</td>
    <td>&nbsp;</td>
    <td valign="top" style="vertical-align:top;"> </td>
    <td valign="top" style="vertical-align:top;"> </td>
    <td valign="top" style="vertical-align:top;"> </td>
  </tr>
</table>
';


echo  $dk['isi'];

echo  '<br><br><div style="float:left; position:relative; right:-50px;">
            <span style="text-align:center;">
            Mengetahui,<br>
            '.$dk["mengetahui"].',
            <br><br><br><br>
            <u>'.$dk["penandatangan"].'</u>
            <br>
            NIP. '.$dk["nip"].'
            </span>
          </div>
          ';
if ($no != $n) 
    echo   '<br><br><br><br>'; else echo  '';

         }                                    
                                            

?>