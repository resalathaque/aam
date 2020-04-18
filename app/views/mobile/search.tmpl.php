<?php include '__header.tmpl.php'; ?>

<div class="item">
	<ul>
	<?php foreach($results as $result): ?>
		<li>
			<a href="/get/<?php echo $result->id ?>"><?php echo $result->title ?></a>
			<i>Artist:</i> <?php echo $result->artist ?>
			<i>Album:</i> <?php echo $result->album ?>
		</li>

	<?php endforeach ?>
	</ul>
</div>
<?php include '__footer.tmpl.php'; ?>
