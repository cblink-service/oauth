<?php

namespace Cblink\Service\OAuth;

use Illuminate\Auth\GenericUser;

/**
 * Class User
 * @package Cblink\Service\OAuth
 * @property-read integer   $id
 * @property-read string    $name
 * @property-read string    $account
 * @property-read integer   $role
 * @property-read integer   $status
 */
class User extends GenericUser
{
}