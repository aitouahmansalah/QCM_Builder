<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id', 'text', 'options', 'correct_answer',
    ];

    protected $casts = [
        'options' => 'array', 
        'correct_answer' => 'array', 
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function responses()
    {
        return $this->hasMany(StudentResponse::class);
    }
}
