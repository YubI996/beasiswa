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
				$id_persyaratan = '';  
				$keterangan = $_POST['keterangan'];  
				$persyaratan = $_POST['persyaratan'];  
				$show = 0;  

					// Proses simpan ke Database
					$sql = $con->prepare("INSERT INTO persyaratan VALUES (:id_persyaratan, :keterangan, :persyaratan, :show)");
					$sql->bindParam(':id_persyaratan', $id_persyaratan);
					$sql->bindParam(':keterangan', $keterangan);
					$sql->bindParam(':persyaratan', $persyaratan);
					$sql->bindParam(':show', $show);
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
						'pesan'=>'Gambar gagal untuk diupload', 
					);
				}

				echo json_encode($response); // konversi variabel response menjadi JSON
	
			}

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$id_persyaratan = $_POST['id_persyaratan']; // Ambil data id_persyaratan dan masukkan ke variabel id_persyaratan
					$keterangan = $_POST['keterangan']; // Ambil data keterangan dan masukkan ke variabel keterangan
					$persyaratan = $_POST['persyaratan']; // Ambil data keterangan dan masukkan ke variabel keterangan

							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE persyaratan SET  keterangan=:keterangan, persyaratan=:persyaratan WHERE id_persyaratan=:id_persyaratan");
							$sql->bindParam(':id_persyaratan', $id_persyaratan);
							$sql->bindParam(':keterangan', $keterangan);
							$sql->bindParam(':persyaratan', $persyaratan);
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
			$id_persyaratan = $_POST['id_persyaratan'];

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM persyaratan WHERE id_persyaratan=:id_persyaratan");
			$sql->bindParam(':id_persyaratan', $id_persyaratan);
			$sql->execute(); // Eksekusi/Jalankan query
 

			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus',  
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}


if ($aksi == 'fdata') {
			$id_persyaratan = $_POST['id_persyaratan'];

			$sql = $con->prepare("SELECT * FROM persyaratan WHERE id_persyaratan=:id_persyaratan");
			$sql->bindParam(':id_persyaratan', $id_persyaratan);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_persyaratan'],  
				'keterangan'=>$d['keterangan'],  
				'persyaratan'=>$d['persyaratan'],  
				'show'=>$d['show'],
			);
			echo json_encode($response); 

	
}


if ($aksi == 'ushow') {
			$id_persyaratan = $_POST['id_persyaratan'];
			$show1 = 1;
			$show0 = 0;

			$sql = $con->prepare("UPDATE persyaratan SET tampil=:show0 WHERE id_persyaratan!=:id_persyaratan");
			$sql->bindParam(':id_persyaratan', $id_persyaratan);
			$sql->bindParam(':show0', $show0);
			$sql->execute(); // Eksekusi/Jalankan query

			$sql1 = $con->prepare("UPDATE persyaratan SET tampil=:show1 WHERE id_persyaratan=:id_persyaratan");
			$sql1->bindParam(':id_persyaratan', $id_persyaratan);
			$sql1->bindParam(':show1', $show1);
			$sql1->execute(); // Eksekusi/Jalankan query


	
}


?>