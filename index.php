<?php include('library.php'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Item Sniffer - Synth</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="icon" type="image/x-icon" href="images/favicon.ico"/>
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<header id="header">
			<h1>Item Sniffer</h1>
			<p>Sniffer d'item sur le fansite DofusBook, compatible Dofus 1.29.</p>
		</header>
		<form id="signup-form" method="post" action="">
			<input type="text" name="id" placeholder="Id de l'item" /><br>
			<input type="text" name="idd" placeholder="Id souhaité pour l'item" />
			<input type="submit" value="Sniffer" name="confirm" />
		</form>
		<?php if(isset($_POST['confirm'])){
			$Object = new Object($_POST['id']);
		?>
		<p>Ligne SQL :</p>
		<textarea style="width:700px;height:100px">INSERT INTO item_template (`id`, `name`, `type`, `level`, `statsTemplate`) VALUES (<?= $_POST['idd']; ?>, <?= addslashes($Object->name()); ?>, <?= $Object->type(); ?>, <?= $Object->level(); ?>, <?= $Object->effects_encode(); ?>);</textarea><br/>
		<p>Ligne SWF :</p>
		<textarea style="width:700px;height:100px">I.u[<?= $_POST['idd']; ?>] = {p: 1, w: 0, fm: true, wd: true, l: <?= $Object->level(); ?>, g: <?= $Object->gfx(); ?>, ep: 0, d: "<?= addslashes($Object->desc()); ?>", t: <?= $Object->type(); ?>, n: "<?= addslashes($Object->name()); ?>"};</textarea>
		<?php } ?>
		<footer id="footer">
			<ul class="icons">
				<li><a href="https://github.com/Synthx/Item-Sniffer" class="icon fa-github" target="_blank"><span class="label">GitHub</span></a></li>
			</ul>
			<ul class="copyright">
				<li>&copy; Synth.</li>
			</ul>
		</footer>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>
	</body>
</html>