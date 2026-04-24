<?php
namespace App\Concerns;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
trait ShiftValidationRules {
    /**
     * Rules for creating a shift.
     * Managers may optionally assign a user_id at creation time.
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function shiftCreateRules(): array {
        return [
            ...$this->shiftDateTimeRules(),
            'user_id' => ['nullable', 'integer', Rule::exists('users', 'id')]
        ];
    }
    /**
     * Rules for updating a shift.
     * All date/time fields become optional so partial updates are allowed.
     * user_id assignment is validated but left to the policy to authorize.
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function shiftUpdateRules(): array {
        return [
            'start_date' => ['sometimes', 'required', 'date'],
            'end_date'   => ['sometimes', 'required', 'date', 'after_or_equal:start_date'],
            'start_time' => ['sometimes', 'required', 'date_format:H:i:s'],
            'end_time'   => ['sometimes', 'required', 'date_format:H:i:s'],
            'user_id'    => ['sometimes', 'nullable', 'integer', Rule::exists('users', 'id')]
        ];
    }
    /**
     * Shared date/time rules used when all four fields are required.
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    private function shiftDateTimeRules(): array {
        return [
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'start_time' => ['required', 'date_format:H:i:s'],
            'end_time' => ['required', 'date_format:H:i:s']
        ];
    }
}