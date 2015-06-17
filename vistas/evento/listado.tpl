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
        <tr>
          {foreach $eventos as $evento}
            <td><a href="#">{$evento->getTitulo()}</a></td>
            <td>{$evento->getDescripcion()}</td>
            <td>{$evento->getAsistencia()}</td>
            <td>{$evento->getComienzo()}</td>
            <td>{$evento->getFin()}</td>
          {foreachelse}
            <td colspan=""><h3>No hay eventos registrados.</h3></td>
          {/foreach}
        </tr>
      </tbody>
    </table>
  </div>
</div>
{/block}
