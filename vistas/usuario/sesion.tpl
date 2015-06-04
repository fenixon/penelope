{extends file='layouts/main.tpl'}
{block name=body}
<form class="form-horizontal" action='usuario/sesion' method='POST'>
  <fieldset>
    <legend>Iniciar sesión</legend>

    <div class="control-group">
      <label class="control-label" for="nick_email">Nick/Email</label>
      <div class="controls">
        <input id="nick_email"
               name="nick_email"
               placeholder="Ej.: lazyjoe/lazy.joe@mail.com"
               class="input-xlarge"
               required=""
               type="text"/>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="contrasenia">Contraseña</label>
      <div class="controls">
        <input id="contrasenia"
               name="contrasenia"
               placeholder="Ej.: ******"
               class="input-xlarge"
               required=""
               type="password"/>
      </div>
    </div>

    <div class="control-group">
      <div class="controls">
        <input id="iniciar_sesion"
               name="iniciar_sesion"
               type="submit"
                class="btn btn-primary"
                value="Iniciar"/>
      </div>
    </div>

  </fieldset>
</form>
{/block}

