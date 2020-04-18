<?php

class Keyword {

	/**
	 * Create new unique keyword
	 */
	public static function create($name, $slug)
	{
		$stmt = db::prepare('
			INSERT INTO keywords
			(name, slug)
			VALUES (:name, :slug)
			ON DUPLICATE KEY
			UPDATE slug = :slug'
		);

		$stmt->execute([':name' => $name, ':slug' => $slug]);

		return db::lastInsertId();
	}

	/**
	 * Get keywords by range (for sitemap)
	 */
	public static function range($offset, $limit = 20000)
	{
		$stmt = db::prepare('
			SELECT slug
			FROM keywords
			LIMIT :limit
			OFFSET :offset');

		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		
		return $stmt->fetchAll();
	}

	/**
	 * Get related keywords
	 */
	public static function related($query)
	{
		$stmt = db::prepare('
			SELECT *
			FROM keywords
			WHERE name LIKE ?
			LIMIT 20');

		$stmt->execute( [$query] );

		return $stmt->fetchAll();
	}

	/**
	 * Get recent keywords
	 */
	public static function recent()
	{
		$stmt = db::query('
			SELECT *
			FROM keywords
			ORDER BY id DESC
			LIMIT 20');

		return $stmt->fetchAll();

	}

	/**
	 * get keywords by letter (for making list)
	 */
	public static function getByLetter($letter)
	{
		$stmt = db::prepare('
			SELECT *
			FROM keywords
			WHERE name LIKE :letter
			ORDER BY name
			LIMIT 500');

		$stmt->execute([':letter' => $letter .'%' ]);
		return $stmt->fetchAll();
	}

}
?>