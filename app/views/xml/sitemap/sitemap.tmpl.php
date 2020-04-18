<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<?php foreach($keywords as $keyword): ?>
	<url>
		<loc><?php echo Config::app('url') . "/{$keyword->slug}.html" ?></loc>
		<changefreq>monthly</changefreq>
		<priority>0.4</priority>
	</url>
	<?php endforeach; ?>
	
</urlset>