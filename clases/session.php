<?php
class Session {
  public static function init() {
    if (session_id() == '') {
      session_start();
    }
  }

  public static function set($key, $value){
    $_SESSION[$key] = $value;
  }

  public static function get($key){
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }

    return NULL;
  }

  public static function has_key($key) {
    if (isset($_SESSION[$key])) {
      return true;
    }

    return false;
  }

  public static function destroy(){
    session_destroy();
  }

  public static function get_session() {
    return $_SESSION;
  }

  public static function iniciar($nick_email, $contrasenia) {
    $usuario=new Usuario();

    $usuario_encontrado=$usuario->encontrar([
      'nick'=>$nick_email,
      'contrasenia'=>sha1($contrasenia)]);

    if (isset($usuario_encontrado)==false) {
      $encontrado=$usuario->encontrar([
        'email'=>$nick_email,
        'contrasenia'=>sha1($contrasenia)]);
    }

    if (isset($usuario_encontrado)==true) {
      self::set('id_usuario', $usuario_encontrado->getId());
      return true;
    } else {
      self::destroy();
      return false;
    }
  }
}
