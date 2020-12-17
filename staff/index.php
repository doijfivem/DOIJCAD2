<?php
include '../functions.php';
if (!isStaff(1)) {
	header('Location: /noauth');
}

?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Staff Panel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Staff Panel" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/staff/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
				<?php include '../assets/staff/header.php'; ?>
					<section id="home-section">
						<div id="container02" class="container columns full screen">
							<div class="inner">
								<div>
									<h2 id="text01">Admin Panel</h2>
									<hr id="divider09">
									<p id="text11"><span>Welcome to the admin panel, use one of the above buttons to navigate around the Admin Panel.</span><br /><br />
										<span>This Computer-Aided-Dispatch (CAD) system (FaxCAD) was developed by <a href="http://faxes.zone"><span style="color: #7289da">FAXES</span></a>.</span><br /><br />
										<span><strong>If you&#39;re experiencing issues please contact FAXES via his <a href="http://faxes.zone/discord"><span style="color: #7289da">Discord</span></a>.</strong></span><br /><br />
										<span><strong><span style="color: #7289da">FaxCAD Links</span></strong></span><br />
										<span><a href="http://faxes.zone/discord" target="_blank">FAXES Discord</a></span><br />
										<span><a href="https://faxes.zone/store/" target="_blank">FaxCAD Store Page</a></span>
									</p>
									<hr id="divider08">
								</div>
								<div>
									<p id="text03">CAD Statistics</p>
									<hr id="divider04">
									<p id="text15">
										<span><strong>Total Citations:</strong> <span style="color: #77B255"><?php echo getStat('citations'); ?></span></span><br />
										<span><strong>Total Arrests:</strong> <span style="color: #77B255"><?php echo getStat('arrests'); ?></span></span><br />
										<span><strong>Active Warrants:</strong> <span style="color: #E8596E"><?php echo getStat('warrants'); ?></span></span><br />
										<span><strong>Active Impounds:</strong> <span style="color: #F0BF48"><?php echo getStat('impounds'); ?></span></span><br /><br />
										
										<span><strong>Total Characters:</strong> <span style="color: #77B255"><?php echo getStat('civs'); ?></span></span><br />
										<span><strong>Total Emergency Personnel:</strong> <span style="color: #77B255"><?php echo getStat('emerg'); ?></span></span>
									</p>
								</div>
							</div>
						</div>
					</section>
					<?php include '../assets/staff/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../assets/staff/main.js"></script>
	</body>
</html>