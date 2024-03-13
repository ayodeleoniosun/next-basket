<?php

namespace App\Domains\Users\Http\Controllers;

use App\Domains\Users\Actions\CreateNewUser;
use App\Domains\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = (new CreateNewUser($request->validated()))->execute();

        return response()->success('User successfully created.', $user, 201);
    }
}
