<?php
	define("DB_HOST", "localhost");
	define("DB_USR", "phpdba");
	define("DB_PASS", "PHP 1234 algo mas complejo");
	define("DB_DB", "penelope");
	//define(DB_TYPE, "mysql");

	$template_config = 
    array(
        'template_dir' => 'vistas/',
        'compile_dir' => 'libs/smarty/templates_c/',
        'cache_dir' => 'libs/smarty/cache/',
        'config_dir' => 'libs/smarty/configs/',
        );
    define ("URL_BASE","/penelope/");
?>
