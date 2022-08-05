<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");


				$id_user = '';  
				$nama = $_POST['nama'];  
				$foto = 'default.png';  
				//$username = $_POST['username'];  
				//$password = $_POST['password'];  
				$email = $_POST['email'];  
				$level = 'Mahasiswa';  
				$since = tglWaktu(date("Y-m-d H:i:s")); 
				$lastlog = '';  
				$kode = kodeAktivasi();  
				$status = '0';  
				$online = '0';  

				$ktm = $_POST['ktm'];  
				$ktp = $_POST['ktp'];  

				$username = $ktm.''.genUname();
				$password = genPassword();
				$password1 = password_hash($password, PASSWORD_DEFAULT);  


//cek username
$cekA = $con->prepare("SELECT  username FROM user WHERE username='$username'");
$cekA->execute();
$cek1 = $cekA->rowCount();

$cekB = $con->prepare("SELECT email FROM user WHERE email='$email'");
$cekB->execute();
$cek2 = $cekB->rowCount();

$cekM = $con->prepare("SELECT no_ktm FROM mahasiswa WHERE no_ktm='$ktm'");
$cekM->execute();
$cek3 = $cekM->rowCount();

$cekP = $con->prepare("SELECT no_ktp FROM mahasiswa WHERE no_ktp='$ktp'");
$cekP->execute();
$cek4 = $cekP->rowCount();

if($cek1>0){
				$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Maaf Username `'.$username.'` sudah dipakai, silakan gunakan Username yang lain!',
						'tipe'=>'error',
						'waktu'=>'4000'
						);
				echo json_encode($response);  

	die();
}
else if($cek2>0){
				$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Maaf Anda telah mendaftarkan email ini Anda pada akun yang lain!',
						'tipe'=>'error',
						'waktu'=>'4000'
						);
				echo json_encode($response);  

	die();
}
else if($cek3>0){
				$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Maaf No. KTM yang Anda masukkan telah terdaftar, silakan gunakan akun yang telah terdaftar!',
						'tipe'=>'error',
						'waktu'=>'4000'
						);
				echo json_encode($response);  

	die();
}
else if($cek4>0){
				$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Maaf No. KTP yang Anda masukkan telah terdaftar, silakan gunakan akun yang telah terdaftar!',
						'tipe'=>'error',
						'waktu'=>'4000'
						);
				echo json_encode($response);  

	die();
}
else{

//simpan data
					$sql = $con->prepare("INSERT INTO user VALUES (:id_user, :nama, :foto, :username, :password, :email, :level, :since, :lastlog, :kode, :status, :online)");
					$sql->bindParam(':id_user', $id_user);
					$sql->bindParam(':nama', $nama);
					$sql->bindParam(':foto', $foto);
					$sql->bindParam(':username', $username);
					$sql->bindParam(':password', $password1);
					$sql->bindParam(':email', $email);
					$sql->bindParam(':level', $level);
					$sql->bindParam(':since', $since);
					$sql->bindParam(':lastlog', $lastlog);
					$sql->bindParam(':kode', $kode);
					$sql->bindParam(':status', $status);
					$sql->bindParam(':online', $online);
					$sql->execute(); // Eksekusi query insert

					$q = $con->prepare("SELECT * FROM user WHERE kode_aktivasi = '$kode'");
					$q->execute();
					$d = $q->fetch();

					$id_mahasiswa = '';
					$id_user = $d['id_user'];

					$sql = $con->prepare("INSERT INTO mahasiswa (id_mahasiswa, foto_mahasiswa, no_ktm, no_ktp, nama_mahasiswa, email, id_user) VALUES (:id_mahasiswa, :foto, :ktm, :ktp, :nama, :email, :id_user)");
					$sql->bindParam(':id_user', $id_user);
					$sql->bindParam(':foto', $foto);
					$sql->bindParam(':email', $email);
					$sql->bindParam(':nama', $nama);
					$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
					$sql->bindParam(':ktm', $ktm);
					$sql->bindParam(':ktp', $ktp);
					$sql->execute();

if ($sql) {
						//kirim email verifikasi akun
						$status = kirimKode($nama, $email, $kode, $id_user, $username, $password);
						
						if($status == 'ok'){
                        $response = array(
                        'status'=>'solol', // Set status
                        'title'=>'BERHASIL!', // Set pesan
                        'pesan'=>'Registrasi Berhasil! Silakan Buka Email Anda untuk mengaktivasi Akun Anda.!<br>Cek Pesan Spam jika tidak ada di kotak masuk Anda.',
                        'tipe'=>'success',
                        'waktu'=>'5000'
                        );
		                echo json_encode($response);  

			            }else{

		            	$sql = $con->prepare("DELETE FROM user WHERE id_user='$id_user'");
		            	$sql->execute();

		            	$sql1 = $con->prepare("DELETE FROM mahasiswa WHERE id_user='$id_user'");
		            	$sql1->execute();

                        $response = array(
                        'status'=>'gagal', // Set status
                        'title'=>'GAGAL!', // Set pesan
                        'pesan'=>'Gagal melakukan registrasi!  Error : '.$status,
                        'user'=>''.$idUser,
                        'tipe'=>'error',
                        'waktu'=>'4000'
                        );
		                echo json_encode($response);
		            }


}else{
	$teks = "".$con->errorInfo()."";
				$response = array(
						'status'=>'gagal', // Set status
						'title'=>'GAGAL!', // Set pesan
						'pesan'=>'Gagal melakukan registrasi! Error : '.$teks.'!',
						'tipe'=>'error',
						'waktu'=>'4000'
						);
				echo json_encode($response);  

}
}

?>