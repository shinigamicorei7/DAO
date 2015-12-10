<?php

require '../vendor/autoload.php';

$conn = new \ORM\Connection\Manager(array(
	"driver" => "mysql",
	"host" => "127.0.0.1",
	"user" => "root",
	"password" => "qweasd123!",
	"dbname" => "EjemploPHP",
	"charset" => "utf8",
	"options" => array()
));

$alumnos = new \ORM\Repositories\AlumnoRepository($conn);

foreach ($alumnos->all() as $alumno)
{
	var_dump($alumno);
}