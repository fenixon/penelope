<div id="opciones_usuario" class="btn-group">
  <button type="button"
          class="btn btn-default dropdown-toggle"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false">
    Locaciones <span class="caret"></span>
  </button>

  <ul class="dropdown-menu">
    {if Session::usuario_conectado()==true}
      <li><a href="#">Tus locaciones</a></li>
    {/if}
    <li><a href="locacion/listar">Listado</a></li>
  </ul>
</div>
