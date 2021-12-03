<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';

    protected $fillable = [
        'number',
        'name',
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'day_number', 'number');
    }
}
