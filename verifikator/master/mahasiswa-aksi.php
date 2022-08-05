<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-verifikator.php");

$aksi = $_POST['aksi'];

if ($aksi == 'fdata') {
			$id_mahasiswa = $_POST['id_mahasiswa'];

			$sql = $con->prepare("SELECT * FROM mahasiswa WHERE id_mahasiswa=:id_mahasiswa");
			$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'idmhs'=>$d['id_mahasiswa'],  
				'idusr'=>$d['id_user'],  
				'nama'=>$d['nama_mahasiswa'],  
				'foto'=>$d['foto_mahasiswa'],  
				'ktm'=>$d['no_ktm'],  
				'ktp'=>$d['no_ktp'],  
				'tpl'=>$d['tempat_lahir'],  
				'tgl'=>$d['tgl_lahir'],  
				'kota'=>$d['kota'],  
				'daerah'=>$d['daerah'],  
				'alamatKtp'=>$d['alamat_ktp'],  
				'alamatS'=>$d['alamat_sekarang'],  
				'telp1'=>$d['telp_mahasiswa'],  
				'email'=>$d['email'],  
				'ayah'=>$d['nama_ayah'],  
				'ibu'=>$d['nama_ibu'],  
				'alamatO'=>$d['alamat_ortu'],  
				'telp2'=>$d['telp_ortu'],  
				'pt'=>$d['perguruan_tinggi'],  
				'alamatP'=>$d['alamat_pt'],  
				'telp3'=>$d['telp_pt'],  
				'jenjang'=>$d['jenjang'],  
				'angkatan'=>$d['angkatan'],  
				'fakultas'=>$d['fakultas'],  
				'ps'=>$d['program_studi'],  
				'jurusan'=>$d['jurusan'],  
				'ilmu'=>$d['ilmu'],  
				'nmbank'=>$d['nama_bank'],  
				'alamatB'=>$d['alamat_bank'],  
				'telp4'=>$d['telp_bank'],  
				'norek'=>$d['no_rekening'],  
				'pemilik'=>$d['pemilik'],  
			);
			echo json_encode($response); 

	
}





?>



