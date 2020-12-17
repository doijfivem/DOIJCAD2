<?php
include '../functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(get('delbolo')) {
	$delbolo = get('delbolo');
	$r = get('r');
	$sql2 = "DELETE FROM bolos WHERE id = " . $delbolo . "";
	$conn->query($sql2);
	header('Location: /dispatch/?c=' . $r);
}

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
	<title><?php fetchSetting('nameSml'); ?> - Communications</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Communications" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic%7CAveria+Sans+Libre:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/dispatch/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../assets/dispatch/header.php'; ?>
					
					<section id="home-section">
						<?php
						if(get('c')) {
							$unitId = get('c');
							if (!isDispatch()) {
								header('Location: /noauth');
							}
							$sql = "SELECT * FROM emerg WHERE id = " . $unitId . " AND deptType = 2";
							$r_query = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($r_query)) {
								if($user->id != $row['discordId']) {
									header('Location: ../noauth');
								}
								$isSupervisor = (isStaff(1) ? "[Supervisor]" : "");

								$serverPass = $row['server'];
								// $serverPass = $_SESSION['patrolServer'];

								// if ($row['server'] == 0 || $row['server'] = NULL || $row['server'] == "") {
								// 	$serverPass = 1;
								// } else {
								// 	$serverPass = $row['server'];
								// }
						?>
								<p id="text10">Communications Panel</p>
								<p id="text06"><?php echo $row['name'];?> <?php echo $isSupervisor; ?></p>
								<script type="text/javascript" src="../assets/jquery.min.js"></script>
								<script src="../assets/dispatch/main.js"></script>
								<script type="text/javascript">
									getZuluTime();
									getUnitsTable(<?php echo $serverPass; ?>);
									getCallsTable(<?php echo $serverPass; ?>, "<?php echo $actual_link; ?>");
									getBoloTable(<?php echo $unitId; ?>);
									getPanicStuff(<?php echo $serverPass; ?>)
								</script>
								<div id="panicAPI"></div>

								<div id="container02" class="container columns full">
									<div class="inner">
										<div>
											<hr id="divider06">
											<div id="zuluTime"></div>
											<?php $panicStatusOfficer = (getPanicStatus($serverPass)['status'] == true ?'<span style="color: #77B255">Active</span>' : '<span style="color: #E8596E">Inactive</span>'); ?>
											<p id="text09"><span>Panic Status: <?php echo $panicStatusOfficer; ?></span><br /><span>Server: <?php echo $serverPass;?></span></p>
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
														<input type="hidden" id="custId" name="redir" value="<?php echo $actual_link; ?>">
														<div class="actions">
															<button type="submit">Update Patrol Server</button>
														</div>
													</div>
												</form>
											<?php
											}
											?>
											<ul id="buttons07" class="buttons">
												<li>
													<a href="nc/?id=<?php echo $row['id'];?>" class="button n01">Name check</a>
												</li><li>
													<a href="vc/?id=<?php echo $row['id'];?>" class="button n02">Plate check</a>
												</li><li>
													<a target="_blank" href="<?php fetchSetting('liveMap'); ?>" class="button n04">Live Map</a>
												</li>
											</ul>
											<ul id="buttons11" class="buttons">
												<li>
													<a href="cc/?id=<?php echo $row['id'];?>&s=<?php echo $row['server'];?>" class="button n01">Create Call</a>
												</li><li>
													<a href="cb/?id=<?php echo $row['id'];?>" class="button n02">Create BOLO</a>
												</li>
											</ul>
											<ul id="buttons15" class="buttons">
												<li>
													<a href="../backend/stopAllPanics.php?r=<?php echo $actual_link; ?>" class="button n03">Stop Panics</a>
												</li>
												<li>
													<a href="../backend/setStatus.php?panic=<?php echo $row['id'];?>&status=1&r=<?php echo $actual_link; ?>" class="button n04">Signal 100 / Panic</a>
												</li>
											</ul>
											
											<div id="getUnitTable"></div>

											<p id="text08">Set Officer Status</p>
											<form enctype="multipart/form-data" id="form03" method="post" action="../backend/updateOfficerStatusDispatch.php" autocomplete="off">
												<div class="inner">
													<div class="field">
														<br />
														<input type="text" id="search" placeholder="Search Name..." onkeyup="filter()">
														<br />
														<select id="select" name="name">
															<option>Officer...</option>
															<?php
															$sql = "SELECT * from emerg WHERE NOT deptType = 2";
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
																	<option><?php echo $row['name']; ?></option>
															<?php
																	$count++;
																}
															}
															?>
														</select>
													</div>
													<div class="field">
														<select name="status" id="form03-new-status" required>
															<option value="10-8">10-8 | In-service</option>
															<option value="10-7">10-7 | Out of service</option>
															<option value="10-6">10-6 | Busy</option>
															<option value="10-11">10-11 | Traffic stop</option>
															<option value="10-15">10-15 | En-route to station</option>
															<option value="10-23">10-23 | On scene</option>
															<option value="10-97">10-97 | En-route</option>
														</select>
													</div>
													<input type="hidden" id="custId" name="redir" value="<?php echo $actual_link; ?>">
													<input type="hidden" id="custId2" name="serverId" value="<?php echo $serverPass;?>">
													<div class="actions">
														<button type="submit">Update Officer Status</button>
													</div>
												</div>
											</form>
										</div>
										<div>
											<?php
											if(get('ext')) {
												$rId = get('ext');
												$sql = "SELECT * FROM calls WHERE id = " . $rId . "";
												$r_query = mysqli_query($conn, $sql);
												while ($rowCallExt = mysqli_fetch_array($r_query)) {
											?>
													<hr id="divider16">
													<p id="text33">Extended Call:</p>
													<p id="text19">
														<span><strong>Call ID:</strong> #<?php echo $rowCallExt['id']; ?></span><br />
														<span><strong>Primary Unit:</strong> <?php echo $rowCallExt['primaryName']; ?></span><br />
														<span><strong>Location:</strong> <?php echo $rowCallExt['location']; ?></span><br />
														<span><strong>Call Type:</strong> <?php echo convertResultToColor($rowCallExt['callType']); ?></span><br />
														<span><strong>Details:</strong> <?php echo $rowCallExt['details']; ?></span><br /><br />
														
														<span><span style="color: #617FE8"><strong><u>Narrative:</u></strong></span></span><br /><br />
														<!--  -->
														<?php
														$narrativeExplode = explode("||&%&||", $rowCallExt['narrative']);
														foreach ($narrativeExplode as &$narrativeList) {
														?>
															<span><?php echo $narrativeList; ?></span><br /><br />
														<?php
														}
														?>
													<form enctype="multipart/form-data" id="form12" method="post" action="../backend/addNarative.php" autocomplete="off">
														<div class="inner">
															<div class="field">
																<input type="text" name="text" id="form12-location" placeholder="Add Narrative..." maxlength="128" required />
															</div>
															<input type="hidden" id="custId" name="redir" value="<?php echo $actual_link; ?>">
															<input type="hidden" id="custId" name="callId" value="<?php echo $rowCallExt['id']; ?>">
															<div class="actions">
																<button type="submit">Add</button>
															</div>
														</div>
													</form>
													<form enctype="multipart/form-data" id="form11" method="post" action="../backend/addUnitToCall.php" autocomplete="off">
														<div class="inner">
															<div class="field">
																<br />
																<input type="text" id="search" placeholder="Search Unit..." onkeyup="filter()">
																<br />
																<select id="select" name="name">
																	<option>Add unit...</option>
																	<?php
																	$sql = "SELECT * from emerg WHERE NOT deptType = 2 AND status = '10-8'";
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
																			<option><?php echo $row['name']; ?> --- <?php echo $row['id']; ?></option>
																	<?php
																			$count++;
																		}
																	}
																	?>
																</select>
															</div>
															<input type="hidden" id="custId" name="redir" value="<?php echo $actual_link; ?>">
															<input type="hidden" id="custId" name="callId" value="<?php echo $rowCallExt['id']; ?>">
															<div class="actions">
																<button type="submit">Add Unit</button>
															</div>
														</div>
													</form>
													<form enctype="multipart/form-data" id="form12" method="post" action="../backend/updateCallLocation.php" autocomplete="off">
														<div class="inner">
															<div class="field">
																<input type="text" name="location" id="form12-location" placeholder="Location..." maxlength="128" required />
															</div>
															<input type="hidden" id="custId" name="redir" value="<?php echo $actual_link; ?>">
															<input type="hidden" id="custId" name="callId" value="<?php echo $rowCallExt['id']; ?>">
															<div class="actions">
																<button type="submit">Update Location</button>
															</div>
														</div>
													</form>
													<form enctype="multipart/form-data" id="form05" method="post" action="../backend/updateCallType.php" autocomplete="off">
														<div class="inner">
															<div class="field">
																<select name="type" id="form05-call-type" required>
																	<option value="">&ndash; Call Type &ndash;</option>
																	<option value="All Call">All Call</option>
																	<option value="Priority One">Priority One</option>
																	<option value="Priority Two">Priority Two</option>
																	<option value="Priority Three">Priority Three</option>
																	<option value="Priority Four">Priority Four</option>
																	<option value="Traffic / Pedestrian Stop">Traffic / Pedestrian Stop</option>
																</select>
															</div>
															<input type="hidden" id="custId" name="redir" value="<?php echo $actual_link; ?>">
															<input type="hidden" id="custId" name="callId" value="<?php echo $rowCallExt['id']; ?>">
															<div class="actions">
																<button type="submit">Update Call Type</button>
															</div>
														</div>
													</form>
													<ul id="buttons04" class="buttons">
														<li>
															<a href="../backend/markAll108.php?callId=<?php echo $rowCallExt['id']; ?>&redir=<?php echo $actual_link; ?>" class="button n01">Mark All 10-8</a>
														</li><li>
															<a href="../backend/archiveCall.php?callId=<?php echo $rowCallExt['id']; ?>&redir=<?php echo $actual_link; ?>" class="button n02">Archive Call</a>
														</li>
													</ul>
													<ul id="buttons16" class="buttons">
														<li>
															<a href="?c=<?php echo get('c');?>" class="button n01">Close Extension</a>
														</li>
													</ul>
													<hr id="divider19">

											<?php
												}
											}
											?>
											<hr id="divider04">
											<p id="text13">Active Calls:</p>
											<div id="callAPI"><p id="text03">Loading...</p></div>

											<hr id="divider04">
											<p id="text02">Current Bolos:</p>
											<div id="boloAPI"><p id="text03">Loading...</p></div>
											<hr id="divider03">
											<!-- <ul id="buttons06" class="buttons">
												<li>
													<a href="#" class="button n01">10-8 | In service</a>
												</li>
											</ul> -->
										</div>
									</div>
								</div>
								<!-- <div id="container04" class="container columns full">
									<div class="inner">
										<div>
											<p id="text32">Create Warrant</p>
											<form enctype="multipart/form-data" id="form08" method="post" action="#">
												<div class="inner">
													<div class="field">
														<input type="text" name="search-name" id="form08-search-name" placeholder="Search Name" maxlength="128" required />
													</div>
													<div class="field">
														<textarea name="crimes" id="form08-crimes" placeholder="Crime(s)" required></textarea>
													</div>
													<div class="actions">
														<button type="submit">Create</button>
													</div>
												</div>
											</form>
										</div>
										<div>
											<p id="text07">All Active Calls</p>
											<div id="table01" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>Model</th>
																<th>Plate</th>
																<th>Color</th>
																<th>Registration</th>
																<th>Insurance</th>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>Grotti Cheetah</td>
																<td>46EEK572</td>
																<td>Purple/Black</td>
																<td>Valid</td>
																<td>Suspended</td>
																<td>...</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div> -->
						<?php
							};
						} else {
						?>
							<div id="container12" class="container default full">
								<div class="inner">
									<ul id="buttons13" class="buttons">
										<?php
										$sql = "SELECT * from emerg WHERE discordId = '" . $user->id . "' AND deptType = 2";
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
						};
						?>
					</section>
					<?php include '../assets/dispatch/footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>