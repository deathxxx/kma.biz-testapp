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

    public function migrate() {
//        $this->client->write('DROP TABLE IF EXISTS ' . $this->table);
        $this->client->write('CREATE TABLE ' . $this->table . ' (url String, length Int32) ENGINE = Memory');
    }

    public function create($url, $length)
    {
        $this->client->insert($this->table, [
            [$url, $length]
        ]);
    }


}