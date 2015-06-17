<?php
  define('ROOT_DIR', dirname(__FILE__));
  define('URL_BASE', "http://".$_SERVER['HTTP_HOST']."/penelope/");
  //define('URL_BASE', "http://localhost/penelope/");

  require 'vendor/autoload.php';
  require 'config/config.php';
  require 'db/db.php';
  require 'clases/session.php';
  require_once 'controladores/ctrl_index.php';
  require 'clases/auth.php';
  require_once('clases/template.php');
  require_once 'clases/clase_base.php';
  $controlIndex=new ControladorIndex();

  $tpl = Template::getInstance();
  //$tpl->asignar('url_base',"localhost/penelope/");
  $tpl->asignar('url_logout',$controlIndex->getUrl("usuario","logout"));
  $tpl->asignar('proyecto',"Penélope");
  $tpl->asignar('url_base', URL_BASE);

  //Cargamos controladores y acciones
  if(isset($_GET['url'])){
    $query = $_GET['url'];
    $request = explode('/', $query);
    $controller = (!empty($request[0])) ? $request[0] : 'usuario';
    $action = (!empty($request[1])) ? $request[1] : 'create';
    $params=array();

    for ($i=2; $i < count($request) ; $i++) { 
      $params[]=$request[$i];
    }
  }else{
    $controller="usuario";
    $action="create";
    $params=array();
  }

  $controllerObj=$controlIndex->cargarControlador($controller);
  $controlIndex->ejecutarAccion($controllerObj,$action,$params);
?>
