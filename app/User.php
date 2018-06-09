<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 *
 * @version 1.0.0
 * @package App
 * @author Stanislav Burikhin
 */
class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Set the user's name.
     *
     * @param  string $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }

    /**
     * Set the password
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }
}
