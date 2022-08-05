<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
include_once ($host1."/inc/koneksi.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once ($host1."/inc/PHPMailer2/src/Exception.php");
require_once ($host1."/inc/PHPMailer2/src/PHPMailer.php");
require_once ($host1."/inc/PHPMailer2/src/SMTP.php");

error_reporting(0);
date_default_timezone_set('Asia/Makassar');


function kirimKode($nm, $eml, $kA, $idU, $uname, $pass){
    $penerima = $eml;
    $nama = $nm;
    $aktivasi = $kA;
    $idUser = $idU;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    /*//Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'schofi.ren@gmail.com';                 // SMTP username
    $mail->Password = 'schofi123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('schofi.ren@gmail.com', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('schofi.ren@gmail.com', 'Admin Beasiswa Bontang'); 
    */
    // $mail->SMTPDebug = 0;     

//$mail->SMTPDebug = 2;                      //Enable verbose debug output
//    $mail->isSMTP();                                            //Send using SMTP
//    $mail->Host       = 'mail.masuk.email';                     //Set the SMTP server to send through
//    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//    $mail->Username   = 'beasiswabontang2021@beasiswabontang.my.id';                     //SMTP username
//    $mail->Password   = 'Phpmysqli123';                               //SMTP password
//    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
//    $mail->Port       = 587;
                                // Enable verbose debug output
    //$mail->Mailer = "smtp";
    // $mail->isSMTP();                                      // Set mailer to use SMTP
    // $mail->Host = 'smtp://smtp.mailtrap.io';  // Specify main and backup SMTP servers
    // $mail->SMTPAuth = true;                               // Enable SMTP authentication
    // $mail->Username = 'cf8b7cae1c827a:2c372f659e6171';                 // SMTP username
    // $mail->Password = 'phpmysql123';                          // SMTP password
    // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    // $mail->Port = 2525;
    
// $mail->isSMTP();
// $mail->Host = 'smtp.mailtrap.io';
// $mail->SMTPAuth = true;
// $mail->Port = 2525;
// $mail->Username = 'cf8b7cae1c827a';
// $mail->Password = '2c372f659e6171';
 $mail->SMTPDebug = 0;
 $mail->isSMTP();
 $mail->Host = '192.168.1.150';
 $mail->SMTPAuth = true;
 $mail->Port = 25;
 $mail->SMTPSecure = 'tls';     
 $mail->Username = 'beasiswa';
 $mail->Password = '123456BAE';
// 	$mail->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
// );
// TCP port to connect to

    //Recipients
    $mail->setFrom('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang'); 


$message = '<html>
<body style="background:#F0F0F0;">
<br>
<p style="font-size:13px;color:#F0F0F0;text-align:center;">&nbsp;</p>

<div>
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; color:#0D7898; height:10px; padding:0px 30px 0px 30px; text-align:center;">-------</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(http://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="http://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      
    </td>
  </tr>
</table>  <div style=" padding:30px 30px 30px 30px">
<p>Yth '.$nama.',<br />
  Terimakasih telah mendaftar. Silakan aktivasi akun Anda dengan mengklik link aktivasi di bawah ini. (aktivasi hanya berlaku sekali).<br /></p>
    <br />
    <center><a href="http://e-beasiswa.bontangkota.go.id/home/aktivasi_akun.php?uC='.$idUser.'&aC='.$aktivasi.'" style="color:#fff; background:#4584EF; border-radius:5px; border:none; text-decoration:none; padding:8px 20px 8px 20px;"> Aktivasi Akun e-Beasiswa</a></center>
<p>&nbsp;</p>
<p>Setelah mengkativasi akun Anda dapat langsung Login ke akun e-Beasiswa Anda dengan Username dan Password berikut, terimakasih.</p>
<p>Username : '.$uname.'</p>
<p>Password : '.$pass.'</p>
<p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p>
<hr>
<div style="color:#939393;text-align:justify; font-size:12px; font-family:Tahoma;">
<p>PENTING</p>
<p>Demi keamanan data Anda, Jangan pernah memberitahu username dan password akun e-Beasiswa Anda atau akun email Anda kepada orang lain. Jika Anda merasa akun Anda telah disalahgunakan oleh orang yang tidak bertanggung jawab, segera hubungi dan laporkan Administrator e-Beasiswa atau hubungi kantor Diskominfotik Kota Bontang atau juga dapat menguhubungi PPID Kota Bontang</p>
    
</div> <hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="http://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
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


    //Attachments
    //$mail->addAttachment('examples/images/phpmailer.png');         // Add attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verifikasi Akun e-Beasiswa Bontang';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
    //$mail->send();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if ($mail->send()) {
        $status = 'ok';
        return $status;
    } else {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
    }
    $mail->ClearAllRecipients(); 

} catch (Exception $e) {
        // $status = 'fail - '.$mail->ErrorInfo;
        // return $status;
    echo "{$mail->ErrorInfo}";
}

        
}




