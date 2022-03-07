<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Str;
class User extends Model implements Authenticatable
{

    use AuthenticableTrait;

    public $incrementing = false;

    protected $fillable = [
        'username','email', 'api_token', 'password',
    ];
    protected $hidden = [
        'password'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id' => true,
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public static function boot()
     {
        parent::boot();
        static::creating(function($user){
            $user->id = Str::uuid()->toString();
        });
    }
}
