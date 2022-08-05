<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];

$send = pesanUser($name, $email, $message);

if ($send == 'ok') {
	$response = array(
		'status'=>'ok',
	);
	echo json_encode($response); 
}else{
	$response = array(
		'status'=>$send,
	);
	echo json_encode($response); 
}
/*
			$message = '<html><body>';
			$message .= '<img src="http://cdn.worldvectorlogo.com/logos/gmail.svg" alt="Website Change Request" />';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
			$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
			$message .= "<tr><td><strong>Type of Change:</strong> </td><td> Submission Form</td></tr>";
			$message .= "<tr><td><strong>Urgency:</strong> </td><td>Urgent</td></tr>";
			$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>http://e-beasiswa.bontangkota.go.id/</td></tr>";
			$message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . htmlentities($_POST['message']) . "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";

			$to = 'beasiswa@bontangkota.go.id';
			
			$subject = 'Email Pengunjung';
			
			$headers = "From : " . $email . "\r\n";
			$headers .= "Reply-To : ". $email . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";

            if (mail($to, $subject, $message, $headers)) {
              echo 'Your message has been sent.';
            } else {
              echo 'There was a problem sending the email.';
            }
*/

?>

