<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;


class CreateRabbitMQQueues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-rabbit-m-q-queues';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create RabbitMQ main and failed queues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection =  new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_LOGIN'),
            env('RABBITMQ_PASSWORD'),
        );

        /** @var AMQPChannel $channel */

        $channel = $connection->channel();

        //Declare main queue
        $channel->queue_declare('main', false, true, false, false);

        // declare failed queue with dead dead-letter exchange
        $channel->queue_declare('failed', false, true, false, false, false, [
            'x-dead-letter-exchange' => ['S', ''],
            'x-dead-letter-routing-key' => ['S', 'main'],
            'x-message-ttl' => ['I', 10000], // 10 second
        ]);

        $channel->close();
        $connection->close();

        $this->info('RabbitMQ queues created successfully');
    }
}
