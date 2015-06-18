<?php
  require_once ROOT_DIR.'/clases/locacion.php';

  class ControladorLocacion extends ControladorIndex {
    public function crear($params=NULL) {
      Auth::requiere_usuario();

      $template=Template::getInstance();
      $template->mostrar("locacion/crear");
    }

    public function save($params=NULL) {
      Auth::requiere_usuario();
      $locacion=new Locacion(array(
        'id_creador'=>Session::get('id_usuario'),
        'latitud'=>((double) $_POST['latitud']),
        'longitud'=>((double) $_POST['longitud']),
        'nombre'=>$_POST['nombre'],
        'publico'=>isset($_POST['publico_si'])
      ));
      $locacion->save();

      if (count($locacion->getErrores())>0) {
        foreach ($locacion->getErrores() as $campo=>$errores) {
          echo "$campo:<br/>";
          foreach ($errores as $error) {
            echo "* $error<br/>";
          }
        }
      }

      $this->redirect('usuario', 'principal');
    }
  }
?>
