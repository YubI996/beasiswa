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
				$id_file = ''; // Ambil data id_file dan masukkan ke variabel id_file
				$keterangan = $_POST['keterangan']; // Ambil data keterangan dan masukkan ke variabel keterangan
				$waktu_upload = tglWaktu(date("Y-m-d H:i:s")); // Ambil data waktu_upload dan masukkan ke variabel waktu_upload
				$author = $_SESSION['id']; // Ambil data author dan masukkan ke variabel author
				$unduhan = $_FILES['unduhan']['name'];
				$tmp = $_FILES['unduhan']['tmp_name'];

				$fileBaru = date("dHms").'-'.$unduhan;
				$path = "file_unduhan/".$fileBaru;

				if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses
						// Proses simpan ke Database
						$sql = $con->prepare("INSERT INTO download VALUES(:id_file, :unduhan, :keterangan, :waktu_upload, :author)");
						$sql->bindParam(':id_file', $id_file);
						$sql->bindParam(':unduhan', $fileBaru);
						$sql->bindParam(':keterangan', $keterangan);
						$sql->bindParam(':waktu_upload', $waktu_upload);
						$sql->bindParam(':author', $author);
						$sql->execute(); // Eksekusi query insert
 
						
					if($sql){ // Jika proses upload sukses
						// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
						$response = array(
							'status'=>'sukses', // Set status
							'pesan'=>'Data berhasil disimpan',  
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

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$id_file = $_POST['id_unduhan']; // Ambil data id_file dan masukkan ke variabel id_file
					$keterangan = $_POST['keterangan']; // Ambil data keterangan dan masukkan ke variabel keterangan
					$ubah = $_POST['ubah']; // Ambil data ubah dan masukkan ke variabel ubah
					$waktu_upload = tglWaktu(date("Y-m-d H:i:s")); // Ambil data waktu_upload dan masukkan ke variabel waktu_upload
					$author = $_SESSION['id']; //$_SESSION['id_user']; // Ambil data author dan masukkan ke variabel author
					$fl = $_POST['fl'];
					$unduhan = $_FILES['unduhan']['name'];
					$tmp = $_FILES['unduhan']['tmp_name'];

					$fileBaru = date("dHms").'-'.$unduhan;
					$path = "file_unduhan/".$fileBaru;

					if ($ubah == '1') {
							if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses

							if(is_file("file_unduhan/".$fl)) // Jika foto ada
							unlink("file_unduhan/".$fl); // Hapus file foto sebelumnya yang ada di folder foto

							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE download SET  nama_file=:unduhan, keterangan_file=:keterangan, waktu_upload=:waktu_upload,  author=:author WHERE id_file=:id_file");
							$sql->bindParam(':id_file', $id_file);
							$sql->bindParam(':unduhan', $fileBaru);
							$sql->bindParam(':keterangan', $keterangan);
							$sql->bindParam(':waktu_upload', $waktu_upload);
							$sql->bindParam(':author', $author);
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
							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE download SET  keterangan_file=:keterangan, waktu_upload=:waktu_upload,  author=:author WHERE id_file=:id_file");
							$sql->bindParam(':id_file', $id_file);
							$sql->bindParam(':keterangan', $keterangan);
							$sql->bindParam(':waktu_upload', $waktu_upload);
							$sql->bindParam(':author', $author);
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

if ($aksi == "del") {
			$id_file = $_POST['id_unduhan'];
			$fl = $_POST['fl'];

			if(is_file("file_unduhan/".$fl)) // Jika foto ada
			unlink("file_unduhan/".$fl); // Hapus file foto sebelumnya yang ada di folder foto

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM download WHERE id_file=:id_file");
			$sql->bindParam(':id_file', $id_file);
			$sql->execute(); // Eksekusi/Jalankan query
 

			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus',  
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}

if ($aksi == 'fdata') {
			$id_file = $_POST['id_file'];

			$sql = $con->prepare("SELECT * FROM download WHERE id_file=:id_file");
			$sql->bindParam(':id_file', $id_file);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_file'],  
				'nama'=>"'".$d['nama_file']."'",  
				'keterangan'=>$d['keterangan_file'],  
				'author'=>$d['author'],  
				'waktu'=>$d['waktu_upload'],  
			);
			echo json_encode($response); 
	
}

?>