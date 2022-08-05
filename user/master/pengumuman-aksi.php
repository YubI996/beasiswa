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
				$id_pengumuman = ''; 
				$judul = $_POST['judul']; 
				$waktu_upload = date("Y-m-d H:i:s"); 
				$isi = $_POST['isi']; 
				$tampil = '0'; 
				$author = $_SESSION['id']; 

					// Proses simpan ke Database
					$sql = $con->prepare("INSERT INTO pengumuman VALUES (:id_pengumuman, :judul, :waktu_upload, :isi, :author, :tampil)");
					$sql->bindParam(':id_pengumuman', $id_pengumuman);
					$sql->bindParam(':judul', $judul);
					$sql->bindParam(':waktu_upload', $waktu_upload);
					$sql->bindParam(':isi', $isi);
					$sql->bindParam(':author', $author);
					$sql->bindParam(':tampil', $tampil);
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

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$id_pengumuman = $_POST['id_pengumuman']; 
					$judul = $_POST['judul']; 
					$waktu_upload = date("Y-m-d H:i:s"); 
					$isi = $_POST['isi']; 
					$author = $_SESSION['id']; 

							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE pengumuman SET  judul_pengumuman=:judul, waktu_pengumuman=:waktu_upload, isi_pengumuman=:isi, author=:author WHERE id_pengumuman=:id_pengumuman");
							$sql->bindParam(':id_pengumuman', $id_pengumuman);
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

if ($aksi == "del") {
			$id_pengumuman = $_POST['id_pengumuman'];

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM pengumuman WHERE id_pengumuman=:id_pengumuman");
			$sql->bindParam(':id_pengumuman', $id_pengumuman);
			$sql->execute(); // Eksekusi/Jalankan query
 

			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus',  
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}

if ($aksi == 'fdata') {
			$id_pengumuman = $_POST['id_pengumuman'];

			$sql = $con->prepare("SELECT * FROM pengumuman WHERE id_pengumuman=:id_pengumuman");
			$sql->bindParam(':id_pengumuman', $id_pengumuman);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_pengumuman'],  
				'judul'=>$d['judul_pengumuman'],  
				'isi'=>$d['isi_pengumuman'],  
				'author'=>$d['author'],  
				'waktu'=>$d['waktu_pengumuman'],  
			);
			echo json_encode($response); 

}

if ($aksi == 'ushow') {
			$id_pengumuman = $_POST['id_pengumuman'];
			$show1 = 1;
			$show0 = 0;

			$sql = $con->prepare("UPDATE pengumuman SET tampil=:show0 WHERE id_pengumuman!=:id_pengumuman");
			$sql->bindParam(':id_pengumuman', $id_pengumuman);
			$sql->bindParam(':show0', $show0);
			$sql->execute(); // Eksekusi/Jalankan query

			$sql1 = $con->prepare("UPDATE pengumuman SET tampil=:show1 WHERE id_pengumuman=:id_pengumuman");
			$sql1->bindParam(':id_pengumuman', $id_pengumuman);
			$sql1->bindParam(':show1', $show1);
			$sql1->execute(); // Eksekusi/Jalankan query

			if ($sql && $sql1) {
				$response = array(
					'status'=>'ok',  
				);
			}else{
				$response = array(
					'status'=>'fail',  
				);
			}
			echo json_encode($response); 

	
}


?>