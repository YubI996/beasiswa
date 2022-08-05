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
				$id_kuota = '';
				$kategori = $_POST['kategori'];
				$jenjang = $_POST['jenjang'];
				$daerah = $_POST['daerah'];
				$ipk_ipa = $_POST['ipk_ipa'];
				$ipk_ips = $_POST['ipk_ips'];
				$ipk_default = $_POST['ipk_default'];
				$kuota_ipa = $_POST['kuota_ipa'];
				$kuota_ips = $_POST['kuota_ips'];
				$kuota_default = $_POST['kuota_default']; 
				// Proses simpan ke Database
$sql = $con->prepare("INSERT INTO kuotaku VALUES(:id_kuota,:kategori,:jenjang,:daerah,
			:kuota_ipa,:kuota_ips,:kuota_default,:ipk_ipa,:ipk_ips,:ipk_default)");
				$sql->bindParam(':id_kuota', $id_kuota);
				$sql->bindParam(':kategori', $kategori);
				$sql->bindParam(':jenjang', $jenjang);
				$sql->bindParam(':daerah', $daerah);
				$sql->bindParam(':kuota_ipa', $kuota_ipa);
				$sql->bindParam(':kuota_ips', $kuota_ips);
				$sql->bindParam(':kuota_default', $kuota_default);
				$sql->bindParam(':ipk_ipa', $ipk_ipa);
				$sql->bindParam(':ipk_ips', $ipk_ips);
				$sql->bindParam(':ipk_default', $ipk_default);
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


			echo json_encode($response);
			 // konversi variabel response menjadi JSON
	
}

if ($aksi == "edt") {
			// Ambil data yang dikirim dari form
				$id_kuota = $_POST['id_kuota'];
				$kategori = $_POST['kategori'];
				$jenjang = $_POST['jenjang'];
				$daerah = $_POST['daerah'];
				$ipk_ipa = $_POST['ipk_ipa'];
				$ipk_ips = $_POST['ipk_ips'];
				$ipk_default = $_POST['ipk_default'];
				$kuota_ipa = $_POST['kuota_ipa'];
				$kuota_ips = $_POST['kuota_ips'];
				$kuota_default = $_POST['kuota_default']; 
					
					// Proses ubah ke Database
					$sql = $con->prepare("UPDATE kuotaku SET  kategori=:kategori, jenjang=:jenjang, daerah=:daerah, kuota_ipa=:kuota_ipa, kuota_ips=:kuota_ips, kuota_default=:kuota_default, ipk_ipa=:ipk_ipa, ipk_ips=:ipk_ips, ipk_default=:ipk_default WHERE id_kuota=:id_kuota");
					$sql->bindParam(':id_kuota', $id_kuota);
					$sql->bindParam(':kategori', $kategori);
					$sql->bindParam(':jenjang', $jenjang);
					$sql->bindParam(':daerah', $daerah);
					$sql->bindParam(':kuota_ipa', $kuota_ipa);
					$sql->bindParam(':kuota_ips', $kuota_ips);
					$sql->bindParam(':kuota_default', $kuota_default);
					$sql->bindParam(':ipk_ipa', $ipk_ipa);
					$sql->bindParam(':ipk_ips', $ipk_ips);
					$sql->bindParam(':ipk_default', $ipk_default);
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
			$id_kuota = $_POST['id_kuota'];

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM kuotaku WHERE id_kuota=:id_kuota");
			$sql->bindParam(':id_kuota', $id_kuota);
			$sql->execute(); // Eksekusi/Jalankan query

 
			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus', 
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}


if ($aksi == 'fdata') {
			$id_kuota = $_POST['id_kuota'];

			$sql = $con->prepare("SELECT * FROM kuotaku WHERE id_kuota=:id_kuota");
			$sql->bindParam(':id_kuota', $id_kuota);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_kuota'],  
				'kategori'=>$d['kategori'],    
				'jenjang'=>$d['jenjang'],    
				'daerah'=>$d['daerah'],    
				'kuota_ipa'=>$d['kuota_ipa'],    
				'kuota_ips'=>$d['kuota_ips'],    
				'kuota_default'=>$d['kuota_default'],    
				'ipk_ipa'=>$d['ipk_ipa'],    
				'ipk_ips'=>$d['ipk_ips'],   
				'ipk_default'=>$d['ipk_default'],   
			);
			echo json_encode($response); 	
}

?>