<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Str;
class User extends Model implements Authenticatable
{
   //
   use AuthenticableTrait;

   public $incrementing = false;
   protected $fillable = [
       'username','email','api_token', 'password',
    ];
   protected $hidden = [
   'password'
   ];
   /*
   * Get Todo of User
   *
   */
   public static function boot()
    {
        parent::boot();
        static::created(function($user){
            $user->id = Str::uuid()->toString();
        });
    }
}