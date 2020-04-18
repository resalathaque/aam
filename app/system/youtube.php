<?php

class Youtube {

	public static function search($query)
	{
		$key = 'youtube-'. Str::slug($query);

		if ( $data = Cache::make($key)->get() )
		{
			return $data;
		}

		else
		{
			if ($data = static::query($query))
			{
				Cache::make($key)->put($data);
				return $data;
			}
		}
	}

	public static function query($query)
	{
		$params = array(
			'q' => $query,
			'type' => 'video',
			'part' => 'snippet',
			'maxResults' => 2,
			'key' => 'AIzaSyDn_C6f6yeZfKFfqsxw9ew_h26KbgUtovg',
		);

		$uri = 'https://www.googleapis.com/youtube/v3/search?'. http_build_query($params);

		$json = http::get($uri);
		
		if ($data = json_decode($json))
		{
			return $data->items;
		}

		return [];
	}
}

?>