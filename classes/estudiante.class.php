<?php
require ("classes/conn.class.php");
require ("classes/validaciones.inc.php");

class Estudiante
{
    public $idestudiante;
    public $fechanacimiento;
    public $estadoregistroestudiante;
    public $idgenero;
    public $conexion;
    public $validacion;
    

    public function _construct()
    {
        $this->conexion = new DB();
        $this->validacion = new Validaciones();
    }

    public function setIdEstudiante($idestudiante)
    {
        $this->idestudiante = $idestudiante;
    }

    public function getIdEstudiante($idestudiante)
    {
       return $this->idestudiante;
    }

    public function setFechaNacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;
    }

    public function getFechaNacimiento($fechanacimiento)
    {
       return $this->fechanacimiento;
    }

    public function setEstadoRegistroEstudiante($estadoregistroestudiante)
    {
        $this->estadoregistroestudiante = $estadoregistroestudiante;
    }

    public function getEstadoRegistroEstudiante($estadoregistroestudiante)
    {
       return $this->estadoregistroestudiante;
    }

    public function setIdGenero($idgenero)
    {
        $this->idgenero = $idgenero;
    }

    public function getIdGenero($idgenero)
    {
       return $this->idgenero;
    }

    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getConexion($conexion)
    {
       return $this->conexion;
    }


    //Metodo para obtener todos los estudiantes

    public function obtenerEstudiantes()
    {
        $resultado = $this -> conexion -> run('SELECT*FROM estudiante;');
        $array = array("mensaje"=>"Registros encontrados", "data"=>$resultado->fetchAll());
    }

    //Metodo para obtener un estudiante
    public function obtenerEstudiante(int $idestudiante)
    {
        if($idestudiante >0)
        {
        $resultado = $this->conexion->run('SELECT*FROM estudiante WHERE id_estudiante='.$idestudiante);
        $array=array("mensaje"=>"Registros encontados", "data"=>$resultado  ->fetch());
        return $array;
    }
    else
    {
    $array=array("mensaje"=>"Registros NO encontrados, identificador incorecto","data"=>"");
    return $array;
    }
    }

    public function nuevoEstudiante($fechanacimiento,$idgenero)
    {
        if(!empty($idgenero)&& !empty($fechanacimiento))
        {
            $parametros = array(
                "fecha_nac"=>$fechanacimiento,
                "id_genero"=>$idgenero
            );
            $resultado = $this->conexion->run('INSERT INTO estudiante(fecha_nacimiento_estudiante,id_genero)VALUES(:fecha_nac,:id_genero);',$parametros);
            if($this->conexion->n > 0 and $this->conexion->id > 0)
            {
                $resultado = $this->obtenerEstudiante($this->conexion->id);
                $array = array("mensaje"=>"Registos encontrados","data"=>$resultado["data"]);
                return  $array;
            }
            else
            {
                $array = array("mensaje"=>"hubo un problema al registar el estudiante", "data"=>"");
                return $array;
            }
        }
            else {
                $array = array("mensaje"=>"parametros enviados vacios","data"=>"");
                return $array;
            }
        }

    }

?>