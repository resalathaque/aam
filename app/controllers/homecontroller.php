<?php

class HomeController {

	/**
	 * Display Home
	 * 
	 * @return View
	 */
	public static function index()
	{
		

		$data = [
			'title' => '9xsongs.com - Free Mp3 Download',
			'description' => 'Free mp3 download',
			'keywords' => 'mp3 songs, free songs download',
			'ustops' => Topchart::usa(),
			];

		if ( Request::mobile() )
		{
			return View::make('mobile.home', $data);
		}
		else
		{
			return View::make('desktop.home', $data);
		}
	}

	/**
	 * Create Url From Search
	 *
	 * @return Response redirect
	 */
	public static function search()
	{
		// replace words to prevent duplicate url
		$query = preg_replace('#(songs|song|musics|music|mp3|download|downloads|free)#i', '', Input::get('q', ''));
		
		// create slug
		$query = Str::slug($query, '_');
		
		if (empty($query))
		{
			// redirect to home
			return Response::redirect('/');
		}

		// store keyword
		Keyword::create(ucwords(str_replace('_', ' ', $query)), $query);

		$uri = "/{$query}";
		return Response::redirect($uri);
	}
}
?>