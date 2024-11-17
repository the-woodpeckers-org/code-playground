<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageStat extends Model
{
    protected $fillable = [
        'category_id',
        'language_id',
        'attempt_count'
    ];

    use HasFactory;
}
