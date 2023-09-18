<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/DbConnectClickHouse.php';

$clickhouse = new DbConnectClickHouse();
$clickhouse->migrate();