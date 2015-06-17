{if Session::has_key('id_usuario')==true}
  <li><a href="{$url_base}usuario/principal">Principal</a></li>
  <li><a href="{$url_base}usuario/perfil">Perfil</a></li>
  <li><a href="{$url_base}usuario/sesion/cerrar">Cerrar sesión</a></li>
{/if}
