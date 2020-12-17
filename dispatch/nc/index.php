<?php
include '../../functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!isDispatch()) {
    header('Location: /noauth');
}

if(get('id')) {
    $redirId = get('id');
}
?>


<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml'); ?> - Communications</title>
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
        <link rel="stylesheet" href="../../assets/dispatch/main.css" />
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
					<?php include '../../assets/dispatch/header.php'; ?>
					
					<section id="home-section">
					    <div id="container07" class="container columns full">
							<div class="inner">
								<div>
									<p id="text17">Name Check</p>
									<!-- <form enctype="multipart/form-data" id="form04" method="post" action="#">
										<div class="inner">
											<div class="field">
												<input type="text" name="search-name" id="form04-search-name" placeholder="Search Name" maxlength="128" onkeyup="showResult(this.value)" />
											</div>
											<div class="actions">
												<button type="submit">Search</button>
											</div>
										</div>
									</form> -->

									<form enctype="multipart/form-data" id="form04" autocomplete="off">
										<div class="inner">
											<input type="text" size="30" placeholder="Search Name..." onkeyup="showResult(this.value)">
											<div id="livesearch"></div>
										</div>
									</form>
									<hr id="divider05">
									<ul id="buttons12" class="buttons">
										<li>
											<a href="/dispatch/?c=<?php echo $redirId; ?>" class="button n01"><svg><use xlink:href="../../assets/icons.svg#refresh"></use></svg><span class="label">Return to Communications Panel</span></a>
										</li>
									</ul>
								</div>
								<div>
								
								<!---------------------------------------------------------------------------------------------->
					<?php
					if(get('sq')) {
						$civId = get('sq');

									$sql = "SELECT * FROM civilians WHERE id = " . $civId . "";
									$r_query = mysqli_query($conn, $sql);
									while ($rowInfo = mysqli_fetch_array($r_query)) {
					?>

										<p id="text18">Search History For: <code><?php echo $rowInfo['firstName'];?> <?php echo $rowInfo['lastName'];?></code></p>
										<div id="image01" class="image">
											<img src="../../assets/civimages/<?php echo $rowInfo['image'];?>" alt="" />
										</div>
										<?php
										$deadChar = ($rowInfo['dead'] == 1 ? "<span style='color: #77B255'>Yes</span>" : "<span style='color: #E8596E'>No</span>");
										?>
										<p id="text19">
										<span><strong>Name:</strong> <?php echo $rowInfo['firstName'];?> <?php echo $rowInfo['lastName'];?></span><br />
										<span><strong>DOB:</strong> <?php echo $rowInfo['dob'];?> (dd/mm/yyyy)</span><br />
										<span><strong>Address:</strong> <?php echo $rowInfo['address'];?></span><br />
										<span><strong>Gender:</strong> <?php echo $rowInfo['gender'];?></span><br />
										<span><strong>Race:</strong> <?php echo $rowInfo['race'];?></span><br />
										<span><strong>Hair Color:</strong> <?php echo $rowInfo['hair'];?></span><br /><br />

										<span><strong>Dead:</strong> <?php echo $deadChar; ?></span><br />
										<span><strong>Active Warrants:</strong> <?php echo warrantCheck($civId)['status']; ?></span><br />

										<?php
										if (warrantCheck($civId)['tf'] == true) {
										?>
											<span><strong>Warrant Details:</strong> <?php echo warrantCheck($civId)['details'];?></span></p>
										<?php
										}
										?>
										<div id="table01" class="table-wrapper">
											<div class="table-inner">
												<table>
													<thead>
														<tr>
															<th>Drivers</th>
															<th>Firearms</th>
															<th>Commercial</th>
															<th>Boat</th>
															<th>Aviation</th>
															<th>Hunting</th>
															<th>Fishing</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php convertResultToColor($rowInfo['licDrive']); ?></td>
															<td><?php convertResultToColor($rowInfo['licWeapons']); ?></td>
															<td><?php convertResultToColor($rowInfo['licComm']); ?></td>
															<td><?php convertResultToColor($rowInfo['licBoat']); ?></td>
															<td><?php convertResultToColor($rowInfo['licAir']); ?></td>
															<td><?php convertResultToColor($rowInfo['licHunt']); ?></td>
															<td><?php convertResultToColor($rowInfo['licFish']); ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<?php
										if (isStaff(1)) {
										?>
											<ul id="buttons05" class="buttons">
												<li>
													<a href="../../backend/suspendLicense.php?lic=licDrive&redir=<?php echo $civId;?>" class="button n01">Suspend Drivers License</a>
												</li><li>
													<a href="../../backend/suspendLicense.php?lic=licComm&redir=<?php echo $civId;?>" class="button n02">Suspend Commercial License</a>
												</li><li>
													<a href="../../backend/suspendLicense.php?lic=licBoat&redir=<?php echo $civId;?>" class="button n03">Suspend Boat License</a>
												</li><li>
													<a href="../../backend/suspendLicense.php?lic=licAir&redir=<?php echo $civId;?>" class="button n04">Suspend Aviation License</a>
												</li><li>
													<a href="../../backend/suspendLicense.php?lic=licWeapons&redir=<?php echo $civId;?>" class="button n05">Suspend Firearms License</a>
												</li><li>
													<a href="../../backend/suspendLicense.php?lic=licHunt&redir=<?php echo $civId;?>" class="button n06">Suspend Hunting License</a>
												</li><li>
													<a href="../../backend/suspendLicense.php?lic=licFish&redir=<?php echo $civId;?>" class="button n07">Suspend Fishing License</a>
												</li>
												<!-- <li>
													<a href="#" class="button n08">Delete Warrant</a>
												</li> -->
											</ul>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
						<div id="container10" class="container default full">
							<div class="inner">
								<p id="text28">Ticket History:</p>
								<div id="table02" class="table-wrapper">
									<div class="table-inner">
										<table>
											<thead>
												<tr>
													<th>ID</th>
													<th>Date & Time</th>
													<th>Offence</th>
													<th>Fine</th>
													<th>Jail Time</th>
													<th>Location</th>
													<th>Veh. Plate</th>
													<th>Veh. Model</th>
													<th>Issuing Officer</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = "SELECT * from tickets WHERE civId = " . $civId . "";
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
														<tr>
															<td>#C-<?php echo $row['id']; ?></td>
															<td><?php echo $row['date']; ?> <?php echo $row['time']; ?></td>
															<td><?php echo $row['offence']; ?></td>
															<td><?php echo $row['fine']; ?></td>
															<td><?php echo $row['jail']; ?></td>
															<td><?php echo $row['location']; ?></td>
															<td><?php echo $row['plate']; ?></td>
															<td><?php echo $row['model']; ?></td>
															<td><?php echo $row['officerName']; ?></td>
														</tr>
																					
												<?php
														$count++;
													}
												} else {
												?>
													<tr>
														<td>No tickets on record.</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div id="container06" class="container default full">
							<div class="inner">
								<p id="text15">Criminal History:</p>
								<div id="table03" class="table-wrapper">
									<div class="table-inner">
										<table>
											<thead>
												<tr>
													<th>ID</th>
													<th>Date & Time</th>
													<th>Offence</th>
													<th>Type</th>
													<th>Location</th>
													<th>Issuing Officer</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = "SELECT * from arrests WHERE civId = " . $civId . "";
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
														<tr>
															<td><a href="<?php echo $_SERVER['REQUEST_URI']?>&getreport=<?php echo $row['id']; ?>">#A-<?php echo $row['id']; ?></a></td>
															<td><?php echo $row['date']; ?> <?php echo $row['time']; ?></td>
															<td><?php echo $row['offence']; ?></td>
															<td><?php echo $row['type']; ?></td>
															<td><?php echo $row['location']; ?></td>
															<td><?php echo $row['officerName']; ?></td>
														</tr>
																					
												<?php
														$count++;
													}
												} else {
												?>
													<tr>
														<td>No arrests on record.</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<?php
								if(get('getreport')) {
									$rId = get('getreport');
									$sql = "SELECT * FROM arrests WHERE id = " . $rId . "";
									$r_query = mysqli_query($conn, $sql);
									while ($row = mysqli_fetch_array($r_query)) {
								?>
										<hr id="divider12"> <p id="text21">Arrest Report Details For <code>#A-<?php echo $row['id']; ?></code></p>
										<p id="text22"><span><strong>Arrest ID:</strong> <span style="color: #617FE8">#A-<?php echo $row['id']; ?></span></span><br />
										<span><strong>Date &amp; Time of Arrest:</strong> <?php echo $row['date']; ?> <?php echo $row['time']; ?></span><br />
										<span><strong>Offence Recorded:</strong> <?php echo $row['offence']; ?></span><br />
										<span><strong>Arrest Type:</strong> <?php echo $row['type']; ?></span><br />
										<span><strong>Fine Issued:</strong> <span style="color: #F0BF48"><?php echo $row['fine']; ?></span></span><br />
										<span><strong>Jail Time Issued:</strong> <span style="color: #F0BF48"><?php echo $row['jail']; ?></span></span><br />
										<span><strong>Location of Arrest:</strong> <?php echo $row['location']; ?></span><br /><br />
										
										<span><strong>Force Used:</strong> <?php convertResultToColor($row['forceUsed']); ?></span><br />
										<span><strong>Lethal Used:</strong> <?php convertResultToColor($row['lethalUsed']); ?></span><br />
										<span><strong>Property Damage:</strong> <?php convertResultToColor($row['propDamage']); ?></span><br />
										<span><strong>Injury Caused:</strong> <?php convertResultToColor($row['injuryCaused']); ?></span><br /><br />
										
										<span><strong>Report Details:</strong></span><br />
										<span><?php echo $row['reportDetails']; ?></span><br /><br />
										
										<span><strong>Arresting Officer:</strong> <span style="color: #617FE8"><?php echo $row['officerName']; ?></span></span></p>
								<?php
									}
								}
								?>
							</div>
						</div>
						<div id="container05" class="container default full">
							<div class="inner">
								<p id="text14">Registered Weapons:</p>
								<div id="table02" class="table-wrapper">
									<div class="table-inner">
										<table>
											<thead>
												<tr>
													<th>Weapon</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = "SELECT * from weapons WHERE charId = " . $civId . "";
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
														<tr>
															<td><?php echo $row['model']; ?></td>
															<td><?php convertResultToColor($row['status']); ?></td>
														</tr>
																					
												<?php
														$count++;
													}
												} else {
												?>
													<tr>
														<td>No weapons on record.</td>
														<td></td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					</section>
					
					<?php include '../../assets/dispatch/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/dispatch/main.js"></script>
	</body>
</html>

<?php
function warrantCheck($id) {
	global $conn;
	$sql = "SELECT * FROM warrants WHERE civId = " . $id . "";
	$r_query = mysqli_query($conn, $sql);
	while ($rowWarrant = mysqli_fetch_array($r_query)) {
		$returnArray = array(
			"tf" => true,
			"status" => "<span style='color: #77B255'>Yes</span>",
			"details" => $rowWarrant['details']
		);
		return $returnArray;
	}

	$returnArray = array(
		"tf" => false,
        "status" => "<span style='color: #E8596E'>No</span>",
        "details" => "N/A"
    );
    return $returnArray;
}
?>