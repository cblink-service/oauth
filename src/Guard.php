<?php

namespace Cblink\Service\OAuth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard as AuthGuard;
use Illuminate\Support\Facades\Cache;

/**
 * Class Guard
 * @package Cblink\Service\OAuth
 */
class Guard implements AuthGuard
{
    use GuardHelpers;
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ApiService
     */
    protected $service;

    protected $cachePrefix = 'user-token-';

    /**
     * @var User|\Illuminate\Contracts\Auth\Authenticatable
     */
    protected $user;

    public function __construct(Request $request, ApiService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function user()
    {
        if (!is_null($this->user)){
            return $this->user;
        }

        $user = null;

        if ($response = $this->validate()){
            $user = new User($response);
        }

        return $this->user = $user;
    }

    /**
     * @param array $credentials
     * @return bool|array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate(array $credentials = [])
    {
        $token = $this->request->header('Authorization');

        if (Cache::has($this->getCacheKey($token))) {
            return Cache::get($this->getCacheKey($token));
        }

        $user = $this->service->getUser($token);

        if (is_array($user)) {
            Cache::put($this->getCacheKey($token), $user, 600);
        }

        return $user;
    }

    /**
     * @param $token
     * @return string
     */
    protected function getCacheKey($token)
    {
        return $this->cachePrefix . md5($token);
    }
}