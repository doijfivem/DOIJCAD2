<?php
include '../functions.php';
// include 'config.php';
// include 'discord.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Fire Department</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Fire Department" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../assets/favicon.png" />	

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic%7CAveria+Sans+Libre:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/fire/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../assets/fire/header.php'; ?>
					<section id="home-section">
						<?php
						if(get('c')) {
							$unitId = get('c');
							if (!isFire()) {
								header('Location: /noauth');
							}
							$sql = "SELECT * FROM emerg WHERE id = " . $unitId . " AND deptType = 1";
							$r_query = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($r_query)) {
								if($user->id != $row['discordId']) {
									header('Location: ../noauth');
								}
								$isSupervisor = (isStaff(1) ? "[Supervisor]" : "");
						?>
								<p id="text10">Fire Department Panel</p>
								<p id="text06"><?php echo $row['name'];?> <?php echo $isSupervisor; ?></p>
								<div id="container02" class="container columns full">
									<div class="inner">
										<div>
											<hr id="divider06">
											<p id="text09"><span>Status: <?php echo $row['status'];?></span><br /><span>Server: <?php echo $row['server'];?></span></p>
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
												</li><li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-7&r=<?php echo $actual_link; ?>" class="button n02">10-7 | Out of service</a>
												</li><li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-6&r=<?php echo $actual_link; ?>" class="button n03">10-6 | Busy</a>
												</li><li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-11&r=<?php echo $actual_link; ?>" class="button n04">10-11 | Traffic stop</a>
												</li><li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-15&r=<?php echo $actual_link; ?>" class="button n05">10-15 | En-route to station</a>
												</li><li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-23&r=<?php echo $actual_link; ?>" class="button n06">10-23 | On scene</a>
												</li><li>
													<a href="../backend/setStatus.php?id=<?php echo $row['id'];?>&status=10-97&r=<?php echo $actual_link; ?>" class="button n07">10-97 | En-route</a>
												</li>
											</ul>
										</div>
										<div>
											<ul id="buttons10" class="buttons">
												<li>
													<a href="nc/?id=<?php echo $row['id'];?>" class="button n01">Medical Records Check</a>
												</li><li>
													<a href="cmr/?id=<?php echo $row['id'];?>" class="button n02">Create Medical Report</a>
												</li>
											</ul>
											<hr id="divider07">
											<p id="text13">My Call:</p>

											<script type="text/javascript" src="../assets/jquery.min.js"></script>
											<script type="text/javascript">
												var auto_refresh = setInterval( function () {
													$('#callAPI').load(`callAPI.php?id=<?php echo $unitId; ?>`);
												}, 2000); // refresh every 1000 milliseconds
											</script>

											<div id="callAPI"><p id="text03">Loading...</p></div>
										</div>
									</div>
								</div>
						<?php
							}
						} else {
						?>
							<div id="container04" class="container default full">
								<div class="inner">
									<ul id="buttons07" class="buttons">
										<li>
											<a href="/join" class="button n01">Join a Department</a>
										</li>
										<?php
										$sql = "SELECT * from emerg WHERE discordId = '" . $user->id . "' AND deptType = 1";
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

										$sql = "SELECT * from pending WHERE discordId = '" . $user->id . "' AND deptType = 1";
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
										
									</ul>
								</div>
							</div>
						<?php
						}
						?>
					</section>
					<?php include '../assets/fire/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../assets/fire/main.js"></script>
	</body>
</html>