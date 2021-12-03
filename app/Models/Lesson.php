<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';

    protected $fillable = [
        'number',
        'start_time',
        'end_time',
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'lesson_number', 'number');
    }
}
