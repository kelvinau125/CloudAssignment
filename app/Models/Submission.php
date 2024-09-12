<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    // Define the table name explicitly if Laravel's pluralization doesn't match
    protected $table = 'submission';

    // Define which fields are mass assignable
    protected $fillable = [
        'studentID',
        'moduleID',
        'score',
        'maxscore',
        'review',
    ];

    /**
     * Relationship: A submission belongs to a student (user).
     * Only return users where 'user_role' is 'student'.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'studentID')
                    ->where('user_role', 'student');
    }

    /**
     * Relationship: A submission belongs to a module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleID');
    }

    /**
     * Calculate the percentage score of the submission.
     */
    public function getPercentageAttribute()
    {
        return ($this->score / $this->maxscore) * 100;
    }
}
