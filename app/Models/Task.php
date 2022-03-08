<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'name', 'board_id', 'status'
    ];

    public function board() :BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
}