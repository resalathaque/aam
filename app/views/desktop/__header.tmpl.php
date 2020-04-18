<!doctype html>
<html lang="en">
<head>

	<?php if (isset($title)): ?>
		<title><?php echo e($title) ?></title>
	<?php endif ?>
	
	<?php if (isset($keyword)): ?>
		<meta name="keyword" content="<?php echo e($keywords) ?>">
	<?php endif ?>

	<?php if (isset($description)): ?>
		<meta description="<?php echo e($description) ?>">
	<?php endif ?>

	<link rel="stylesheet" href="/assets/css/pure-min.css">
	<link rel="stylesheet" href="/assets/css/style.css">

</head>
<body>
	<div class="container pure-g">
		<div class="hero pure-u-1">
			<h1>songs</h1>
		</div>
		<div class="pure-u-4-5">
			<div class="main">
	
			<form action="/" method="post" class="pure-form">
				<div class="form-group">
					<input type="text" name="q" placeholder="Search mp3 by artist or album" class="pure-u-4-5">
					<input type="submit" value="Search" class="pure-u-1-6 pure-button pure-button-primary">
				</div>
			</form>