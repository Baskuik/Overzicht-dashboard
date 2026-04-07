<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['upload_id', 'action', 'description', 'employee_name', 'duration', 'cost', 'date'];

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
