<?php include('__header.tmpl.php') ?>

<div class="download">
	<h3><?php echo "{$mp3->title} - {$mp3->artist}"  ?></h3>
	<a href="/load/<?php echo $mp3->id ?>" class="pure-u-1-2 pure-button pure-button-primary">Download</a>
</div>

<?php include('__footer.tmpl.php') ?>