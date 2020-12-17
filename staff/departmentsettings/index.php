<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';
if (!isStaff(0)) {
	header('Location: /noauth');
}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(get('rem')) {
	$rem = get('rem');
	if(isStaff(0)) {
		$sql = "DELETE FROM departments WHERE id = $rem";
		$conn->query($sql);
		header('Location: index.php');
	}
}

if(isset($_POST['deptName'])) {
	if(isStaff(0)) {
		$deptName = $_POST['deptName'];
		$deptId = $_POST['deptId'];
		$sql2 = "UPDATE departments SET name = '$deptName' WHERE id = " . $deptId . "";
    	$conn->query($sql2);
	}
}

if(isset($_POST['deptColor'])) {
	if(isStaff(0)) {
		$deptColor = $_POST['deptColor'];
		$deptId = $_POST['deptId'];
		$sql2 = "UPDATE departments SET color = '$deptColor' WHERE id = " . $deptId . "";
    	$conn->query($sql2);
	}
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
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/staff/header.php'; ?>
					<section id="home-section">
						<div id="container04" class="container columns full">
							<div class="inner">
								<div>
									<hr id="divider06">
									<p id="text28">Change Allowed Characters Per User</p>
									<p id="text13">Use <code>-1</code> for unlimited characters.</p>
									<form enctype="multipart/form-data" id="form13" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form13-total-characters-per-user" value="<?php fetchSetting('maxChars'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="maxChars">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider16">
									<p id="text34">Penal Code Link</p>
									<form enctype="multipart/form-data" id="form19" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form19-penal-code" value="<?php fetchSetting('penalCode'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="penalCode">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider20">
									<p id="text38">Live Map Link</p>
									<form enctype="multipart/form-data" id="form21" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form21-live-map-link" value="<?php fetchSetting('liveMap'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="liveMap">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider13">
									<p id="text25">Name Format</p>
									<p id="text13">This is what&#39;s templated when people join a department. Eg; <code>1A-999 | Fax M.</code></p>
									<form enctype="multipart/form-data" id="form04" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form04-live-map-link" value="<?php fetchSetting('nameFormat'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="nameFormat">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
								</div>
								<div>
									<p id="text37">Add Department</p>
									<form enctype="multipart/form-data" id="form11" method="post" action="../../backend/createDepartment.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="name" id="form11-department-name" placeholder="Department Name" maxlength="128" required />
											</div>
											<div class="field">
												<input type="text" name="color" id="form11-department-color-hex-color" placeholder="Department Color (Hex Color)" maxlength="128" required />
											</div>
											<div class="field">
												<select name="type" id="form11-department-type" required>
													<option value="">&ndash; Department Type &ndash;</option>
													<option value="0">LEO</option>
													<option value="1">Fire</option>
													<option value="2">Dispatch</option>
												</select>
											</div>
											<div class="field">
												<select name="verification" id="form11-verification-required" required>
													<option value="">&ndash; Verification Required? &ndash;</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
											<div class="actions">
												<button type="submit">Create Department</button>
											</div>
										</div>
									</form>
									<hr id="divider17">
									<p id="text26">Current Departments</p>
									<div id="table02" class="table-wrapper">
										<div class="table-inner">
											<table>
												<thead>
													<tr>
														<th>Department</th>
														<th>Department Color</th>
														<th>Type</th>
														<th>Verification</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = "SELECT * from departments";
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
																<form enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off">
																<td><input type="text" name="deptName" value="<?php echo $row['name']; ?>"></td>
																<td><span style="color: <?php echo $row['color']; ?>"><input type="text" name="deptColor" value="<?php echo $row['color']; ?>"></span></td>
																<td><?php echo $row['typeName']; ?></td>
																<td><?php echo $row['locked']; ?></td>
																<input type="hidden" id="custIdLol" name="deptId" value="<?php echo $row['id']; ?>">
																<td><button type="submit">Save</button> <a href="?rem=<?php echo $row['id']; ?>">Delete</a></td>
																</form>
															</tr>
																						
													<?php
															$count++;
														}
													} else {
													?>
														<tr>
															<td>No departments.</td>
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
						</div>
					</section>
					<?php include '../../assets/staff/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/staff/main.js"></script>
	</body>
</html>