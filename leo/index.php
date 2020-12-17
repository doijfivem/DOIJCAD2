<?php
include '../functions.php';
// include 'config.php';
// include 'discord.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(get('deleteVeh')) {
	$vehId = get('deleteVeh');
	if(session('access_token')) {
		$sql = "SELECT * FROM vehicles WHERE id = " . $vehId . "";
		$r_query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($r_query)){
			if($user->id != $row['discordId']) {
				header('Location: ../noauth');
			}
			$sql2 = "DELETE FROM vehicles WHERE id = " . $vehId . "";
			$conn->query($sql2);
			header('Location: ../civ/?c=' . $row['charId'] . '');
		}       
	}
}

?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Law Enforcement</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Law Enforcement" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic%7CAveria+Sans+Libre:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/leo/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../assets/leo/header.php'; ?>
					<section id="home-section">
					<?php
						if(get('c')) {
							$unitId = get('c');
							if (!isLEO()) {
								header('Location: ../../noauth');
							}
							$sql = "SELECT * FROM emerg WHERE id = " . $unitId . " AND deptType = 0";
							$r_query = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($r_query)) {
								if($user->id != $row['discordId']) {
									header('Location: ../noauth');
								}
								$isSupervisor = (isStaff(1) ? "[Supervisor]" : "");
								$serverPass = $row['server'];
					?>

								<p id="text10">Law Enforcement Panel</p>
								<p id="text06"><?php echo $row['name'];?> <?php echo $isSupervisor; ?></p>

								<script type="text/javascript" src="../assets/jquery.min.js"></script>
								<script type="text/javascript">
									var auto_refresh = setInterval( function () {
										$('#panicAPI').load('panicAPI.php?s=<?php echo $serverPass; ?>');
									}, 8000); // refresh every 1000 milliseconds
								</script>

								<div id="panicAPI"></div>
								<div id="container02" class="container columns full">
									<div class="inner">
										<div>
											<hr id="divider06">
											<?php $panicStatusOfficer = ($row['name'] == getPanicStatus($serverPass)['name'] ?'<span style="color: #77B255">Active</span>' : '<span style="color: #E8596E">Inactive</span>'); ?>
											<p id="text09"><span>Status: <?php echo $row['status'];?></span><br /><span>Panic Status: <?php echo $panicStatusOfficer; ?> </span><br /><span>Server: <?php echo $row['server'];?></span></p>
											<?php
											if(getServerCount() > 0) {
											?>
												<form enctype="multipart/form-data" id="form03" method="post" action="../backend/updateServer.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<select name="server" id="form03-license-type" required>
																<option value="">&ndash; Select Server &ndash;</option>
																<?php
																$sql = "SELECT * FROM servers";
																$r_query = mysqli_query($conn, $sql);
																while ($rowServ = mysqli_fetch_array($r_query)) {
																?>
																	<option value="<?php echo $rowServ['id'];?>"><?php echo $rowServ['name'];?></option>
																<?php
																}
																?>
															</select>
														</div>
														<input type="hidden" id="custId" name="char" value="<?php echo $row['id'];?>">
														<input type="hidden" id="custId2" name="redir" value="<?php echo $actual_link; ?>">
														<div class="actions">
															<button type="submit">Update Patrol Server</button>
														</div>
													</div>
												</form>
											<?php
											}
											?>
											
											<ul id="buttons03" class="buttons">
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-8&r=<?php echo $actual_link; ?>" class="button n01">10-8 | In service</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-7&r=<?php echo $actual_link; ?>" class="button n02">10-7 | Out of service</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-6&r=<?php echo $actual_link; ?>" class="button n03">10-6 | Busy</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-11&r=<?php echo $actual_link; ?>" class="button n04">10-11 | Traffic stop</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-15&r=<?php echo $actual_link; ?>" class="button n05">10-15 | En-route to station</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-23&r=<?php echo $actual_link; ?>" class="button n06">10-23 | On scene</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-97&r=<?php echo $actual_link; ?>" class="button n07">10-97 | En-route</a>
												</li>
												<?php
												
												if (getPanicStatus($serverPass)['name'] == $row['name']) {
												?>
												<li>
													<a href="../backend/setStatus.php?panic=<?php echo $row['id'];?>&status=2&r=<?php echo $actual_link; ?>" class="button n08">Deactivate Panic Button</a>
												</li>
												<?php
												} else {
												?>
												<li>
													<a href="../backend/setStatus.php?panic=<?php echo $row['id'];?>&status=1&r=<?php echo $actual_link; ?>" class="button n08">Panic Button</a>
												</li>
												<?php
												}
												?>
											</ul>
											<!-- <form enctype="multipart/form-data" id="form02" method="post" action="#">
												<div class="inner">
													<div class="field">
														<textarea name="notepad" id="form02-notepad" placeholder="Notepad" required></textarea>
													</div>
													<div class="actions">
														<button type="submit">Save to browser</button>
													</div>
												</div>
											</form> -->
										</div>
										<div>
											<hr id="divider07">
											<ul id="buttons10" class="buttons">		
												<li>
													<a href="nc/?id=<?php echo $row['id'];?>" class="button n04">Name check</a>
												</li>		
												<li>
													<a href="vc/?id=<?php echo $row['id'];?>" class="button n04">Plate check</a>
												</li>
												<li>
													<a href="/logout" class="button n04">Logout</a>
												</li>
											</ul>
											<ul id="buttons10" class="buttons">
												<li>
													<a target="_blank" href="<?php fetchSetting('penalCode');?>" class="button n01">Penal code</a>
												</li>
												<li>
													<a href="ct/?id=<?php echo $row['id'];?>" class="button n02">Create Ticket</a>
												</li>
												<li>
													<a href="ca/?id=<?php echo $row['id'];?>" class="button n03">Create Arrest</a>
												</li>
												<?php
												if (isStaff(1)) {
												?>
												<li>
													<a href="cw/?id=<?php echo $row['id'];?>" class="button n03">Create Warrant</a>
												</li>
												<?php
												}
												?>
											</ul>
											<hr id="divider07">
											<script type="text/javascript" src="../assets/jquery.min.js"></script>
											<script type="text/javascript">
												var auto_refresh = setInterval( function () {
													$('#callAPI').load(`callAPI.php?id=<?php echo $unitId; ?>`);
												}, 2000); // refresh every 1000 milliseconds
											</script>

											<div id="callAPI"><p id="text03">Loading...</p></div>

											<hr id="divider04">
											<p id="text02">Current Bolos:</p>

											<script type="text/javascript" src="../assets/jquery.min.js"></script>
											<script type="text/javascript">
												$('#BoloAPI').load(`BoloAPI.php`);
												var auto_refresh = setInterval( function () {
													$('#BoloAPI').load(`BoloAPI.php`);
												}, 60000); // refresh every 1000 milliseconds
											</script>

											<div id="BoloAPI"><p id="text03">Loading...</p></div>
											<hr id="divider03">
										</div>
									</div>
								</div>				
						<?php
							}
						} else {
						?>
							<div id="container12" class="container default full">
								<div class="inner">
									<ul id="buttons06" class="buttons">
										<?php
										$sql = "SELECT * from emerg WHERE discordId = '" . $user->id . "' AND deptType = 0";
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
												<li>
													<a href="?c=<?php echo $row['id'];?>" class="button n01"><span><?php echo $row['name'];?> // <span style="color: <?php echo getDeptColor($row['dept']); ?>"><?php echo $row['dept']; ?></span></span></a>
												</li>
											
										<?php
												$count++;
											}
										}

										$sql = "SELECT * from pending WHERE discordId = '" . $user->id . "' AND deptType = 0";
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
												<li>
													<a class="button n01"><span><?php echo $row['name'];?> // <span style="color: <?php echo getDeptColor($row['dept']); ?>"><?php echo $row['dept']; ?></span> // PENDING</span></a>
												</li>
											
										<?php
												$count++;
											}
										}
										?>
										<li>
											<a href="/join" class="button n01">Join a Department</a>
										</li>
									</ul>
								</div>
							</div>
						<?php 
						}
						?>
					</section>
					<?php include '../assets/leo/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../assets/leo/main.js"></script>
	</body>
</html>