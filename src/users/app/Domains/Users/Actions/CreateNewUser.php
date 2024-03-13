<?php

namespace App\Domains\Users\Actions;

use App\Domains\Users\Jobs\PingJob;
use App\Models\User;
use Illuminate\Support\Str;

class CreateNewUser
{
    public function __construct(public array $data)
    {
    }

    public function execute(): User
    {
        $password = Str::random();

        $user =  User::create([
           'first_name' => $this->data['firstName'],
            'last_name' => $this->data['lastName'],
            'email' => $this->data['email'],
            'password' => bcrypt($password),
        ]);

        PingJob::dispatch($user->toArray());

        return $user;
    }
}
