<?xml version='1.0' encoding='utf-8'?>
<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/siteindex.xsd">

<?php foreach(range(1, $sitemaps) as $sitemap): ?>
	<sitemap>
		<loc><?php echo Config::app('url') ."/sitemap/{$sitemap}.xml" ?></loc>
	</sitemap>
<?php endforeach ?>

</sitemapindex>