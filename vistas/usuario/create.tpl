{extends file='layouts/main.tpl'}
{block name=body}
<div class="row">
  <form class="form-horizontal" method="POST" action="penelope/save">
    <fieldset>
      <!-- Form Name -->
      <legend>Registrar usuario</legend>

      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="username">Nombre de usuario</label>
        <div class="controls">
          <input id="username" name="username" placeholder="ej.: lazyjoe"
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

      <!-- Password input-->
      <div class="control-group">
        <label class="control-label" for="password">Contraseña</label>
        <div class="controls">
          <input id="password" name="password" placeholder="ej.: ******"
                 class="input-xlarge" required="" type="password"/>
        </div>
      </div>

      <!-- Password input-->
      <div class="control-group">
        <label class="control-label" for="repassword">
          Confirmación de contraseña
        </label>
        <div class="controls">
          <input id="repassword" name="repassword" placeholder="ej.: ******"
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
