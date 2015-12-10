<?php

use ORM\Connection\Manager;
use ORM\Models\Alumno;
use ORM\Repositories\AlumnoRepository;

require '../vendor/autoload.php';

$conn = new Manager(array(
	"driver" => "mysql",
	"host" => "127.0.0.1",
	"user" => "root",
	"password" => "qweasd123!",
	"dbname" => "EjemploPHP",
	"charset" => "utf8",
	"options" => array()
));

$alumnos = new AlumnoRepository($conn);

/**
 * Aqui traemos todos los alumno ingresados en nuestra tabla
 */
if ($todos = $alumnos->todos())
{
	echo '<h1>Todos los Alumnos</h1>';
	foreach ($todos as $alumno)
	{
		echo '<pre>';
		var_dump($alumno);
		echo '</pre>';
	}
}

/**
 * Aqui buscamos 1 solo alumno por su PK que es codigoAlumno
 */
if ($alumno = $alumnos->buscar("000001"))
{
	echo '<h1>El alumno con el codigo: 000001</h1>';
	echo '<pre>';
	var_dump($alumno);
	echo '</pre>';

	$alumno->setComentarioAlumno('Acavo de actualizar este alumno');
	if ($alumno = $alumnos->actualizar($alumno))
	{
		echo '<h1>Actualizamos al alumno con el codigo: 000001</h1>';
		echo '<pre>';
		var_dump($alumno);
		echo '</pre>';
	}
}


if (false === $alumnos->buscar('000002'))
{
	echo '<h1>Se crea un alumno usando el modelo Alumno</h1>';
	/**
	 * Creamos un usuario usando el Modelo
	 */
	$alumno = new Alumno();
	$alumno->setCodigoAlumno('000002');
	$alumno->setNombreAlumno('Joel');
	$alumno->setApellidoAlumno('Velastegui');
	$alumno->setCursoAlumno('4EGB-C');
	$alumno->setPromedioAlumno('15');
	echo '<pre>';
	var_dump($alumnos->crear($alumno));
	echo '</pre>';
}

if (false === $alumnos->buscar('000003'))
{
	echo '<h1>Se crea un alumno usando un arreglo</h1>';
	/**
	 * Creamos un usuario usando un arreglo
	 */
	$alumno = array(
		'codigoAlumno' => '000003',
		'nombreAlumno' => 'Prueba'
	);
	echo '<pre>';
	var_dump($alumnos->crear($alumno));
	echo '</pre>';
}