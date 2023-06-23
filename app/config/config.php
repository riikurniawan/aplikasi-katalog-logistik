<?php

require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

define('BASEURL', 'http://localhost/aplikasi-katalog-logistik/public/');

// set DB const
define('DB_HOST', $_ENV["DB_HOST"]);
define('DB_PORT', $_ENV["DB_PORT"]);
define('DB_USER', $_ENV["DB_USER"]);
define('DB_PASS', $_ENV["DB_PASS"]);
define('DB_NAME', $_ENV["DB_NAME"]);
