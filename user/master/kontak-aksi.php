<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];

$sql1 = $con->prepare("SELECT * FROM kontak");
$sql1->execute();
$d = $sql1->fetch();

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					if ($_POST['email'] != "") {
						$email = $_POST['email']; 
					}else{
						$email = $d['email']; 						
					} 
					if ($_POST['telp'] != "") {
						$telp = $_POST['telp']; 
					}else{
						$telp = $d['no_telp']; 						
					} 
					if ($_POST['fax'] != "") {
						$fax = $_POST['fax']; 
					}else{
						$fax = $d['fax']; 						
					} 
					if ($_POST['alamat'] != "") {
						$alamat = $_POST['alamat']; 
					}else{
						$alamat = $d['alamat']; 						
					} 

							$sql = $con->prepare("UPDATE kontak SET email=:email, no_telp=:telp, alamat=:alamat, fax=:fax");
							$sql->bindParam(':fax', $fax);
							$sql->bindParam(':telp', $telp);
							$sql->bindParam(':alamat', $alamat);
							$sql->bindParam(':email', $email);
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


?>