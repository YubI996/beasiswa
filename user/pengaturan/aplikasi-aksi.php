<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];

$sql1 = $con->prepare("SELECT * FROM aplikasi");
$sql1->execute();
$d = $sql1->fetch();

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					if ($_POST['title'] != "") {
						$title = $_POST['title']; 
					}else{
						$title = $d['title']; 						
					} 
					if ($_POST['jft'] != "") {
						$jft = $_POST['jft']; 
					}else{
						$jft = $d['judul_tag_front']; 						
					} 
					if ($_POST['tf'] != "") {
						$tf = $_POST['tf']; 
					}else{
						$tf = $d['tag_front']; 						
					} 
					if ($_POST['versi'] != "") {
						$versi = $_POST['versi']; 
					}else{
						$versi = $d['versi']; 						
					} 
					if ($_POST['owner'] != "") {
						$owner = $_POST['owner']; 
					}else{
						$owner = $d['owner']; 						
					} 

					$fl1 = $_POST['fl1'];
					$fl2 = $_POST['fl2'];
					$fl3 = $_POST['fl3'];

					if (!empty($_FILES["logo1"]["tmp_name"])) {
						$logo1 = date("dYm").'-'.$_FILES['logo1']['name'];

						if(is_file("../../inc/images/".$d['logo_title'])) 
						unlink("../../inc/images/".$d['logo_title']); 
					}else{
						$logo1 = $d['logo_title'];
					}
					if (!empty($_FILES["logo2"]["tmp_name"])) {
						$logo2 = date("dYm").'-'.$_FILES['logo2']['name'];

						if(is_file("../../inc/images/".$d['logo_front'])) 
						unlink("../../inc/images/".$d['logo_front']); 
					}else{
						$logo2 = $d['logo_front'];
					}
					if (!empty($_FILES["logo3"]["tmp_name"])) {
						$logo3 = date("dYm").'-'.$_FILES['logo3']['name'];

						if(is_file("../../inc/images/".$d['logo_user'])) 
						unlink("../../inc/images/".$d['logo_user']); 
					}else{
						$logo3 = $d['logo_user'];
					}

					$tmp1 = $_FILES['logo1']['tmp_name'];
					$tmp2 = $_FILES['logo2']['tmp_name'];
					$tmp3 = $_FILES['logo3']['tmp_name'];

					$path1 = "../../inc/images/".$logo1;
					$path2 = "../../inc/images/".$logo2;
					$path3 = "../../inc/images/".$logo3;

					move_uploaded_file($tmp1, $path1);
					move_uploaded_file($tmp2, $path2);
					move_uploaded_file($tmp3, $path3);

							$sql = $con->prepare("UPDATE aplikasi SET title=:title, judul_tag_front=:jft, tag_front=:tf, versi=:versi, owner=:owner, logo_title=:logo1, logo_front=:logo2, logo_user=:logo3");
							$sql->bindParam(':title', $title);
							$sql->bindParam(':jft', $jft);
							$sql->bindParam(':tf', $tf);
							$sql->bindParam(':versi', $versi);
							$sql->bindParam(':owner', $owner);
							$sql->bindParam(':logo1', $logo1);
							$sql->bindParam(':logo2', $logo2);
							$sql->bindParam(':logo3', $logo3);
							$sql->execute(); // Eksekusi query insert 

						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', // Set pesan 
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