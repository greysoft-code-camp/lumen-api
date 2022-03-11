<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lists extends Model
{
    protected $fillable = [
        'list', 'board_id',
];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}