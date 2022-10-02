<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password_reset extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
    protected $table = 'password_resets';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}