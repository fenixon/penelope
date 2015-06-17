<?php
  require_once ROOT_DIR.'/clases/locacion.php';

  class ControladorLocacion extends ControladorIndex {
    public function crear($params=NULL) {
      $template=Template::getInstance();
      $template->mostrar("locacion/crear");
    }
  }
?>
