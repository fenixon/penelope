<?php
  /**
  * --------------
  * Tabla usuarios:
  * --------------
  * id int(11)
  * admin tinyint(1)
  * nombres varchar(100)
  * apellidos varchar(100)
  * fecha_nac date
  * email varchar(255)
  * fecha_baja date
  */
  class Usuario extends ClaseBase {
    private $id;
    private $admin;
    private $nombres;
    private $apellidos;
    private $fecha_nac;
    private $email;
    private $fecha_baja;

    //=========================================================================
    //Constructor
    //=========================================================================
    public function __construct($params=NULL) {
      if (isset($params)) {
        foreach ($params as $key=>$value) {
          if (property_exists(get_class($this), $key)) {
            $this->$key=$value;
          }
        }
      }

      if (!isset($this->id)) {
        $this->id=-1;
      }

      parent::__construct("usuarios");
    }

    //=========================================================================
    //Getters
    //=========================================================================
    public function getId() {
      return $this->id;
    }

    public function isAdmin() {
      return $this->admin;
    }

    public function getNombres() {
      return $this->nombres;
    }

    public function getApellidos() {
      return $this->apellidos;
    }

    public function getFechaNac() {
      return $this->fecha_nac;
    }

    public function getEmail() {
      return $this->email;
    }

    public function getFechaBaja() {
      return $this->fecha_baja;
    }

    //=========================================================================
    //Setters
    //=========================================================================
    public function setId($id) {
      $this->id=$id;
    }

    public function setAdmin($admin) {
      $this->admin=$admin;
    }

    public function setNombres($nombres) {
      $this->nombres=$nombres;
    }

    public function setApellidos($apellidos) {
      $this->apellidos=$apellidos;
    }

    public function setFechaNac($fecha_nac) {
      $this->fecha_nac=$fecha_nac;
    }

    public function setEmail($email) {
      $this->email=$email;
    }

    public function setFechaBaja($fecha_baja) {
      $this->fecha_baja=$fecha_baja;
    }

    public function save() {
      if ($this->getId() <= 0) {
        if ($this->insert() > 0) {
          return true;
        }
      } else {
        if ($this->update() > 0) {
          return true;
        }
      }

      return false;
    }

    private function insert() {
      $sql='INSERT INTO usuarios (admin, nombres, apellidos,';
      $sql.=' fecha_nac, email, fecha_baja) ';
      $sql.="VALUES (?, ?, ?, ?, ?, ?)";

      $prepared_statement=$this->db->prepare($sql);
      $prepared_statement->bind_param(
        'isssss',
        $this->admin,
        $this->nombres,
        $this->apellidos,
        $this->fecha_nac,
        $this->email,
        $this->fecha_baja
      );
      $prepared_statement->execute();

      return $prepared_statement->affected_rows;
    }

    private function update() {
      $sql='UPDATE usuarios SET admin=?, nombres=?, apellidos=?, fecha_nac=?,';
      $sql.=' email=?, fecha_baja=? WHERE id=?';

      $prepared_statement=$this->db->prepare($sql);
      $prepared_statement->bind_param(
        'isssssi',
        $this->admin,
        $this->nombres,
        $this->apellidos,
        $this->fecha_nac,
        $this->email,
        $this->fecha_baja,
        $this->id
      );
      $prepared_statement->execute();

      return $prepared_statement->affected_rows;
    }
  }
?>
