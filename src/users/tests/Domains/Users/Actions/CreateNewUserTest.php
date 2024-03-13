<?php

namespace Tests\Domains\Users\Actions;

use App\Domains\Users\Actions\CreateNewUser;
use App\Domains\Users\Jobs\PublishUserDataToNotificationService;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Queue;

it('can create new users', function () {
    Queue::fake();

    $faker = Factory::create();

    $payload = [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
    ];

    $user = (new CreateNewUser($payload))->execute();

    Queue::assertPushed(PublishUserDataToNotificationService::class);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->first_name)->toEqual($payload['firstName'])
        ->and($user->last_name)->toEqual($payload['lastName'])
        ->and($user->email)->toEqual($payload['email']);
});

