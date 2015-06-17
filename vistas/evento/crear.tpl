{extends file='layouts/main.tpl'}

{block name=body}
<div class="row">
  <form class="form-horizontal" method="POST" action="evento/save">
    <fieldset>
      <!-- Form Name -->
      <legend>Registrar evento</legend>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="titulo">Título</label>
        <div class="controls">
          <input id="titulo" name="titulo" placeholder="ej.: Concierto de jazz"
                 class="input-xxlarge" required="" type="text" value="Probando"/>
        </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="descripcion">Descripción</label>
        <div class="controls">
          <textarea id="descripcion" name="descripcion"
                    placeholder="ej.: Concierto donde tocan jazz."
                    class="input-xlarge" required="">
            Probando
          </textarea>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="dia_inicio">Fecha de inicio</label>
        <div class="controls">
          <select id="dia_inicio" name="dia_inicio">
            {for $dia_inicio=1 to 30}
              <option value="{$dia_inicio}">{$dia_inicio}</option>
            {/for}
          </select>
          <select id="mes_inicio" name="mes_inicio">
            {for $mes_inicio=1 to 12}
              <option value="{$mes_inicio}">{$mes_inicio}</option>
            {/for}
          </select>
          <select id="anio_inicio" name="anio_inicio">
            {for $anio_inicio=2000 to 2100}
              <option value="{$anio_inicio}">{$anio_inicio}</option>
            {/for}
          </select>
        </div>
      </div>

      <!-- Button -->
      <div class="control-group">
        <div class="controls">
          <button id="confirm" name="confirm" class="btn btn-info">
            Guardar
          </button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
{/block}
