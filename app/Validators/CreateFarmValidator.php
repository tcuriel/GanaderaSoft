<?php

namespace App\Validators;

use App\Validators\BaseValidator;

class CreateFarmValidator extends BaseValidator
{
    protected function rules(): array
    {
        $exploitations = config('app.explotacion');
        $exploitationsRules = [];

        foreach ($exploitations as $exploitation) {
            $exploitationsRules[] = $exploitation;
        }

        return [
            'name' => 'required|string|max:255',
            'exploitation' => 'required|in:' . implode(',', $exploitationsRules),
        ];
    }
}
