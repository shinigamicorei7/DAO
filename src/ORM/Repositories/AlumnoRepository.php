<?php namespace ORM\Repositories;


use Exception;
use ORM\Connection\Manager;
use ORM\Models\Alumno;
use PDO;

class AlumnoRepository
{
	/**
	 * @var PDO
	 */
	protected $connection;

	/**
	 * AlumnoRepository constructor.
	 * @param Manager $managerConnection
	 */
	public function __construct(Manager $managerConnection)
	{
		$this->manager = $managerConnection;
		$this->connection = $this->manager->getConnection();
	}


	/**
	 * @param $id
	 * @return Alumno
	 * @throws Exception
	 */
	public function find($id)
	{
		$ps = $this->connection->prepare("SELECT * FROM alumno WHERE codigoAlumno = ?");
		$ps->bindParam(1, $id, PDO::PARAM_STR);
		if ($ps->execute())
		{
			$ps->setFetchMode(PDO::FETCH_CLASS,Alumno::class);
			return $ps->fetch();
		}

		throw new Exception("No se encontro un alumno con este código");
	}

	/**
	 * @return Alumno[]
	 * @throws Exception
	 */
	public function all()
	{
		$st = $this->connection->query('SELECT * FROM alumno');

		if (false != $st)
		{
			return $st->fetchAll(PDO::FETCH_CLASS, Alumno::class);
		}
	}

}