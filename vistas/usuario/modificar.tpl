{extends file='layouts/main.tpl'}

{block name=navbar}
  {include file='usuario/barra_usuario.tpl'}
{/block}

{block name=body}
<div class="row">
  <form>
    <div class="row">
      <h1 class="page-header">{$usuario->getNick()}</h1>
    </div>

    <div class="row">
      <ul>
        <li>Nombre: {$usuario->getNombres()}</li>
        <li>Apellido: {$usuario->getApellidos()}</li>
        <li>
          Email: <a href="mailto:{$usuario->getEmail()}">
            {$usuario->getEmail()}
          </a>
        </li>
        <li>Fecha de nacimiento: 
          {$usuario->getFechaNac()}
        </li>
      </ul>
    </div>

    <div class="row">
      <input type="submit" class="btn btn-primary" value="Guardar"/>
    </div>
  </form>
</div>
{/block}
