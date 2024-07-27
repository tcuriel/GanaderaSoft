<?php

namespace App\Validators;
use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{
    abstract protected function rules(): array;

    public function validate(array $data): bool
    {
        $validator = Validator::make($data, $this->rules());
        return $validator->passes();
    }

    public function errors(array $data): array
    {
        $validator = Validator::make($data, $this->rules());
        return $validator->errors()->all();
    }
}