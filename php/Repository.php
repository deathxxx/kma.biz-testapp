<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'DbConnectMaria.php';
require_once 'DbConnectClickHouse.php';

class Repository {
    private $maria;
    private $clickhouse;

    public function __construct() {
        $this->maria = new DbConnectMaria();
        $this->clickhouse = new DbConnectClickHouse();
    }

    public function execute($curlResp) {
        $time = microtime(true);
        $this->maria->create($curlResp['url'], $curlResp['response_length'], $time);
        $this->clickhouse->create($curlResp['url'], $curlResp['response_length'], $time);
    }

    public function __destruct() {
        $this->maria->close();
        $this->clickhouse->close();
    }

}