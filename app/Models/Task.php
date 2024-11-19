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
        'assigned_by',
        'created_by',
        'closed_by',
        'step_id',
        'end_date',
        'status'
    ];

    protected $dates = [
        'end_date'
    ];

    protected $attributes = [];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function assignedBy()
    {
        $assignedBy = $this->belongsTo(User::class, "assigned_by")->first();

        $assignedBy = $assignedBy ? $assignedBy : null;

        return  $assignedBy;
    }
}
