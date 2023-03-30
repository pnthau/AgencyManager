<?php

namespace App\Traits\Users;

use App\Http\Requests\Auth\StoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


trait RegistersUsers
{
    use RedirectsUsers;

    public function registering(StoreRequest $request)
    {
        $request['password'] = Hash::make($request['passwordF']);
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function registerGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $data = Socialite::driver('google')->user();
        $user = User::where('email', $data->email)->first();
        $is_exist = is_null($user);
        if (!$user) {
            // Create a new user.
            $user = new User;
            $user->email = $user->email;
        }
        $user->name = $data->name;
        $user->avatar = $data->avatar;
        $user->save();
        //Log the user in
        auth()->guard()->login($user);
        return  $is_exist ?  redirect($this->redirectPath()) : redirect()->route('register');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
