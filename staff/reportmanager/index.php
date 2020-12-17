<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';
if (!isStaff(0)) {
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
		<meta name="og:title" content="<?php fetchSetting('nameSml');?> - CAD" />
		<meta name="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:url" content="<?php echo $redirect;?>" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../assets/staff/main.css" />
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
			xmlhttp.open("GET", "../../backend/TicketSearch.php?q=" + str, true);
			xmlhttp.send();
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/staff/header.php'; ?>
					<section id="home-section">
						<div id="container08" class="container columns full">
							<div class="inner">
								<div>
									<p id="text33">Delete Medical Report</p>
									<form enctype="multipart/form-data" id="form18" method="post" action="../../backend/deleteReport.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="repId" id="form18-enter-report-id-eg-mr173830" placeholder="Enter Medical Report ID (Eg; MR-173830)" maxlength="128" required />
											</div>
											<input type="hidden" id="custId1" name="sett" value="medicalreports">
											<div class="actions">
												<button type="submit">Delete Report</button>
											</div>
										</div>
									</form>
									<hr id="divider12">
									<p id="text27">Delete Arrest</p>
									<form enctype="multipart/form-data" id="form12" method="post" action="../../backend/deleteReport.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="repId" id="form12-enter-arrest-id-eg-173830" placeholder="Enter Arrest ID (Eg; A-173830)" maxlength="128" required />
											</div>
											<input type="hidden" id="custId2" name="sett" value="arrests">
											<div class="actions">
												<button type="submit">Delete Arrest</button>
											</div>
										</div>
									</form>
								</div>
								<div>
									<p id="text29">Delete Ticket</p>
									<form enctype="multipart/form-data" id="form17" method="post" action="../../backend/deleteReport.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="repId" id="form17-enter-ticket-id-eg-c173830" placeholder="Enter Ticket ID (Eg; C-173830)" maxlength="128" required />
											</div>
											<input type="hidden" id="custId3" name="sett" value="tickets">
											<div class="actions">
												<button type="submit">Delete Ticket</button>
											</div>
										</div>
									</form>
									<hr id="divider18">
									<p id="text32">Delete Warrant</p>
									<form enctype="multipart/form-data" id="form16" method="post" action="../../backend/deleteReport.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="repId" id="form16-enter-arrest-id-eg-a173830" placeholder="Enter Warrant ID (Eg; W-173830)" maxlength="128" required />
											</div>
											<input type="hidden" id="custId4" name="sett" value="warrants">
											<div class="actions">
												<button type="submit">Delete Warrant</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</section>
					<?php include '../../assets/staff/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/staff/main.js"></script>
	</body>
</html>