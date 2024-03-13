<?php

namespace App\Domains\Users\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
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
    public function fire(): void
    {
        $data = $this->getDataFromPublisher();

        Storage::append('users.log', json_encode($data));
    }

    private function getDataFromPublisher() {
        $payload = json_decode(json_encode($this->payload()));
        $user = unserialize($payload->data->command);

        return $this->convertToObject($user)->data;
    }

    private function convertToObject($object)
    {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen('stdClass') . ':"' .'stdClass'. '"', serialize($object)));
    }
}
