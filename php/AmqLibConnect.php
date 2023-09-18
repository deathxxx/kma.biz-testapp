<?php

//require_once __DIR__. '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AmqLibConnect
{

    private $connection;
    private $channel;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function connect()
    {


        // Set up the connection to RabbitMQ
        $this->connection = new AMQPStreamConnection('173.25.0.6', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();

        // Declare the queue
        $this->channel->queue_declare('my_queue', false, true, false, false);



//        echo "Connected RabbitMQ\n";
    }

    public function disconnect() {
        // Close the connection
        $this->channel->close();
        $this->connection->close();

//        echo "Close RabbitMQ\n";
    }

    public function send($url) {
        // Create a message
        $message = new AMQPMessage($url, array('delivery_mode' => 2));

        // Publish the message to the queue
        $this->channel->basic_publish($message, '', 'my_queue');

        echo "Send to RabbitMQ\n";
    }

    public function get() {
        return ($this->channel->basic_get('my_queue', true, null)->body);
    }

    public function listen(&$callback) {


// Consume messages from the queue
        $this->channel->basic_consume('my_queue', '', false, true, false, false, $callback);

        return $this->channel;
    }
}