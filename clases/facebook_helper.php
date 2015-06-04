<?php
  use Facebook\FacebookSession;
  use Facebook\FacebookRequest;
  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\GraphUser;

  /**
  * Clase que encapsula las interacciones con Facebook para su reutilización.
  */
  class FacebookHelper {
    /**
    * Método que devuelve la URL que invoca al diálogo de inicio de sesión de
    * Facebook.
    */
    public static function get_login_url() {
      Session::init();

      $loginUrl=NULL;

      FacebookSession::setDefaultApplication(
        '1568741600080101', 'c9ab684a048e998c55fa3fa1c2f592c7');

      $helper = new FacebookRedirectLoginHelper(
        "http://".URL_BASE."usuario/create/facebook");

      $permisos=array('email');
      $loginUrl=$helper->getLoginUrl($permisos);

      return $loginUrl;
    }

    /**
    * Método que procesa la respuesta de Facebook.
    */
    public static function facebook_callback() {
      Session::init();

      FacebookSession::setDefaultApplication(
        '1568741600080101', 'c9ab684a048e998c55fa3fa1c2f592c7');

      $helper = new FacebookRedirectLoginHelper(
        "http://".URL_BASE."usuario/create/facebook");

      try {
        if ( Session::has_key('access_token')==true ) {
          // Check if an access token has already been set.
          $session = new FacebookSession( Session::get('access_token') );
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
        Session::set('access_token', $session->getToken());
        // Logged in
        //echo 'Successfully logged in!';

        try {
          $user_profile=( new FacebookRequest(
            $session, 'GET', '/me'
          ))->execute()->getGraphObject(GraphUser::className());

          //echo "Name: ".$user_profile->getName();
          //echo ", Email: ".$user_profile->getEmail();
        } catch(FacebookRequestException $e) {
          echo "Ocurrió un error n° ".$e->getCode();
          echo ": ".$e->getMessage();
        }

        if (Session::get('usuario_logueado')==NULL) {
          $usuario_registrado=Usuario::verificar_facebook($user_profile->getEmail());

          if($usuario_registrado==2) {
            self::registro(
              array(
                'procedencia'=>'facebook',
                'datos'=>$user_profile));
          } elseif($usuario_registrado==1) {
            //Existe un usuario con email igual al de Facebook.
            self::actualizar(array("id_manejador_sesion"=>"facebook"));
          } else {
            header('location: index.php');
          }
        } else {
          header('location: index.php');
        }
      } else {
        // Generate the login URL for Facebook authentication.
        $loginUrl = $helper->getLoginUrl();
        echo '<a href="' . $loginUrl . '">Login</a>';
      }
    }

    public static function get_facebook_profile() {
      Session::init();

      FacebookSession::setDefaultApplication(
        '1568741600080101', 'c9ab684a048e998c55fa3fa1c2f592c7');

      $helper = new FacebookRedirectLoginHelper(
        "http://".URL_BASE."usuario/create/facebook");

      try {
        if ( Session::has_key('access_token')==true ) {
          // Check if an access token has already been set.
          $session = new FacebookSession( Session::get('access_token') );
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
        Session::set('access_token', $session->getToken());
        Session::set('id_manejador', 0);
        Session::set('nombre_manejador', 'facebook');
        // Logged in
        //echo 'Successfully logged in!';

        try {
          $perfil=( new FacebookRequest($session, 'GET', '/me'
          ))->execute()->getGraphObject(GraphUser::className());

          //echo "Name: ".$perfil->getName();
          //echo ", Email: ".$perfil->getEmail();
          return $perfil;
        } catch(FacebookRequestException $e) {
          echo "Ocurrió un error n° ".$e->getCode();
          echo ": ".$e->getMessage();
        }
      }

      return NULL;
    }
  }
?>
