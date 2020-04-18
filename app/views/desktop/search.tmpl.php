<?php include('__header.tmpl.php') ?>

<article class="post">
	<h2><b>Results for:</b> <?php echo $query ?></h2>

	<!-- youtube results limited to 2 -->
	<?php foreach ($youtube as $u): ?>
		<div class="item pure-g">
			<div class="pure-u-1-8">
				<div class="left">
					<span>320kbps</span>
				</div>
			</div>
			<div class="pure-u-7-8">
				<div class="right">
					<p>
						<div class="title"><a target="_blank" rel="nofollow" href="http://www.fullrip.net/mp3/<?php echo $u->id->videoId ?>"><?php echo $u->snippet->title ?></a></div>
						<span><?php echo e($u->snippet->description) ?></span>
					</p>
				</div>
			</div>
		</div>
	<?php endforeach ?>

	<!-- results from mp3 database -->
	<?php foreach ($results as $result): ?>
		
		<div class="item pure-g">
			<div class="pure-u-1-8">
				<div class="left">
					<span>128kbps</span>
					<span><?php echo bytes($result->size) ?></span>
				</div>
			</div>

			<div class="pure-u-7-8">
				<div class="right">
					<p>
						<div  class="title"><a ref="nofollow" href="/get/<?php echo $result->id ?>"><?php echo e($result->title) ?></a></div>
						<?php if (!empty($result->artist)): ?>
							<span class="info"><i>Artist:</i> <?php echo e($result->artist) ?></span>
						<?php endif ?>
						<?php if (!empty($result->album)): ?>
							<span class="info"><i>Album:</i> <?php echo e($result->album) ?></span>
						<?php endif ?>
					</p>
				</div>
			</div>
		</div>

	<?php endforeach ?>
</article>

<?php include('__footer.tmpl.php') ?>