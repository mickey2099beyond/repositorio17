<?php namespace AppData\Model;
class Login
{
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $edad;
    private $id_sexo;
    private $id_tipo_usuario;
    private $id_usuario;
    private $usuario;
    private $contraseña;
    private $id_tipo;
    private $conexion;
    private $password;
    private $nickname;
    function __construct()
    {
        $this->conexion=new conexion();

    }
    public function set($atributo,$valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }
    public function verify(){
        $sql="SELECT u.id_usuario, p.nombre, p.ap_p, p.ap_m, u.id_tipo_usuario,p.id_persona
          FROM persona p, usuario u, sexo s, tipo_usuario tu
          WHERE u.nickname='{$this->usuario}'
            AND u.password='{$this->contraseña}'
            AND p.id_usuario=u.id_usuario
            AND u.id_tipo_usuario=tu.id_tipo_usuario
            AND p.id_sexo=s.id_sexo";
        $dato=$this->conexion->QueryResultado($sql);
        return $dato;

        /*
        if(isset($_POST)){
        $this->login->set("usuario".$_POST[usuario]);
        $this->login->set("password".$_POST[password]);
        $datos=$this->login->verify();
        if(mysqli_num_rows($datos)>0){
$_SESSION["nombre"]=$datos["nombre"]."".$datos["ap"]."".$datos["am"];
$_SESSION["id_tipo_usuario"]=$datos['id_tipo_usuario'];
$_SESSION['id_persona']=$datos['id_persona'];

}else{

$_SESSION["error_login"]="Los datos introducidos son incorrectos,favor de verificar";
}?>
<script type="text/javascript">
window.location href="<?php echo URL?>";
</script>
<?php


      }
public function verify(){

$sql="SELECT p.id_persona,p.nombre,p.ap,p.am FROM usuarios u,personas p";
$dato=$this->conexion->QueryResultado($sql);
return $datos;
}
        */
    }

    public function registar(){

    }
    public function guardar(){
        $slq="INSERT INTO usuario (nickname, password, id_tipo_usuario) VALUES ('{$this->nickname}','{$this->password}','{$this->id_tipo_usuario}')";
        $this->conexion->QuerySimple($slq);
        $sql="SELECT * FROM usuario WHERE nickname='{$this->nickname}' AND password='{$this->password}'";
        $dato=$this->conexion->QueryResultado($sql);
        //var_dump($dato);
        //print_r($dato);
        if (mysqli_num_rows($dato) > 0) {
            $datos=mysqli_fetch_assoc($dato);
        }
        if(isset($datos['id_usuario'])){

            $sql="INSERT INTO persona(nombre, ap_p, ap_m, edad, id_sexo, id_usuario) VALUES ('{$this->nombre}','{$this->ap_p}','{$this->ap_m}','{$this->edad}','{$this->id_sexo}','{$datos['id_usuario']}')";
            $this->conexion->QuerySimple($sql);
        }
    }
    public function getSex(){
        $sql="SELECT * FROM sexo";
        $datos=$this->conexion->QueryResultado($sql);
        return $datos;
    }

    public function getUser(){
        $sql="SELECT * FROM tipo_usuario";
        $datos=$this->conexion->QueryResultado($sql);
        return $datos;
    }

}
?>
