<?php
include '../functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Login" />
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
						<h2 id="text09"><?php fetchSetting('nameSml');?> CAD Login</h2>
						<p id="text11"><a href="/register">Don't have an account? Register!</a></p>
						<hr id="divider02">
						<?php if(get('err')) { ?>
							<p id="text11"><strong><span style="color: #E8596E"><?php echo get('err'); ?></span></strong></p>
						<?php } ?>
						<p id="text11"></p>
						<form enctype="multipart/form-data" id="form01" method="post" action="../backend/login.php" autocomplete="off">
							<div class="inner">
								<div class="field">
									<input type="text" name="username" id="form01-username" placeholder="Username" maxlength="128" required />
								</div>
								<br />
								<div class="field">
									<input type="password" name="password" id="form01-pasword" placeholder="Password" maxlength="128" required />
								</div>
								<div class="actions">
									<button type="submit">Login</button>
								</div>
							</div>
						</form>
						<?php if(getloginShitLink()["allowDiscord"]) {?>
							<ul id="buttons01" class="buttons">
								<li>
									<a href="?discord=login" class="button n02"><svg><use xlink:href="/assets/icons.svg#discord"></use></svg><span class="label">Login Through Discord</span></a>
								</li>
							</ul>
						<?php } ?>
					</section>
					<?php include '../assets/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../assets/main/main.js"></script>
	</body>
</html>

