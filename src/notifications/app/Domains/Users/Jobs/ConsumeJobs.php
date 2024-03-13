<?php

namespace App\Domains\Users\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpAmqpLib\Message\AMQPMessage;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\RabbitMQQueue;

class ConsumeJobs extends RabbitMQJob
{


    /**
     * Execute the job.
     *
     * @return void
     */
    public function fire()
    {
        $payload = json_decode(json_encode($this->payload()));

        $user = unserialize($payload->data->command);
        dd($user);

        $data = json_decode($this->getRawBody(), true);
        print_r($data);
    }
}
