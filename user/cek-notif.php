<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

if ($_GET['cek'] == "batasKumpul") {
	$sql = $con->prepare("SELECT * FROM set_beasiswa");
	$sql->execute();
	$d = $sql->fetch();
	$tgl = $d['tgl_tutup'];
	echo batasKumpul($tgl) ;
}


if ($_GET['cek'] == "kritikSaran") {


	$qs = $con->prepare("SELECT id_kritik FROM kritik");
	$qs->execute();
	$n2 = $qs->rowCount();

if (!isset($_COOKIE['nkritik'])) {
	$cookie = 0;
	$newcookie = ($n2 - $cookie);
	setcookie('nkritik', $newcookie, strtotime('+1 months'), '/');

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

	$a = array(
	    'jks' => $newcookie,
	    'sck' => 0
	);

echo "data: " . json_encode($a);
echo PHP_EOL;
echo PHP_EOL;
flush();


}else{

	$cookie = $_COOKIE['nkritik'];
	if ($n2 != $cookie) {
		setcookie('nkritik', $n2, strtotime('+1 months'), '/');
	} 

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

	$a = array(
	    'jks' => $n2,
	    'sck' => 1
	);

echo "data: " . json_encode($a);
echo PHP_EOL;
echo PHP_EOL;
flush();

}

 
echo "data: " . json_encode($a);
echo PHP_EOL;
echo PHP_EOL;
flush();

}

?>
