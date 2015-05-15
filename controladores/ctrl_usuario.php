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
      $usuario=new Usuario(array(
        'admin'=>false,
        'nombres'=>' ',
        'apellidos'=>' ',
        'fecha_nac'=>'2015-01-15',
        'email'=>$_POST['email'],
        'nick'=>$_POST['nick'],
        'contrasenia'=>$_POST['contrasenia']
      ));

      echo "Guardado: ";
      echo $usuario->save();

      //$this->redirect('usuario', 'create');
    }
  }
?>
