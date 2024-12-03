<?php
	session_start();

	// Retrieve the error and clear it from the session
	$error = isset($_SESSION['error']) ? $_SESSION['error'] : 'unknown';
	unset($_SESSION['error']);

	// Define funny messages
	$errorMessages = [
		'u404' => "Looks like you tried guessing someone else's secret handshake!",
		'p404' => "That doesn't look like the magic word to me!",
		'd404' => "Uh-oh! Our database took a coffee break. Please be patient!",
		'ua404' => "Hold on! You need a VIP pass to get in here!",
		'unknown' => "Hmm... what sorcery is this? You broke something we didn't know could be broken!",
	];

	$funnyMessage = $errorMessages[$error] ?? $errorMessages['unknown'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>404</title>
	<link rel="stylesheet" href="../css/404.css">
	<link rel="stylesheet" href="../css/main.css">
	<script src="../js/dark_mode.js"></script>
</head>

<body>
	<?php include('../php/templates/header.php'); ?>

	<div class="box">
		<div class="text">
			<div>ERROR</div>
			<h1>404</h1>
			<hr><br>
			<div>Page Not Found</div><br>
			<div>What did you do?</div>
			<p class="funny-message" style=""><?php echo $funnyMessage; ?></p>
		</div>

		<div class="astronaut">
			<img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="Astronaut" class="src">
		</div>
	</div>

	<?php include('../php/templates/footer.php'); ?>
	<script src="../js/404.js"></script>
</body>
</html>