function resetPassword($nm, $eml, $uname, $pass){
    $penerima = $eml;
    $nama = $nm; 

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    /*//Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'schofi.ren@gmail.com';                 // SMTP username
    $mail->Password = 'schofi123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('schofi.ren@gmail.com', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('schofi.ren@gmail.com', 'Admin Beasiswa Bontang'); 
    */
//    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    //$mail->Mailer = "smtp";
//    $mail->isSMTP();                                      // Set mailer to use SMTP
//    $mail->Host = '10.0.0.3';  // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;                               // Enable SMTP authentication
//    $mail->Username = 'beasiswa@bontangkota.go.id';                 // SMTP username
//    $mail->Password = '123456BAE';                          // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 587;                                    // TCP port to connect to
$mail->SMTPDebug = 0;
 $mail->isSMTP();
 $mail->Host = '192.168.1.150';
 $mail->SMTPAuth = true;
 $mail->Port = 25;
 $mail->SMTPSecure = 'tls';     
 $mail->Username = 'beasiswa';
 $mail->Password = '123456BAE';
    //Recipients
    $mail->setFrom('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang'); 


$message = '<html>
<body style="background:#F0F0F0;">
<br>
<p style="font-size:13px;color:#F0F0F0;text-align:center;">&nbsp;</p>

<div>
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; color:#0D7898; height:10px; padding:0px 30px 0px 30px; text-align:center;">-------</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(http://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="http://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      
    </td>
  </tr>
</table>  <div style=" padding:30px 30px 30px 30px">
<p>Yth '.$nama.',<br />
<p>Kami telah memulihkan akun Anda dengan mengubah ulang Password Anda. Silakan gunakan username dan password sebagai berikut untuk masuk ke akun e-Beasiswa Anda.</p>
<p>Username : '.$uname.'</p>
<p>Password : '.$pass.'</p>
<p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p>
<hr>
<div style="color:#939393;text-align:justify; font-size:12px; font-family:Tahoma;">
<p>PENTING</p>
<p>Demi keamanan data Anda, Jangan pernah memberitahu username dan password akun e-Beasiswa Anda atau akun email Anda kepada orang lain. Jika Anda merasa akun Anda telah disalahgunakan oleh orang yang tidak bertanggung jawab, segera hubungi dan laporkan Administrator e-Beasiswa atau hubungi kantor Diskominfotik Kota Bontang atau juga dapat menguhubungi PPID Kota Bontang</p>
    
</div> <hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="http://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
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


    //Attachments
    //$mail->addAttachment('examples/images/phpmailer.png');         // Add attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pemulihan Akun e-Beasiswa Bontang';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
    //$mail->send();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if ($mail->send()) {
        $status = 'ok';
        return $status;
    } else {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
    }
    $mail->ClearAllRecipients(); 

} catch (Exception $e) {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
}

        
}

