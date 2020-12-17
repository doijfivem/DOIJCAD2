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
		<title><?php fetchSetting('nameSml');?> - Join CAD</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Join" />
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
						<h2 id="text09">Join A Department</h2>
						<p id="text11">Civilians are not required to register. See the <a href="/civ">Civilian Panel</a></p>
						<hr id="divider02">

							<form enctype="multipart/form-data" id="form01" method="post" action="../backend/joinDept.php" autocomplete="off">
								<div class="inner">
									<div class="field">
										<label for="form01-callsign-and-name">Call-sign and Name</label>
										<input type="text" name="name" id="form01-callsign-and-name" placeholder=" <?php fetchSetting('nameFormat'); ?> " maxlength="128" required />
									</div>
									<div class="field">
										<label for="form01-department">Department</label>
										<select name="department" id="form01-department" required>
											<option value="">&ndash; Select Department &ndash;</option>
											<?php
											$sql = 'SELECT * from departments';
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
													<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
											<?php
													$count++;
												}
											} else {
												echo 'Error';
											}
											?>
										</select>
									</div>
									<div class="actions">
										<button type="submit">Join Department</button>
									</div>
								</div>
							</form>
						
						<ul id="buttons03" class="buttons">
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

