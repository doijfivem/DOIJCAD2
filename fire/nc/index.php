<?php
include '../../functions.php';
if (!isFire()) {
	header('Location: /noauth');
}

if(get('id')) {
    $redirId = get('id');
}
?>


<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Staff Panel</title>
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
		<link rel="stylesheet" href="../../assets/fire/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>

		<script>
			function showResult(str) {
			if (str.length==0) {
				document.getElementById("livesearch").innerHTML="";
				document.getElementById("livesearch").style.border="0px";
				return;
			}
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {  // code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState == 4 && this.status == 200) {
				document.getElementById("livesearch").innerHTML = this.responseText;
				// document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET", "../../backend/searchAPI.php?id=<?php echo $redirId; ?>&q=" + str, true);
			xmlhttp.send();
			}
		</script>

	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/fire/header.php'; ?>
					<section id="home-section">
						<div id="container07" class="container columns full">
							<div class="inner">
								<div>
									<p id="text17">Name Check</p>
									<form enctype="multipart/form-data" id="form04" autocomplete="off">
										<div class="inner">
											<input type="text" size="30" placeholder="Search Name..." onkeyup="showResult(this.value)">
											<div id="livesearch"></div>
										</div>
									</form>
									<hr id="divider05">
									<ul id="buttons04" class="buttons">
										<li>
											<a href="/fire/?c=<?php echo $redirId; ?>" class="button n01"><svg><use xlink:href="../../assets/icons.svg#refresh"></use></svg><span class="label">Return to FD Panel</span></a>
										</li>
									</ul>
								</div>
								<div>
									<?php
									if(get('sq')) {
										$civId = get('sq');
										$sql = "SELECT * FROM medicalreports WHERE civId = " . $civId . "";
										$r_query = mysqli_query($conn, $sql);
										if (mysqli_num_rows($r_query) > 0) {
											while ($rowInfo = mysqli_fetch_array($r_query)) {
									?>
												<p id="text18">Search History For: <code><?php echo $rowInfo['civName'];?></code></p><br />
												<div id="table03" class="table-wrapper">
													<div class="table-inner">
														<table>
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Details</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>#MR-<?php echo $rowInfo['id'];?></td>
																	<td><?php echo $rowInfo['details'];?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
									<?php
											}
										} else {
									?>
											<div id="table03" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>ID</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>No medical history found</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</section>
					<section id="createreport-section">
						<div id="container03" class="container columns full">
							<div class="inner">
								<div>
									<hr id="divider09">
									<p id="text11">Create Medical Report</p>
									<hr id="divider10">
									<ul id="buttons01" class="buttons">
										<li>
											<a href="#" class="button n01"><svg><use xlink:href="../assets/icons.svg#refresh"></use></svg><span class="label">Return to FD Panel</span></a>
										</li>
									</ul>
								</div>
								<div>
									<p id="text04"><span>State of San Andreas Medical Report</span><br /><span>#MR-173830</span></p>
									<p id="text23"><span>Date: 09/04/2019</span><br /><span>Time: 06:25:16 AM</span></p>
									<form enctype="multipart/form-data" id="form01" method="post" action="#">
										<div class="inner">
											<div class="field">
												<input type="text" name="patient" id="form01-patient" placeholder="Patient" maxlength="128" required />
											</div>
											<div class="field">
												<textarea name="details" id="form01-details" placeholder="Details" required></textarea>
											</div>
											<div class="actions">
												<button type="submit">Submit Arrest Report</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</section>
					<?php include '../../assets/fire/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/fire/main.js"></script>
	</body>
</html>