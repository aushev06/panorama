<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $email_verify_at
 * @property string $avatar
 * @property string $password
 * @property string $remember_token
 * @property integer $role
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const TABLE_NAME = 'ref_user';

    const ATTR_ID              = 'id';
    const ATTR_NAME            = 'name';
    const ATTR_PHONE           = 'phone';
    const ATTR_EMAIL           = 'email';
    const ATTR_EMAIL_VERIFY_AT = 'email_verify_at';
    const ATTR_AVATAR          = 'avatar';
    const ATTR_ROLE            = 'role';
    const ATTR_PASSWORD        = 'password';
    const ATTR_REMEMBER_TOKEN  = 'remember_token';
    const ATTR_CREATED_AT      = 'created_at';
    const ATTR_UPDATED_AT      = 'updated_at';

    const ROLE_ADMIN = 1;
    const ROLE_USER  = 0;

    protected $table = self::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
