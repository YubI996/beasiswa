<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
	$key = @$_GET['key'];
	if ($key == "") {
		$sql = $con->prepare("SELECT * FROM download");
	}else{
		$sql = $con->prepare("SELECT * FROM download WHERE nama_file LIKE '%$key%' OR keterangan_file LIKE '%$key%'");
	}
		$sql->execute();
	$no = 1;
	$no1 = $sql->rowCount();
	if ($no1 == 0) {
		echo "<span style='color:red;'>Tidak ada file dengan kata kunci '$key' ditemukan.</span>";
	}else{
	while ($d = $sql->fetch()) {
?>
                        <li class="wow fadeInUp" data-wow-duration="<?php echo $no1; ?>00ms" data-wow-delay="<?php echo $no; ?>00ms"><i class="fa fa-angle-right"></i><a href="https://e-beasiswa.bontangkota.go.id/user/master/file_unduhan/<?php echo  $d['nama_file']; ?>" style="color:#0E76BC;"><?php echo  $d['keterangan_file'].' - '.$d['nama_file']; ?></a></li>
<?php
		$no++;
		$no1--;
}

	}
?>