<?php

namespace Tests\Domains\Users\Actions;

use App\Domains\Users\Actions\AppendUserDataInLog;
use Faker\Factory;
use Illuminate\Support\Facades\Storage;

it('can append new user data to a log file', function () {
    Storage::fake();

    $faker = Factory::create();

    $payload = [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
    ];

    (new AppendUserDataInLog($payload))->execute();

    Storage::assertExists('users.log');
    
    $content = json_decode(Storage::get('users.log'));

    expect($content)->toBeObject()
        ->and($content->firstName)->toEqual($payload['firstName'])
        ->and($content->lastName)->toEqual($payload['lastName'])
        ->and($content->email)->toEqual($payload['email']);
});
