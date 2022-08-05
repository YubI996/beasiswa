<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];

if ($aksi == "del") {
			$id_kritik = $_POST['id_kritik'];

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM kritik WHERE id_kritik=:id_kritik");
			$sql->bindParam(':id_kritik', $id_kritik);
			$sql->execute(); // Eksekusi/Jalankan query
 
			$qs = $con->prepare("SELECT id_kritik FROM kritik");
			$qs->execute();
			$n2 = $qs->rowCount();

			setcookie('nkritik', $n2, strtotime('+1 months'), '/');

			
			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus',  
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}


if ($aksi == 'ushow') {
			$id_kritik = $_POST['id_kritik'];
			$tampil = $_POST['tampil'];

			$sql = $con->prepare("UPDATE kritik SET tampil=:tampil WHERE id_kritik=:id_kritik");
			$sql->bindParam(':id_kritik', $id_kritik);
			$sql->bindParam(':tampil', $tampil);
			$sql->execute(); // Eksekusi/Jalankan query

			if ($sql) {
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