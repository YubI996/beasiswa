<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../inc/images/<?php echo $logo_title; ?>">
 <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $host ?>/home/maintenance/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $host ?>/home/maintenance/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $host ?>/home/maintenance/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $host ?>/home/maintenance/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $host ?>/home/maintenance/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $host ?>/home/maintenance/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="size1 bg0 where1-parent">
		<!-- Coutdown -->
		<div class="flex-c-m bg-img1 size2 where1 overlay1 where2 respon2" style="background-image: url('../home/images/beasiswa/bg11.png');">
			<div class="wsize2 flex-w flex-c-m cd100 js-tilt">
				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 days">35</span>
					<span class="s2-txt4">Days</span>
				</div>

				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 hours">17</span>
					<span class="s2-txt4">Hours</span>
				</div>

				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 minutes">50</span>
					<span class="s2-txt4">Minutes</span>
				</div>

				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
					<span class="l2-txt1 p-b-9 seconds">39</span>
					<span class="s2-txt4">Seconds</span>
				</div>
			</div>
		</div>
		
		<!-- Form -->
		<div class="size3 flex-col-sb flex-w p-l-60 p-r-60 p-t-45 p-b-45 respon1">
			<div class="wrap-pic1">
				<img src="../home/images/beasiswa/logo11.png" alt="LOGO">
			</div>
 
				<p class="m1-txt1 p-b-36">
					Website kami sedang dalam tahap perbaikan dan akan segera kembali  <br> 
					<span class="s2-txt3 p-t-18"><i>Our website is Under maintenance and coming back soon</i></span>
				<!-- <form class="contact100-form validate-form" style="margin-top: -30px;">
					<div class="wrap-input100 m-b-10 validate-input" data-validate = "Name is required">
						<input class="s2-txt1 placeholder0 input100" type="text" name="name" placeholder="Your Name">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20 validate-input" data-validate = "Email is required: ex@abc.xyz">
						<input class="s2-txt1 placeholder0 input100" type="text" name="email" placeholder="Email Address">
						<span class="focus-input100"></span>
					</div>

					<div class="w-full">
						<button class="flex-c-m s2-txt2 size4 bg1 bor1 hov1 trans-04">
							Subscribe
						</button>
					<span class="s2-txt3 p-t-18"><i>Untuk pengajuan p</i></span>
					</div>
				</form>  -->
				</p> 

				<img src="../inc/assets/images/foot.jpg" style="width: 300px; height: auto;">
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="<?php echo $host ?>/home/maintenance/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $host ?>/home/maintenance/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo $host ?>/home/maintenance/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $host ?>/home/maintenance/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $host ?>/home/maintenance/vendor/countdowntime/moment.min.js"></script>
	<script src="<?php echo $host ?>/home/maintenance/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="<?php echo $host ?>/home/maintenance/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="<?php echo $host ?>/home/maintenance/vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 5,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="<?php echo $host ?>/home/maintenance/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo $host ?>/home/maintenance/js/main.js"></script>

</body>
</html>