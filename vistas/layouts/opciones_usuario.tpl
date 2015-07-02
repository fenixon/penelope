<!-- Single button -->
<div id="opciones_usuario" class="btn-group">
  <button type="button"
          class="btn btn-default dropdown-toggle"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false">
    Usuario <span class="caret"></span>
  </button>

  <ul class="dropdown-menu">
    {if Session::usuario_conectado()==true}
      <li><a href="usuario/principal">Principal</a></li>
      <li><a href="usuario/perfil">Perfil</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="usuario/sesion/cerrar">Cerrar sesión</a></li>
    {else}
      <li><a href="usuario/sesion">Iniciar sesión</a></li>
      <li><a href="usuario/create">¡Regístrate!</a></li>
    {/if}
  </ul>
</div>
