<?php
date_default_timezone_set("Asia/Makassar");
$hostd = '20.20.0.11'; // Nama hostnya
$username = 'siswa'; // Username
$password = 'Mahas1sw4#'; // Password (Isi jika menggunakan password)
$database = 'beasiswa'; // Nama databasenya

try {
        // Buat Object PDO baru dan simpan ke variable $db
		$con = new PDO('mysql:host='.$hostd.';dbname='.$database, $username, $password);
        // Mengatur Error Mode di PDO untuk segera menampilkan exception ketika ada kesalahan
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }// Koneksi ke MySQL dengan PDO

//cek batas tgl
$hq = $con->prepare("SELECT * FROM set_beasiswa");
$hq->execute();
$dh = $hq->fetch();

if ($dh['tgl_tutup'] <= date("Y-m-d H:is")) {
	$qu = $con->prepare("UPDATE set_beasiswa SET status_penerimaan='0'");
	$qu->execute();
}


//ambil data aplikasi
$qa = $con->prepare("SELECT * FROM aplikasi");
$qa->execute();
$da = $qa->fetch();

$title = $da['title'];
$logo_title = $da['logo_title'];
$logo_user = $da['logo_user'];
$logo_front = $da['logo_front'];
$owner = $da['owner'];
$versi = $da['versi'];
$tema_user = $da['tema_user'];
$background = $da['background'];

$host = $da['base_url'];

$nomd3pres = number_format('2250000', 0,'','.');
$nomd3TA = number_format('2500000', 0,'','.');
$nomS1pres = number_format('3000000', 0,'','.');
$nomS1TA = number_format('3250000', 0,'','.');
$nomcoass = number_format('3000000', 0,'','.');

/*
$qr = $con->prepare("SELECT * FROM rentang");
$qr->execute();
$dtRange = array();
while ($dr = $qr->fetch()) {
	$dtRange[] = array(
					'awal'=>$dr['awal'],
					'akhir'=>$dr['akhir'],
					'awal1'=>$dr['awal1'],
					'akhir1'=>$dr['akhir1'], 
				 );
}
*/

$host1 = $_SERVER['DOCUMENT_ROOT'];
include_once ($host1."/inc/lib_func.php");

?>
