<?php
include '../functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Banned</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Banned" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />
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
						<h2 id="text14">Insufficient Access - Banned</h2>
						<hr id="divider01">
						<p id="text15">Oh no. Looks like you have been banned from the <?php fetchSetting('nameSml');?> CAD.</p>
						<p id="text16">Contact an administrator for more details.</p>
						<ul id="buttons06" class="buttons">
							<li>
								<a href="<?php fetchSetting('invite');?>" class="button n02"><svg><use xlink:href="../assets/icons.svg#discord"></use></svg><span class="label">Discord</span></a>
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