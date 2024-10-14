<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'step_id',
        'end_date',
        'status'
    ];

    protected $dates = [
        'end_date'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
