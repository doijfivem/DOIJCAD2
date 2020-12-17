<?php
include '../functions.php';
if(!session('access_token')) {
    header('Location: /noauth');
}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Pending Verification</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Pending Verification" />
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

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141607712-3"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-141607712-3');
        </script>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../assets/header.php'; ?>
					<section id="home-section">
						<h2 id="text01">Pending Verification</h2>
						<hr id="divider11">
						<p id="text13">Your request is pending verification by an admin. Please wait for this to be done!</p>
						<p id="text03">We sent a notification to the team to let them know.</p>
						<ul id="buttons05" class="buttons">
							<li>
								<a href="/" class="button n01"><svg><use xlink:href="../assets/icons.svg#home"></use></svg><span class="label">Home</span></a>
							</li><li>
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