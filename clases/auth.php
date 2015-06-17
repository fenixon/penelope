<?php
class Auth extends ControladorIndex {
  public static function requiere_usuario() {
    Session::init();

    if (Session::get('id_usuario')==NULL) {
      self::redirect("usuario","sesion");
    }
  }

  public static function requiere_anonimo() {
    Session::init();

    if (Session::get('id_usuario')!=NULL) {
      self::redirect("usuario","sesion");
    }
  }
}
?>
