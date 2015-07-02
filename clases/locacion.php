<?php
  /**
  * --------------
  * Tabla eventos:
  * --------------
  * id           int(11)
  * creador      int(11)
  * latitud      decimal(8, 4)
  * longitud     decimal(8, 4)
  * nombre       varchar(255)
  * publico      tinyint(1)
  */
  class Locacion extends ClaseBase {
    private $id;
    private $creador;
    private $latitud;
    private $longitud;
    private $nombre;
    private $publico;

    //=========================================================================
    //Constructor
    //=========================================================================
    public function __construct($params=NULL) {
      parent::__construct("locaciones");

      if (isset($params)) {
        foreach ($params as $key=>$value) {
          //Con esto nos aseguramos de que corran las validaciones necesarias.
          //La contra es que vamos a tener que nombrar a todos los
          //setters 'set...'
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

    public function getCreador() {
      return $this->creador;
    }

    public function getLatitud() {
      return $this->latitud;
    }

    public function getLongitud() {
      return $this->longitud;
    }

    public function getNombre() {
      return $this->nombre;
    }

    public function getPublico() {
      return $this->publico;
    }

    //=========================================================================
    // Setters
    //=========================================================================
    public function setId($id) {
      $this->id=$id;
    }

    public function setCreador($creador) {
      $this->creador=$creador;
    }

    public function setLatitud($latitud) {
      $this->latitud=$latitud;
    }

    public function setLongitud($longitud) {
      $this->longitud=$longitud;
    }

    public function setNombre($nombre) {
      $this->nombre=$nombre;
    }

    public function setPublico($publico) {
      $this->publico=$publico;
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

      $sql='INSERT INTO locaciones (creador, latitud, longitud,';
      $sql.=' nombre, publico)';
      $sql.=" VALUES (?, ?, ?, ?, ?)";

      $prepared_statement=$this->getDB()->prepare($sql);
      $prepared_statement->bind_param(
        'iddsi',
        Session::get('id_usuario'),
        $this->latitud,
        $this->longitud,
        $this->nombre,
        $this->publico
      );

      if ($prepared_statement->execute()==true) {
        $filas_afectadas=$prepared_statement->affected_rows;
        return $filas_afectadas;
      }

      return -1;
    }

    private function update() {
      $sql='UPDATE locaciones SET creador=?, latitud=?, longitud=?, nombre=?,';
      $sql.=' publico=? WHERE id=?';

      $prepared_statement=$this->getDB()->prepare($sql);
      $prepared_statement->bind_param(
        'iddsbi',
        $this->creador,
        $this->latitud,
        $this->longitud,
        $this->nombre,
        $this->publico
      );

      if ($prepared_statement->execute()==true) {
        $filas_afectadas=$prepared_statement->affected_rows;
        return $filas_afectadas;
      }

      return -1;
    }
  }
?>
