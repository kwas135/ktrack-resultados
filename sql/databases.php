<?php
	
	class Database{
		private $con;
		private $dbhost="localhost";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="ktrack";
		function __construct(){
			$this->connect_db();
		}
		public function connect_db(){
			$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
		}
		
		public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
		public function create($numero,$tag,$nombre,$equipo,$categoria,$vueltas,$ciudad,$telefono,$email){
			$sql = "INSERT INTO `tregistro` (numero, tag, nombre, equipo, categoria,vueltas,ciudad,telefono,email) VALUES ('$numero','$tag','$nombre','$equipo','$categoria','$vueltas','$ciudad','$telefono','$email')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function read(){
			$sql = "SELECT DISTINCT categoria,salida FROM tsalidas ORDER BY  categoria ASC, nombre asc";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function readctiempo1(){
			$sql = "SELECT numero FROM(SELECT numero,marcaje FROM finonza ORDER BY marcaje desc LIMIT 6) T1 ORDER BY marcaje";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function readctiempo(){
			$sql = "select tregistro.numero,tregistro.nombre,tregistro.equipo,tregistro.categoria,tsalidas.salida,tsalidas.marcaje,tsalidas.total from tregistro inner join tsalidas on tsalidas.numero=tregistro.numero WHERE registrado='no' ORDER BY tregistro.categoria ASC";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		
		public function read2(){
			$sql = "SELECT  DISTINCT categoria FROM tregistro WHERE inicio='si' ORDER BY  categoria ASC, nombre asc";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function read3(){
			$sql = "SELECT * FROM tregistro WHERE inicio='si' ORDER BY categoria ASC, numero ASC";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
                
                public function read4(){
			$sql = "SELECT * FROM tregistro WHERE inicio='no'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
                 public function read5(){
			$sql = "SELECT * FROM tregistro WHERE inicio='no'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
                public function read6(){
			$sql = "SELECT numero, nombre, email, categoria FROM tregistro Order By categoria";
                        $res = mysql_free_result($this->con, $sql);
			return  $res ;
		}
		public function imprimir(){
			$sql = "SELECT @lugar := case when @categoria=categoria then @lugar+1 ELSE @lugar := 1
END AS lugar,numero, @categoria := categoria AS c, nombre,equipo,ciudad,vueltas,TIEMPOS,TotalHoras
FROM
(SELECT @lugar:=0)i,
(SELECT finonza.numero,@categoria:=categoria as categoria,nombre,equipo,ciudad,count(finonza.numero)as vueltas,
GROUP_CONCAT(finonza.total ORDER BY finonza.vuelt  ASC SEPARATOR '--|--')as TIEMPOS,
SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(marcaje, salida))))as TotalHoras
 FROM tregistro inner JOIN finonza ON finonza.numero=tregistro.numero 
GROUP BY numero ORDER BY  tregistro.categoria ,`vueltas` desc, `TotalHoras`)tt
 ";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		
		
		public function single_record($idregistro){
			$sql = "SELECT * FROM tregistro where idtreg='$idregistro'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}
		public function update($idregistro,$numero,$tag,$nombre,$equipo,$categoria,$ciudad,$telefono,$email,$inicio,$vueltas){
			$sql = "UPDATE tregistro SET idtreg='$idregistro', numero='$numero',tag='$tag',nombre='$nombre',equipo='$equipo',categoria='$categoria',ciudad='$ciudad',telefono='$telefono',email='$email', inicio='$inicio',vueltas='$vueltas' WHERE idtreg='$idregistro'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
                               

			}else{
				return false;
			}
		}
		public function itiempos($categoria){
			$sql = "INSERT INTO `tsalida` (numero,categoria)
SELECT numero,categoria FROM `tregistro`  WHERE categoria='$categoria'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
					echo "Error al registrar el tiempo";
				return false;
			}
		}
		public function delete($idregistro){
			$sql = "DELETE FROM tregistro WHERE idtreg=$idregistro";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
					echo "Error al eliminar el registro";
				return false;
			}
		}
                public function agregar($numero){
			$sql = "UPDATE tregistro SET inicio = '0' WHERE numero=$numero";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
					echo "Error al insertar registro";
				return false;
			}
		}
	}
	
	

?>	

