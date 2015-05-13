<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <base href="/penelope/"/>

    <!-- The above 3 meta tags *must* come first in the head; any other head 
    content must come *after* these tags -->

    <meta name="description" content="Penélope"/>

    <title>{block name=title}Penélope | Registro de usuario{/block}</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    {block name=head}{/block}
  </head>

  <body>
    <!-- ================================================================== -->
    <!-- Comienzo de barra de navegación                                    -->
    <!-- ================================================================== -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed"
                  data-toggle="collapse" data-target="#navbar"
                  aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">{$proyecto}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{$url_logout}">Cerrar Sesión</a></li>
          </ul>
          <form class="navbar-form navbar-right" method="post"
                action="{$url_base}usuario/buscar/">
            <input type="text" id="buscar" name="buscar"
                   class="form-control" placeholder="Buscar..."/>
            <input type="submit" value="Buscar"
                   class="form-control btn btn-primary"/>
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
      {block name=body}{/block}
    </div>
  </body>
</html>
