<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'name', 'board_id', 'status'
    ];

    public function list(): BelongsTo
    {
        return $this->belongsTo(Lists::class, 'lists_id');
    }
}