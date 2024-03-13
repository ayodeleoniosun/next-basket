<?php

namespace App\Domains\Users\Actions;

use Illuminate\Support\Facades\Storage;

class AppendUserDataInLog
{
    public function __construct(public array $data)
    {
    }

    public function execute(): void
    {
        Storage::append('users.log', json_encode($this->data));
    }
}