function kirimNotif($nm, $eml, $msg){
    $penerima = $eml;
    $nama = $nm;
    $pesan = $msg;
 

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    /*$mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'schofi.ren@gmail.com';                 // SMTP username
    $mail->Password = 'schofi123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('schofi.ren@gmail.com', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('schofi.ren@gmail.com', 'Admin Beasiswa Bontang'); 
    */
//    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
//    $mail->isSMTP();                                      // Set mailer to use SMTP
//    $mail->Host = '10.0.0.3';  // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;                               // Enable SMTP authentication
//    $mail->Username = 'beasiswa@bontangkota.go.id';                 // SMTP username
//    $mail->Password = '123456BAE';                           // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 587;                                    // TCP port to connect to
$mail->SMTPDebug = 0;
 $mail->isSMTP();
 $mail->Host = '192.168.1.150';
 $mail->SMTPAuth = true;
 $mail->Port = 25;
 $mail->SMTPSecure = 'tls';     
 $mail->Username = 'beasiswa';
 $mail->Password = '123456BAE';
    //Recipients
    $mail->setFrom('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang'); 


$message = '<html>
<body style="background:#F0F0F0;">
<br>
<p style="font-size:13px;color:#F0F0F0;text-align:center;">&nbsp;</p>

<div>
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; color:#0D7898; height:10px; padding:0px 30px 0px 30px; text-align:center;">&nbsp;</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(http://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="http://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      
    </td>
  </tr>
</table>
<div style=" padding:30px 30px 30px 30px">
<p>Hallo '.$nama.',<br />
  Verifikator telah memverifikasi data permohonan Anda, namun berkas yang Anda kirimkan terdapat kesalahan sebagai berikut : <br /></p>
    <br />
    <div style="color:#fff; background:#34495e; border-radius:5px; border:none; text-decoration:none; padding:8px 20px 8px 20px;"> '.$pesan.'</div>
    <br>
<p>Silakan login ke akun e-Beasiswa Anda dan mohon untuk segera Anda perbaiki/lengkapi berkas yang dimaksud tersebut. Terimakasih.</p>
<p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p>
<hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="http://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
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


    //Attachments
    //$mail->addAttachment('examples/images/phpmailer.png');         // Add attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verifikasi Berkas';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->send();
    $mail->ClearAllRecipients(); 

} catch (Exception $e) {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
}


        
}


function kirimNotif1($nm, $eml, $msg){
    $penerima = $eml;
    $nama = $nm;
    $pesan = $msg;



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    /*$mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'schofi.ren@gmail.com';                 // SMTP username
    $mail->Password = 'schofi123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('schofi.ren@gmail.com', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('schofi.ren@gmail.com', 'Admin Beasiswa Bontang'); 
    */
//    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
//    $mail->isSMTP();                                      // Set mailer to use SMTP
//    $mail->Host = '10.0.0.3';  // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;                               // Enable SMTP authentication
//    $mail->Username = 'beasiswa@bontangkota.go.id';                 // SMTP username
//    $mail->Password = '123456BAE';                           // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 587;                                    // TCP port to connect to
$mail->SMTPDebug = 0;
 $mail->isSMTP();
 $mail->Host = '192.168.1.150';
 $mail->SMTPAuth = true;
 $mail->Port = 25;
 $mail->SMTPSecure = 'tls';     
 $mail->Username = 'beasiswa';
 $mail->Password = '123456BAE';
    //Recipients
    $mail->setFrom('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang'); 


$message = '<html>
<body style="background:#F0F0F0;">
<br>
<p style="font-size:13px;color:#F0F0F0;text-align:center;">&nbsp;</p>

<div>
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; color:#0D7898; height:10px; padding:0px 30px 0px 30px; text-align:center;">&nbsp;</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(http://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="http://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      
    </td>
  </tr>
</table>
<div style=" padding:30px 30px 30px 30px">
<p>Hallo '.$nama.',<br />
  Berkas Anda telah diverifikasi dan dinyatakan <b>LENGKAP</b>. Mohon untuk mengirimkan <b>BERKAS ASLI</b> permohonan beasiswa Anda ke Bagian Sosial Ekonomi Sekretariat Daerah Lantai III Bontang Lestari. <br /></p>
<p>Terimakasih. Have a nice day ~</p>
<p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p>
<hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="http://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
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


    //Attachments
    //$mail->addAttachment('examples/images/phpmailer.png');         // Add attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verifikasi Berkas';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->send();
    $mail->ClearAllRecipients(); 

} catch (Exception $e) {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
}


        
}

