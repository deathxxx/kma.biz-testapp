<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// RabbitMQ server configuration
$host = '173.25.0.6';
$port = 5672;
$username = 'guest';
$password = 'guest';
$queueName = 'my_queue2';

$vhost = '/';

// Create a connection
$connection = new AMQPStreamConnection($host, $port, $username, $password, $vhost);

// Create a channel
$channel = $connection->channel();

// Declare a queue (create it if it doesn't exist)
$channel->queue_declare($queueName, false, true, false, false);

// Send 10 messages to the queue
for ($i = 1; $i <= 10; $i++) {
    $messageBody = "Message $i ". microtime(true);
    $message = new AMQPMessage($messageBody);
    $channel->basic_publish($message, '', $queueName);
    echo "Sent: $messageBody\n";
}

// Consume and print 10 messages from the queue
$callback = function ($message) {
    echo "Received: ", $message->body, "\n";
};

$channel->basic_consume($queueName, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

// Close the channel and the connection
$channel->close();
$connection->close();
