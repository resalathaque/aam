<?php

class Mp3 {
	
	public static function search($query)
	{
		'WHERE MATCH(title, album, artist) AGAINST(:query IN BOOLEAN MODE)
				ORDER BY MATCH(title, album, artist) AGAINST(:query IN BOOLEAN MODE) DESC
		';
		
		$stmt = db::prepare('
				SELECT *
				FROM data
				LIMIT 0, 25'
			);


		$stmt->execute([':query' => $query]);

		return $stmt->fetchAll();
	}
}

?>