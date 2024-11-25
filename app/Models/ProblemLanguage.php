<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemLanguage extends Model
{
    protected $table = 'problem_languages';
    protected $fillable = [
        'problem_id',
        'language_id'
    ];
    use HasFactory;

    public function problem() {
        return $this->belongsTo(Problem::class, 'problem_id');
    }

    public function language() {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
