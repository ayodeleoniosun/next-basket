<?php

namespace Tests\Domains\Users\Http\Controllers;

use App\Domains\Common\Enums\StatusEnum;
use Faker\Factory;
use Illuminate\Support\Facades\Log;

it('cannot create new users if all required fields are not filled', function () {
    $faker = Factory::create();

    $payload = [
        'firstName' => $faker->firstName,
        'email' => $faker->email,
    ];

    $response = $this->postJson('api/users', $payload)->json();

    expect($response)->toBeArray()
        ->and($response['status'])->toEqual(StatusEnum::ERROR->value)
        ->and($response['message'])->toEqual('The last name field is required.');
});

it('cannot create new users if email exist', function () {
    $faker = Factory::create();

    $payload = [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
    ];

    $this->postJson('api/users', $payload);
    $response = $this->postJson('api/users', $payload)->json();

    expect($response)->toBeArray()
        ->and($response['status'])->toEqual(StatusEnum::ERROR->value)
        ->and($response['message'])->toEqual('The email has already been taken.');
});

it('can create new users', function () {
    $faker = Factory::create();

    $payload = [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
    ];

    $response = $this->postJson('api/users', $payload)->json();
    $user = $response['data'];

    expect($response)->toBeArray()
        ->and($response['status'])->toEqual(StatusEnum::SUCCESS)
        ->and($response['message'])->toEqual('User successfully created.')
        ->and($user['first_name'])->toEqual($payload['firstName'])
        ->and($user['last_name'])->toEqual($payload['lastName'])
        ->and($user['email'])->toEqual($payload['email']);
});
