<?php

use ClickHouseDB\Client;

class DbConnectClickHouse
{

    private $table = 'urls';
    private $client;
    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $host = '173.25.0.5';
        $port = 8123;
        $username = '';
        $password = '';
        $database = 'default';

        $this->client = new Client([
            'host' => $host,
            'port' => $port,
            'username' => $username,
            'password' => $password,
            'database' => $database,
        ]);
    }

    private function migrate() {
        $this->client->write('CREATE TABLE ' . $this->table . ' (url String, length Int32, timestamp String, date Nullable(DateTime) default now()) ENGINE = Memory');
    }

    private function drop() {
        $this->client->write('DROP TABLE IF EXISTS ' . $this->table);
    }

    public function create($url, $length, $time)
    {
        $this->client->insert($this->table, [
            [$url, $length, $time, microtime(true)]
        ]);
    }

    public function checkMigration($drop = false){
        if ($drop) {
            $this->drop();
        }
        $query = "SELECT 1 FROM system.tables WHERE database = 'default' AND name = '$this->table'";
        $result = $this->client->select($query);
        if ($result->fetchOne() > 0) {
            echo "Table 'urls' exists in database 'default'.\n";
        } else {
            echo "Table 'urls' does not exist in database 'default'.\n";
            $this->migrate();
        }
    }

    public function report(){
        $query = "SELECT
                   COUNT(*) AS count,
                   DATE_FORMAT(date, '%Y-%m-%d %H:%i') AS grouped_minutes,
                   AVG(length) AS avg_integer,
                   MIN(date) AS first_datetime,
                   MAX(date) AS last_datetime
            FROM mydatabase.urls
            GROUP BY grouped_minutes
            ORDER BY grouped_minutes;";
        $result = $this->client->select($query);
        return $result->fetchOne();
    }


}