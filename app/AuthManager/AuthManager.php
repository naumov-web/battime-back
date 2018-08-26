<?php

namespace App\AuthManager;

use Auth;
use JWTAuth;
use App\User;
use JWTFactory;

class AuthManager
{
    /**
     * Login user
     */
    public function login(array $credentials)
    {
        if(Auth::once($credentials)) {
            $user = Auth::getUser();
        } else {
            abort(400, 'Invalid Credentials');
        }

        return $this->createTokenSet($user);
    }

    /**
     * Create JWT token
     *
     * @return string
     */
    protected function createToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    /**
    * Create JWT refresh token
    *
    * @return string
    */
    protected function createRefreshToken($user)
    {
        $claims = [
            'sub' => $user->id,
            'type' => 'refresh',
            'exp'=> time() + config('jwt.refresh_ttl')
        ];
        $payload = JWTFactory::make($claims);

        return JWTAuth::encode($payload)->get();
    }

    /**
     * Guess identifier type
     */
    protected function guessIdentifierType($identifier)
    {
        return 'email';
    }

    /**
     * Create token and refresh token
     */
    protected function createTokenSet(User $user)
    {
        $token = $this->createToken($user);
        $refreshToken = $this->createRefreshToken($user);

        return ['token'=>$token,
                'refresh_token'=>$refreshToken,
                'id'=>$user->id];
    }

}