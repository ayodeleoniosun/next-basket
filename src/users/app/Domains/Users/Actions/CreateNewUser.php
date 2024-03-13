<?php

namespace App\Domains\Users\Actions;

use App\Domains\Users\Jobs\PublishUserDataToNotificationService;
use App\Models\User;
use Illuminate\Support\Str;

class CreateNewUser
{
    public function __construct(public array $data)
    {
    }

    public function execute():User
    {
        $user =  User::create([
           'first_name' => $this->data['firstName'],
            'last_name' => $this->data['lastName'],
            'email' => $this->data['email'],
            'password' => bcrypt(Str::random()),
        ]);

        PublishUserDataToNotificationService::dispatch($user->toArray());

        return $user;
    }
}
