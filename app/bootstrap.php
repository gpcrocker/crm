<?php

const DOT_ENV = __DIR__ . '/../';

if (file_exists(DOT_ENV . '/.env')) {
    $dotEnv = new \Dotenv\Dotenv(DOT_ENV);
    $dotEnv->load();
    unset($dotEnv);
}
