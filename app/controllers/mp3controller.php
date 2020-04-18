<?php

class Mp3Controller {
	
	public static function result($query)
	{
		$query = ucwords(str_replace('_', ' ', $query));
		$results = Mp3::search($query);
		$youtube = Youtube::search($query);

		$data = [
			'title' => $query . ' - Free Mp3 Download',
			'description' => $query,
			'keywords' => $query,
			'query' => $query,
			'results' => $results,
			'youtube' => $youtube,
			'relateds' => Keyword::related($query),
			];

		if ( Request::mobile() )
		{
			return View::make('mobile.search', $data);
		}
		else
		{
			return View::make('desktop.search', $data);
		}
	}

	/**
	 * Show
	 *
	 * @param int $id
	 * @return View
	 */
	public static function getById($id)
	{
		if (!$mp3 = db::find('mp3', $id))
		{
			return App::abort(404);
		}

		$data = [
			'title' => $mp3->title .' - mp3 Download',
			'mp3'	=> $mp3,
			];

		if ( Request::mobile() )
		{
			return View::make('mobile.get', $data);
		}
		else
		{
			return View::make('desktop.get', $data);
		}
	}

	public static function download($id)
	{
		if ( $mp3 = db::find('mp3', $id) )
		{
			// incremant hits
			db::increment('mp3', 'size', $mp3->id);

			return Response::redirect($mp3->url);
		}

		return App::abort(404);
	}
}
?>