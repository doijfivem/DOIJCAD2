<?php
include 'functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - CAD Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Home" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />

		<link rel="icon" type="image/png" href="assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="assets/main/main.css" />

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141607712-3"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-141607712-3');
        </script>
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include 'assets/header.php'; ?>
					<section id="home-section">
						<div id="container02" class="container columns full screen">
							<div class="inner">
								<div>
									<?php
										if(session('access_token')) { ?>
											<h2 id="text17">Welcome <?php echo $user->username; ?></h2>
									<?php	
										} else { ?>
											<h2 id="text17">Welcome User</h2>
									<?php
										}
									?>
									
									<hr id="divider12">
									<hr id="divider09">
									<p id="text06"><span>Welcome to the <?php fetchSetting('name');?> Computer-Aided Dispatch System.</span><br /><br /><span><?php fetchSetting('description');?></span></p>
									<hr id="divider08">
									<ul id="buttons01" class="buttons">
										<li>
											<a href="<?php fetchSetting('invite');?>" class="button n01"><svg><use xlink:href="assets/icons.svg#discord"></use></svg><span class="label"><?php fetchSetting('nameSml');?> Discord Server</span></a>
										</li>
										<?php 
										if(!session('access_token')) {
										?>
											<li>
												<a href="<?php echo getloginShitLink()["loginLink"]; ?>" class="button n02"><svg><use xlink:href="assets/icons.svg#play"></use></svg><span class="label">Login</span></a>
											</li>
										<?php
										} else {
										?>
											<li>
												<a href="/logout" class="button n02"><svg><use xlink:href="assets/icons.svg#play"></use></svg><span class="label">Logout</span></a>
											</li>
										<?php
										}
										?>
									</ul>
								</div>
								<div>
									<p id="text05">CAD Statistics</p>
									<hr id="divider03">
									<hr id="divider04">
									<p id="text19"><span><strong>Total Citations:</strong> <span style="color: #77B255"><?php echo getStat('citations'); ?></span></span><br />
									<span><strong>Total Arrests:</strong> <span style="color: #77B255"><?php echo getStat('arrests'); ?></span></span><br />
									<span><strong>Active Warrants:</strong> <span style="color: #E8596E"><?php echo getStat('warrants'); ?></span></span><br /><br />
									<span><strong>Total Characters:</strong> <span style="color: #77B255"><?php echo getStat('civs'); ?></span></span><br />
									<span><strong>Emergency Personnel:</strong> <span style="color: #77B255"><?php echo getStat('emerg'); ?></span></span><br />
									<span><strong>Active Impounds:</strong> <span style="color: #F0BF48"><?php echo getStat('impounds'); ?></span></span></p>
								</div>
							</div>
						</div>
						<?php
						if(getStat('news') > 0) {
						?>
							<p id="text18">Latest News</p>
							<div id="container03" class="container default">
								<div class="inner">
							<?php
									$sql = 'SELECT * from news ORDER BY id DESC';
									if (mysqli_query($conn, $sql)) {
										echo "";
									} else {
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}
									$count = 1;
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
							?>
									
											<p id="text04" style="color: <?php fetchSetting('shareColor'); ?>">Posted on <code><?php echo $row['date']; ?></code></p>
											<p id="text07"><?php echo $row['details']; ?></p>
											<hr id="divider06">
											<br>
										
							<?php
											$count++;
										}
									}
						?>
								</div>
							</div>
						<?php
						}
						?>
					</section>
					<?php include 'assets/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="assets/main/main.js"></script>
	</body>
</html>