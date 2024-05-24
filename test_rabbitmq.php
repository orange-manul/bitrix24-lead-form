<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;

require 'vendor/autoload.php';

try {
    $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
    echo "Connected to RabbitMQ";
    $connection->close();
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
