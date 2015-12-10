<?php
/**
 * Created by PhpStorm.
 * User: bvelastegui
 * Date: 10/12/15
 * Time: 14:18
 */

namespace ORM\Models;


class Alumno
{
	protected $codigoAlumno = '';
	protected $nombreAlumno = '';
	protected $apellidoAlumno = '';
	protected $cursoAlumno = '';
	protected $promedioAlumno = '';
	protected $comentarioAlumno = '';

	/**
	 * Alumno constructor.
	 * @param array $attributes
	 */
	public function __construct(array $attributes = array())
	{
		foreach ($attributes as $key => $attribute)
		{
			$this->{'set' . ucwords($key)}($attribute);
		}
	}

	/**
	 * @return mixed
	 */
	public function getCodigoAlumno()
	{
		return $this->codigoAlumno;
	}

	/**
	 * @param mixed $codigoAlumno
	 */
	public function setCodigoAlumno($codigoAlumno)
	{
		$this->codigoAlumno = $codigoAlumno;
	}

	/**
	 * @return mixed
	 */
	public function getNombreAlumno()
	{
		return $this->nombreAlumno;
	}

	/**
	 * @param mixed $nombreAlumno
	 */
	public function setNombreAlumno($nombreAlumno)
	{
		$this->nombreAlumno = $nombreAlumno;
	}

	/**
	 * @return mixed
	 */
	public function getApellidoAlumno()
	{
		return $this->apellidoAlumno;
	}

	/**
	 * @param mixed $apellidoAlumno
	 */
	public function setApellidoAlumno($apellidoAlumno)
	{
		$this->apellidoAlumno = $apellidoAlumno;
	}

	/**
	 * @return mixed
	 */
	public function getCursoAlumno()
	{
		return $this->cursoAlumno;
	}

	/**
	 * @param mixed $cursoAlumno
	 */
	public function setCursoAlumno($cursoAlumno)
	{
		$this->cursoAlumno = $cursoAlumno;
	}

	/**
	 * @return mixed
	 */
	public function getPromedioAlumno()
	{
		return $this->promedioAlumno;
	}

	/**
	 * @param mixed $promedioAlumno
	 */
	public function setPromedioAlumno($promedioAlumno)
	{
		$this->promedioAlumno = $promedioAlumno;
	}

	/**
	 * @return mixed
	 */
	public function getComentarioAlumno()
	{
		return $this->comentarioAlumno;
	}

	/**
	 * @param mixed $comentarioAlumno
	 */
	public function setComentarioAlumno($comentarioAlumno)
	{
		$this->comentarioAlumno = $comentarioAlumno;
	}


}