{extends file='layouts/main.tpl'}
{block name=body}
<div class="row">
  <form class="form-horizontal" method="POST" action="penelope/save">
    <fieldset>
      <!-- Form Name -->
      <legend>Registrar usuario</legend>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="nick">Nombre de usuario</label>
        <div class="controls">
          <input id="nick" name="nick" placeholder="ej.: lazyjoe"
                 class="input-xxlarge" required="" type="text"/>
        </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="email">E-Mail</label>
        <div class="controls">
          <input id="email" name="email" placeholder="ej.: lazyjoe@mail.com"
                 class="input-xlarge" required="" type="text"/>
        </div>
      </div>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="reemail">Confirmación de E-Mail</label>
        <div class="controls">
          <input id="reemail" name="reemail" placeholder="ej.: lazyjoe@mail.com"
                 class="input-xlarge" required="" type="text"/>
        </div>
      </div>

      <!-- Password input-->
      <div class="control-group">
        <label class="control-label" for="contrasenia">Contraseña</label>
        <div class="controls">
          <input id="contrasenia" name="contrasenia" placeholder="ej.: ******"
                 class="input-xlarge" required="" type="contrasenia"/>
        </div>
      </div>

      <!-- Password input-->
      <div class="control-group">
        <label class="control-label" for="recontrasenia">
          Confirmación de contraseña
        </label>
        <div class="controls">
          <input id="recontrasenia" name="recontrasenia" placeholder="ej.: ******"
                 class="input-xlarge" required="" type="password"/>
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
