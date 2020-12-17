<style>
#dividerFoot {
	height: 1.125rem;
	line-height: 1.125rem;
}

#dividerFoot:before {
	width: 2%;
	border-top: solid 1px transparent;
	height: 1px;
}

#footerTextGlobal {
	text-align: center;
	color: #DCDDDE;
	font-family: 'Arimo', sans-serif;
	font-size: 0.5em;
	line-height: 1.5;
	font-weight: 400;
}
</style>

<footer id="footer">
    <hr id="dividerFoot">
    <p id="footerTextGlobal">&copy; <?php echo date("Y"); ?>, <?php fetchSetting('name');?></p>
</footer>
<!-- © -->