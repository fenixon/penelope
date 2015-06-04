{extends file='layouts/main.tpl'}
{block name=body}
<h1>REGISTRO CON GOOGLE</h1>
<div>
  <a id="penelope_button" name="penelope_button" href="usuario/create">
    Registrarse con Penélope
  </a>
  |
  <a id="facebook_button" name="facebook_button" href="usuario/create/facebook">
    Registrarse con Facebook
  </a>
  |
  <a id="twitter_button" name="twitter_button" href="usuario/create/twitter">
    Registrarse con Twitter
  </a>
</div>
{/block}
