<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Problem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'attempt_count',
        'is_passed',
        'passed_at',
        'deleted_at',
        'contest_id',
        'created_by'
    ];

    protected $appends = [
        'testcases',
        'languages',
        'categories'
    ];

    public function getCategoriesAttribute() {
        return ProblemTags::select('categories.*')->where('problem_id', $this->id)->join('categories', 'category_id', '=', 'categories.id')->get();
    }

    public function getLanguagesAttribute() {
        return ProblemLanguage::select('languages.*')->where('problem_id', $this->id)->join('languages', 'languages.id', '=', 'problem_languages.language_id')->get();
    }

    public function getTestcasesAttribute() {
        return Testcase::where('problem_id', $this->id)->get();
    }

    public function testcases()
    {
        return $this->hasMany(Testcase::class, 'problem_id', 'id');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'problem_id', 'id');
    }

}
