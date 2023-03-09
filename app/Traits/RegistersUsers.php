<?php

namespace App\Traits;

use App\Http\Requests\Auth\StoreRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Laravel\Socialite\Facades\Socialite;

trait RegistersUsers
{
    use RedirectsUsers;

    public function create(StoreRequest $request)
    {
        return User::create($request->validated());
    }

    public function registerGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // Update existing user's information
            $existingUser->name = $user->name;
            $existingUser->save();
        } else {
            // Create new user
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->save();
        }

        // Log the user in
        auth()->login($existingUser ?? $newUser);

        return  redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
