<?php include '__header.tmpl.php'; ?>

<?php echo e($mp3->title) ?>
<?php echo e($mp3->artist) ?>

<?php echo $mp3->size ?>

<a href="<?php echo $mp3->url ?>">Download</a>

<?php include '__footer.tmpl.php'; ?>
