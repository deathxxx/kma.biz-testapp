<?php


require_once 'vendor/autoload.php';

use ClickHouseDB\Client;

// ClickHouse server configuration
$host = '173.25.0.5';
$port = 8123;
$username = '';
$password = '';
$database = 'default';

try {
    // Create a ClickHouse client
    $client = new Client([
        'host' => $host,
        'port' => $port,
        'username' => $username,
        'password' => $password,
        'database' => $database,
    ]);

    // Define the table name and data to insert
    $table = 'your_table';
    $data = [
        ['John', 30],
        ['Alice', 25],
        ['Bob', 35],
    ];

    // Insert data into the table
    $client->insert($table, $data);

    echo "Data inserted successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}