function kirimNotif2($email, $nama_mahasiswa, $no_ktm, $perguruan_tinggi, $semester, $ipk, $periode, $kategori){


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    /*$mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'schofi.ren@gmail.com';                 // SMTP username
    $mail->Password = 'schofi123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('schofi.ren@gmail.com', 'Admin Beasiswa Bontang');
    $mail->addAddress($email);               // Name is optional
    $mail->addReplyTo('schofi.ren@gmail.com', 'Admin Beasiswa Bontang'); 
    */
//    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
//    $mail->isSMTP();                                      // Set mailer to use SMTP
//    $mail->Host = '10.0.0.3';  // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;                               // Enable SMTP authentication
//    $mail->Username = 'beasiswa@bontangkota.go.id';                 // SMTP username
//    $mail->Password = '123456BAE';                           // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 587;                                    // TCP port to connect to
$mail->SMTPDebug = 0;
 $mail->isSMTP();
 $mail->Host = '192.168.1.150';
 $mail->SMTPAuth = true;
 $mail->Port = 25;
 $mail->SMTPSecure = 'tls';     
 $mail->Username = 'beasiswa';
 $mail->Password = '123456BAE';
    //Recipients
    $mail->setFrom('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang');
    $mail->addAddress($penerima);               // Name is optional
    $mail->addReplyTo('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang'); 


$message = '<html>
<body style="background:#F0F0F0;">
<br>
<p style="font-size:13px;color:#F0F0F0;text-align:center;">&nbsp;</p>

<div>
<div style="margin-right:10%; margin-left:10%;padding-top:5%; padding-bottom:5%; background:#0D7898; color:#0D7898; height:10px; padding:0px 30px 0px 30px; text-align:center;">&nbsp;</div>
<div style="margin-right:10%; margin-left:10%; background:#fff;  border:1px solid #CCC;">
<table style="background:url(http://e-beasiswa.bontangkota.go.id/inc/assets/images/top3.png) no-repeat; background-position:-5px -40px;background-size:cover; height:100px; width:100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <img src="http://e-beasiswa.bontangkota.go.id/inc/images/10201709-logo1.png" style="width:280px; height:auto; margin-left:10px; margin-top:30px;">      

    </td>
  </tr>
</table>
<div style=" padding:30px 30px 30px 30px">
<p>Yth  '.$nama_mahasiswa.',<br />
  Berdasarkan hasil verifikasi dan penyeleksian berkas permohonan beasiswa Pemerintah Kota Bontang periode '.$periode.'<br />
Permohonan Beasiswa Anda dinyatakan diterima dan berhak untuk menerima dana pendidikan Pemerintah Kota Bontang periode '.$periode.'.</p>
<br>
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
    <td  style="border:0.1px solid #c6c6c6;height:30px;" >&nbsp;: Beasiswa '.$kategori.'</td>
  </tr>
</table>
</div>
<table style="width: 100%;">
    <tr>
        <td width="80%" style="vertical-align: top;"><br><p>Untuk informasi selanjutnya silakan login ke akun e-Beasiswa Anda atau silakan hubungi kontak kami. Terimakasih.</p> </td>
        <td width="20%"><img src="http://e-beasiswa.bontangkota.go.id/inc/assets/images/acc1.png" style="width:120px; height:auto;"></td>
    </tr>
    <tr>
        <td colspan="2" style="vertical-align: top;">
        <p>Hormat kami,<br />
Administrator e-Beasiswa Bontang</p></td>
    </tr>
</table>


<hr style=" border-top:dashed #00a2d1 2px; font-size:24px; "><br>
<center><img src="http://e-beasiswa.bontangkota.go.id/inc/assets/images/foot.jpg" style="width:60%; height:auto;margin-right:auto;margin-left:auto;"></center>
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


    //Attachments
    //$mail->addAttachment('examples/images/phpmailer.png');         // Add attachments
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pengumuman Penerima Beasiswa Pemkot';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        $status = 1;
        return $status;
    } else {
        $status = 0;
        return $status;
    }
    $mail->ClearAllRecipients(); 

} catch (Exception $e) {
        $status = 0;
        return $status;
}


        
}

function pesanUser($nm, $eml, $msg){
    $penerima = $eml;
    $nama = htmlspecialchars($nm);
    $pesan = htmlspecialchars($msg);



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    /*$mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'schofi.ren@gmail.com';                 // SMTP username
    $mail->Password = 'schofi123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('schofi.ren@gmail.com', 'Admin Beasiswa Bontang');
    $mail->addAddress('schofi.ren@gmail.com');               // Name is optional
    $mail->addReplyTo($penerima, $nm); 
    */
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = '192.168.1.150';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'beasiswa';                 // SMTP username
    $mail->Password = '123456BAE';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('beasiswa@bontangkota.go.id', 'Admin Beasiswa Bontang');
    $mail->addAddress('beasiswa@bontangkota.go.id');               // Name is optional
    $mail->addReplyTo($penerima, $nama); 


$message = '
<p>Pesan dari : '.$nama.',<br />
  '.$pesan.'</p>
';

    //Attachments
    //$mail->addAttachment('examples/images/phpmailer.png');         // Add attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pesan Pengunjung e-Beasiswa';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if ($mail->send()) {
        $status = 'ok';
        return $status;
    } else {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
    }
    $mail->ClearAllRecipients(); 

} catch (Exception $e) {
        $status = 'fail - '.$mail->ErrorInfo;
        return $status;
}

        
}

