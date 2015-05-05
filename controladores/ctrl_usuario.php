<?php
require "clases/clase_base.php";
require "clases/usuario.php";
require_once('clases/template.php');
require_once('clases/Utils.php');
require_once('clases/session.php');
require_once('clases/auth.php');
//COmentar la linea siguiente si tienen COMPOSER
require "libs/facebook-php-sdk-v4-4.0-dev/autoload.php";
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class ControladorUsuario extends ControladorIndex {

 function listado($params=array()){
 	
 	Auth::estaLogueado();

	$buscar="";
	$titulo="Listado";
	$mensaje="";
	if(!empty($params)){
		if($params[0]=="borrar"){
			$usuario=new Usuario();
			$idABorrar=$params[1];
	 		if($usuario->borrar($idABorrar)){
	 			//Redirigir al listado
	 			//header('Location: index.php');exit;
	 			$this->redirect("usuario","listado");
	 		}else{
	 			//Mostrar error
	 			$usr=$usuario->obtenerPorId($idABorrar);
	 			//$mensaje="Error!! No se pudo borrar el usuario  <b>".$usr->getNombre()." ".$usr->getApellido()."</b>";
	 			$mensaje="ERROR. No existe el usuario";
	 			$usuarios=$usuario->getListado();	
	 		}
		}else if($params[0]=="mail"){
	 		$usuario=new Usuario();
	 		$idAEnviar=$params[1];
	 		$usr=$usuario->obtenerPorId($idAEnviar);

	 		$utils=new Utils();
	 		$res=$utils->enviarEmail($usr->getEmail(),$usr->getNombre()." ".$usr->getApellido());	
	 		if($res){
	 			//Redirigir al listado
	 			$mensaje="Mail enviado!";
	 			$usuarios=$usuario->getListado();
	 		}else{
	 			$mensaje="Error!! No se pudo enviar email al usuario  <b>".$usr->getNombre()." ".$usr->getApellido()."</b>";
	 			$usuarios=$usuario->getListado();	
	 		}
	 	}else{
	 		$usuario=new Usuario();
			$usuarios=$usuario->getListado();	
	 	}
	}else{
 		$usuario=new Usuario();
		$usuarios=$usuario->getListado();	
 	}
	
	//Llamar a la vista
 	$tpl = Template::getInstance();
 	$datos = array(
    'usuarios' => $usuarios,
    'buscar' => $buscar,
    'titulo' => $titulo,
    'mensaje' => $mensaje,
    );

	$tpl->asignar('usuario_nuevo',$this->getUrl("usuario","nuevo"));
	$tpl->mostrar('usuarios_listado',$datos);

}
function buscar($params=array()){
 	
 	Auth::estaLogueado();

	$buscar="";
	$titulo="Listado";
	$mensaje="";
	$usuarios=array();
	if(isset($_POST["buscar"]) && $_POST["buscar"]!="" ){
			$titulo="Buscando..";
	 		$usuario=new Usuario();
	 		$buscar=$_POST["buscar"];
			$usuarios=$usuario->getBusqueda($buscar);	
	}else{
		$usuario=new Usuario();
		$usuarios=$usuario->getListado();
	}
 	
	//Llamar a la vista
	//require_once("vistas/usuarios_listado.php");
	
 	$tpl = Template::getInstance();
 	$datos = array(
    'usuarios' => $usuarios,
    'buscar' => $buscar,
    'titulo' => $titulo,
    'mensaje' => $mensaje,
    );

	
	$tpl->asignar('usuario_nuevo',$this->getUrl("usuario","nuevo"));
	$tpl->mostrar('usuarios_listado',$datos);

}

function nuevo(){
	$mensaje="";
	if(isset($_POST["nombre"])){
		$usr= new Usuario();
		$usr->setNombre($_POST["nombre"]);
		$usr->setApellido($_POST["apellido"]);
		$usr->setCI($_POST["ci"]);
		$usr->setEdad($_POST["edad"]);
		$usr->setEmail($_POST["email"]);
		if($usr->agregar()){
			$this->redirect("usuario","listado");
			exit;
		}else{
			$mensaje="Error! No se pudo agregar el usuario";
		}

		
	}
	$tpl = Template::getInstance();
	$tpl->asignar('titulo',"Nuevo Usuario");
	$tpl->asignar('buscar',"");
	$tpl->asignar('mensaje',$mensaje);
	$tpl->mostrar('usuarios_nuevo',array());

}
function login(){

	$mensaje="";
	session_start();
	// Initialize the Facebook SDK.
	FacebookSession::setDefaultApplication( '1606231786259862', '47dd4cb4941076f7c287c977d2b84d1b' );
	$helper = new FacebookRedirectLoginHelper('http://localhost/tip/ejemplos/framework/fb_login.php');
	
	$permissions = array(
		   'scope' => 'public_profile,email'
		);
	$loginUrl = $helper->getLoginUrl($permissions);

	if(isset($_POST["email"])){
		$usr= new Usuario();
		
		$email=$_POST["email"];
		$pass=sha1($_POST["password"]);

		if($usr->login($email,$pass)){
			$this->redirect("usuario","listado");
			exit;
		}else{
			$mensaje="Error! No se pudo agregar el usuario";
		}

		
	}
	$tpl = Template::getInstance();
	$tpl->asignar('titulo',"Nuevo Usuario");
	$tpl->asignar('loginUrl',$loginUrl);
	$tpl->asignar('buscar',"");
	$tpl->asignar('mensaje',$mensaje);
	$tpl->mostrar('usuarios_login',array());

}
function logout(){
	$usr= new Usuario();
	$usr->logout();
	$this->redirect("usuario","login");
}

function loginFB(){
	session_start();

	FacebookSession::setDefaultApplication( '1606231786259862', '47dd4cb4941076f7c287c977d2b84d1b' );
	$helper = new FacebookRedirectLoginHelper('http://localhost/tip/ejemplos/framework/fb_login.php');
	try {
	    if ( isset( $_SESSION['access_token'] ) ) {
	        // Check if an access token has already been set.
	        $session = new FacebookSession( $_SESSION['access_token'] );
	    } else {
	        // Get access token from the code parameter in the URL.
	        $session = $helper->getSessionFromRedirect();
	    }
	} catch( FacebookRequestException $ex ) {

	    // When Facebook returns an error.
	    print_r( $ex );
	} catch( \Exception $ex ) {

	    // When validation fails or other local issues.
	    print_r( $ex );
	}
	if ( isset( $session ) ) {

	    // Retrieve & store the access token in a session.
	    $_SESSION['access_token'] = $session->getToken();
	    // Logged in
	    echo 'Successfully logged in!';

	    try {

		    // Retrieve User’s Profile Information
			$request = ( new FacebookRequest( $session, 'GET', '/me' ) )->
			execute();

			// Get response as an array
		    $user = $request->getGraphObject()->asArray();

		    //echo "Name: " . $user_profile->getName();
		    print_r( $user );




		  } catch(FacebookRequestException $e) {

		    echo "Exception occured, code: " . $e->getCode();
		    echo " with message: " . $e->getMessage();

		  }   
	} else {

	    // Generate the login URL for Facebook authentication.
	    $permissions = array(
		   'scope' => 'public_profile,email'
		);

		$loginUrl = $helper->getLoginUrl($permissions);
	    echo '<a href="' . $loginUrl . '">Login</a>';
	}
}

}
?>