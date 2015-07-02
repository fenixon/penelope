{extends file='layouts/main.tpl'}

{block name=navbar}
  {include file='usuario/barra_usuario.tpl'}
{/block}

{block name=body}
<div class="row panel panel-default">
  <div class="row panel-body">
    <h1 class="page-header">{$usuario->getNick()}</h1>
  </div>

  <div class="row panel-body">
    <ul>
      <li>Nombre: {($usuario->getNombres()!=' ')?$usuario->getNombres():"N/A"}</li>
      <li>Apellido: {($usuario->getApellidos()!=' ')?$usuario->getApellidos():"N/A"}</li>
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

  <div class="row panel-body">
    <a href="usuario/modificar" class="btn btn-primary">Editar perfil</a>
  </div>
</div>
{/block}

