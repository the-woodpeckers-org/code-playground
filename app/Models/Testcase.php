<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testcase extends Model
{
    use HasFactory;

    protected $fillable = [
        'stdin'
    ];

    public function Problem() {
        return $this->belongsTo(Problem::class);
    }
}
