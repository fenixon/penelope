{extends file='layouts/main.tpl'}

{block name=body}
<div class="row panel panel-default">
  <div class="row panel-body">
    <h1 class="page-header">{$evento->getTitulo()} <small>#{$evento->getId()}</small></h1>
  </div>

  <div class="row panel-body">
    <div class="col-lg-12">
      <strong>Descripción:</strong> {$evento->getDescripcion()}
    </div>

    <div class="col-lg-12">
      <strong>Registrado por:</strong> <a href="#">{$evento->getCreador()}</a>
    </div>

    <div class="col-lg-12">
      <strong>Se realiza en:</strong> <a href="#">{$evento->getLocacion()}</a>
    </div>

    <div class="col-lg-6">
      <strong>Fecha de comienzo:</strong> {$evento->getComienzo()}
    </div>
    <div class="col-lg-6">
      <strong>Fecha de finalización:</strong> {$evento->getFin()}
    </div>

    <div class="col-lg-6">
      <strong>Asistencia:</strong> {$evento->getAsistencia()}
    </div>
    <div class="col-lg-6">
      <strong>Puntaje:</strong> {$evento->getPuntaje()}
    </div>
  </div>

  {if $evento->getCreador()==Session::get('id_usuario')}
    <div class="row panel-body">
      <a href="{$url_base}evento/modificar" class="btn btn-primary">
        Editar evento
      </a>
    </div>
  {/if}
</div>
{/block}

