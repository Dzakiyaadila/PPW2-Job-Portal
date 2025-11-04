<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_lists';

    protected $fillable = [
        'position',
        'company',
        'salary_range',
        'capacity',
        'description',
        'location',
        'is_active',
    ];
}
