<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';
if (!isStaff(0)) {
	header('Location: /noauth');
}

if(get('rem')) {
	$rem = get('rem');
	if(isStaff(0)) {
		$sql = "DELETE FROM bans WHERE id = $rem";
		$conn->query($sql);
		header('Location: index.php');
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
						<div id="container07" class="container columns full">
							<div class="inner">
								<div>
									<p id="text08">Banned Users</p>
									<div id="table01" class="table-wrapper">
										<div class="table-inner">
											<table>
												<thead>
													<tr>
														<th>Name</th>
														<th>User ID</th>
														<th>IP</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

													<?php
													$sql = "SELECT * from bans";
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
																<td><?php echo $row['name']; ?></td>
																<td><?php echo $row['discordId']; ?></td>
																<td><?php echo $row['ip']; ?></td>
																<td><a href="?rem=<?php echo $row['id']; ?>">Remove</a></td>
															</tr>
																						
													<?php
															$count++;
														}
													} else {
													?>
														<tr>
															<td>No bans.</td>
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
								<div>
									<p id="text14">Ban User</p>
									<p id="text36">This will ban a user until manually removed on the left. This is a auto-learning ban system, meaning that information gets added to the ban when the user attempts to view a page.<br><br>BE AWARE THIS WILL NOT ALLOW THE USER TO VIEW ANY PAGE!</p>
									<form enctype="multipart/form-data" id="form05" method="post" action="../../backend/createAdmin.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="bname" id="form05-display-name" placeholder="Display Name" maxlength="128" required />
											</div>
											<div class="field">
												<input type="text" name="id" id="form05-discord-user-id" placeholder="User ID" maxlength="128" required />
											</div>
											<div class="actions">
												<button type="submit">Add Ban</button>
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