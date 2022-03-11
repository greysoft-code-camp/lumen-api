<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

//Run O!
class Board extends Model
{
    protected $casts = [
        'lists' => 'array'
    ];

    protected $fillable = [
        'user_id','name', 'lists',
    ];

    /**
     * Get the user that owns the Board
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lists(): HasMany
    {
        return $this->hasMany(Lists::class);
    }

    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(
            Task::class,
            Lists::class,
            'board_id',
            'lists_id',
            'id',
            'id',
        );
    }
}