/*function cekBobotNilai($nilai1, $nilai2, $nilai3, $nilai4) {

    $max = count($dtRange);
    for ($x=0; $x < $max; $x++) { 

        if ($nilai1 >= $dtRange[$x]['awal'] && $nilai1 <= $dtRange[$x]['akhir']) { 
            $nb['b1'] = $dtRange[$x]['bobot'];
       }
        if ($nilai2 >= $dtRange[$x]['awal'] && $nilai2 <= $dtRange[$x]['akhir']) { 
            $nb['b2'] = $dtRange[$x]['bobot'];
       }
        if ($nilai3 >= $dtRange[$x]['awal'] && $nilai3 <= $dtRange[$x]['akhir']) { 
            $nb['b3'] = $dtRange[$x]['bobot'];
       }
        if ($nilai4 >= $dtRange[$x]['awal'] && $nilai4 <= $dtRange[$x]['akhir']) { 
            $nb['b4'] = $dtRange[$x]['bobot'];
       }
    }
    //$bobotNilai = $n1.'-'.$n2.'-'.$n3.'-'.$n4;
    return $nb;;
}*/

function kodeAktivasi(){
//membuat kode aktivasi
$karakter = '1234567890';  
$kode = '';  
  for($i = 0; $i < 6; $i++) {  
   $pos = rand(0, strlen($karakter)-1);  
   $kode .= $karakter[$pos];  
  }
 return $kode;
}

function genUname(){
$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  
$pass = '';  
  for($i = 0; $i < 3; $i++) {  
   $pos = rand(0, strlen($karakter)-1);  
   $pass .= $karakter[$pos];  
  }
 return $pass;
}

function genPassword(){
$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';  
$pass = '';  
  for($i = 0; $i < 8; $i++) {  
   $pos = rand(0, strlen($karakter)-1);  
   $pass .= $karakter[$pos];  
  }
 return $pass;
}

function antiInjection($data){
$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
return $filter_sql;
}


function tanggal($tgl){
$tanggal = substr($tgl,8,2);
$bulan   = getBulan(substr($tgl,5,2));
$tahun   = substr($tgl,0,4);
return $tanggal.' '.$bulan.' '.$tahun;
}


function tglWaktu($tglWaktu){
$pecah1=explode(" ", $tglWaktu);
$tgl = tanggal($pecah1[0]);
$waktu = $pecah1[1];
return $tgl.' '.$waktu;
}

function tglWaktu1($tglWaktu){
$pecah1=explode(" ", $tglWaktu);
$tgl = getBulan1($pecah1[1]); 
return $pecah1[2].'-'.$tgl.'-'.$pecah1[0];
}

function getBulan1($bln){
switch ($bln){
case 'Januari':
return 1;
break;
case 'Februari':
return 2;
break;
case 'Maret':
return 3;
break;
case 'April':
return 4;
break;
case 'Mei':
return 5;
break;
case 'Juni':
return 6;
break;
case 'Juli':
return 7;
break;
case 'Agustus':
return 8;
break;
case 'September':
return 9;
break;
case 'Oktober':
return 10;
break;
case 'November':
return 11;
break;
case 'Desember':
return 12;
break;
}
}


function getBulan($bln){
switch ($bln){
case 1:
return "Januari";
break;
case 2:
return "Februari";
break;
case 3:
return "Maret";
break;
case 4:
return "April";
break;
case 5:
return "Mei";
break;
case 6:
return "Juni";
break;
case 7:
return "Juli";
break;
case 8:
return "Agustus";
break;
case 9:
return "September";
break;
case 10:
return "Oktober";
break;
case 11:
return "November";
break;
case 12:
return "Desember";
break;
}
}


