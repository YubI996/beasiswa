<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];

$sql1 = $con->prepare("SELECT * FROM user WHERE id_user='$_SESSION[id]'");
$sql1->execute();
$d = $sql1->fetch();

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$id_user = $_SESSION['id'];
					if ($_POST['nama'] != "") {
						$nama = $_POST['nama']; 
					}else{
						$nama = $d['nama_user']; 						
					} 
					if ($_POST['email'] != "") {
						$email = $_POST['email']; 
					}else{
						$email = $d['email']; 						
					} 
					if ($_POST['username'] != "") {
						$username = $_POST['username']; 
					}else{
						$username = $d['username']; 						
					} 

					$level = $_POST['level']; 
					$password = $_POST['password']; 
					$password1 = password_hash($password, PASSWORD_DEFAULT);
					$fl = $_POST['fl'];

					$foto = $_FILES['foto']['name'];
					$tmp = $_FILES['foto']['tmp_name'];

					$fotoBaru = date("dsY").'-'.$foto;
					$path = "../master/foto_user/".$fotoBaru;

					if ($foto > 0 || $foto != "") {
							if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses
								if ($d['foto_user'] != "default.png") {
									if(is_file("../master/foto_user/".$d['foto_user'])) // Jika foto ada
									unlink("../master/foto_user/".$d['foto_user']); // Hapus file foto sebelumnya yang ada di folder foto
								}
							}

							if ($level == 'Mahasiswa') {
								$qM = $con->prepare("UPDATE mahasiswa SET foto_mahasiswa=:foto, email=:email WHERE id_user=:id_user");
								$qM->bindParam(':id_user', $id_user);
								$qM->bindParam(':foto', $fotoBaru);
								$qM->bindParam(':email', $email);
								$qM->execute();
							}

						if ($password != '') {
							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE user SET nama_user=:nama, foto_user=:foto, username=:username, password=:password1, email=:email  WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':foto', $fotoBaru);
							$sql->bindParam(':password1', $password1);
							$sql->bindParam(':email', $email);
							$sql->execute(); // Eksekusi query insert
 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', // Set pesan 
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON

						}else{
							$sql = $con->prepare("UPDATE user SET nama_user=:nama, foto_user=:foto, username=:username, email=:email  WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':foto', $fotoBaru);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':email', $email);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', // Set pesan 
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON
						}
					}else{
							if ($level == 'Mahasiswa') {
								$qM = $con->prepare("UPDATE mahasiswa SET email=:email WHERE id_user=:id_user");
								$qM->bindParam(':id_user', $id_user);
								$qM->bindParam(':email', $email);
								$qM->execute();
							}

						$password1 = password_hash($password, PASSWORD_DEFAULT);
						if ($password != '' || $password > 0) {
							$sql = $con->prepare("UPDATE user SET nama_user=:nama,  username=:username, password=:password1, email=:email WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':password1', $password1);
							$sql->bindParam(':email', $email);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', // Set pesan 
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON
						}else{
							$sql = $con->prepare("UPDATE user SET nama_user=:nama, username=:username, email=:email  WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':email', $email);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', // Set pesan 
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON
						}						
					}

					

		
}


?>