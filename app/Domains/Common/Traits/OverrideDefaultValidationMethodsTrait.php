<?php

namespace App\Domains\Common\Traits;

use App\Domains\Common\Enums\StatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

trait OverrideDefaultValidationMethodsTrait
{
    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => StatusEnum::ERROR->value,
                    'message' => $validator->errors()->first(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY)
            );
        }

        parent::failedValidation($validator);
    }
}
