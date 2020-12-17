<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';



?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php fetchSetting('nameSml');?> - Civilian Make Dead</title>
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
		<link rel="stylesheet" href="../../assets/civ/main.css" />
		<style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/civ/header.php'; ?>
					<section id="home-section">
					<?php
					if(get('c')) {
						$charId = get('c');
						if(session('access_token')) {
							$sql = "SELECT * FROM civilians WHERE id = " . $charId . "";
							$r_query = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($r_query)){
								if($user->id != $row['discordId']) {
									header('Location: ../../noauth');
								}
					?>
								<h2 id="text15">Character Edit</h2>
									<p id="text16">Please note that not all options can be edited.</p>
									<form enctype="multipart/form-data" id="form04" method="post" action="../../backend/editCharacter.php?c=<?php echo $row['id'];?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<label for="form04-change-gender">Change Gender:</label>
												<select name="gender" id="form04-change-gender" required>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="Other">Other</option>
												</select>
											</div>
											<div class="actions">
												<button type="submit">Change Gender</button>
											</div>
										</div>
									</form>
									
									<form enctype="multipart/form-data" id="form05" method="post" action="../../backend/editCharacter.php?c=<?php echo $row['id'];?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<label for="form05-change-address">Change Address:</label>
												<input type="text" name="address" id="form05-change-address" value="<?php echo $row['address'];?>" maxlength="128" required />
											</div>
											<div class="actions">
												<button type="submit">Change Address</button>
											</div>
										</div>
									</form>
									
									<form enctype="multipart/form-data" id="form06" method="post" action="../../backend/editCharacter.php?c=<?php echo $row['id'];?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<label for="form06-change-hair-color">Change Hair Color:</label>
												<input type="text" name="hair" id="form06-change-hair-color" value="<?php echo $row['hair'];?>" maxlength="128" required />
											</div>
											<div class="actions">
												<button type="submit">Change Hair Color</button>
											</div>
										</div>
									</form>
									
									<form enctype="multipart/form-data" id="form02" method="post" action="../../backend/editCharacter.php?c=<?php echo $row['id'];?>" autocomplete="off">
										<div class="inner">
											<div class="field">
												<label for="form02-change-image">Change Image:</label>
												<div class="file" data-placeholder="" data-filename="">
													<input type="file" accept="image/jpeg, image/jpg, image/gif, image/png" name="file" id="form02-change-image" required />
												</div>
											</div>
											<div class="actions">
												<button type="submit">Change Image</button>
											</div>
										</div>
									</form>
					<?php
							}       
						}
					}
					?>
					</section>
					<?php include '../../assets/civ/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/civ/main.js"></script>
	</body>
</html>