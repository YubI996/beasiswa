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
				$id_berita = ''; // Ambil data id_berita dan masukkan ke variabel id_berita
				$judul = $_POST['judul']; // Ambil data judul dan masukkan ke variabel judul
				$waktu_upload = date("Y-m-d H:i:s"); // Ambil data waktu_upload dan masukkan ke variabel waktu_upload
				$isi = $_POST['isi']; // Ambil data judul dan masukkan ke variabel judul
				$author = $_SESSION['id']; //$_SESSION['id_user']; // Ambil data author dan masukkan ke variabel author
				$foto = $_FILES['foto']['name'];
				$tmp = $_FILES['foto']['tmp_name'];

				$fotoBaru = date("dsY").'-'.$foto;
				$path = "file_berita/".$fotoBaru;
				$suka = 0;
				$baca = 0;

			if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses
					// Proses simpan ke Database
					$sql = $con->prepare("INSERT INTO berita VALUES (:id_berita, :judul, :waktu_upload, :isi, :foto, :author, :suka, :baca)");
					$sql->bindParam(':id_berita', $id_berita);
					$sql->bindParam(':judul', $judul);
					$sql->bindParam(':waktu_upload', $waktu_upload);
					$sql->bindParam(':isi', $isi);
					$sql->bindParam(':foto', $fotoBaru);
					$sql->bindParam(':author', $author);
					$sql->bindParam(':suka', $suka);
					$sql->bindParam(':baca', $baca);
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
						'html'=>$html // Set html
					);
				}

				echo json_encode($response); // konversi variabel response menjadi JSON
	
			}			
			}

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$id_berita = $_POST['id_berita']; // Ambil data id_berita dan masukkan ke variabel id_berita
					$fl = $_POST['fl'];
					$ubah = $_POST['ubah']; // Ambil data ubah dan masukkan ke variabel ubah
					$judul = $_POST['judul']; // Ambil data judul dan masukkan ke variabel judul
					$waktu_upload = date("Y-m-d H:i:s"); // Ambil data waktu_upload dan masukkan ke variabel waktu_upload
					$isi = $_POST['isi']; // Ambil data judul dan masukkan ke variabel judul
					$author = $_SESSION['id']; //$_SESSION['id_user']; // Ambil data author dan masukkan ke variabel author
					$foto = $_FILES['foto']['name'];
					$tmp = $_FILES['foto']['tmp_name'];

					$fotoBaru = date("dsY").'-'.$foto;
					$path = "file_berita/".$fotoBaru;

					if ($ubah == '1') {
							if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses

							if(is_file("file_berita/".$fl)) // Jika foto ada
							unlink("file_berita/".$fl); // Hapus file foto sebelumnya yang ada di folder foto

							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE berita SET  judul=:judul, waktu_upload=:waktu_upload, isi_berita=:isi, foto=:foto,  author=:author WHERE id_berita=:id_berita");
							$sql->bindParam(':id_berita', $id_berita);
							$sql->bindParam(':judul', $judul);
							$sql->bindParam(':waktu_upload', $waktu_upload);
							$sql->bindParam(':isi', $isi);
							$sql->bindParam(':foto', $fotoBaru);
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
							$sql = $con->prepare("UPDATE berita SET  judul=:judul, waktu_upload=:waktu_upload, isi_berita=:isi, author=:author WHERE id_berita=:id_berita");
							$sql->bindParam(':id_berita', $id_berita);
							$sql->bindParam(':judul', $judul);
							$sql->bindParam(':waktu_upload', $waktu_upload);
							$sql->bindParam(':isi', $isi);
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
			$id_berita = $_POST['id_berita'];
			$fl = $_POST['fl'];

			if(is_file("file_berita/".$fl)) // Jika foto ada
			unlink("file_berita/".$fl); // Hapus file foto sebelumnya yang ada di folder foto

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM berita WHERE id_berita=:id_berita");
			$sql->bindParam(':id_berita', $id_berita);
			$sql->execute(); // Eksekusi/Jalankan query

 

			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus',  
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}

if ($aksi == 'fdata') {
			$id_berita = $_POST['id_berita'];

			$sql = $con->prepare("SELECT * FROM berita WHERE id_berita=:id_berita");
			$sql->bindParam(':id_berita', $id_berita);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_berita'],  
				'judul'=>$d['judul'],  
				'isi'=>$d['isi_berita'],  
				'author'=>$d['author'],  
				'foto'=>$d['foto'],  
				'waktu'=>$d['waktu_upload'],  
			);
			echo json_encode($response); 

	
}
?>