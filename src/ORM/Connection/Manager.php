<?php namespace ORM\Connection;


use PDO;
use PDOException;

class Manager
{
	protected static $conn = null;
	protected $params;

	/**
	 * Manager constructor.
	 * @param array $params
	 */
	public function __construct(array $params)
	{
		$this->params = $params;
	}

	/**
	 * @return PDO
	 */
	public function getConnection()
	{
		if (is_null(self::$conn))
		{
			try
			{
				$dsn = sprintf('%s:host=%s;dbname=%s;charset=%s', $this->params['driver'], $this->params['host'], $this->params['dbname'], $this->params['charset']);
				$user = $this->params['user'];
				$password = $this->params['password'];
				$options = $this->params['options'];
				self::$conn = new PDO($dsn, $user, $password, $options);
			}
			catch (PDOException $ex)
			{
				echo $ex->getMessage();
				echo nl2br($ex->getTraceAsString());
				die('Error con la conección a la base de datos');
			}

			return self::$conn;
		}
	}

}