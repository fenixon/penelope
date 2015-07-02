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
                 class="input-xxlarge" required="" type="text"/>
        </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="descripcion">Descripción</label>
        <div class="controls">
          <textarea id="descripcion" name="descripcion"
                    placeholder="ej.: Concierto donde tocan jazz."
                    class="input-xlarge" required=""></textarea>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="dia_inicio">Fecha de inicio</label>
        <div class="controls">
          <select id="dia_inicio" name="dia_inicio">
            {for $dia_inicio=1 to 30}
              <option value="{$dia_inicio}"
                      {if $dia==$dia_inicio}selected=""{/if}>
                {$dia_inicio}
              </option>
            {/for}
          </select>
          <select id="mes_inicio" name="mes_inicio">
            {for $mes_inicio=1 to 12}
              <option value="{$mes_inicio}"
                      {if $mes==$mes_inicio}selected=""{/if}>
                {$mes_inicio}
              </option>
            {/for}
          </select>
          <select id="anio_inicio" name="anio_inicio">
            {for $anio_inicio=2000 to 2100}
              <option value="{$anio_inicio}"
                      {if $anio==$anio_inicio}selected=""{/if}>
                {$anio_inicio}
              </option>
            {/for}
          </select>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="dia_fin">Fecha de finalización</label>
        <div class="controls">
          <select id="dia_fin" name="dia_fin">
            {for $dia_fin=1 to 30}
              <option value="{$dia_fin}"
                      {if $dia==$dia_fin}selected=""{/if}>
                {$dia_fin}
              </option>
            {/for}
          </select>
          <select id="mes_fin" name="mes_fin">
            {for $mes_fin=1 to 12}
              <option value="{$mes_fin}"
                      {if $mes==$mes_fin}selected=""{/if}>
                {$mes_fin}
              </option>
            {/for}
          </select>
          <select id="anio_fin" name="anio_fin">
            {for $anio_fin=2000 to 2100}
              <option value="{$anio_fin}"
                      {if $anio==$anio_fin}selected=""{/if}>
                {$anio_fin}
              </option>
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
