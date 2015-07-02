<?php
  require_once ROOT_DIR.'/clases/evento.php';

  class ControladorEvento extends ControladorIndex {
    public function crear ($params=NULL) {
      Auth::requiere_usuario();

      $template=Template::getInstance();
      $template->asignar("dia", date("d"));
      $template->asignar("mes", date("m"));
      $template->asignar("anio", date("Y"));
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
        "comienzo"=>$_POST["anio_inicio"]."-".$_POST["mes_inicio"]."-".$_POST["dia_inicio"],
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

    public function listar($params=NULL) {
      $eventos=Evento::getEventos();

      $template=Template::getInstance();
      $template->asignar("eventos", $eventos);
      $template->mostrar("evento/listar");
    }

    public function mostrar($params=NULL) {
      if (isset($params[0])) {
        $auxiliar_evento=new Evento();
        $evento=$auxiliar_evento->obtenerPorId((int) $params[0]);

        $template=Template::getInstance();
        $template->asignar("evento", $evento);
        $template->mostrar("evento/mostrar");
      } else {
        $this->redirect("evento", "listar");
      }
    }
  }
?>
