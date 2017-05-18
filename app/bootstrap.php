<?php

const DOT_ENV = __DIR__ . '/../';

require __DIR__ . '/../vendor/autoload.php';

if (file_exists(DOT_ENV . '/.env')) {
    $dotEnv = new \Dotenv\Dotenv(DOT_ENV);
    $dotEnv->load();
    unset($dotEnv);
}
