<?php

namespace App\Rules;

use App\Models\Service;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StatusRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $service = Service::find($value);
        if (! $service?->status) {
            $fail('The service must be active to create one product.');
        }
    }
}
