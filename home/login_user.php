<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");


if (isset($_POST['aksi'])) {
	


	$email = trim(strtolower($_POST['email']));
	$sql = $con->prepare("SELECT id_user, username, nama_user FROM user WHERE email='$email' AND level='Mahasiswa' LIMIT 1");
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$d = $sql->fetch();

		$password = genPassword();
		$password1 = password_hash($password, PASSWORD_DEFAULT);  
		$id_user = $d['id_user'];

		$sql1 = $con->prepare("UPDATE user SET password='$password1' WHERE id_user='$id_user'");
		$sql1->execute();

		if ($sql1) {
			$status = resetPassword($d['nama_user'], $email, $d['username'], $password);

			if ($status == 'ok') {
                        $response = array(
                        'status'=>'solol', // Set status
                        'title'=>'BERHASIL!', // Set pesan
                        'pesan'=>'Pemulihan Akun Berhasil! Silakan buka email Anda untuk mengetahui password pemulihan Anda yang baru. (Note : Cek Folder SPAM jika di Folder Utama tidak ada).',
                        'tipe'=>'success',
                        'waktu'=>'5000'
                        );
		                echo json_encode($response);  
			}else{
                        $response = array(
                        'status'=>'fail', // Set status
                        'title'=>'ERROR!', // Set pesan
                        'pesan'=>'Gagal mengirim email pemulihan akun. Error : '.$status,
                        'tipe'=>'error',
                        'waktu'=>'5000'
                        );
		                echo json_encode($response);  
			}

		}else{
				$teks = "".$con->errorInfo()."";
                        $response = array(
                        'status'=>'fail', // Set status
                        'title'=>'ERROR!', // Set pesan
                        'pesan'=>'Gagal melakukan pemulihan akun. Error : '.$teks,
                        'tipe'=>'error',
                        'waktu'=>'5000'
                        );
		                echo json_encode($response);  
		}
	}else{
                        $response = array(
                        'status'=>'fail', // Set status
                        'title'=>'Ups!', // Set pesan
                        'pesan'=>'Email '.$email.' tidak terdaftar di sistem kami, silakan gunakan email yang Anda gunakan pada saat registrasi akun.',
                        'tipe'=>'warning',
                        'waktu'=>'5000'
                        );
		                echo json_encode($response);  
	}


	
}else{



$j = gmdate("H:i:s", time()+60*60*8);
$last = date("d M Y "). $j;

$username1 = $_POST['username'];
$password1 = $_POST['password'];


//$username2 = antiInjection($username1);
//$password2 = antiInjection($password1);
//$password = password_verify();
$sql = $con->prepare("SELECT * FROM user WHERE username = '$username1'");
$sql->execute();
$jumlah = $sql->rowCount();
if ($jumlah>0){


$data = $sql->fetch(); 

$hash = $data['password'];
if (password_verify($password1, $hash)) {
$totkode = strlen($data['kode_aktivasi']);
//cek aktivasi akun	
if ($data['status_aktivasi'] == "0" && $totkode == 6) {
					$response = array(
						'status'=>'gagal', // Set status
						'title'=>'NOT-ACTIVATED!', // Set pesan
						'pesan'=>'Akun Anda belum diaktivasi, silakan buka email Anda dan aktivasi akun Anda!',
						'tipe'=>'error',
						'waktu'=>'4000'
					);
				echo json_encode($response);  
	die();
}else if($data['status_aktivasi'] == "0" && $totkode > 6){
					$response = array(
						'status'=>'gagal', // Set status
						'title'=>'BLOCKED!', // Set pesan
						'pesan'=>'Akun Anda telah di non-aktifkan oleh Administrator e-Beasiswa, Silakan hubungi Administrator e-Beasiswa untuk mengaktivasi kembali!',
						'tipe'=>'error',
						'waktu'=>'4000'
					);
				echo json_encode($response);  
	die();
}

//aktivkan status online
$aOL=$con->prepare("UPDATE user SET online='1' WHERE id_user='$data[id_user]'");
$aOL->execute();

$level = $data['level'];

switch ($level){
case "Admin" :
{

$_SESSION['id'] = $data['id_user'];
$_SESSION['level']="Admin";
$_SESSION['nama'] = $data['nama_user'];
$_SESSION['ll'] = $data['last_login'];

$_SESSION['login'] = "Login";
$_SESSION['last'] = $last;


					$response = array(
						'status'=>'solol', // Set status
						'hal'=>'../user/', // Set status
					);
					echo json_encode($response);  

break;
}
case "Verifikator" :
{
$_SESSION['id'] = $data['id_user'];
$_SESSION['level']="Verifikator";
$_SESSION['nama'] = $data['nama_user'];
$_SESSION['ll'] = $data['last_login'];

$_SESSION['login'] = "Login";
$_SESSION['last'] = $last;

					$response = array(
						'status'=>'solol', // Set status
						'hal'=>'../verifikator/', // Set status
					);
					echo json_encode($response);  
break;
}
case "Mahasiswa" :
{
$_SESSION['id'] = $data['id_user'];
$_SESSION['level']="Mahasiswa";
$_SESSION['nama'] = $data['nama_user'];
$_SESSION['ll'] = $data['last_login'];

$_SESSION['login'] = "Login";
$_SESSION['last'] = $last;


					$response = array(
						'status'=>'solol', // Set status
						'hal'=>'../mahasiswa/', // Set status
					);
					echo json_encode($response);  
break;
}
}


} else {
					$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Maaf Password Anda salah, silakan ulangi dengan benar!',
						'tipe'=>'error',
						'waktu'=>'4000'
					);
				echo json_encode($response);  
}

}
else {
					$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Maaf Username atau Password Anda salah, silakan ulangi dengan benar!',
						'tipe'=>'error',
						'waktu'=>'4000'
					);
				echo json_encode($response);  
}

}


	?>

