{extends file="layouts/main.tpl"}

{block name=body}
<div class="row panel panel-default">
  <div class="row panel-body">
    <h1 class="page-header">{$locacion->getNombre()} <small>#{$locacion->getId()}</small></h1>
  </div>

  <div class="row panel-body">
    <div class="col-lg-12">
      <strong>Registrado por:</strong>
      <a href="usuario/perfil/{$locacion->getCreador()}">
        {$locacion->getCreador()}
      </a>
    </div>

    <div class="col-lg-12">
      <strong>Coordenadas:</strong> Longitud: {$locacion->getLongitud()}; Latitud: {$locacion->getLatitud()}
    </div>

    <div class="col-lg-12">
      <strong>Visibilidad:</strong>
      {if $locacion->getPublico()==true}
        Público <small><i>(es visible para todos lo usuarios)</i></small>
      {else}
        Privado <small><i>(solo pueden verlo los usuarios invitados)</i></small>
      {/if}
    </div>

    <div class="col-lg-12">
      <button id="centrar-locacion" class="btn btn-success">
        Centrar lugar en el mapa
      </button>
    </div>

    <div class="col-lg-12">
      <div id="googleMap" style="width:100%;height:400px;"></div>
    </div>
  </div>

  {if $locacion->getCreador()==Session::get('id_usuario')}
    <div class="row panel-body">
      <a href="locacion/modificar/{$locacion->getId()}" class="btn btn-primary">
        Editar evento
      </a>
    </div>
  {/if}
</div>
{/block}

{block name=latitud}{$locacion->getLatitud()}{/block}
{block name=longitud}{$locacion->getLongitud()}{/block}
{block name=locacion}{$locacion->getNombre()}{/block}
