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
	 * @return Alumno|bool
	 * @throws Exception
	 */
	public function buscar($id)
	{
		$ps = $this->connection->prepare("SELECT * FROM alumno WHERE codigoAlumno = ?");
		$ps->bindParam(1, $id, PDO::PARAM_STR);
		if ($ps->execute())
		{
			$ps->setFetchMode(PDO::FETCH_CLASS, Alumno::class);
			return $ps->fetch();
		}

		return false;
	}

	/**
	 * @return Alumno[]
	 * @throws Exception
	 */
	public function todos()
	{
		$st = $this->connection->query('SELECT * FROM alumno');

		if (false != $st)
		{
			$st->setFetchMode(PDO::FETCH_CLASS, Alumno::class);
			return $st->fetchAll();
		}

		return false;
	}

	/**
	 * @param $alumno
	 * @return Alumno
	 * @throws Exception
	 */
	public function crear($alumno)
	{
		if ($alumno instanceof Alumno)
		{
			return $this->crearDesdeModelo($alumno);
		}
		elseif (is_array($alumno))
		{
			return $this->crearDesdeArreglo($alumno);
		}
		else
		{
			return false;
		}
	}

	protected function crearDesdeModelo(Alumno $alumno)
	{
		$ps = $this->connection->prepare('INSERT INTO alumno (codigoAlumno,nombreAlumno,apellidoAlumno,cursoAlumno,promedioAlumno,comentarioAlumno) VALUES (?,?,?,?,?,?)');
		$codigo = $alumno->getCodigoAlumno();
		$nombre = $alumno->getNombreAlumno();
		$apellido = $alumno->getApellidoAlumno();
		$curso = $alumno->getCursoAlumno();
		$promedio = $alumno->getPromedioAlumno();
		$comentario = $alumno->getComentarioAlumno();
		$ps->bindParam(1, $codigo, PDO::PARAM_STR);
		$ps->bindParam(2, $nombre, PDO::PARAM_STR);
		$ps->bindParam(3, $apellido, PDO::PARAM_STR);
		$ps->bindParam(4, $curso, PDO::PARAM_STR);
		$ps->bindParam(5, $promedio, PDO::PARAM_STR);
		$ps->bindParam(6, $comentario, PDO::PARAM_STR);

		if ($ps->execute())
		{
			return $this->buscar($alumno->getCodigoAlumno());
		}

		return false;
	}

	protected function crearDesdeArreglo(array $alumno)
	{
		if (array_key_exists('codigoAlumno', $alumno))
		{
			$alumno = new Alumno($alumno);
			return $this->crearDesdeModelo($alumno);
		}

		return false;
	}

	public function actualizar(Alumno $alumno)
	{
		$ps = $this->connection->prepare('UPDATE alumno SET nombreAlumno = ?, apellidoAlumno = ?, cursoAlumno = ?, promedioAlumno = ?,comentarioAlumno = ? WHERE codigoAlumno = ?');

		$codigo = $alumno->getCodigoAlumno();
		$nombre = $alumno->getNombreAlumno();
		$apellido = $alumno->getApellidoAlumno();
		$curso = $alumno->getCursoAlumno();
		$promedio = $alumno->getPromedioAlumno();
		$comentario = $alumno->getComentarioAlumno();
		$ps->bindParam(1, $nombre, PDO::PARAM_STR);
		$ps->bindParam(2, $apellido, PDO::PARAM_STR);
		$ps->bindParam(3, $curso, PDO::PARAM_STR);
		$ps->bindParam(4, $promedio, PDO::PARAM_STR);
		$ps->bindParam(5, $comentario, PDO::PARAM_STR);
		$ps->bindParam(6, $codigo, PDO::PARAM_STR);

		if ($ps->execute())
		{
			return $this->buscar($alumno->getCodigoAlumno());
		}

		return false;
	}

}