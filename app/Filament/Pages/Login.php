<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Http\Livewire\Auth\Login as FilamentLogin;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Login extends FilamentLogin
{
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('nik')
                ->label('NIK')
                ->required()
                ->autocomplete(),
            TextInput::make('password')
                ->label(__('filament::login.fields.password.label'))
                ->password()
                ->required(),
            Checkbox::make('remember')
                ->label(__('filament::login.fields.remember.label')),
        ];
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'nik' => __('filament::login.messages.throttled', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }

        $data = $this->form->getState();

        if (!Filament::auth()->attempt([
            'nik' => $data['nik'],
            'password' => $data['password'],
        ], $data['remember'])) {
            throw ValidationException::withMessages([
                'nik' => __('filament::login.messages.failed'),
            ]);
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
