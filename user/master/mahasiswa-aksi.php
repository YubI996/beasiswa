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
				$exp = explode('~', $_POST['kota']);
				$id_mahasiswa = '';  
				$id_user = $_POST['id_user']; 
				$nama = $_POST['nama'];  
				$ktm = $_POST['ktm'];  
				$ktp = $_POST['ktp'];  
				$tpl = $_POST['tpl']; 
				$tgl = $_POST['tgl']; 
				$kota = $exp[0];
				$daerah = $exp[1];
				$alamatKtp = $_POST['alamatKtp']; 
				$alamatS = $_POST['alamatS']; 
				$telp1 = $_POST['telp1']; 
				$ayah = $_POST['ayah'];  
				$ibu = $_POST['ibu']; 
				$alamatO = $_POST['alamatO'];  
				$telp2 = $_POST['telp2']; 
				$pt = $_POST['pt']; 
				$alamatP = $_POST['alamatP']; 
				$telp3 = $_POST['telp3']; 
				$jenjang = $_POST['jenjang']; 
				$angkatan = $_POST['angkatan']; 
				$fakultas = $_POST['fakultas']; 
				$ps = $_POST['ps']; 
				$jurusan = $_POST['jurusan']; 
				$ilmu = $_POST['ilmu']; 
				$nmbank = $_POST['nmbank']; 
				$alamatB = $_POST['alamatB']; 
				$telp4 = $_POST['telp4'];  
				$norek = $_POST['norek'];  
				$pemilik = $_POST['pemilik'];  

				$q = $con->prepare("SELECT email FROM user WHERE id_user='$id_user'");
				$q->execute();
				$e = $q->fetch();
				$email = $e['email'];

				$foto = 'default.png';

					// Proses simpan ke Database
					$sql = $con->prepare("INSERT INTO mahasiswa VALUES (:id_mahasiswa, :id_user, :foto, :nama, :ktm, :ktp, :tpl, :tgl, :kota, :daerah, :alamatKtp, :alamatS, :telp1, :email, :ayah, :ibu, :alamatO, :telp2, :pt, :alamatP, :telp3, :jenjang, :angkatan, :fakultas, :ps, :jurusan, :ilmu, :nmbank, :alamatB, :telp4, :norek, :pemilik)");
					$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
					$sql->bindParam(':id_user', $id_user);
					$sql->bindParam(':foto', $foto);
					$sql->bindParam(':nama', $nama);
					$sql->bindParam(':ktm', $ktm);
					$sql->bindParam(':ktp', $ktp);
					$sql->bindParam(':tpl', $tpl);
					$sql->bindParam(':tgl', $tgl);
					$sql->bindParam(':kota', $kota);
					$sql->bindParam(':daerah', $daerah);
					$sql->bindParam(':alamatKtp', $alamatKtp);
					$sql->bindParam(':alamatS', $alamatS);
					$sql->bindParam(':telp1', $telp1);
					$sql->bindParam(':email', $email);
					$sql->bindParam(':ayah', $ayah);
					$sql->bindParam(':ibu', $ibu);
					$sql->bindParam(':alamatO', $alamatO);
					$sql->bindParam(':telp2', $telp2);
					$sql->bindParam(':pt', $pt);
					$sql->bindParam(':alamatP', $alamatP);
					$sql->bindParam(':telp3', $telp3);
					$sql->bindParam(':jenjang', $jenjang);
					$sql->bindParam(':angkatan', $angkatan);
					$sql->bindParam(':fakultas', $fakultas);
					$sql->bindParam(':ps', $ps);
					$sql->bindParam(':jurusan', $jurusan);
					$sql->bindParam(':ilmu', $ilmu);
					$sql->bindParam(':nmbank', $nmbank);
					$sql->bindParam(':alamatB', $alamatB);
					$sql->bindParam(':telp4', $telp4);
					$sql->bindParam(':norek', $norek);
					$sql->bindParam(':pemilik', $pemilik);
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
					$exp = explode('~', $_POST['kota']);
					$id_mahasiswa = $_POST['id_mahasiswa']; 
					$id_user = $_POST['id_user']; 
					$nama = $_POST['nama'];  
					$ktm = $_POST['ktm'];  
					$ktp = $_POST['ktp'];  
					$tpl = $_POST['tpl']; 
					$tgl = $_POST['tgl']; 
					$kota = $exp[0];
					$daerah = $exp[1];
					$alamatKtp = $_POST['alamatKtp']; 
					$alamatS = $_POST['alamatS']; 
					$telp1 = $_POST['telp1']; 
					$ayah = $_POST['ayah'];  
					$ibu = $_POST['ibu']; 
					$alamatO = $_POST['alamatO'];  
					$telp2 = $_POST['telp2']; 
					$pt = $_POST['pt']; 
					$alamatP = $_POST['alamatP']; 
					$telp3 = $_POST['telp3']; 
					$jenjang = $_POST['jenjang']; 
					$angkatan = $_POST['angkatan']; 
					$fakultas = $_POST['fakultas']; 
					$ps = $_POST['ps']; 
					$jurusan = $_POST['jurusan']; 
					$ilmu = $_POST['ilmu']; 
					$nmbank = $_POST['nmbank']; 
					$alamatB = $_POST['alamatB']; 
					$telp4 = $_POST['telp4'];  
					$norek = $_POST['norek'];  
					$pemilik = $_POST['pemilik'];  

						$q = $con->prepare("SELECT email FROM user WHERE id_user='$id_user'");
						$q->execute();
						$e = $q->fetch();
						$email = $e['email'];

							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE mahasiswa SET  id_user=:id_user, nama_mahasiswa=:nama, no_ktm=:ktm, no_ktp=:ktp, tempat_lahir=:tpl, tgl_lahir=:tgl, kota=:kota, daerah=:daerah, alamat_ktp=:alamatKtp, alamat_sekarang=:alamatS, telp_mahasiswa=:telp1, email=:email, nama_ayah=:ayah, nama_ibu=:ibu, alamat_ortu=:alamatO, telp_ortu=:telp2, perguruan_tinggi=:pt, alamat_pt=:alamatP, telp_pt=:telp3, jenjang=:jenjang, angkatan=:angkatan, fakultas=:fakultas, program_studi=:ps, jurusan=:jurusan, ilmu=:ilmu, nama_bank=:nmbank, alamat_bank=:alamatB, telp_bank=:telp4, no_rekening=:norek, pemilik=:pemilik WHERE id_mahasiswa=:id_mahasiswa");
							$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':ktm', $ktm);
							$sql->bindParam(':ktp', $ktp);
							$sql->bindParam(':tpl', $tpl);
							$sql->bindParam(':tgl', $tgl);
							$sql->bindParam(':kota', $kota);
							$sql->bindParam(':daerah', $daerah);
							$sql->bindParam(':alamatKtp', $alamatKtp);
							$sql->bindParam(':alamatS', $alamatS);
							$sql->bindParam(':telp1', $telp1);
							$sql->bindParam(':email', $email);
							$sql->bindParam(':ayah', $ayah);
							$sql->bindParam(':ibu', $ibu);
							$sql->bindParam(':alamatO', $alamatO);
							$sql->bindParam(':telp2', $telp2);
							$sql->bindParam(':pt', $pt);
							$sql->bindParam(':alamatP', $alamatP);
							$sql->bindParam(':telp3', $telp3);
							$sql->bindParam(':jenjang', $jenjang);
							$sql->bindParam(':angkatan', $angkatan);
							$sql->bindParam(':fakultas', $fakultas);
							$sql->bindParam(':ps', $ps);
							$sql->bindParam(':jurusan', $jurusan);
							$sql->bindParam(':ilmu', $ilmu);
							$sql->bindParam(':nmbank', $nmbank);
							$sql->bindParam(':alamatB', $alamatB);
							$sql->bindParam(':telp4', $telp4);
							$sql->bindParam(':norek', $norek);
							$sql->bindParam(':pemilik', $pemilik);
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
			$id_mahasiswa = $_POST['id_mahasiswa'];

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM mahasiswa WHERE id_mahasiswa=:id_mahasiswa");
			$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
			$sql->execute(); // Eksekusi/Jalankan query

 
			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus',  
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}

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



