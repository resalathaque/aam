<?php


class ListController {
	
	public static function getList($letter)
	{
		$data = [
			'title' => $letter .' list',
			'keywords' => Keyword::getByLetter($letter),
		];

		return View::make('desktop.list', $data);
	}
}

?>