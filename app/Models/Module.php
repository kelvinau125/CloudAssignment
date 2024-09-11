<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'module';

    protected $fillable = ['educatorID', 'title'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'moduleID');
    }
}
