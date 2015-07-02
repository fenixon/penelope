{if isset($flash)==true}
  <div class="row">
  <div role="alert" class="alert alert-{$flash['tipo_alerta']}">
    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

      <ul>
        {foreach $flash['mensajes'] as $mensaje}
          <li>{$mensaje}</li>
        {foreachelse}
          <li>N/A</li>
        {/foreach}
      </ul>
  </div>
  </div>
{/if}
