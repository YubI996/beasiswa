<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];


if ($aksi == 'fdata') {
			$id_bta = $_POST['id_bta'];

			$sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.daerah, m.ilmu, m.perguruan_tinggi, m.jenjang FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bta=:id_bta");
			$sql->bindParam(':id_bta', $id_bta);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$q = $con->prepare("SELECT nama_user FROM user WHERE id_user='$d[verifikator]'");
			$q->execute();
			$du = $q->fetch();

			if ($du['nama_user'] == '') 
				$nmu = '-'; else $nmu = $du['nama_user'];

			$response = array(
				'id'=>$d['id_bta'],  
				'idmhs'=>$d['id_mahasiswa'],  
				'nama'=>$d['nama_mahasiswa'],  
				'foto'=>$d['foto_mahasiswa'],  
				'pt'=>$d['perguruan_tinggi'],  
				'daerah'=>$d['daerah'],  
				'ilmu'=>$d['ilmu'],  
				'jenjang'=>$d['jenjang'],  
				'periode'=>$d['periode'],  
				'tglP'=>$d['tgl_permohonan'],  
				'semester'=>$d['semester'],  
'semester1'=>konversiRomawi($d['semester']),   
				'ipk'=>$d['ipk'],  
				'suratP'=>$d['surat_permohonan'],  
				'suratAK'=>$d['aktif_kuliah'],  
				'khs'=>$d['transkrip'],  
				'suratPN'=>$d['surat_penelitian'],  
				'propPN1'=>$d['proposal_penelitian1'],  
				'propPN2'=>$d['proposal_penelitian2'],  
				'suratTA'=>$d['surat_ta'],  
				'suratB'=>$d['non_beasiswa'],  
				'suratK'=>$d['non_pekerja'],  
				'ktm'=>$d['ktm'],  
				'ktp'=>$d['ktp'],  
				'akta'=>$d['akta_kelahiran'],  
				'kk'=>$d['kk'],  
				'domisili'=>$d['domisili'],  
				'suratN'=>$d['non_narkoba'],  
				'sertifikat1'=>$d['sertifikat1'],  
				'sertifikat2'=>$d['sertifikat2'],  
				'sertifikat3'=>$d['sertifikat3'],  
				'burek'=>$d['buku_rekening'],  
				'ijazah1'=>$d['ijazah_sekolah'],  
				'ijazah2'=>$d['ijazah_pt'],  
				'statusV'=>$d['status_verifikasi'],  
				'tglV'=>$d['tgl_verifikasi'],  
				'keterangan'=>$d['keterangan'],  
				'verifikator'=>$nmu,  
			);
			echo json_encode($response); 

	
}
					
if ($aksi == 'tetapkan') {
			$id_bta = explode(",", $_POST['id_bta']);
			$periode = $_POST['periode'];

			
			$max = count($id_bta);
			$qr = '';
			for ($i=1; $i < $max; $i++) { 
				$qr .=" AND NOT id_bta='".$id_bta[$i]."'";
			}

			$sql = $con->prepare("UPDATE beasiswa_ta SET status_verifikasi='2' WHERE NOT id_bta='$id_bta[0]' $qr");
			$sql->execute(); // Eksekusi/Jalankan query

			$qu = $con->prepare("UPDATE periode SET penetapan=(penetapan+2) WHERE periode='$periode'");
			$qu->execute();
			
			$response = array(
				'status'=>'ok',  
				'status1'=>$qr,  
			);
			echo json_encode($response); 

			
}
					

?>