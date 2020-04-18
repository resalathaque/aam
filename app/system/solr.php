<?php

class Solr {
	
	protected static $instance = null;

	static function connection()
	{
		if (is_null(static::$instance))
		{
			static::$instance = new SolrClient(Config::solr());
		}

		return static::$instance;
	}

	function search($key)
	{
		$query = new SolrQeury();
		$query->setQuery($key);

		$query->setStart(0);
		$query->setRows(20);

		$query->addField('title')->addField('artist')->addField('album');

		$queryResponse = static::connection()->query($query);

		return $queryResponse->getResponse();
	}

	static function add()
	{
		$doc = new SolrInputDocument;

		$doc->addField('name', 'kiash');

		$response = static::connection()->addDocument($doc);
		$r = $response->getResponse();
		static::connection()->commit();

		return $r;
	}
}

?>