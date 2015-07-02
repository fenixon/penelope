{extends file='layouts/main.tpl'}

{block name=navbar}
  {include file='usuario/barra_usuario.tpl'}
{/block}

{block name=body}
<div class="row">
  <form class="form" method="POST" action="usuario/actualizar">
    <fieldset>
      <div class="row">
        <h1 class="page-header">{$usuario->getNick()}</h1>
      </div>

      <div class="row">
        <div class="control-group">
          <label class="control-label" for="nombres">Nombres</label>
          <div class="controls">
            <input id="nombres"
                   name="nombres"
                   class="control"
                   type="text"
                   value="{$usuario->getNombres()}"
                   placeholder="ej.: Lazy"/>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="apellidos">Apellidos</label>
          <div class="controls">
            <input id="apellidos"
                   name="apellidos"
                   class="control"
                   type="text"
                   value="{$usuario->getApellidos()}"
                   placeholder="ej.: Joe"/>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input id="email"
                   name="email"
                   class="control"
                   type="email"
                   value="{$usuario->getEmail()}"
                   placeholder="ej.: email@penelope.com.uy"/>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="fecha_nac">Fecha de nacimiento</label>
          <div class="controls">
            <input id="fecha_nac"
                   name="fecha_nac"
                   class="control"
                   type="text"
                   value="{$usuario->getFechaNac()}"
                   placeholder="ej.: 12/03/2015"/>
          </div>
        </div>
      </div>

      <div class="row">
        <input type="submit" class="btn btn-primary" value="Guardar"/>
        <a class="btn btn-danger" href="usuario/perfil">Cancelar</a>
      </div>
    </fieldset>
  </form>
</div>
{/block}
