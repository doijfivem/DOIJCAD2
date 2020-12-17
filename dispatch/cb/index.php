<?php
include '../../functions.php';
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!isDispatch()) {
    header('Location: /noauth');
}

if(get('id')) {
    $redirId = get('id');
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
                            <hr id="divider09">
                            <p id="text11">Create BOLO</p>
                            <hr id="divider18">
                            <ul id="buttons01" class="buttons">
                                <li>
                                    <a href="/dispatch/?c=<?php echo $redirId; ?>" class="button n01"><svg><use xlink:href="../../assets/icons.svg#refresh"></use></svg><span class="label">Return to Communications Panel</span></a>
                                </li>
                            </ul>
                            <p id="text04"><span>Create State BOLO</span><br /><span>#DRAFT</span></p>
                            <p id="text23"><span>Date: <?php echo date("d/m/Y"); ?></span><br /><span>Time: <?php echo date("h:i:sa"); ?></span></p>
                            <form enctype="multipart/form-data" id="form01" method="post" action="../../backend/createBolo.php" autocomplete="off">
                                <div class="inner">
                                    <div class="field">
                                        <textarea name="details" id="form01-bolo-details" placeholder="BOLO Details" required></textarea>
                                    </div>
                                    <input type="hidden" id="custId2" name="redir" value="<?php echo $redirId;?>">
                                    <div class="actions">
                                        <button type="submit">Submit BOLO</button>
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