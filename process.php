<?php

require("classes/estudiante.class.php");

$Estudiante = new Estudiante();

$resultado = $Estudiante->obtenerEstudiantes();

header("Content-Type: Application/json");
echo(json_encode($resultado));




?>