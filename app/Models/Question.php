<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'question';

    protected $fillable = ['question', 'ans1', 'ans2', 'cors_ans', 'moduleID'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleID');
    }
}
