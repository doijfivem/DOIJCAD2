<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';
if (!isLEO()) {
	header('Location: ../../noauth');
}
if (!isStaff(1)) {
	header('Location: ../../noauth');
}
if(get('id')) {
    $redirId = get('id');
}
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Law Enforcement</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta name="og:title" content="<?php fetchSetting('nameSml');?> - CAD" />
		<meta name="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:url" content="<?php echo $redirect;?>" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic%7CAveria+Sans+Libre:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../assets/leo/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/leo/header.php'; ?>
					<section id="home-section">
							<!-- <div id="container03" class="container columns full"> -->
								<div class="inner">
									<!-- <div> -->
										<hr id="divider09">
										<p id="text11">Create Warrant</p>
										<hr id="divider10">
										<ul id="buttons01" class="buttons">
											<li>
												<a href="/leo/?c=<?php echo $redirId; ?>" class="button n01"><svg><use xlink:href="../../assets/icons.svg#refresh"></use></svg><span class="label">Return to LEO Panel</span></a>
											</li>
										</ul>
									<!-- </div>
									<div> -->
										<p id="text04"><span>State Warrant</span><br /><span>#W-DRAFT</span></p>
										<p id="text23"><span>Date: <?php echo date("d/m/Y"); ?></span><br /><span>Time: <?php echo date("h:i:sa"); ?></span></p>
										<form enctype="multipart/form-data" id="form01" method="post" action="../../backend/createWarrant.php" autocomplete="off">
											<div class="inner">
												<div class="field">
														<br />
														<input type="text" id="search" placeholder="Search Name..." onkeyup="filter()">
														<br />
														<select id="select" name="name">
															<option>Issued to...</option>
															<?php
															$sql = "SELECT * from civilians WHERE NOT dead = 1";
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
																	<option><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?> - <?php echo $row['dob']; ?></option>
															<?php
																	$count++;
																}
															}
															?>
														</select>
												</div>
												<div class="field">
													<textarea name="details" id="form01-report-details" placeholder="Report Details" required></textarea>
												</div>
												<div class="field">
													<input type="text" name="sign" id="form01-sign-off" placeholder="Sign Off" maxlength="128" required />
												</div>
												<input type="hidden" id="custId5" name="redir" value="<?php echo $redirId; ?>">
												<div class="actions">
													<button type="submit">Create Warrant</button>
												</div>
											</div>
										</form>
									<!-- </div> -->
								</div>
							<!-- </div> -->
					</section>
					<?php include '../../assets/leo/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/leo/main.js"></script>
	</body>
</html>