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
	if(isStaff(1)) {
		$sql3 = "DELETE FROM servers WHERE id = $rem";
		$conn->query($sql3);
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
						<div id="container05" class="container columns full">
							<div class="inner">
								<div>
									<p id="text17">Discord Guild ID</p>
									<form enctype="multipart/form-data" id="form08" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form08-share-color" value="<?php fetchSetting('discordGuildId'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="discordGuildId">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider11">
									<p id="text21">Share Description</p>
									<form enctype="multipart/form-data" id="form14" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<textarea name="update" id="form14-share-description" required><?php fetchSetting('description'); ?></textarea>
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="description">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider11">
									<p id="text21">Servers</p>
									<form enctype="multipart/form-data" id="form08" method="post" action="../../backend/createServer.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="name" id="form08-share-color" placeholder="Server name..." maxlength="128" required />
											</div>
											<div class="actions">
												<button type="submit">Create Server</button>
											</div>
										</div>
									</form>
									<br />
									<div id="table03" class="table-wrapper">
										<div class="table-inner">
											<table>
												<thead>
													<tr>
														<th class="tableWhiteOverride">ID</th>
														<th class="tableWhiteOverride">Name</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = "SELECT * from servers";
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
																<td class="tableWhiteOverride"><?php echo $row['id']; ?></td>
																<td class="tableWhiteOverride"><?php echo $row['name']; ?></td>
																<td class="tableWhiteOverride"><a href="?rem=<?php echo $row['id']; ?>">Remove</a></td>
															</tr>
																						
													<?php
															$count++;
														}
													} else {
													?>
														<tr>
															<td class="tableWhiteOverride">No servers.</td>
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
									<hr id="divider15">
									<p id="text19">CAD Background Color</p>
									<p id="text20">This must be a <a href="https://www.w3schools.com/colors/colors_picker.asp">HEX color</a>!</p>
									<form enctype="multipart/form-data" id="form10" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form10-share-color" value="<?php fetchSetting('backgroundColor'); ?>" maxlength="128" />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="backgroundColor">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>

								</div>
								<div>
									<p id="text35">Site Name</p>
									<form enctype="multipart/form-data" id="form20" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form20-site-name" value="<?php fetchSetting('name'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="name">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider19">
									<p id="text18">Site Name Small</p>
									<p id="text24">This should be the <strong>acronym</strong> or <strong>abbreviation</strong> of your community. Eg; FXRP.</p>
									<form enctype="multipart/form-data" id="form09" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form09-site-name" value="<?php fetchSetting('nameSml'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="nameSml">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider15">
									<p id="text19">Share Color</p>
									<p id="text20">This must be a <a href="https://www.w3schools.com/colors/colors_picker.asp">HEX color</a>!</p>
									<form enctype="multipart/form-data" id="form10" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form10-share-color" value="<?php fetchSetting('shareColor'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="shareColor">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider21">
									<p id="text40">Community Discord Invite</p>
									<form enctype="multipart/form-data" id="form22" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<input type="text" name="update" id="form22-invite" value="<?php fetchSetting('invite'); ?>" maxlength="128" required />
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId" name="sett" value="invite">
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider05">
									<p id="text22">Site Favicon (.png)</p>
									<form enctype="multipart/form-data" id="form06" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<div class="file" data-placeholder="Favicon" data-filename="">
													<input type="file" accept="image/jpeg, image/jpg, image/gif, image/png" name="favicon" id="form06-favicon" required />
												</div>
											</div>
											<div class="actions">
												<button type="submit">Change Setting</button>
											</div>
										</div>
									</form>
									<hr id="divider21">
									<p id="text40">Login Type</p>
									<p id="text20">Current Login Setting: <?php echo getloginShitLink()["typeName"]; ?></p>
									<form enctype="multipart/form-data" id="form22" method="post" action="../../backend/updateSiteSetting.php?r=<?php echo $actual_link; ?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<select name="update" id="form01-loginsetting" required>
													<option value="1">Discord Login Only</option>
													<option value="2">Classic Login Only</option>
													<option value="3">Classic & Discord Logins</option>
												</select>
											</div>
											<input type="hidden" id="custId" name="auth" value="0">
											<input type="hidden" id="custId2" name="sett" value="logintype">
											<div class="actions">
												<button type="submit">Change Setting</button>
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