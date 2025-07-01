<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory , SoftDeletes;

    protected $casts = [
        'options' => 'array',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
