<?php

class SitemapController {
	
	/**
	 * Show Sitemap Index
	 *
	 * @return response
	 */	
	public static function index()
	{
		$total = db::count('keywords');
		$sitemaps = ceil($total / Config::sitemap('limit'));

		$content = View::make('xml.sitemap.index', compact('sitemaps'))->publish();
		
		return Response::make($content, 200, ['Content-type' => 'application/xml'])->send();
	}

	/**
	 * Generate sitemap with range
	 *
	 * @param int $page
	 * @return Response
	 */
	public static function sitemap($page)
	{
		$limit = Config::sitemap('limit');
		
		// get range
		$page = (int) $page;
		$offset = ($page - 1) * $limit;

		// get keywords
		$keywords = Keyword::range($offset, $limit);

		// echo out custom XML response
		$contnet = View::make('xml.sitemap.sitemap', compact('keywords'))->publish();

		return Response::make($contnet, 200, ['Content-type' => 'application/xml'])->send();
	}
}

?>