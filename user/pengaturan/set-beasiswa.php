<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

	$set = $_GET['set'];
	$set1 = $_POST['sett'];

	
if ($set == 'sistem') {
	$sistem = $_POST['sistem'];
	$sql = $con->prepare("UPDATE set_beasiswa SET status_beasiswa='$sistem', publish='0'");
	$sql->execute();
}
else if ($set == 'tutup') {
	$tutup = $_POST['tutup'];
	$sql = $con->prepare("UPDATE set_beasiswa SET status_penerimaan='$tutup'");
	$sql->execute();
}
else if ($set1 == 'publish') {
	$publish = $_POST['publish'];
	$sql = $con->prepare("UPDATE set_beasiswa SET publish='$publish', status_beasiswa='0'");
	$sql->execute();

	$periode = $_POST['periode']; 

  $sqlxx = $con->prepare("UPDATE beasiswa_prestasi SET keterangan='Belum memenuhi standar kriteria penilaian' WHERE NOT status_verifikasi='3' AND periode='$periode'");
  $sqlxx->execute();


  $sqlyy = $con->prepare("UPDATE beasiswa_ta SET keterangan='Belum memenuhi standar kriteria penilaian' WHERE NOT status_verifikasi='3' AND periode='$periode'");
  $sqlyy->execute();


$qn = $con->prepare("SELECT * FROM set_beasiswa");
$qn->execute();
$dn = $qn->fetch();
if ($dn['notifikasi'] == 1) {
  
    $sqlp = $con->prepare("SELECT b.*, m.email, m.nama_mahasiswa, m.no_ktm, m.perguruan_tinggi FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periode' AND b.status_verifikasi='3'");
    $sqlp->execute();
    $n = $sqlp->rowCount();

    $sql1 = $con->prepare("SELECT b.*, m.email, m.nama_mahasiswa, m.no_ktm, m.perguruan_tinggi FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periode' AND b.status_verifikasi='3'");
    $sql1->execute();
    $n1 = $sql1->rowCount();

$s = 0;
while ($d = $sqlp->fetch()) {
    
    $email = $d['email'];
    $nama_mahasiswa = $d['nama_mahasiswa'];
    $no_ktm = $d['no_ktm'];
    $perguruan_tinggi = $d['perguruan_tinggi'];
    $semester = $d['semester'];
    $ipk = $d['ipk'];

    $a = kirimNotif2($email, $nama_mahasiswa, $no_ktm, $perguruan_tinggi, $semester, $ipk, $periode, 'Prestasi');
    $s = $s + $a;
}
$jb = $s;


$s1 = 0;
while ($d1 = $sql1->fetch()) {
    
    $email1 = $d1['email'];
    $nama_mahasiswa1 = $d1['nama_mahasiswa'];
    $no_ktm1 = $d1['no_ktm'];
    $perguruan_tinggi1 = $d1['perguruan_tinggi'];
    $semester1 = $d1['semester'];
    $ipk1 = $d1['ipk'];

    $a1 = kirimNotif2($email1, $nama_mahasiswa1, $no_ktm1, $perguruan_tinggi1, $semester1, $ipk1, $periode, 'Tugas Akhir');
    $s1 = $s1 + $a1;
}
$jb1 = $s1;


/*

$s1 = 1;
$q1 = $sql1->fetchAll();
foreach ($q1 as $d1) { 

    

$message ='<html>
<body style="background:#F0F0F0;">
<br>
<div style="margin-top:20px;">
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; height:10px; padding:0px 30px 0px 30px">
</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(https://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="https://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      
    </td>
  </tr>
</table>
<div style=" padding:30px 30px 30px 30px">';
$message .='<p>Yth  '.$nama_mahasiswa1.',<br />
  Berdasarkan hasil verifikasi dan penyeleksian berkas permohonan beasiswa Pemerintah Kota Bontang periode '.$periode.'<br />
Permohonan Beasiswa Anda dinyatakan diterima dan berhak untuk menerima dana pendidikan Pemerintah Kota Bontang periode '.$periode.'.</p>';
    $message .='<br>
<div>
<table style="width:100%;border:0.2px solid #c6c6c6;" border="1" cellspacing="0" cellpadding="0" >
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;"  width="35%">&nbsp;No. KTM</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;"  width="65%">&nbsp;: '.$no_ktm1.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Nama</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$nama_mahasiswa1.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Perguruan Tinggi</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$perguruan_tinggi1.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Semester</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$semester1.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;IPK</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$ipk1.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Permohonan Beasiswa</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: Beasiswa Prestasi</td>
  </tr>
</table>';
$message .='<img src="https://e-beasiswa.bontangkota.go.id/inc/assets/images/acc1.png" style="width:120px; height:auto; float:right; position:relative; top:-120px; margin-right:10px;">
</div>
<p>Untuk informasi selanjutnya silakan login ke akun e-Beasiswa Anda atau silakan hubungi kontak kami.</p>
<p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p>
<p>&nbsp;</p>
<a href="./">e-Beasiswa Bontang</a>
<hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="https://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
</div>
</td>
</tr>
</table>
</div>
</div>
<p style="font-size:13px;color:#999;text-align:center;">© Diskominfo dan Statistik Bontang, Jl. Bessai Berinta Graha Taman Praja Blok I Lantai 3, Kel. Bontang Lestari </p>
<br></div>
</body>
</html>';

    $mail->addAddress($email1, $nama_mahasiswa1);
    $mail->Body = $message;

        if ($mail->send()) {
           $jb1 = $s1++;
        }else{
           $jb1 = $s1;
        }
	$mail->clearAddresses();
    
    }


$s = 1;
$q = $sqlp->fetchAll();
foreach ($q as $d) { 

    
    $email = $d['email'];
    $nama_mahasiswa = $d['nama_mahasiswa'];
    $no_ktm = $d['no_ktm'];
    $perguruan_tinggi = $d['perguruan_tinggi'];
    $semester = $d['semester'];
    $ipk = $d['ipk'];


$message ='<html>
<body style="background:#F0F0F0;">
<br>
<div style="margin-top:20px;">
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; height:10px; padding:0px 30px 0px 30px">
</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(https://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="https://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      
    </td>
  </tr>
</table>
<div style=" padding:30px 30px 30px 30px">';
$message .='<p>Yth  '.$nama_mahasiswa.',<br />
  Berdasarkan hasil verifikasi dan penyeleksian berkas permohonan beasiswa Pemerintah Kota Bontang periode '.$periode.'<br />
Permohonan Beasiswa Anda dinyatakan diterima dan berhak untuk menerima dana pendidikan Pemerintah Kota Bontang periode '.$periode.'.</p>';
    $message .='<br>
<div>
<table style="width:100%;border:0.2px solid #c6c6c6;" border="1" cellspacing="0" cellpadding="0" >
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;"  width="35%">&nbsp;No. KTM</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;"  width="65%">&nbsp;: '.$no_ktm.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Nama</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$nama_mahasiswa.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Perguruan Tinggi</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$perguruan_tinggi.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Semester</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$semester.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;IPK</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: '.$ipk.'</td>
  </tr>
  <tr>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;Permohonan Beasiswa</td>
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: Beasiswa Prestasi</td>
  </tr>
</table>';
$message .='<img src="https://e-beasiswa.bontangkota.go.id/inc/assets/images/acc1.png" style="width:120px; height:auto; float:right; position:relative; top:-120px; margin-right:10px;">
</div>
<p>Untuk informasi selanjutnya silakan login ke akun e-Beasiswa Anda atau silakan hubungi kontak kami. Terimakasih.</p>
<p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p>
<hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="https://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
</div>
</td>
</tr>
</table>
</div>
</div>
<p style="font-size:13px;color:#999;text-align:center;">© Diskominfo dan Statistik Bontang, Jl. Bessai Berinta Graha Taman Praja Blok I Lantai 3, Kel. Bontang Lestari </p>
<br></div>
</body>
</html>';
    
    $mail->addAddress($email, $nama_mahasiswa);
    $mail->Body = $message;

        if ($mail->send()) {
           $jb = $s++;
        }else{
           $jb = $s;
        }
	$mail->clearAddresses();

    }

*/

    if ($jb == $n || $jb1 == $n1) {
		$response = array(
					'status'=>'sukses' // Set status
				);
    }else{
		$response = array(
					'status'=>'gagal' // Set status
				);
    }

	echo json_encode($response);
} //end if notifikasi
else{
    $response = array(
          'status'=>'sukses' // Set status
        );

  echo json_encode($response);

}

}
else{
	$notif = $_POST['notif'];
	$sql = $con->prepare("UPDATE set_beasiswa SET notifikasi='$notif'");
	$sql->execute();
}
?>
