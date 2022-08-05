<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");
$aksi = $_POST['aksi'];

			if ($aksi == "add") {
			// Ambil data yang dikirim dari form
				$id_user = '';  
				$nama = $_POST['nama'];  
				$foto = 'default.png';  
				$username = $_POST['username'];  
				$password = $_POST['password'];  
				$password1 = password_hash($_POST['password'], PASSWORD_DEFAULT);  
				$email = $_POST['email'];  
				$level = $_POST['level'];  
				$since = tglWaktu(date("Y-m-d H:i:s")); 
				$lastlog = '';  
				$kode = kodeAktivasi();  
				$status = '0';  
				$online = '0';  

				$ktm = $_POST['ktm'];  
				$ktp = $_POST['ktp'];  

			if($level == "Mahasiswa"){ // Jika levelnya mahasiswa
					// Proses simpan ke Database
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

					if($sql){ // Jika proses upload sukses

						//kirim email verifikasi akun
						kirimKode($username, $password, $email, $kode, $id_user);

 

						// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
						$response = array(
							'status'=>'sukses', // Set status
							'pesan'=>'Data berhasil disimpan', 
						);
					}else{ // Jika proses upload gagal
						$response = array(
							'status'=>'gagal', // Set status
							'pesan'=>'Gambar gagal untuk diupload',  
						);
					}
					

					echo json_encode($response); // konversi variabel response menjadi JSON


			}else{ //jika level selain mahasiswa
					// Proses simpan ke Database
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

					if($sql){ // Jika proses upload sukses

						//kirim email verifikasi akun
						kirimKode($username, $password, $email, $kode, $id_user);

 
						// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
						$response = array(
							'status'=>'sukses', // Set status
							'pesan'=>'Data berhasil disimpan', 
						);
					}else{ // Jika proses upload gagal
						$response = array(
							'status'=>'gagal', // Set status
							'pesan'=>'Gambar gagal untuk diupload',  
						);
					}


					echo json_encode($response); // konversi variabel response menjadi JSON

			}		
	
						
			}

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$id_user = $_POST['id_user'];  
					$nama = $_POST['nama'];  
					$email = $_POST['email'];  
					$username = $_POST['username'];  
					$password = $_POST['password'];  
					$password1 = password_hash($password, PASSWORD_DEFAULT);
					$level = $_POST['level'];  
					$status = $_POST['aktivasi'];  
					$fl = $_POST['fl'];

					$foto = $_FILES['foto']['name'];
					$tmp = $_FILES['foto']['tmp_name'];

					$fotoBaru = date("dsY").'-'.$foto;
					$path = "foto_user/".$fotoBaru;

					if ($foto > 0 || $foto != "") {
							if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses
								if ($fl != "default.png") {
									if(is_file("foto_user/".$fl)) // Jika foto ada
									unlink("foto_user/".$fl); // Hapus file foto sebelumnya yang ada di folder foto
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
							$sql = $con->prepare("UPDATE user SET nama_user=:nama, foto_user=:foto, username=:username, password=:password1, email=:email, level=:level, status_aktivasi=:status WHERE id_user=:id_user");
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':foto', $fotoBaru);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':password1', $password1);
							$sql->bindParam(':email', $email);
							$sql->bindParam(':level', $level);
							$sql->bindParam(':status', $status);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah',  
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON

						}else{
							$sql = $con->prepare("UPDATE user SET nama_user=:nama, foto_user=:foto, username=:username, email=:email, level=:level, status_aktivasi=:status WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':foto', $fotoBaru);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':email', $email);
							$sql->bindParam(':level', $level);
							$sql->bindParam(':status', $status);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', 
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
							$sql = $con->prepare("UPDATE user SET nama_user=:nama,  username=:username, password=:password1, email=:email, level=:level, status_aktivasi=:status WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':password1', $password1);
							$sql->bindParam(':email', $email);
							$sql->bindParam(':level', $level);
							$sql->bindParam(':status', $status);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah',  
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON
						}else{
							$sql = $con->prepare("UPDATE user SET nama_user=:nama, username=:username, email=:email, level=:level, status_aktivasi=:status WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':username', $username);
							$sql->bindParam(':email', $email);
							$sql->bindParam(':level', $level);
							$sql->bindParam(':status', $status);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah',  
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

if ($aksi == "del") {
			$id_user = $_POST['id_user'];
			$fl = $_POST['fl'];

			if ($fl != "default.png") {
				if(is_file("foto_user/".$fl)) // Jika foto ada
				unlink("foto_user/".$fl); // Hapus file foto sebelumnya yang ada di folder foto
			}

			$q = $con->prepare("SELECT level FROM  user WHERE id_user='$id_user'");
			$q->execute();
			$dq = $q->fetch();
			if ($dq['level'] == 'Mahasiswa') {
				// Query untuk menghapus data periode berdasarkan periode yang dikirim
				$sql = $con->prepare("DELETE FROM mahasiswa WHERE id_user=:id_user");
				$sql->bindParam(':id_user', $id_user);
				$sql->execute(); // Eksekusi/Jalankan query
 
				// Query untuk menghapus data periode berdasarkan periode yang dikirim
				$sql = $con->prepare("DELETE FROM user WHERE id_user=:id_user");
				$sql->bindParam(':id_user', $id_user);
				$sql->execute(); // Eksekusi/Jalankan query
 
			}else{
				// Query untuk menghapus data periode berdasarkan periode yang dikirim
				$sql = $con->prepare("DELETE FROM user WHERE id_user=:id_user");
				$sql->bindParam(':id_user', $id_user);
				$sql->execute(); // Eksekusi/Jalankan query
			}

			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus', 
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}

if ($aksi == 'fdata') {
			$id_user = $_POST['id_user'];

			$sql = $con->prepare("SELECT * FROM user WHERE id_user=:id_user");
			$sql->bindParam(':id_user', $id_user);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_user'],  
				'nama'=>$d['nama_user'],  
				'foto'=>$d['foto_user'],  
				'email'=>$d['email'],  
				'username'=>$d['username'],  
				'level'=>$d['level'],  
				'since'=>$d['since'],  
				'lastlog'=>$d['last_login'],  
				'kodeA'=>$d['kode_aktivasi'],  
				'statusA'=>$d['status_aktivasi'],  
			);
			echo json_encode($response); 
}

?>