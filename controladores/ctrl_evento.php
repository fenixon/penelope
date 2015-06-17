<?php
  require_once ROOT_DIR.'/clases/evento.php';

  class ControladorEvento extends ControladorIndex {
    public function crear ($params=NULL) {
      Auth::requiere_usuario();

      $template=Template::getInstance();
      $template->mostrar('evento/crear');
    }

    public function save ($params=NULL) {
      Auth::requiere_usuario();

      $evento=new Evento(array(
        "id_creador"=>1,
        "id_locacion"=>1,
        "asistencia"=>0,
        "puntaje"=>0,
        "titulo"=>$_POST["titulo"],
        "comienzo"=>"2015-06-15",
        "fin"=>"2015-06-15",
        "descripcion"=>$_POST["descripcion"]
      ));
      echo "COASDOS: ";
      echo $evento->save();

      if (count($evento->getErrores())>0) {
        foreach ($evento->getErrores() as $campo=>$errores) {
          echo "$campo:<br/>";
          foreach ($errores as $error) {
            echo "* $error<br/>";
          }
        }
      }
    }

    public function listado($params=NULL) {
      $eventos=Evento::getEventos();

      $template=Template::getInstance();
      $template->asignar("eventos", $eventos);
      $template->mostrar("evento/listado");
    }
  }
?>
