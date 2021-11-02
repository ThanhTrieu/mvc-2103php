<?php

namespace app\configs;

use \PDO;
use \PDOException;
class Database
{
    protected $db;
    private $hostDatabase;
    private $databaseName;
    private $userDatabase;
    private $passwordDatabase;

    public function __construct()
    {
        $this->db = $this->connectionDatabase('localhost','fashion_female','root','');
    }

    protected function connectionDatabase(
        $host,
        $dbName,
        $username,
        $password
    )
    {
        try {
            $this->hostDatabase = $host;
            $this->databaseName = $dbName;
            $this->userDatabase = $username;
            $this->passwordDatabase = $password;

            $dbh = new PDO('mysql:host='.$this->hostDatabase.';dbname='.$this->databaseName.';charset=utf8', $this->userDatabase, $this->passwordDatabase);

            if(ENVIRONMENT === 'development') {
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }

            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    protected function disconnectDatabase()
    {
        $this->db = null;
    }

    public function __destruct()
    {
        $this->disconnectDatabase();
    }
}