<?php

$database_host = getenv('DB_HOST');
$database_name = getenv('DB_NAME');
$database_user = getenv('DB_USER');
$database_password = getenv('DB_PASSWORD');
$mailhost = getenv('MAILHOST');
define('USE_PHPMAILER6', true);
define('IMPORT_FILESIZE',50);
define('TEST', 0);
define('HASH_ALGO', 'sha256');
define('UPLOADIMAGES_DIR','images');
define('VERBOSE',true);
define('ASKFORPASSWORD',true);
define('DEVVERSION',true);
$show_dev_errors = 1;
