<?php
include '../functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - 404</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
		<link rel="icon" type="image/png" href="../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/main/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<section id="home-section">
						<h2 id="text14">404</h2>
						<hr id="divider01">
						<p id="text15">The page you're looking for might have been removed, relocated or is temporarily unavailable.</p>
						<p id="text16">Contact an administrator for more details.</p>
						<ul id="buttons06" class="buttons">
							<li>
								<a href="javascript:history.back()" class="button n02"><svg><use xlink:href="../assets/icons.svg#arrow-left"></use></svg><span class="label">Back</span></a>
							</li>
						</ul>
					</section>
					<?php include '../assets/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../assets/main/main.js"></script>
	</body>
</html>