<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'password' => bcrypt(Str::random(16)),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]
            );

            $token = JWTAuth::fromUser($user);

            $userData = json_encode([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'phone' => $user->phone,
            ]);

            // return response()->json([
            //     'status' => 'success',
            //     'token' => $token,
            //     'user' => $user
            // ]);

            return redirect("http://127.0.0.1:8000?token=$token&name=" . urlencode($userData));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
