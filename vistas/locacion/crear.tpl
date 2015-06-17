{extends file="layouts/main.tpl"}

{block name=body}
<div class="row">
  <form class="form-horizontal" method="POST" action="locacion/save">
    <fieldset>
      <!-- Form Name -->
      <legend>Registrar locación</legend>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="nombre">Nombre</label>
        <div class="controls">
          <input id="nombre" name="nombre" class="input-xxlarge"
                 required="" type="text" placeholder="Ej.: Teatro Joe's"/>
        </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="latitud">Latitud</label>
        <div class="controls">
          <input id="latitud" name="latitud" class="input-xxlarge"
                 required="" type="number" value="5000"/>
        </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="longitud">Longitud</label>
        <div class="controls">
          <input id="longitud" name="longitud" class="input-xxlarge"
                 required="" type="number" value="5000"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">¿Visible para todos los usuarios?</label>
        <div class="controls">
          <label class="control-label">Sí</label>
          <input id="publico_si" name="publico_si" type="radio" value="1"/>
          &nbsp;
          <label class="control-label">No</label>
          <input id="publico_no" name="publico_no" type="radio" value="0"/>
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
