<?php

class db {

	/**
	 * @var pdo instance
	 * @access private
	 */
	private static $instance = null;

	/**
	 * options
	 * @access private
	 */
	private static $options = array(
		PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_OBJ,
	);


	/**
	 * connect to db
	 * if not connected then connect or return previous connection
	 * 
	 * @return pdo instance
	 */
	public static function connection()
	{
		if (is_null(static::$instance))
		{
			extract(Config::database());
			
			static::$instance = new pdo($dns, $username, $password, static::$options);
		}

		return static::$instance;
	}

	/**
	 * Call PDO Methods Statically
	 * @example db::query('SELECT * FROM ....');
	 * 
	 * @return object
	 */
	public static function __callStatic($method, $params)
	{
		return call_user_func_array([static::connection(), $method], $params);
	}


	/**
	 * Count Number of colums
	 *
	 * @param table name
	 * @return int
	 */
	public static function count($table)
	{
		return static::query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
	}


	/**
	 * Insert
	 *
	 * @param string table name
	 * @param array data
	 *
	 * @return int auto increment value on success
	 */
	public static function insert($table, $data)
	{
		$keys = join(', ', array_keys($data));
		$holders = trim(str_repeat('?, ', count($data)), ', ');

		static::prepare("INSERT INTO {$table} ({$keys}) VALUES ({$holders})")
			->execute(array_values($data));

		return static::lastInsertId();
	}

	/**
	 * Fetch all
	 *
	 * @param string table name
	 */
	public static function all($table)
	{
		$stmt = static::query("SELECT * FROM `{$table}`");

		return $stmt->fetchAll();
	}

	/**
	 * Find by id
	 *
	 * @param string table name
	 * @param int id
	 *
	 * @return obj
	 */
	public static function find($table, $id)
	{
		$stmt	= static::prepare("SELECT * FROM {$table} WHERE id = ? LIMIT 1");
		$stmt->execute([$id]);
		return $stmt->fetch();
	}

	/**
	 * Delete by id
	 *
	 * @param string table name
	 * @param int id
	 */
	public static function delete($table, $id)
	{
		return static::prepare("DELETE FROM {$table} WHERE id = ?")
			->execute([$id]);
	}

	public static function increment($table, $field, $id)
	{
		return static::prepare("
			UPDATE `{$table}`
			SET {$field} = {$field} + 1
			WHERE id = ?")
			->execute([$id]);
	}
}

?>