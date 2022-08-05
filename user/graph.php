<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
?>
<script type="text/javascript">
	$(function () {
    getMorris('line1', 'line_chart1');
    getMorris('line2', 'line_chart2');
    getMorris('line3', 'line_chart3');
    getMorris('line4', 'line_chart4');
});
function getMorris(type, element) {
    if (type === 'line1') {
        Morris.Line({
            element: element,
            data: [
 			
 			<?php
 				$pr = $con->prepare("SELECT * FROM periode");
 				$pr->execute();
 				while ($dp = $pr->fetch()) {
 					
 					$periodx = $dp['periode'];
 					$periodex = explode("/", $periodx);
 				
 				$gp1 = $con->prepare("SELECT id_mahasiswa FROM beasiswa_prestasi WHERE periode='$periodx'");
 				$gp1->execute();
 				$n1 = $gp1->rowCount();

 				$gt1 = $con->prepare("SELECT id_mahasiswa FROM beasiswa_ta WHERE periode='$periodx'");
 				$gt1->execute();
 				$n2 = $gt1->rowCount();
 			?>
	            	{
	                    'periode': '<?php echo $periodex[0]; ?>',
	                    'prestasi': <?php echo $n1; ?>,
	                    'ta': <?php echo $n2; ?>
	                },

			<?php
				}
			?>

                ],
            xkey: 'periode',
            ykeys: ['prestasi', 'ta'],
            labels: ['Prestasi', 'Tugas Akhir'],
            lineColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)'],
            lineWidth: 3,
            parseTime: false
        });
    }
    else if (type === 'line2') {
        Morris.Line({
            element: element,
            data: [
 			
 			<?php
 				$pr = $con->prepare("SELECT * FROM periode");
 				$pr->execute();
 				while ($dp = $pr->fetch()) {
 					
 					$periodx = $dp['periode'];
 					$periodex = explode("/", $periodx);
 				
					$sql6 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodx' AND m.kota  LIKE '%bontang%'");
					$sql6->execute();
					$sql6->fetch();
					$n3 = $sql6->rowCount();


					$sql61 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodx' AND NOT m.kota  LIKE '%bontang%'");
					$sql61->execute();
					$sql61->fetch();
					$n5 = $sql61->rowCount();

 			?>

	            	{
	                    'periode': '<?php echo $periodex[0]; ?>',
	                    'luar': <?php echo $n5; ?>,
	                    'dalam': <?php echo $n3; ?>
	                },


			<?php
				}
			?>

                ],
            xkey: 'periode',
            ykeys: ['luar', 'dalam'],
            labels: ['Luar', 'Dalam'],
            lineColors: ['rgb(255, 102, 54)', 'rgb(0, 137, 125)'],
            lineWidth: 3,
            parseTime: false
        });

    }
    else if (type === 'line3') {
        Morris.Line({
            element: element,
            data: [
    		<?php
 				$pr = $con->prepare("SELECT * FROM periode");
 				$pr->execute();
 				while ($dp = $pr->fetch()) {
 					
 					$periodx = $dp['periode'];
 					$periodex = explode("/", $periodx);
					$sql7 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodx' AND m.kota  LIKE '%bontang%'");
					$sql7->execute();
					$sql7->fetch();
					$n4 = $sql7->rowCount();

					$sql71 = $con->prepare("SELECT b.*, m.kota FROM beasiswa_ta b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.periode='$periodx' AND NOT m.kota  LIKE '%bontang%'");
					$sql71->execute();
					$sql71->fetch();
					$n6 = $sql71->rowCount();
			?>

	            	{
	                    'periode': '<?php echo $periodex[0]; ?>',
	                    'luar': <?php echo $n6; ?>,
	                    'dalam': <?php echo $n4; ?>
	                },

			<?php
				}
			?>

                ],
            xkey: 'periode',
            ykeys: ['luar', 'dalam'],
            labels: ['Luar', 'Dalam'],
            lineColors: ['rgb(171, 50, 192)', 'rgb(249, 73, 61)'],
            lineWidth: 3,
            parseTime: false
        });

    }
    else{
        Morris.Line({
            element: element,
            data: [
    		<?php
 				$pr = $con->prepare("SELECT * FROM periode");
 				$pr->execute();
 				while ($dp = $pr->fetch()) {
 					
 					$periodx = $dp['periode'];
 					$periodex = explode("/", $periodx);

	 				$ipk1 = $con->prepare("SELECT AVG(ipk) AS ipk1 FROM beasiswa_prestasi WHERE periode='$periodx'");
	 				$ipk1->execute();
	 				$dr1 = $ipk1->fetch();

	 				if ($dr1['ipk1'] == "NULL" || $dr1['ipk1'] == "") {
		 				$n7 = 'null';	 										
	 				}else{
		 				$n7 = $dr1['ipk1'];	 					
	 				}

	 				$ipk2 = $con->prepare("SELECT AVG(ipk) AS ipk2 FROM beasiswa_ta WHERE periode='$periodx'");
	 				$ipk2->execute();
	 				$dr2 = $ipk2->fetch();

	 				if ($dr2['ipk2'] == "NULL" || $dr2['ipk2'] == "") {
		 				$n8 = 'null';	 										
	 				}else{
		 				$n8 = $dr2['ipk2'];	 					
	 				}

			?>

	            	{
	                    'periode': '<?php echo $periodex[0]; ?>',
	                    'prestasi': <?php echo $n7; ?>,
	                    'ta': <?php echo $n8; ?>
	                },

			<?php
				}
			?>

                ],
            xkey: 'periode',
            ykeys: ['prestasi', 'ta'],
            labels: ['Prestasi', 'Tugas Akhir'],
            lineColors: ['rgb(66, 85, 193)', 'rgb(142, 206, 69)'],
            lineWidth: 3,
            parseTime: false
        });

    }
}
</script>