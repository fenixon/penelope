<?php
  require_once ROOT_DIR.'/clases/usuario.php';

  class ControladorUsuario extends ControladorIndex {
    /**
    * Método que despliega el formulario de registro de usuario.
    */
    public function create($params) {
      $template=Template::getInstance();
      $template->mostrar('usuario/create');
    }

    /**
    * Método que guarda los datos del usuario en el sistema.
    */
    public function save($params) {
      var_dump($_GET);
      echo '<br/>';
      var_dump($_POST);
      echo '<br/>';
      $usuario=new Usuario(array(
        'admin'=>false,
        'nombres'=>' ',
        'apellidos'=>' ',
        'fecha_nac'=>'2015-01-15',
        'email'=>$_POST['email']
      ));

      var_dump($usuario);

      //$this->redirect('usuario', 'create');
    }
  }
?>
