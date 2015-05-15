<?php
  /**
  * --------------
  * Tabla usuarios:
  * --------------
  * id           int(11)
  * nick         varchar(100)
  * contrasenia  varchar(100)
  * admin        tinyint(1)
  * nombres      varchar(100)
  * apellidos    varchar(100)
  * fecha_nac    date
  * email        varchar(255)
  * fecha_baja   date
  */
  class Usuario extends ClaseBase {
    private $id;
    private $nick;
    private $contrasenia;
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

    public function getNick() {
      return $this->nick;
    }

    public function getContrasenia() {
      return $this->contrasenia;
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

    public function setNick($nick) {
      $this->nick=$nick;
    }

    public function setContrasenia($contrasenia) {
      $this->contrasenia=$contrasenia;
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

      redirect("usuario", "create");

      return false;
    }

    private function insert() {
      $sql='INSERT INTO usuarios (admin, nombres, apellidos,';
      $sql.=' fecha_nac, email, fecha_baja, nick, contrasenia)';
      $sql.=" VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

      $prepared_statement=$this->getDB()->prepare($sql);
      $prepared_statement->bind_param(
        'isssssss',
        $this->admin,
        $this->nombres,
        $this->apellidos,
        $this->fecha_nac,
        $this->email,
        $this->fecha_baja,
        $this->nick,
        $this->contrasenia
      );

      if ($prepared_statement->execute()==true) {
        return $filas_afectadas;
      } else {
        /*foreach ($prepared_statement->error_list as $key=>$value) {
          echo "<br/>";
          var_dump($value);
        }*/

        return -1;
      }

      $filas_afectadas=$prepared_statement->affected_rows;
    }

    private function update() {
      $sql='UPDATE usuarios SET admin=?, nombres=?, apellidos=?, fecha_nac=?,';
      $sql.=' email=?, fecha_baja=?, nick=?, contrasenia=? WHERE id=?';

      $prepared_statement=$this->getDB()->prepare($sql);
      $prepared_statement->bind_param(
        'isssssssi',
        $this->admin,
        $this->nombres,
        $this->apellidos,
        $this->fecha_nac,
        $this->email,
        $this->fecha_baja,
        $this->nick,
        $this->contrasenia,
        $this->id
      );
      $prepared_statement->execute();

      $filas_afectadas=$prepared_statement->affected_rows;

      return $filas_afectadas;
    }
  }
?>
