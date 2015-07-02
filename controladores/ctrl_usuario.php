<?php
  require_once ROOT_DIR.'/clases/usuario.php';
  require_once ROOT_DIR.'/clases/facebook_helper.php';
  require_once ROOT_DIR.'/clases/evento.php';
  require_once ROOT_DIR.'/clases/locacion.php';

  class ControladorUsuario extends ControladorIndex {
    /**
    * Método que despliega el formulario de registro de usuario.
    * El método puede recibir el manejador de la sesión del usuario.
    * Esto hará que dicho manejador quede atado al usuario para que pueda iniciar
    * sesión con dicho manejador si lo desea.
    */
    public function create($params=NULL) {
      Auth::requiere_anonimo();

      if ($params==NULL or $params[0]=="" or $params=="penelope") {
        $this->crear_propio();
      } else if ($params[0]=="facebook") {
        $this->crear_con_facebook();
      } else if ($params[0]=="google") {
        $this->crear_con_google();
      } else if ($params[0]=="twitter") {
        $this->crear_con_twitter();
      }
    }

    /**
    * Método específico para mostrar el formulario de registro por defecto de
    * Penélope.
    */
    private function crear_propio() {
      $template=Template::getInstance();
      $template->mostrar('usuario/create');
    }

    /**
    * Método específico para mostrar el formulario de registro vía Facebook.
    */
    private function crear_con_facebook() {
      Session::init();

      //Si en sesion ya hay una sesión con Facebook
      if (Session::has_key('access_token')==true or 
          isset($_GET['code'])==true
      ) {
        $perfil=FacebookHelper::get_facebook_profile();
        $template=Template::getInstance();
        $template->asignar('usuario_facebook', $perfil->getName());
        $template->asignar('email', $perfil->getEmail());
        $template->mostrar('usuario/create_facebook');
      } else {
        Session::destroy();
        $this->relocate(FacebookHelper::get_login_url());
      }
    }

    /**
    * Método específico para mostrar el formulario de registro vía Google.
    */
    private function crear_con_google() {
      $template=Template::getInstance();
      $template->mostrar('usuario/create_google');
    }

    /**
    * Método específico para mostrar el formulario de registro vía Twitter.
    */
    private function crear_con_twitter() {
      $template=Template::getInstance();
      $template->mostrar('usuario/create_twitter');
    }

    /**
    * Método que guarda los datos del usuario en el sistema.
    * El método debe recibir los siguientes parámetros:
    * @param string email       Dirección de correo electrónico del usuario.
    * @param string nick        El nick por medio del cual se hará referencia 
    *                           al usuario.
    * @param string contrasenia Constraseña del usuario.
    */
    public function save($params=NULL) {
      Auth::requiere_usuario();

      if (Session::has_key('id_manejador')) {
        $id_manejador=Session::get('id_manejador');

        if ($id_manejador==0) {
          $this->guardar_facebook();
        }
      } else {
        $this->guardar_penelope();
      }

      $this->redirect('usuario', 'login');
    }

    private function guardar_penelope() {
      $usuario=new Usuario(array(
        'admin'=>false,
        'nombres'=>' ',
        'apellidos'=>' ',
        'fecha_nac'=>'2015-01-15',
        'email'=>$_POST['email'],
        'nick'=>$_POST['nick'],
        'contrasenia'=>$_POST['contrasenia']
      ));
      $usuario->save();

      if (count($usuario->getErrores())>0) {
        foreach ($usuario->getErrores() as $campo=>$errores) {
          echo "$campo:<br/>";
          foreach ($errores as $error) {
            echo "* $error<br/>";
          }
        }
      }
    }

    private function guardar_facebook() {
      $perfil=FacebookHelper::get_facebook_profile();

      $usuario=new Usuario(array(
        'admin'=>false,
        'nombres'=>' ',
        'apellidos'=>' ',
        'fecha_nac'=>'2015-01-15',
        'email'=>$perfil->getEmail(),
        'nick'=>$_POST['nick'],
        'contrasenia'=>$_POST['contrasenia']
      ));
      $usuario->save();

      if (count($usuario->getErrores())>0) {
        foreach ($usuario->getErrores() as $campo=>$errores) {
          echo "$campo:<br/>";
          foreach ($errores as $error) {
            echo "* $error<br/>";
          }
        }
      }
    }

    /**
    * Método que elimina un usuario del sistema.
    * @param number id_usuario Identificación del usuario que se desea
    *                          eliminar.
    * @to do Falta todo.
    */
    public function eliminar($params=NULL) {
      Auth::requiere_usuario();

      $usuario=new Usuario();
      $usuario_conectado=$usuario->obtenerPorId(Session::get('id_usuario'));
      $id_usuario=Session::get('id_usuario');
      $accion='sesion';

      if ($usuario_conectado->getAdmin()==true) {
        if (isset($params[0])==true) {
          $id_usuario=$params[0];
        }
      } else {
        Session::destroy();
      }

      $usuario_conectado->setFechaBaja('2015-06-17');
      $usuario_conectado->save();

      $this->redirect('usuario', $accion);
    }

    /**
    * Método para iniciar o cerrar una sesión de usuario según corresponda.
    */
    public function sesion($params=NULL) {
      Session::init();

      if (Session::has_key('id_usuario')==false) {
        $this->iniciar_sesion($params);
      } else if ($params[0]=='cerrar') {
        $this->cerrar_sesion();
      } else {
        $this->redirect('usuario', 'principal');
      }
    }

    /**
    * Método para iniciar una sesión de usuario.
    * @param string nick_email  El nick o email que identifica al usuario.
    * @param string contrasenia La contraseña que envía el usuario.
    */
    private function iniciar_sesion($params=NULL) {
      $nick_email=NULL;
      $contrasenia=NULL;

      if (isset($params[0])) {
        if ($params[0]=='facebook') {
          $this->iniciar_con_facebook();
        } else if ($params[0]=='google') {
          $this->iniciar_con_google();
        } else if ($params[0]=='twitter') {
          $this->iniciar_con_twitter();
        }
      }

      $this->iniciar_con_penelope();
    }

    private function iniciar_con_penelope() {
      if (isset($_POST['nick_email'])) {
        $nick_email=$_POST['nick_email'];
      }
      if (isset($_POST['contrasenia'])) {
        $contrasenia=$_POST['contrasenia'];
      }

      $template=Template::getInstance();

      if (isset($nick_email)) {
        $usuario=Session::iniciar($nick_email, $contrasenia);

        if ($usuario==true) {
          $this->redirect('usuario', 'principal');
        } else {
          $this->redirect('usuario', 'sesion');
        }
      } else {
        $template->mostrar('usuario/sesion');
      }
    }

    /**
    * Método para cerrar la sesión de usuario que esté activa.
    */
    private function cerrar_sesion() {
      Session::init();
      Session::destroy();
      $this->redirect('usuario', 'sesion');
    }

    /**
    * Método que despliega la vista principal de usuarios.
    */
    public function principal() {
      Auth::requiere_usuario();

      $evento=new Evento();
      $locacion=new Locacion();

      $template=Template::getInstance();
      $template->asignar('eventos', $evento->getEventos());
      $template->asignar('locaciones', $locacion->getListado());
      $template->mostrar('usuario/principal');
    }

    /**
    * Método que invoca la vista con el perfil del usuario consultado.
    * @param numeric id_usuario Se debe ingresar la identificación del usuario 
    *                           a consultar.
    */
    public function perfil($params=NULL) {
      Auth::requiere_usuario();

      $usuario=new Usuario();

      if (isset($params[0])==true) {
        $usuario=$usuario->obtenerPorId((int) $params[0]);
      } else {
        $usuario=$usuario->obtenerPorId(Session::get('id_usuario'));
      }

      $template=Template::getInstance();
      $template->asignar('usuario', $usuario);
      $template->mostrar('usuario/perfil');
    }

    /**
    * Método que invoca la vista con el formulario de modificación de usuarios.
    */
    public function modificar() {
      Auth::requiere_usuario();

      $usuario=new Usuario();
      $usuario=$usuario->obtenerPorId(Session::get('id_usuario'));

      $template=Template::getInstance();
      $template->asignar('usuario', $usuario);
      $template->mostrar('usuario/modificar');
    }

    public function actualizar() {
      Auth::requiere_usuario();

      $fecha=DateTime::createFromFormat("d/m/Y", $_POST["fecha_nac"]);

      $usuario=new Usuario();
      $usuario=$usuario->obtenerPorId(Session::get('id_usuario'));
      $usuario->setNombres($_POST["nombres"]);
      $usuario->setApellidos($_POST["apellidos"]);
      $usuario->setEmail($_POST["email"]);
      $usuario->setFechaNac(date_format($fecha, "Y-m-d"));
      $usuario->save();

      if (count($usuario->getErrores())>0) {
        foreach ($usuario->getErrores() as $campo=>$errores) {
          echo "$campo:<br/>";
          foreach ($errores as $error) {
            echo "* $error<br/>";
          }
        }
      }

      $this->redirect('usuario', 'perfil');
    }
  }
?>
