<?php

namespace App\Validators;

use App\Validators\BaseValidator;
use Illuminate\Validation\Factory;

class ValidatorFactory
{
    
    private Factory $validatorFactory;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function make(string $validatorClass, array $data = []): BaseValidator
    {
        $validator = $this->validatorFactory->make($data, [], []);
        $validator = new $validatorClass($validator);
        return $validator;
    }

}

