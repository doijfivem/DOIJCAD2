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
		$sql = "DELETE FROM news WHERE id = $rem";
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
						<div id="container09" class="container columns full">
							<div class="inner">
								<div>
									<p id="text30">Current News Posts</p>
									<div id="table06" class="table-wrapper">
										<div class="table-inner">
											<table>
												<thead>
													<tr>
														<th>Post</th>
														<th>Date Posted</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = "SELECT * from news";
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
																<td><?php echo $row['details']; ?></td>
																<td><?php echo $row['date']; ?></td>
																<td><a href="?rem=<?php echo $row['id']; ?>">Delete</a></td>
															</tr>
																						
													<?php
															$count++;
														}
													} else {
													?>
														<tr>
															<td>No news posts.</td>
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
									<p id="text31">Create News Post</p>
									<p id="text13">HTML can be used in these posts.</p>
									<form enctype="multipart/form-data" id="form15" method="post" action="../../backend/createNewsPost.php" autocomplete="off">
										<div class="inner">
											<div class="field">
												<textarea name="post" id="form15-post" placeholder="Post..." required></textarea>
											</div>
											<div class="actions">
												<button type="submit">Create Post</button>
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