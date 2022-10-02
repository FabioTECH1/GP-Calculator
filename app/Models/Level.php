<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = [
        'level'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}