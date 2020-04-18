<?php include '__header.tmpl.php'; ?>

<h2><?php echo $title ?></h2>

<ul>
<?php foreach ($keywords as $keyword): ?>
	<li><a href="/<?php echo $keyword->slug ?>"><?php echo $keyword->name ?></a></li>
<?php endforeach ?>
</ul>

<?php include('__footer.tmpl.php'); ?>