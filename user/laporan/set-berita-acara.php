<?php 
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];


if ($aksi == "edt") {

$judul = $_POST['judul'];
$atas = $_POST['atas'];
$isi = $_POST['penutup'];
$mengetahui = $_POST['mengetahui'];
$penandatangan = $_POST['penandatangan'];
$nip = $_POST['nip'];

							$sql = $con->prepare("UPDATE set_berita_acara SET judul=:judul, atas=:atas, isi=:isi, mengetahui=:mengetahui, penandatangan=:penandatangan, nip=:nip");
							$sql->bindParam(':judul', $judul);
							$sql->bindParam(':atas', $atas);
							$sql->bindParam(':isi', $isi);
							$sql->bindParam(':mengetahui', $mengetahui);
							$sql->bindParam(':penandatangan', $penandatangan);
							$sql->bindParam(':nip', $nip);
							$sql->execute();  
 							
						if($sql){ 
							 
							$response = array(
								'status'=>'sukses',  
								'pesan'=>'Data berhasil diubah' 
							);
						}else{  
							$response = array(
								'status'=>'gagal',  
								'pesan'=>'Gambar gagal untuk diupload', 
							);
						}


						echo json_encode($response); 
}						


?>