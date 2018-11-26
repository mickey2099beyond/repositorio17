<?php
  namespace AppData\Controller;
  use AppData\Model\Acentar;
  class AcentarController
  {

    private $acentar;
    function __construct()
    {
      $this->acentar=new Acentar();
    }
    function index()
    {

      $datos=$this->acentar->getAlumns();
      return $datos;

}
 function select(){
$datos=$this->calificaciones->getMaterias();
return $datos;

 }
    function eliminar($id){
			$this->acentar->set("id",$id[0]);
			$this->acentar->delete();
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					swal({
						title: "Listo !!!!",
						text: "Se ha eliminado correctamente",
						timer: 2000
					});
					setTimeout(function(){
						window.location.href="<?php echo URL ?>Acentar/index"
					},2100);
				})
			</script>
			<?php
		}
		function get($id){
			$this->acentar->set("id",$id);
			$datos=$this->acentar->getOne();
			if(mysqli_num_rows($datos)>0){
				$datos=mysqli_fetch_assoc($datos);
			}
			echo json_encode($datos);
		}
		function edit(){
			$data=$_POST['arreglo'];
			$this->acentar->set("id",$data[0]['value']);
			$this->acentar->set("nombre_per",$data[1]['value']);
			$this->acentar->set("ap",$data[2]['value']);
			$this->acentar->set("am",$data[3]['value']);
			$this->acentar->updatePer();
      ?>
      <script type="text/javascript">
        $(document).ready(function(){
          swal({
            title: "Listo !!!!",
            text: "Se ha editado la informacion correctamente",
            timer: 2000
          });
          setTimeout(function(){
            window.location.href="<?php echo URL ?>Acentar/index"
          },2100);
        })
      </script>
      <?php
		}
    function printacentar(){
$datos[0]=$this->acentar->getmateria();
$datos[1]=$this->acentar->getgrupo();
$datos[2]=$this->acentar->getmaestro();
$datos[3]=$this->acentar->getuni();
$datos[5]=$this->acentar->getAlumns();
$datos[6]=$this->acentar->getcal();
return $datos;

    }
    function __destruct()
    {

    }
  }


 ?>
