<?php
include '../../functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!isDispatch()) {
    header('Location: /noauth');
}

if(get('id')) {
    $redirId = get('id');
    $serverId = get('s');
}
?>


<!DOCTYPE HTML>
<html lang="en">
	<head>
	<title><?php fetchSetting('nameSml'); ?> - Communications</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />

		<meta name="description" content="<?php fetchSetting('description');?>" />
		<meta name="og:title" content="<?php fetchSetting('nameSml');?> - CAD" />
		<meta name="og:description" content="<?php fetchSetting('description');?>" />
		<meta name="og:url" content="<?php echo $redirect;?>" />
		<meta name="theme-color" content="<?php fetchSetting('shareColor');?>" />
		<meta name="twitter:card" content="summary" />
		<link rel="icon" type="image/png" href="../../assets/favicon.png" />

		<link href="https://fonts.googleapis.com/css?family=Arimo:700,700italic,400,400italic,900,900italic%7CAveria+Sans+Libre:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../assets/dispatch/main.css" />
        <style>
			body {background-color: <?php echoBackGroundColor(); ?>;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include '../../assets/dispatch/header.php'; ?>
					
					<section id="home-section">
                        <div class="inner">
                            <hr id="divider13">
                            <p id="text05">Create Call</p>
                            <hr id="divider14">
                            <ul id="buttons09" class="buttons">
                                <li>
                                    <a href="/dispatch/?c=<?php echo $redirId;?>" class="button n01"><svg><use xlink:href="../../assets/icons.svg#refresh"></use></svg><span class="label">Return to Communications Panel</span></a>
                                </li>
                            </ul>
                            <p id="text27"><span><strong><span style="color: #617FE8">Call Types Key:</span></strong></span><br /><span><strong>All Call</strong> All units to respond. Code 3 resp.</span><br /><span><strong>Priority One</strong> Immediate attention. Code 3 resp.</span><br /><span><strong>Priority Two</strong> Important. Code 3 resp.</span><br /><span><strong>Priority Three</strong> Moderately important. Code 2 resp.</span><br /><span><strong>Priority Four</strong> No immediate action. Code 1 resp.</span><br /><span><strong>Traffic / Pedestrian Stop</strong> No resp.</span></p>
                            <p id="text24"><span>Communications Call</span><br /><span>#DRAFT</span></p>
                            <p id="text25"><span>Date: <?php echo date("d/m/Y"); ?></span><br /><span>Time: <?php echo date("h:i:sa"); ?></span></p>
                            <br />
                            <form enctype="multipart/form-data" id="form06" method="post" action="../../backend/createCall.php" autocomplete="off">
                                <div class="inner">
                                    <div class="field">
                                        <input type="text" id="search" placeholder="Search Unit..." onkeyup="filter()">
                                        <br />
                                        <select id="select" name="primary">
                                            <!-- <option>Select Primary Unit...</option> -->
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
                                    <div class="field">
                                        <select name="type" id="form06-call-type" required>
                                            <option value="">&ndash; Call Type &ndash;</option>
                                            <option value="All Call">All Call</option>
                                            <option value="Priority One">Priority One</option>
                                            <option value="Priority Two">Priority Two</option>
                                            <option value="Priority Three">Priority Three</option>
                                            <option value="Priority Four">Priority Four</option>
                                            <option value="Traffic / Pedestrian Stop">Traffic / Pedestrian Stop</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="location" id="form06-location" placeholder="Location" maxlength="128" required />
                                    </div>
                                    <div class="field">
                                        <textarea name="details" id="form06-call-details" placeholder="Call Details" required></textarea>
                                    </div>
                                    <input type="hidden" id="custId" name="redir" value="<?php echo $redirId;?>">
                                    <input type="hidden" id="custId2" name="serverId" value="<?php echo $serverId;?>">
                                    <div class="actions">
                                        <button type="submit">Create Call</button>
                                    </div>
                                </div>
                            </form>
                        </div>
					</section>
					
					<?php include '../../assets/dispatch/footer.php'; ?>
				</div>
			</div>
		</div>
		<script src="../../assets/dispatch/main.js"></script>
	</body>
</html>