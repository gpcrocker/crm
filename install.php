<?php

/** LOAD ENV */
require __DIR__ . '/app/bootstrap.php';

class Installer
{
    /** @var PDO $db */
    protected $db;

    /** Credentials */
    protected $dbHost;
    protected $dbName;
    protected $dbUser;
    protected $dbPass;
    protected $dbCharset;

    /**
     * Installer constructor.
     * @param $db
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function __construct($db)
    {
        if ($db['host']  !== false) {
            $this->dbHost = $db['host'] ;
        } else {
            throw new \Psr\Log\InvalidArgumentException('DB_HOST Not Set');
        }

        if ($db['name'] !== false) {
            $this->dbName = $db['name'];
        } else {
            throw new \Psr\Log\InvalidArgumentException('DB_NAME Not Set');
        }

        if ($db['user'] !== false) {
            $this->dbUser = $db['user'];
        } else {
            throw new \Psr\Log\InvalidArgumentException('DB_USER Not Set');
        }

        if ($db['pass'] !== false) {
            $this->dbPass = $db['pass'];
        } else {
            throw new \Psr\Log\InvalidArgumentException('DB_PASS Not Set');
        }

        if ($db['charset'] !== false) {
            $this->dbCharset = $db['charset'];
        } else {
            throw new \Psr\Log\InvalidArgumentException('DB_CHARSET Not Set');
        }
    }

    protected function getPdoObject()
    {
        $dsn ="mysql:host=$this->dbHost";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = null;
        try {
            $pdo = new PDO($dsn, $this->dbUser, $this->dbPass, $opt);
        } catch (\PDOException $pde) {
            die('Error: '.$pde->getMessage().' Code: '.$pde->getCode());
        }
        return $pdo;
    }

    /**
     * @return bool
     */
    public function run()
    {
        if (!(PHP_SAPI === 'cli')) {
            return false;
        }

        if ($pdo = $this->getPdoObject()) {
            $pdo->query("CREATE DATABASE IF NOT EXISTS $this->dbName");
            $pdo->query("use $this->dbName");
        }
    }

}

$db['host'] = getenv('DB_HOST');
$db['name'] = getenv('DB_NAME');
$db['user'] = getenv('DB_USER');
$db['pass'] = getenv('DB_PASS');
$db['charset'] = getenv('DB_CHARSET');

$install = new Installer($db);
$install->run();
