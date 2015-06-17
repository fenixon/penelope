<?php
  /**
  * --------------
  * Tabla eventos:
  * --------------
  * id           int(11)
  * creador      int(11)
  * locacion     int(11)
  * asistencia   int(11)
  * puntaje      int(11)
  * titulo       varchar(50)
  * comienzo     date
  * fin          date
  * descripcion  varchar(140)
  */
  class Evento extends ClaseBase {
    private $id;
    private $id_creador;
    private $id_locacion;
    private $asistencia;
    private $puntaje;
    private $titulo;
    private $comienzo;
    private $fin;
    private $descripcion;

    public function __construct($params=NULL) {
      parent::__construct("eventos");

      if (isset($params)) {
        foreach ($params as $key=>$value) {
          //Con esto nos aseguramos de que corran las validaciones necesarias.
          //La contra es que vamos a tener que nombrar a todos los
          //setters 'set...' y a los getters 'get...'
          if (property_exists(get_class($this), $key)) {
            $atributo='';
            $key=strtolower($key);
            $piezas_atributo=explode('_', $key);

            foreach ($piezas_atributo as $pieza) {
              $atributo.=ucfirst($pieza);
            }

            $metodo="set$atributo";
            $this->$metodo($value);
          }
        }
      }

      if (!isset($this->id)) {
        $this->id=-1;
      }
    }

    //=========================================================================
    // Getters
    //=========================================================================
    public function getId() {
      return $this->id;
    }

    public function getIdCreador() {
      return $this->id_creador;
    }

    public function getIdLocacion() {
      return $this->id_locacion;
    }

    public function getAsistencia() {
      return $this->asistencia;
    }

    public function getPuntaje() {
      return $this->puntaje;
    }

    public function getTitulo() {
      return $this->titulo;
    }

    public function getComienzo() {
      return $this->comienzo;
    }

    public function getFin() {
      return $this->fin;
    }

    public function getDescripcion() {
      return $this->descripcion;
    }

    //-------------------------------------------------------------------------
    public static function getEventos($max=10, $offset=0) {
      $sql="SELECT * FROM eventos LIMIT $offset, $max";
      $resultado=NULL;
      $eventos=array();
      $evento=new Evento();

      $resultado=$evento->getDB()->query($sql);

      if (isset($resultado)) {
        $eventos[]=new Evento($resultado->fetch_assoc());
      }

      return $eventos;
    }

    //=========================================================================
    // Setters
    //=========================================================================
    public function setId($id) {
      $this->id=$id;
    }

    public function setIdCreador($id_creador) {
      $this->id_creador=$id_creador;
    }

    public function setIdLocacion($id_locacion) {
      $this->id_locacion=$id_locacion;
    }

    public function setAsistencia($asistencias) {
      $this->asistencia=$asistencias;
    }

    public function setPuntaje($puntaje) {
      $this->puntaje=$puntaje;
    }

    public function setTitulo($titulo) {
      $this->titulo=$titulo;
    }

    public function setComienzo($comienzo) {
      $this->comienzo=$comienzo;
    }

    public function setFin($fin) {
      $this->fin=$fin;
    }

    public function setDescripcion($descripcion) {
      $this->descripcion=$descripcion;
    }

    //-------------------------------------------------------------------------
    public function save() {
      if ($this->getId() <= 0) {
        if ($this->insert() > 0) {
          return 0;
        }
      } else {
        if ($this->update() > 0) {
          return 0;
        }
      }

      return 1;
    }

    private function insert() {
      if (count($this->getErrores())>0) {
        return -2;
      }

      $sql='INSERT INTO eventos (creador, locacion, asistencia,';
      $sql.=' puntaje, titulo, comienzo, fin, descripcion)';
      $sql.=" VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

      $prepared_statement=$this->getDB()->prepare($sql);
      $prepared_statement->bind_param(
        'iiiissss',
        Session::get('id_usuario'),
        $id_locacion=2,
        $asistencia=0,
        $puntaje=0,
        $this->titulo,
        $this->comienzo,
        $this->fin,
        $this->descripcion
      );

      if ($prepared_statement->execute()==true) {
        $filas_afectadas=$prepared_statement->affected_rows;
        return $filas_afectadas;
      }

      return -1;
    }

    private function update() {
      $sql='UPDATE eventos SET creador=?, locacion=?, asistencia=?, puntaje=?,';
      $sql.=' titulo=?, comienzo=?, fin=?, descripcion=? WHERE id=?';

      $prepared_statement=$this->getDB()->prepare($sql);
      $prepared_statement->bind_param(
        'iiiissssi',
        $this->creador,
        $this->locacion,
        $this->asistencia,
        $this->puntaje,
        $this->titulo,
        $this->comienzo,
        $this->fin,
        $this->descripcion,
        $this->id
      );

      if ($prepared_statement->execute()==true) {
        $filas_afectadas=$prepared_statement->affected_rows;
        return $filas_afectadas;
      }

      return -1;
    }
  }
?>
