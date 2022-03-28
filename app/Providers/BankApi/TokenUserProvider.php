<?php

namespace App\Providers\BankApi;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Http;

class TokenUserProvider implements UserProvider
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private const EMAIL = 'email';

    /**
     * @var string
     */
    private const TOKEN = 'token';
    private const PASSWORD = 'password';

    /**
     * Create a new token sso user provider.
     *
     * @param  string  $email
     * @param  string  $token
     * @return void
     */
    public function __construct()
    {

        $this->host = env('SSO_HOST');
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier): ?Authenticatable
    {

        dd("here 6");
        return null;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($email, $token): ?Authenticatable
    {
        dd("here 5");
        return $this->getUser($email, $token);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials = []): ?Authenticatable
    {

        if (!array_key_exists(self::EMAIL, $credentials) && !array_key_exists(self::PASSWORD, $credentials)) {
            return null;
        }

        if (!$this->validate($credentials[self::EMAIL], $credentials[self::PASSWORD])) {
            return null;
        }

        return $this->getUser($credentials[self::EMAIL], $credentials[self::PASSWORD]);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials = []): bool
    {

        dd("here 3 ");
        return $this->validate($credentials[self::EMAIL], $credentials[self::TOKEN]);
    }

    /**
     * instance user from sso data user
     *
     * @param  string $email
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function getUser(?string $email, ?string $token): ?Authenticatable
    {
        $data = [
            "Name"=>$email,
            "Password"=>$token
        ];
        $response = Http::withHeaders([
            self::EMAIL => $email,
            self::TOKEN => $token,
        ])->post('http://localhost:65455/v1/auth/login',$data);

        if ($response->status() !== 200) {
            return null;
        }

        $ssoUserInfo = json_decode($response->body());
        if (!$ssoUserInfo) {
            return null;
        }

        return new User((array) $ssoUserInfo);
    }


    /**
     * validate if email and token are valid
     *
     * @param  string $email
     * @param  string $token
     * @return bool
     */
    private function validate(?string $email, ?string $token): bool
    {
        $data = [
            "Name"=>$email,
            "Password"=>$token
        ];
        $response = Http::withHeaders([
            self::EMAIL => $email,
            self::TOKEN => $token,
        ])->post('http://localhost:65455/v1/auth/login',$data);
        return $response->status() == 200;
    }
}
