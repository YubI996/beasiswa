<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];

$sql1 = $con->prepare("SELECT * FROM tentang");
$sql1->execute();
$d = $sql1->fetch();

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					if (!empty($_FILES["video"]["tmp_name"])) {
						$video =  date("dsY").'-'.$_FILES['video']['name']; 
					}else{
						$video = $d['video']; 						
					} 
					if ($_POST['kv'] != "") {
						$kv = $_POST['kv']; 
					}else{
						$kv = $d['ket_video']; 						
					} 
					if ($_POST['quote'] != "") {
						$quote = $_POST['quote']; 
					}else{
						$quote = $d['quote']; 						
					} 
					if ($_POST['aq'] != "") {
						$aq = $_POST['aq']; 
					}else{
						$aq = $d['author_quote']; 						
					} 

					$tmp = $_FILES['video']['tmp_name'];

					$path = "../../inc/images/".$video;

					if (!empty($_FILES["video"]["tmp_name"])) {
							if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses
									if(is_file("../../inc/images/".$d['video'])) // Jika video ada
									unlink("../../inc/images/".$d['video']); // Hapus file video sebelumnya yang ada di folder video
							}
					}


							$sql = $con->prepare("UPDATE tentang SET video=:video, ket_video=:kv, quote=:quote, author_quote=:aq");
							$sql->bindParam(':aq', $aq);
							$sql->bindParam(':kv', $kv);
							$sql->bindParam(':quote', $quote);
							$sql->bindParam(':video', $video);
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