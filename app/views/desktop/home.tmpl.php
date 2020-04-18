<?php include '__header.tmpl.php'; ?>

<?php foreach ($ustops as $ustop): ?>
	
	<div class="topcharts">
		<a href="/<?php echo Str::slug($ustop['title'], '_') ?>">
			<img src="<?php echo $ustop['thumb'] ?>" alt="<?php echo $ustop['title'] ?>" title="<?php echo $ustop['title'] ?>">
		</a>
	</div>
	
<?php endforeach ?>

<?php include('__footer.tmpl.php'); ?>