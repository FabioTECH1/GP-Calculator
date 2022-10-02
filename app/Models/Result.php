<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    protected $casts = [
        'course' => 'array',
        'unit' => 'array',
        'grade' => 'array',
        'grade_alpha' => 'array'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}