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
				$id_periode = ''; // Ambil data periode dan masukkan ke variabel periode
				$periode = $_POST['periode']; // Ambil data periode dan masukkan ke variabel periode
				$penetapan = 0; // Ambil data periode dan masukkan ke variabel periode
				// Proses simpan ke Database
				$sql = $con->prepare("INSERT INTO periode VALUES(:id_periode,:periode,:penetapan)");
				$sql->bindParam(':id_periode', $id_periode);
				$sql->bindParam(':periode', $periode);
				$sql->bindParam(':penetapan', $penetapan);
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

if ($aksi == "edt") {
			// Ambil data yang dikirim dari form
				$id_periode = $_POST['id_periode']; // Ambil data periode dan masukkan ke variabel periode
				$periode = $_POST['periode']; // Ambil data periode dan masukkan ke variabel periode
					
					// Proses ubah ke Database
					$sql = $con->prepare("UPDATE periode SET  periode=:periode WHERE id_periode=:id_periode");
					$sql->bindParam(':periode', $periode);
					$sql->bindParam(':id_periode', $id_periode);
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
			$id_periode = $_POST['id_periode'];

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM periode WHERE id_periode=:id_periode");
			$sql->bindParam(':id_periode', $id_periode);
			$sql->execute(); // Eksekusi/Jalankan query

 
			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus', 
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}


if ($aksi == 'fdata') {
			$id_periode = $_POST['id_periode'];

			$sql = $con->prepare("SELECT * FROM periode WHERE id_periode=:id_periode");
			$sql->bindParam(':id_periode', $id_periode);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_periode'],  
				'periode'=>$d['periode'],    
			);
			echo json_encode($response); 	
}

?>