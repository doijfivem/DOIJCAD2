<?php
include '../functions.php';
// include 'config.php';
// include 'discord.php';

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

if(get('deleteWeap')) {
	$weapId = get('deleteWeap');
	if(session('access_token')) {
		$sql = "SELECT * FROM weapons WHERE id = " . $weapId . "";
		$r_query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($r_query)){
			if($user->id != $row['discordId']) {
				header('Location: ../noauth');
			}
			$sql2 = "DELETE FROM weapons WHERE id = " . $weapId . "";
			$conn->query($sql2);
			header('Location: ../civ/?c=' . $row['charId'] . '');
		}       
	}
}

?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Civilian</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta property="og:site_name" content="<?php fetchSetting('name');?> - CAD" />
		<meta property="og:title" content="Civilian" />
		<meta property="og:type" content="website" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta property="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:image" content="/assets/favicon.png" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/civ/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../assets/civ/header.php'; ?>
					<section id="home-section">
						<?php
						if(get('c')) {
							$civId = get('c');
							$sql = "SELECT * FROM civilians WHERE id = " . $civId . "";
							$r_query = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($r_query)){

								if($user->id != $row['discordId']) {
									header('Location: ../noauth');
								}
							
						?>
								<div id="container03" class="container columns full">
									<div class="inner">
										<div>
											<p id="text14"><?php echo $row['firstName'];?> <?php echo $row['lastName'];?>&#39;s Information:</p>
											<div id="image01" class="image">
												<img src="../assets/civimages/<?php echo $row['image'];?>" alt="" />
											</div>
											<?php $deadChar = ($row['dead'] == 1 ? "Yes" : "No"); ?>
											<p id="text10"><span>Name: <?php echo $row['firstName'];?> <?php echo $row['lastName'];?></span><br /><span>Gender: <?php echo $row['gender'];?></span><br /><span>Race: <?php echo $row['race'];?></span><br /><span>Address: <?php echo $row['address'];?></span><br /><span>DOB: <?php echo $row['dob'];?> (dd/mm/yyyy)</span><br /><span>Hair Color: <?php echo $row['hair'];?></span><br /><span>Dead: <?php echo $deadChar;?></span></p>
										</div>
										<div>
											<?php if(!isCharDead($row['dead'])) { ?>
												<p id="text12">Update License Status</p>
												<form enctype="multipart/form-data" id="form03" method="post" action="../backend/UpdateLicense.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<select name="license" id="form03-license-type" required>
																<option value="">&ndash; License Type &ndash;</option>
																<option value="licDrive">Drivers License</option>
																<option value="licWeapons">Firearms License</option>
																<option value="licHunt">Hunting License</option>
																<option value="licFish">Fishing License</option>
																<option value="licComm">Commercial License</option>
																<option value="licBoat">Boating License</option>
																<option value="licAir">Aviation License</option>
															</select>
														</div>
														<div class="field">
															<select name="status" id="form03-license-status" required>
																<option value="">&ndash; License Status &ndash;</option>
																<option value="Valid">Valid</option>
																<option value="Invalid">Invalid</option>
																<option value="Revoked">Revoked</option>
																<option value="Suspended">Suspended</option>
															</select>
														</div>
														<input type="hidden" id="custId" name="char" value="<?php echo $row['id'];?>">
														<div class="actions">
															<button type="submit">Update</button>
														</div>
													</div>
												</form>
											<hr id="divider06">
											<?php
											}
											?>
											<p id="text04">License Status&#39;s</p>
											<div id="table02" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>Drivers</th>
																<th>Firearms</th>
																<th>Hunting</th>
																<th>Fishing</th>
																<th>Commercial</th>
																<th>Boating</th>
																<th>Aviation</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><?php convertResultToColor($row['licDrive']); ?></td>
																<td><?php convertResultToColor($row['licWeapons']); ?></td>
																<td><?php convertResultToColor($row['licHunt']); ?></td>
																<td><?php convertResultToColor($row['licFish']); ?></td>
																<td><?php convertResultToColor($row['licComm']); ?></td>
																<td><?php convertResultToColor($row['licBoat']); ?></td>
																<td><?php convertResultToColor($row['licAir']); ?></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<hr id="divider02">
											<ul id="buttons06" class="buttons">
												<?php if(!isCharDead($row['dead'])) { ?>
													<li>
														<a href="edit/?c=<?php echo $row['id'];?>" class="button n01"><svg><use xlink:href="../assets/icons.svg#information"></use></svg><span class="label">Edit Character Information</span></a>
													</li><li>
														<a href="makedead/?c=<?php echo $row['id'];?>" class="button n02"><svg><use xlink:href="../assets/icons.svg#lock"></use></svg><span class="label">Mark Dead</span></a>
													</li>
												<?php
												}
												?>
												<li>
													<a href="/civ" class="button n03"><svg><use xlink:href="../assets/icons.svg#refresh"></use></svg><span class="label">Character Selection</span></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="container05" class="container columns full">
									<div class="inner">
										<div>
											<p id="text06"><?php echo $row['firstName'];?> <?php echo $row['lastName'];?>&#39;s Vehicles:</p>
											<?php if(!isCharDead($row['dead'])) { ?>
												<form enctype="multipart/form-data" id="form08" method="post" action="../backend/createVehicle.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<input type="text" name="model" id="form08-model" placeholder="Model" maxlength="128" required />
														</div>
														<div class="field">
															<input type="text" name="plate" id="form08-plate" placeholder="Plate" maxlength="128" required />
														</div>
														<div class="field">
															<input type="text" name="color" id="form08-color" placeholder="Color" maxlength="128" required />
														</div>
														<div class="field">
															<select name="registration" id="form08-registration-status" required>
																<option value="">&ndash; Registration Status &ndash;</option>
																<option value="None">None</option>
																<option value="Valid">Valid</option>
																<option value="Invalid">Invalid</option>
																<option value="Expired">Expired</option>
															</select>
														</div>
														<div class="field">
															<select name="insurance" id="form08-insurance-status" required>
																<option value="">&ndash; Insurance Status &ndash;</option>
																<option value="None">None</option>
																<option value="Valid">Valid</option>
																<option value="Invalid">Invalid</option>
																<option value="Expired">Expired</option>
															</select>
														</div>
														<input type="hidden" id="custId3" name="char" value="<?php echo $row['id'];?>">
														<input type="hidden" id="custId4" name="charName" value="<?php echo $row['firstName'];?> <?php echo $row['lastName'];?>">
														<div class="actions">
															<button type="submit">Add Vehicle</button>
														</div>
													</div>
												</form>
											<?php
											}
											?>
										</div>
										<div>
											<div id="table03" class="table-wrapper">
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
															<?php
															$sql = 'SELECT * from vehicles WHERE charId = ' . $civId . '';
															if (mysqli_query($conn, $sql)) {
																echo "";
															} else {
																echo "Error: " . $sql . "<br>" . mysqli_error($conn);
															}
															$count = 1;
															$result = mysqli_query($conn, $sql);
															if (mysqli_num_rows($result) > 0) {
																while ($row2 = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																		<td><?php echo $row2['model']; ?></td>
																		<td><?php echo $row2['plate']; ?></td>
																		<td><?php echo $row2['color']; ?></td>
																		<td><?php convertResultToColor($row2['rego']); ?></td>
																		<td><?php convertResultToColor($row2['insure']); ?></td>
																		<td><a href="?deleteVeh=<?php echo $row2['id']; ?>">Delete</a></td>
																	</tr>
															<?php
																	$count++;
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<?php if(!isCharDead($row['dead'])) { ?>
												<form enctype="multipart/form-data" id="form03" method="post" action="../backend/updateRego.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<select name="vehicle" id="form03-license-type" required>
																<option value="">&ndash; Vehicle &ndash;</option>		
																<?php
																$sql = 'SELECT * from vehicles WHERE charId = ' . $civId . ' ORDER BY id DESC';
																if (mysqli_query($conn, $sql)) {
																	echo "";
																} else {
																	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
																}
																$count = 1;
																$result = mysqli_query($conn, $sql);
																if (mysqli_num_rows($result) > 0) {
																	while ($row2 = mysqli_fetch_assoc($result)) {
																?>
																		<option value="<?php echo $row2['id']; ?>"><?php echo $row2['model']; ?> - <?php echo $row2['plate']; ?></option>
																<?php
																		$count++;
																	}
																}
																?>
															</select>
														</div>
														<div class="field">
															<select name="status" id="form03-license-status" required>
																<option value="">&ndash; Registration Status &ndash;</option>
																<option value="None">None</option>
																<option value="Valid">Valid</option>
																<option value="Invalid">Invalid</option>
																<option value="Expired">Expired</option>
															</select>
														</div>
														<input type="hidden" id="char" name="char" value="<?php echo $civId;?>">
														<div class="actions">
															<button type="submit">Update</button>
														</div>
													</div>
												</form>
												<form enctype="multipart/form-data" id="form03" method="post" action="../backend/updateInsurance.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<select name="vehicle" id="form03-license-type" required>
															<option value="">&ndash; Vehicle &ndash;</option>
																<?php
																$sql = 'SELECT * from vehicles WHERE charId = ' . $civId . ' ORDER BY id DESC';
																if (mysqli_query($conn, $sql)) {
																	echo "";
																} else {
																	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
																}
																$count = 1;
																$result = mysqli_query($conn, $sql);
																if (mysqli_num_rows($result) > 0) {
																	while ($row2 = mysqli_fetch_assoc($result)) {
																?>
																		<option value="<?php echo $row2['id']; ?>"><?php echo $row2['model']; ?> - <?php echo $row2['plate']; ?></option>
																<?php
																		$count++;
																	}
																}
																?>
															</select>
														</div>
														<div class="field">
															<select name="status" id="form03-license-status" required>
																<option value="">&ndash; Insurance Status &ndash;</option>
																<option value="None">None</option>
																<option value="Valid">Valid</option>
																<option value="Invalid">Invalid</option>
																<option value="Expired">Expired</option>
															</select>
														</div>
														<input type="hidden" id="custId5" name="char" value="<?php echo $civId;?>">
														<div class="actions">
															<button type="submit">Update</button>
														</div>
													</div>
												</form>
											<hr id="divider06">
											<?php
											}
											?>
										</div>
									</div>
								</div>
								<div id="container07" class="container columns full">
									<div class="inner">
										<div>
											<p id="text09"><?php echo $row['firstName'];?> <?php echo $row['lastName'];?>&#39;s Firearms:</p>
											<?php if(!isCharDead($row['dead'])) { ?>
												<form enctype="multipart/form-data" id="form07" method="post" action="../backend/createWeapon.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<input type="text" name="model" id="form07-weapon-model" placeholder="Weapon Model" maxlength="128" required />
														</div>
														<div class="field">
															<select name="status" id="form07-registration-status" required>
																<option value="">&ndash; Registration Status &ndash;</option>
																<option value="Valid">Valid</option>
																<option value="Valid (with CCW)">Valid (with CCW)</option>
															</select>
														</div>
														<input type="hidden" id="custId6" name="char" value="<?php echo $row['id'];?>">
														<div class="actions">
															<button type="submit">Add Weapon</button>
														</div>
													</div>
												</form>
											<?php
											}
											?>
										</div>
										<div>
											<div id="table05" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>Weapon Model</th>
																<th>Status</th>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = 'SELECT * from weapons WHERE charId = ' . $civId . '';
															if (mysqli_query($conn, $sql)) {
																echo "";
															} else {
																echo "Error: " . $sql . "<br>" . mysqli_error($conn);
															}
															$count = 1;
															$result = mysqli_query($conn, $sql);
															if (mysqli_num_rows($result) > 0) {
																while ($row2 = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																		<td><?php echo $row2['model']; ?></td>
																		<td><?php convertResultToColor($row2['status']); ?></td>
																		<td><a href="?deleteWeap=<?php echo $row2['id']; ?>">Delete</a></td>
																	</tr>
															<?php
																	$count++;
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<?php if(!isCharDead($row['dead'])) { ?>
												<form enctype="multipart/form-data" id="form03" method="post" action="../backend/updateWeaponStatus.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<select name="weapon" id="form03-license-type" required>
															<option value="">&ndash; Weapon &ndash;</option>
																<?php
																$sql = 'SELECT * from weapons WHERE charId = ' . $civId . ' ORDER BY id DESC';
																if (mysqli_query($conn, $sql)) {
																	echo "";
																} else {
																	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
																}
																$count = 1;
																$result = mysqli_query($conn, $sql);
																if (mysqli_num_rows($result) > 0) {
																	while ($row2 = mysqli_fetch_assoc($result)) {
																?>
																		<option value="<?php echo $row2['id']; ?>"><?php echo $row2['model']; ?></option>
																<?php
																		$count++;
																	}
																}
																?>
															</select>
														</div>
														<div class="field">
															<select name="status" id="form03-license-status" required>
																<option value="">&ndash; Status &ndash;</option>
																<option value="None">None</option>
																<option value="Valid">Valid</option>
																<option value="Valid (with CCW)">Valid (with CCW)</option>
															</select>
														</div>
														<input type="hidden" id="custId7" name="char" value="<?php echo $civId;?>">
														<div class="actions">
															<button type="submit">Update</button>
														</div>
													</div>
												</form>
											<?php
											}
											?>
										</div>
									</div>
								</div>
								<hr id="divider05">
								<div id="container04" class="container columns full">
									<div class="inner">
										<div>
											<p id="text08"><?php echo $row['firstName'];?> <?php echo $row['lastName'];?>&#39;s Tickets:</p>
											<div id="table06" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>Date</th>
																<th>Location</th>
																<th>Offence</th>
																<th>Officer</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = 'SELECT * from tickets WHERE civId = ' . $civId . '';
															if (mysqli_query($conn, $sql)) {
																echo "";
															} else {
																echo "Error: " . $sql . "<br>" . mysqli_error($conn);
															}
															$count = 1;
															$result = mysqli_query($conn, $sql);
															if (mysqli_num_rows($result) > 0) {
																while ($row2 = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																		<td><?php echo $row2['date']; ?> <?php echo $row2['time']; ?></td>
																		<td><?php echo $row2['location']; ?></td>
																		<td><?php echo $row2['offence']; ?></td>
																		<td><?php echo $row2['officerName']; ?></td>
																	</tr>
															<?php
																	$count++;
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div>
											<p id="text05"><?php echo $row['firstName'];?> <?php echo $row['lastName'];?>&#39;s Warrants:</p>
											<div id="table04" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>Date</th>
																<th>Reason</th>
																<!-- <th>Status</th> -->
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = 'SELECT * from warrants WHERE civId = ' . $civId . '';
															if (mysqli_query($conn, $sql)) {
																echo "";
															} else {
																echo "Error: " . $sql . "<br>" . mysqli_error($conn);
															}
															$count = 1;
															$result = mysqli_query($conn, $sql);
															if (mysqli_num_rows($result) > 0) {
																while ($row2 = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																		<td>N/A</td>
																		<td><?php echo $row2['details']; ?></td>
																	</tr>
															<?php
																	$count++;
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="container06" class="container columns full">
									<div class="inner">
										<div>
											<p id="text07"><?php echo $row['firstName'];?> <?php echo $row['lastName'];?>&#39;s Arrests:</p>
										</div>
										<div>
											<div id="table01" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th>Date</th>
																<th>Location</th>
																<th>Reason</th>
																<th>Officer</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = 'SELECT * from arrests WHERE civId = ' . $civId . '';
															if (mysqli_query($conn, $sql)) {
																echo "";
															} else {
																echo "Error: " . $sql . "<br>" . mysqli_error($conn);
															}
															$count = 1;
															$result = mysqli_query($conn, $sql);
															if (mysqli_num_rows($result) > 0) {
																while ($row2 = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																		<td><?php echo $row2['date']; ?> <?php echo $row2['time']; ?></td>
																		<td><?php echo $row2['location']; ?></td>
																		<td><?php echo $row2['offence']; ?></td>
																		<td><?php echo $row2['officerName']; ?></td>
																	</tr>
															<?php
																	$count++;
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						} else {
						?>
							<div id="container02" class="container columns full screen">
								<div class="inner">
									<div>
										<ul id="buttons05" class="buttons">
										<?php
										$sql = "SELECT * from civilians WHERE discordId = '" . $user->id . "'";
										if (mysqli_query($conn, $sql)) {
											echo "";
										} else {
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
										}
										$count = 1;
										$result = mysqli_query($conn, $sql);
										if (mysqli_num_rows($result) > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
												$deadChar = ($row['dead'] == 1 ? " - Deceased" : "");
										?>
												<li>
													<a href="?c=<?php echo $row['id'];?>" class="button n01">Name: <?php echo $row['firstName'];?> <?php echo $row['lastName'];?> | DOB: <?php echo $row['dob'];?> <?php echo $deadChar; ?></a>
												</li>
											
										<?php
												$count++;
											}
										} else {
											echo '<p id="text16">Create your first character!</p>';
										}
										?>
										</ul>
										<?php
										if(getStat('maxcivs') > 0) {
										?>
											<hr id="divider04">
											<p id="text03">A maximum of <strong><?php fetchSetting('maxChars'); ?></strong> characters is permitted.</p>
										<?php
										}
										?>
									</div>
									<div>
										<?php
										$sql = "SELECT COUNT(id) from civilians WHERE discordId = '" . $user->id . "' AND dead = 0";
										$r_query = mysqli_query($conn, $sql);
										$civMax = getStat('maxcivs');
										if($civMax < 0) {
											$civMax = 999999999999999;
										}
										while ($row = mysqli_fetch_array($r_query)){
											if($row[0] >= $civMax) {
												echo '<p id="text16">Maximum characters created.</p>';
											} else {
										
										?>
												<form enctype="multipart/form-data" id="form01" method="post" action="../backend/createCivilian.php" autocomplete="off">
													<div class="inner">
														<div class="field">
															<input type="text" name="firstname" id="form01-first-name" placeholder="First Name" maxlength="128" required />
														</div>
														<div class="field">
															<input type="text" name="lastname" id="form01-last-name" placeholder="Last Name" maxlength="128" required />
														</div>
														<div class="field">
															<select name="gender" id="form01-select-gender" required>
																<option value="">&ndash; Select Gender &ndash;</option>
																<option value="Female">Female</option>
																<option value="Male">Male</option>
																<option value="Other">Other</option>
															</select>
														</div>
														<div class="field">
															<select name="race" id="form01-select-race" required>
																<option value="">&ndash; Select Race &ndash;</option>
																<option value="White">White</option>
																<option value="African American">African American</option>
																<option value="Asian">Asian</option>
																<option value="Hispanic">Hispanic</option>
															</select>
														</div>
														<div class="field">
															<input type="text" name="address" id="form01-address" placeholder="Address" maxlength="128" required />
														</div>
														<div class="field">
															<input type="text" name="dob" id="form01-dd-mm-yyyy-date-of-birth" placeholder="dd/mm/yyyy (Date of Birth)" maxlength="128" required />
														</div>
														<div class="field">
															<input type="text" name="hair" id="form01-hair-color" placeholder="Hair Color" maxlength="128" required />
														</div>
														<div class="field">
															<div class="file" data-placeholder="Character Image (optional)" data-filename="">
																<input type="file" accept="image/jpeg, image/jpg, image/gif, image/png" name="file" id="form01-character-image" />
															</div>
														</div>
														<div class="actions">
															<button type="submit">Create Character</button>
														</div>
													</div>
												</form>
										<?php
											}
										}
										?>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					<?php include '../assets/civ/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../assets/civ/main.js"></script>
	</body>
</html>