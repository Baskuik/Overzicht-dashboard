<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    protected $fillable = [
        'upload_id',
        'action',
        'description',
        'employee_name',
        'duration',
        'cost',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
        'duration' => 'decimal:2',
        'cost' => 'decimal:2',
    ];

    public function upload(): BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }
}
