{extends file='layouts/main.tpl'}

{block name=navbar}
  {include file='usuario/barra_usuario.tpl'}
{/block}

{block name=body}
<div class="row">
  <div class="contenedor-mapa">
    <div id="googleMap" style="width:100%;height:400px;"></div>
  </div>

  <div class="panel-eventos">
    <div class="panel panel-default">
      <table class="table">
        <thead>
          <th>Evento</th>
          <th>Descripción</th>
        </thead>

        <tbody>
          {foreach $eventos as $evento}
            <tr>
              <td>
                <a href="evento/mostrar/{$evento->getId()}">
                  {$evento->getTitulo()}
                </a>
              </td>
              <td>{$evento->getDescripcion()}</td>
            </tr>
          {foreachelse}
            <tr>
              <td colspan="2">No hay eventos cercanos vigentes.</td>
            </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
</div>
{/block}

