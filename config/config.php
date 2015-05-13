<?php
  define("DB_HOST", "localhost");
  define("DB_USR", "phpdba");
  define("DB_PASS", "PHP 1234 algo mas complejo");
  define("DB_DB", "penelope");
  //define(DB_TYPE, "mysql");

  $template_config = array(
    'template_dir' => ROOT_DIR.'/vistas/',
    'compile_dir' => ROOT_DIR.'/vendor/smarty/smarty/templates_c/',
    'cache_dir' => ROOT_DIR.'/vendor/smarty/smarty/cache/',
    'config_dir' => ROOT_DIR.'/vendor/smarty/smarty/configs/'
  );
  define ("URL_BASE","/penelope/");
?>
