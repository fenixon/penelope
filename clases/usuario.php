<?php
  /**
  * ---------------
  * Tabla usuarios:
  * ---------------
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
    private $manejadores_sesion;

    //=========================================================================
    //Constructor
    //=========================================================================
    public function __construct($params=NULL) {
      parent::__construct("usuarios");

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
    //Getters
    //=========================================================================
    public function getId() {
      return $this->id;
    }

    public function getNick() {
      return $this->nick;
    }

    //¿Deberíamos dejar esta función?, tal vez no...
    public function getContraseniaEncriptada() {
      return $this->contrasenia;
    }

    public function getAdmin() {
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
      $this->contrasenia=sha1($contrasenia);
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
      if ($this->id<0) {
        //Control de dirección email repetida--------------------------------->
        $email=strtolower($email);
        $sql='SELECT * FROM usuarios WHERE email=?';
        $prepared_statement=$this->getDB()->prepare($sql);
        $prepared_statement->bind_param('s', $email);

        if ($prepared_statement->execute()==true) {
          $prepared_statement->store_result();
          if ($prepared_statement->num_rows()>0) {
            $this->addError('email', "¡Clave duplicada!");
            $prepared_statement->close();
            return;
          }
        }
        //--------------------------------------------------------------------<
      }

      $this->email=$email;
    }

    public function setFechaBaja($fecha_baja) {
      $this->fecha_baja=$fecha_baja;
    }

    public function addManejadorSesion($id_manejador) {
      $manejador=ManejadorSesion($id_manejador);
      array_push($this->manejadores_sesion, $manejador);
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
      if (count($this->getErrores())>0) {
        return -2;
      }

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
        $filas_afectadas=$prepared_statement->affected_rows;
        return $filas_afectadas;
      }

      return -1;
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

      if ($prepared_statement->execute()==true) {
        $filas_afectadas=$prepared_statement->affected_rows;
        return $filas_afectadas;
      }

      return -1;
    }

    public function encontrar($params=NULL) {
      $query='SELECT * FROM usuarios WHERE ';
      $resultado=NULL;
      $i=0;

      foreach ($params as $atributo => $valor) {
        if ($i>0) {
          $query.=' AND ';
        }

        $query.="$atributo='$valor'";
        $i+=1;
      }

      $resultado=$this->getDB()->query($query);

      if (isset($resultado)) {
        return new Usuario($resultado->fetch_assoc());
      }

      return NULL;
    }
  }
?>