/*
class terbilangRupiah {

    function terbilang ($angka) {
        
        $angka = (float)$angka;
        $bilangan = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');

        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            return sprintf('Seratus %s', $this->terbilang($angka - 100));
        } else if ($angka < 1000) {
            $hasil_bagi = (int)($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            $hasil_bagi = (int)($angka / 1000); 
            $hasil_mod = $angka % 1000;
            return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } else if ($angka < 1000000000) {
            $hasil_bagi = (int)($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            $hasil_bagi = (int)($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) {
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }
}
*/
function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    $size = filesize($file);
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
    }



 function selisihWaktu($waktu){

$pecah1=explode(" ", $waktu);
$pecah2=explode("-", $pecah1[0]);
$pecah3=explode(":", $pecah1[1]);

$tglW=$pecah2[2];
$blnW=$pecah2[1];
$thnW=$pecah2[0];

$dtkW=$pecah3[2];
$mntW=$pecah3[1];
$jamW=$pecah3[0];

// mencari mktime untuk tanggal 1 Januari 2011 00:00:00 WIB
$selisih1 =  mktime($jamW, $mntW, $dtkW, $blnW, $tglW, $thnW);

// mencari mktime untuk current time
$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

// mencari selisih detik antara kedua waktu
$delta = $selisih2 - $selisih1;

// proses mencari jumlah hari
$a = floor($delta / 86400);

// proses mencari jumlah jam
$sisa = $delta % 86400;
$b  = floor($sisa / 3600);

// proses mencari jumlah menit
$sisa = $sisa % 3600;
$c = floor($sisa / 60);

// proses mencari jumlah detik
$sisa = $sisa % 60;
$d = floor($sisa / 1);

if ($a == 0 && $b == 0 && $c == 0) {
    return  $d.' detik yang lalu';
}
if ($a == 0 && $b == 0) {
    return  $c.' menit yang lalu';
}
if ($a == 0) {
    return  $b.' jam yang lalu';
}
if ($a == 1) {
    return $a="Kemarin";
}
if ($a > 0 && $a<=3) {
    return  $a.' hari yang lalu';
}
if ($a >= 0 && $a>3) {
    return  tanggal($waktu);
}
}

 function batasKumpul($waktu){

$pecah1=explode(" ", $waktu);
$pecah2=explode("-", $pecah1[0]);
$pecah3=explode(":", $pecah1[1]);

$tglW=$pecah2[2];
$blnW=$pecah2[1];
$thnW=$pecah2[0];

$dtkW=$pecah3[2];
$mntW=$pecah3[1];
$jamW=$pecah3[0];

// mencari mktime untuk tanggal 1 Januari 2011 00:00:00 WIB
$selisih1 =  mktime($jamW, $mntW, $dtkW, $blnW, $tglW, $thnW);

// mencari mktime untuk current time
$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

// mencari selisih detik antara kedua waktu
$delta = $selisih1 - $selisih2;

// proses mencari jumlah hari
$a = floor($delta / 86400);

// proses mencari jumlah jam
$sisa = $delta % 86400;
$b  = floor($sisa / 3600);

// proses mencari jumlah menit
$sisa = $sisa % 3600;
$c = floor($sisa / 60);

// proses mencari jumlah detik
$sisa = $sisa % 60;
$d = floor($sisa / 1);

    return  $a. ' hari '. $b. ' jam ' . $c. ' menit '. $d.' detik';
}


function batasiNotifPesan($a){
    if(strlen($a) <= 48){
        return $a;
    }else{
        return substr($a, 0, 48).'...';     
    }
}
function batasiBerita($a){
    if(strlen($a) <= 300){
        return $a;
    }else{
        return substr($a, 0, 300).'[...]';     
    }
}

function batasiNamaFile($a){
    if(strlen($a) > 30){
    $b = substr($a, 0, 30);
    $c = end(explode('.', $a));
    return $b.'...'.$c;
    }else{
    return $a;
    }
}

function konversiRomawi($integer)
{
 // konversi angka yang dikirim dari parameter ke integer (hanya untuk memastikan)
 $integer = intval($integer);
 $result = '';
 
 // Buat array pencarian yang berisi semua angka Romawi 
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Tentukan jumlah yang cocok
  $matches = intval($integer/$value);
 
  // Tambahkan jumlah karakter yang sama ke string
  $result .= str_repeat($roman,$matches);
 
  // set integer dengan menggunakan modulus
  $integer = $integer % $value;
 }
 
 // kembalikan hasil nilai romawi
 return $result;
}

function romawi2Integer($angka){
    $romans = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    );

    $roman = $angka;
    $result = 0;

    foreach ($romans as $key => $value) {
        while (strpos($roman, $key) === 0) {
            $result += $value;
            $roman = substr($roman, strlen($key));
        }
    }
    return $result;

}
 ?>