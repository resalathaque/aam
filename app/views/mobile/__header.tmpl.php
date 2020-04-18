<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<?php if (isset($title)): ?>
		<title><?php echo e($title) ?></title>
	<?php endif ?>

	<?php if (isset($keywords)): ?>
		<meta name="keywords" content="<?php echo e($keywords) ?>">
	<?php endif ?>

	<?php if (isset($description)): ?>
		<meta name="description" content="<?php echo e($description) ?>">
	<?php endif ?>

	<link rel="canonical" href="<?php echo Request::uri() ?>"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="/assets/css/mobile.css">
</head>
<body>
	
<div class="hero">
	<a href="/">9XSongs</a>
</div>

<form action="/" method="post">
	<input type="text" name="q">
	<input type="submit" value="Search">
</form>