<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'DbConnectMaria.php';
require_once 'DbConnectClickHouse.php';

/**
 * 0) init - check if databases exists
 */
$drop = true;

$maria = new DbConnectMaria();
$maria->checkMigration($drop);

$clickhouse = new DbConnectClickHouse();
$clickhouse->checkMigration($drop);

echo "Initiated successfully\n";