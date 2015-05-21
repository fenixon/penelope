<?php
  class ClaseBase{
    private $tabla;
    private $db;
    private $conectar;
    private $modelo;
    private $errores;

    public function __autoload($class) {
      print "autoloading $class\n";
      require_once($class.'.php');
    }

    public function __construct($tabla) {
      $this->tabla=(string) $tabla;
      $this->db=DB::conexion();
      $this->modelo=get_class($this);
      $this->errores=array();
    }

    public function getDB(){
      return $this->db;
    }

    public function getErrores() {
      return $this->errores;
    }

    public function addError($campo, $error) {
      if (!isset($this->errores[$campo])) {
        $this->errores[$campo]=array();
      }

      array_push($this->errores[$campo], $error);
    }

    //Funciones comunes a todas las clases
    public function getListado(){
      $sql="select * from $this->tabla ";
      $resultados=array();

      $resultado =$this->getDB()->query($sql)
        or die ("Fallo en la consulta");

      while ( $fila = $resultado->fetch_object() ) {
        $objeto= new $this->modelo($fila);
        $resultados[]=$objeto;
      }
      return $resultados;
    }

    public function obtenerPorId($id){
      $sql="select * from $this->tabla where id=$id ";
      $res=NULL;
      $resultado =$this->getDB()->query($sql)
        or die ("Fallo en la consulta");

      if($fila = $resultado->fetch_object()) {
        $res= new $this->modelo($fila);
      }
      return $res;
    }

    public function borrar($id){
      $sql="DELETE FROM $this->tabla WHERE id=$id ";
      $resultado =$this->getDB()->query($sql);
      $res=false;

      if($this->getDB()->affected_rows>0){
        $res=true;
      }

      return $res;
    }
}
?>

