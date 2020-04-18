<div class="pure-u-1-5">
	<div class="aside">
		
		<?php if (isset($relateds)): ?>
			<h3>Related Search</h3>
			<ul>	
				<?php foreach ($relateds as $related): ?>
				<li><a href="/<?php echo $related->slug ?>"><?php echo $related->name ?></a></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
		
		<h3>Recent Search</h3>
		<div class="recent">
			<ul>
			<?php foreach (Keyword::recent() as $keyword): ?>
				<li><a href="/<?php echo $keyword->slug ?>"><?php echo $keyword->name ?></a></li>	
			<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>