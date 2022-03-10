<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Casts\Attribute;
class User extends Model implements Authenticatable
{

    use AuthenticableTrait;

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
        static::creating(function($user) {
            $user->id = Str::uuid()->toString();
        });
    }

    /**
     * Get all of the boards for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }

    public function tasks() : HasManyThrough
    {
        return $this->hasManyThrough(
            Task::class,
            Board::class,
            'user_id',
            'board_id',
            'id',
            'id'
        );
    }
}