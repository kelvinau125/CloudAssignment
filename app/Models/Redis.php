<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redis extends Model
{
    use HasFactory;

    // Define the table name if it's not pluralized automatically
    protected $table = 'redis';

    // Define which fields are mass assignable
    protected $fillable = [
        'studentID',
        'moduleID',
        'data',
    ];

    // Specify that the 'data' field is JSON
    protected $casts = [
        'data' => 'array', // This will automatically handle the JSON encoding/decoding
    ];

    /**
     * Get the student associated with the Redis entry.
     * Only return users where 'user_role' is 'student'.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'studentID')
                    ->where('user_role', 'student');
    }

    /**
     * Get the module associated with the Redis entry.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleID');
    }
}
