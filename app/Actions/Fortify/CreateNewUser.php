<?php
namespace App\Actions\Fortify;
use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules, ProfileValidationRules;
    /**
     * Validate and create a newly registered user.
     * @param  array<string, string>  $input
     */
    public function create(array $input): User {
        Validator::make($input, [
            ...$this->profileRules(),
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'password' => $this->passwordRules()
        ])->validate();
        return User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'] ?? null,
            'password' => $input['password']
        ]);
    }
}