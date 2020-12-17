<?php
include '../../functions.php';
if (!isDispatch()) {
	header('Location: ../../noauth');
}

if(get('id')) {
    $redirId = get('id');
}
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Communications</title>
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
				// document.getElementById("livesearch").style.border = "0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET", "../../backend/searchAPI.php?id=<?php echo $redirId; ?>&qv=" + str, true);
			xmlhttp.send();
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/leo/header.php'; ?>
					<section id="home-section">
						<div id="container11" class="container columns full">
							<div class="inner">
								<div>
									<p id="text29">Vehicle Check</p>
									<form enctype="multipart/form-data" id="form07" autocomplete="off">
										<div class="inner">
											<input type="text" size="30" placeholder="Search Plate..." onkeyup="showResult(this.value)">
											<div id="livesearch"></div>
										</div>
									</form>
									<hr id="divider16">
									<ul id="buttons11" class="buttons">
										<li>
											<a href="/dispatch/?c=<?php echo $redirId; ?>" class="button n01"><svg><use xlink:href="../../assets/icons.svg#refresh"></use></svg><span class="label">Return to Communications Panel</span></a>
										</li>
									</ul>
								</div>
								<div>
									<?php
									if(get('sq')) {
										$plate = get('sq'); 

										$sql = "SELECT * FROM vehicles WHERE id = " . $plate . "";
										$r_query = mysqli_query($conn, $sql);
										while ($rowInfo = mysqli_fetch_array($r_query)) {
									?>
											<p id="text30">Search Information For <code><?php echo $rowInfo['plate'];?></code></p>
											<hr id="divider17">
											<p id="text31"><span><strong>Plate:</strong> <?php echo $rowInfo['plate'];?></span><br />
											<span><strong>Model:</strong> <?php echo $rowInfo['model'];?></span><br />
											<span><strong>Color:</strong> <?php echo $rowInfo['color'];?></span><br />
											<span><strong>Registered Owner:</strong> <a target="_blank" href="../nc/?id=<?php echo $redirId; ?>&sq=<?php echo $rowInfo['charId'];?>"><?php echo $rowInfo['charName'];?></a></span><br /><br />
											
											<span><strong>Stolen:</strong> <?php convertResultToColor($rowInfo['stolen']); ?></span><br /><br />

											<span><strong>Insurance Status:</strong> <?php convertResultToColor($rowInfo['insure']); ?></span><br />
											<span><strong>Registration Status:</strong> <?php convertResultToColor($rowInfo['rego']); ?></span></p>
									<?php
										}
									?>
									<!-- <ul id="buttons05" class="buttons">
										<li>
											<a href="../../backend/markStolen.php?id=< ?php echo $plate;?>" class="button n01">Mark as stolen</a>
										</li>
									</ul> -->
									<?php
									}
									?>
									
								</div>
							</div>
						</div>
					</section>
					<?php include '../../assets/leo/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/leo/main.js"></script>
	</body>
</html>