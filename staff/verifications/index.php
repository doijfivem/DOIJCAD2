<?php
include '../../functions.php';
// include 'config.php';
// include 'discord.php';
if (!isStaff(1)) {
	header('Location: /noauth');
}

if(get('con')) {
	$con = get('con');
	if(isStaff(1)) {
		$sql = "SELECT * FROM pending WHERE id = " . $con . "";
		$r_query = mysqli_query($conn, $sql);
		while ($rowPend = mysqli_fetch_array($r_query)){
			$dId = $rowPend["discordId"];
			$name = $rowPend["name"];
			$dept = $rowPend["department"];
			$deptType = $rowPend["deptType"];
			$sql2 = "INSERT INTO emerg (discordId,name,dept,deptType,status,server,callId) VALUES ('$dId', '$name', '$dept', $deptType, '10-7', 1, 0)";
			if ($conn->query($sql2) === TRUE) {
				header('Location: /');
			} else {
				echo "Error: " . $sql2 . "<br>" . $conn->error;
				// header( 'Location: index.php');
			};
		}
		$sql3 = "DELETE FROM pending WHERE id = $con";
		$conn->query($sql3);
		header('Location: index.php');
	}
}

if(get('den')) {
	$den = get('den');
	if(isStaff(1)) {
		$sql3 = "DELETE FROM pending WHERE id = $den";
		$conn->query($sql3);
		header('Location: index.php');
	}
}

if(get('rem')) {
	$rem = get('rem');
	if(isStaff(1)) {
		$sql3 = "DELETE FROM emerg WHERE id = $rem";
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

		<script>
			function showResult(str) {
			if (str.length==0) {
				document.getElementById("livesearch").innerHTML="";
				document.getElementById("livesearch").style.border="0px";
				return;
			}
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {  // code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState == 4 && this.status == 200) {
				document.getElementById("livesearch").innerHTML = this.responseText;
				// document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET", "../../backend/MemberSearch.php?q=" + str, true);
			xmlhttp.send();
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/staff/header.php'; ?>
					<section id="home-section">
						<div id="container06" class="container columns full">
							<div class="inner">
								<div>
									<p id="text05">Pending Verifications</p>
									<div id="table03" class="table-wrapper">
										<div class="table-inner">
											<table>
												<thead>
													<tr>
														<th>Name</th>
														<th>User ID</th>
														<th>Department</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = "SELECT * from pending";
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
																<td><span style="color: <?php echo getDeptColor($row['department']); ?>"><?php echo $row['department']; ?></span></td>
																<td>
																	<ul id="buttons05" class="buttons">
																		<li><a href="?con=<?php echo $row['id']; ?>" class="button n01">Approve</a></li>
																		<li><a href="?den=<?php echo $row['id']; ?>" class="button n02">Deny</a></li>
																	</ul>
																</td>
															</tr>
																						
													<?php
															$count++;
														}
													} else {
													?>
														<tr>
															<td>No pending verifications.</td>
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
									<p id="text06">Search Department Members</p>
									<form enctype="multipart/form-data" id="form23" method="post" action="#" autocomplete="off">
										<div class="inner">
											<div class="field">
											<input type="text" size="30" placeholder="Search Member Name..." onkeyup="showResult(this.value)">
											</div>

										</div>
									</form>
									<div id="table04" class="table-wrapper">
										<div class="table-inner">
											<table>
												<thead>
													<tr>
														<th>Name</th>
														<th>User ID</th>
														<th>Department</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody id="livesearch">

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