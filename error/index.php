<?php
include '../functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Error</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta name="og:title" content="<?php fetchSetting('nameSml');?> - CAD" />
		<meta name="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:url" content="<?php echo $redirect;?>" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
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
					<?php include '../assets/header.php'; ?>
					<section id="home-section">
						<h2 id="text14">Error</h2>
						<hr id="divider01">
						<p id="text15">There was an error while trying to process your request.</p>
						<br />
						<p id="text16"><?php echo get('e'); ?></p>
						<ul id="buttons06" class="buttons">
							<li>
								<a href="/" class="button n01"><svg><use xlink:href="../assets/icons.svg#home"></use></svg><span class="label">Home</span></a>
							</li><li>
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