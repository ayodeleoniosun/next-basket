<?php

namespace App\Domains\Users\Jobs;

use App\Domains\Users\Actions\AppendUserDataInLog;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;

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

        (new AppendUserDataInLog($data))->execute();
    }

    private function getDataFromPublisher()
    {
        $payload = json_decode(json_encode($this->payload()));
        $user = unserialize($payload->data->command);

        return $this->convertToObject($user)->data;
    }

    private function convertToObject($object)
    {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:'.strlen('stdClass').':"'.'stdClass'.'"',
            serialize($object)));
    }
}
