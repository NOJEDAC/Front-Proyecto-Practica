<?php

namespace App\Providers\BankApi;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class TokenGuard implements Guard
{
    use GuardHelpers;

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
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(
        UserProvider $provider,
        Request $request
    ) {
        $this->request = $request;
        $this->provider = $provider;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(): ?Authenticatable
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        if (!empty($this->request->header(self::TOKEN))) {
            $credentials = [
                self::EMAIL => $this->request->header(self::EMAIL),
                self::PASSWORD => $this->request->header(self::PASSWORD),
            ];

            $user = $this->provider->retrieveByCredentials($credentials);
        }

        return $this->user = $user;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = []): bool
    {
        if (empty($credentials[self::PASSWORD])) {
            return false;
        }

        $credentials = [
            self::EMAIL => $credentials[self::EMAIL],
            self::PASSWORD => $credentials[self::PASSWORD],
        ];

        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * Set the current request instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}
