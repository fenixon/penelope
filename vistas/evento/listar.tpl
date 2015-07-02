{extends file="layouts/main.tpl"}

{block name=body}
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">Listado de eventos</div>

    <table class="table">
      <thead>
        <tr>
          <th>Evento</th>
          <th>Descripción</th>
          <th>Asistentes</th>
          <th>Fecha de inicio</th>
          <th>Fecha de finalización</th>
        </tr>
      </thead>

      <tbody>
        {foreach $eventos as $evento}
          <tr>
            <td><a href="evento/mostrar/{$evento->getId()}">{$evento->getTitulo()}</a></td>
            <td>{$evento->getDescripcion()}</td>
            <td>{$evento->getAsistencia()}</td>
            <td>{$evento->getComienzo()}</td>
            <td>{$evento->getFin()}</td>
          </tr>
        {foreachelse}
          <tr>
            <td colspan="5"><h3>No hay eventos registrados.</h3></td>
          </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>
{/block}
