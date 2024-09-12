<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use SoftDeletes;

    protected $table = 'module';

    protected $fillable = ['educatorID', 'title'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'moduleID');
    }

    public function educator()
    {
        return $this->belongsTo(User::class, 'educatorID');
    }
}
