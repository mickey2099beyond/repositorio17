<?php
    namespace AppData\Model;
    class Acentar
      {

	     	private $id,$nombre_per,$ap,$am;
        function __construct()
        {
          $this->conexion=new conexion();
        }
        public function set($atributo,$valor)
        {
          $this->$atributo=$valor;
        }
        public function get($atributo)
        {
          return $this->$atributo;
        }

        public function getAlumns(){
          $sql="SELECT c.calificacion, p.id_persona, u.id_usuario, p.nombre_per, p.ap, p.am FROM
           calificaciones c, personas p, usuarios u
           WHERE p.id_persona=u.id_usuario
           AND u.id_tusuario= 1
           AND p.id_persona=c.id_persona
           ORDER BY p.ap ASC";
          // $sql="SELECT u.id_usuario, p.nombre, p.ap_p, p.ap_m FROM persona p, usuario u WHERE p.id_usuario=u.id_usuario AND u.id_tipo_usuario=1 ORDER by p.ap_p ASC";
          // echo $sql;
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }
        public function getcal(){
          $sql="SELECT c.calificacion, p.id_persona, u.id_usuario, p.nombre_per, p.ap, p.am
           FROM calificaciones c, personas p, usuarios u
           WHERE p.id_persona=u.id_usuario
           AND u.id_tusuario= 1
            AND p.id_persona=c.id_persona
            ORDER BY p.ap ASC";
          // $sql="SELECT u.id_usuario, p.nombre, p.ap_p, p.ap_m FROM persona p, usuario u WHERE p.id_usuario=u.id_usuario AND u.id_tipo_usuario=1 ORDER by p.ap_p ASC";
          // echo $sql;
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }
        public function getmateria(){
          $sql="SELECT p.nombre_per, p.ap, p.am, m.desc_materia, g.desc_grupo
           FROM personas p, materias m, grupos g, asigna_mat a
           WHERE p.id_persona=a.id_persona
            AND m.id_materia=a.id_materia
            AND g.id_grupo=a.id_grupo
            AND p.id_usuario=2";
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }
        public function getgrupo(){
          $sql="SELECT p.nombre_per, p.ap, p.am, m.desc_materia, g.desc_grupo
          FROM personas p, materias m, grupos g, asigna_mat a
          WHERE p.id_persona=a.id_persona
          AND m.id_materia=a.id_materia
          AND g.id_grupo=a.id_grupo
          AND p.id_usuario=2";
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }
        public function getmaestro(){
          $sql="SELECT p.nombre_per, p.ap, p.am, m.desc_materia, g.desc_grupo
           FROM personas p, materias m, grupos g, asigna_mat a
           WHERE p.id_persona=a.id_persona
            AND m.id_materia=a.id_materia
            AND g.id_grupo=a.id_grupo
            AND p.id_usuario=2";
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }
        public function getuni(){
          $sql="SELECT  m.desc_materia, m.no_unidades
          from materias m,asigna_mat a, personas p, grupos g
           WHERE m.id_materia=a.id_materia
           AND p.id_persona=a.id_persona
            AND g.id_grupo=a.id_grupo";
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }
        public function getcali(){
          // $sql="SELECT c.calificacion FROM calificaciones c, persona p WHERE p.id_persona=c.id_persona ";
          // $sql="SELECT u.id_usuario, p.nombre, p.ap_p, p.ap_m FROM persona p, usuario u WHERE p.id_usuario=u.id_usuario AND u.id_tipo_usuario=1 ORDER by p.ap_p ASC";
          // echo $sql;
          $datos=$this->conexion->QueryResultado($sql);
          return $datos;
        }

        public function getOne(){
    $sql="SELECT u.id_usuario, p.nombre, p.ap, p.am
          FROM personas p, usuarios u
          WHERE p.id_usuario=u.id_usuario
          AND u.id_tusuario=1
          AND p.id_usuario='{$this->id_usuario}'
          ORDER BY p.ap ASC";
    $datos=$this->conexion->QueryResultado($sql);
    return $datos;
  }

        public function getunidad1(){
          $sql="SELECT c.calificacion
          FROM calificaciones c
          WHERE c.calificacion  ";
          //echo $sql;
        //  $datos=$this->conexion->QueryResultado($sql);
          //return $datos;
          $this->conexion->QuerySimple($sql);


        }
        public function delete(){
			$sql="DELETE FROM usuarios
			WHERE id_usuario='{$this->id[0]}'";
			$this->conexion->QuerySimple($sql);
			$sql="DELETE FROM personas
			WHERE id_usuario='{$this->id[0]}'";
			$this->conexion->QuerySimple($sql);
		}
        public function updatePer(){
    $sql="UPDATE personas SET nombre_per='{$this->nombre}', ap='{$this->ap}', am='{$this->am}' WHERE id_usuario='$this->id'";
    $this->conexion->QuerySimple($sql);
  }
  public function generalData(){

$sql="SELECT p.nombre, p.ap, p.am,m.desc_materia,g.desc_grupo,m.no_unidades
      FROM personas p,materias m,grupos g,asigna_mat am, usuarios u
      WHERE p.id_persona=am.id_persona
      AND m.id_materia=am.id_materia
      AND g.id_grupo=am.id_grupo";
      $this->conexion->QuerySimple($sql);
      return $datos;

  }
  public function calificacionesh(){

    $datos[0]=mysqli_fetch_assoc($this->reportes->getAlums());
    $datos[1]=$this->reportes->getAlums();
  }
  public function getMateriash(){

    $sql="SELECT p.nombre, p.ap, p.am,m.desc_materia,g.desc_grupo,m.no_unidades
          FROM personas p,materias m,grupos g,asigna_mat am, usuarios u
          WHERE p.id_persona=am.id_persona
          AND m.id_materia=am.id_materia
          AND g.id_grupo=am.id_grupo
          AND p.id_persona='{$_SESSION['id_persona']}' ";

          $this->conexion->QuerySimple($sql);
          return $datos;
  }
}

 ?>
