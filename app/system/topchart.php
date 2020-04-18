<?php

class Topchart {
	
	public static function usa()
	{
		$topchart = array();

		$json = http::get('https://itunes.apple.com/us/rss/topsongs/limit=12/json');

		if ($data = json_decode($json))
		{
			foreach ($data->feed->entry as $entry)
			{
				$topchart[] = [
					'title' => @$entry->{'im:name'}->label,
					'thumb' => @$entry->{'im:image'}[2]->label,
					];
			}
		}

		return $topchart;
	}
}
?>