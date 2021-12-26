<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;


/**
 * Class User
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $phone_verified_at
 * @property string $email
 * @property string $email_verify_at
 * @property string $avatar
 * @property string $password
 * @property string $remember_token
 * @property integer $role
 * @property string $address
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const TABLE_NAME = 'ref_user';
    protected $table = self::TABLE_NAME;

    const ATTR_ID              = 'id';
    const ATTR_NAME            = 'name';
    const ATTR_PHONE           = 'phone';
    const ATTR_PHONE_VERIFY_AT = 'phone_verified_at';
    const ATTR_EMAIL           = 'email';
    const ATTR_EMAIL_VERIFY_AT = 'email_verified_at';
    const ATTR_AVATAR          = 'avatar';
    const ATTR_BIRTHDAY        = 'birthday';
    const ATTR_ROLE            = 'role';
    const ATTR_PASSWORD        = 'password';
    const ATTR_ADDRESS         = 'address';
    const ATTR_REMEMBER_TOKEN  = 'remember_token';
    const ATTR_CREATED_AT      = 'created_at';
    const ATTR_UPDATED_AT      = 'updated_at';

    const ROLE_ADMIN = 1;
    const ROLE_USER  = 0;
    
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
        'avatar',
        'birthday',
        'address',
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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function sendEmailConfirmation($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function hasUserVerified()
    {
        return !is_null($this->email_verified_at) || !is_null($this->phone_verified_at);
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function hasVerifiedPhone()
    {
        return !is_null($this->phone_verified_at);
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            static::ATTR_PHONE_VERIFY_AT => $this->freshTimestamp(),
//            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }
}
