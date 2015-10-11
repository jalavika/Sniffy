<?php 
include('library.php');
$Object = new Object(3485);
?>
<HTML>
<head>
	<title>Dofus - <?= $Object->name(); ?></title>
</head>
<body>
	<h3><?= $Object->name(); ?></h3>
	<h5>Niv. <?= $Object->level(); ?> - Type : <?= $Object->type(); ?></h5>
	<h6>GFX : <?= $Object->gfx(); ?></h6>
	<p><?= $Object->desc(); ?></p>
	<h5>Effets</h5>
	<?= $Object->effects_string(); ?>
	<h5>Encoded effects</h5>
	<?= $Object->effects_encode(); ?>
	<br>
	<p>Ligne SQL</p>
	<textarea style="width:700px;height:100px">INSERT INTO item_template (`id`, `name`, `type`, `level`, `statsTemplate`) VALUES (, , , , );</textarea><br/>
	<p>Ligne SWF</p>
	<textarea style="width:700px;height:100px">I.u[] = {p: 1, w: 0, fm: true, wd: true, l: , g: , ep: 0, d: "", t: , n: ""};</textarea>
</body>
</HTML>