<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';

if(get('confirm')) {
	$charId = get('charId');
	if(session('access_token')) {
		$sql = "SELECT * FROM civilians WHERE id = " . $charId . "";
		$r_query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($r_query)){
			if($user->id != $row['discordId']) {
				header('Location: ../../noauth');
			}
			$sql2 = "UPDATE civilians SET dead = 1 WHERE id = " . $charId . "";
			$conn->query($sql2);
			header('Location: /');
		}       
	}
}

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
							$civId = get('c');
						?>
						<h2 id="text01">Make Character Dead?</h2>
						<p id="text11"><span><u><strong>Are you sure you would like to make your character deceased?</strong></u></span><br /><span>This will not allow you to use the character anymore and allow no further edits to the character profile.</span><br /><span><u><strong>This cannot be undone!</strong></u></span></p>
						<ul id="buttons04" class="buttons">
							<li>
								<a href="javascript:history.back();" class="button n01"><svg><use xlink:href="../../assets/icons.svg#arrow-left"></use></svg><span class="label">No</span></a>
							</li><li>
								<a href="?confirm=1&charId=<?php echo $civId; ?>" class="button n02"><svg><use xlink:href="../../assets/icons.svg#arrow-right"></use></svg><span class="label">Yes</span></a>
							</li>
						</ul>
						<?php
						} else {
							header('Location: ../../noauth');
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