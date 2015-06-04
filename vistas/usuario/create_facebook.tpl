{extends file='layouts/main.tpl'}
{block name=body}
<div class="row">
  <form class="form-horizontal" method="POST" action="usuario/save">
    <fieldset>
      <!-- Form Name -->
      <legend>Registro para {$usuario_facebook}</legend>

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
          <input id="email" name="email" type="hidden" value="{$email}"/>
          <input id="reemail" name="reemail" type="hidden" value="{$email}"/>
          <span>{$email}</span>
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

      <div>
        <a id="penelope_button" name="penelope_button" href="usuario/create">
          Registrarse con Penélope
        </a>
        |
        <a id="google_button" name="google_button" href="usuario/create/google">
          Registrarse con Google
        </a>
        |
        <a id="twitter_button" name="twitter_button" href="usuario/create/twitter">
          Registrarse con Twitter
        </a>
      </div>
    </fieldset>
  </form>
</div>
{/block}
