<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<url>
		<loc>{{ route('home') }}</loc>
		<changefreq>daily</changefreq>
		<priority>1.0</priority>
	</url>

	@foreach($categories as $category)
	<url>
		<loc>{{ action('CategoryController@getIndex', $category->name) }}</loc>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>
	@endforeach

	@foreach($albums as $album)
	<url>
		<loc>{{ action('AlbumController@show', [$album->category->name, $album->name]) }}</loc>
		<changefreq>monthly</changefreq>
		<priority>0.6</priority>
	</url>
	@endforeach
	
</urlset>