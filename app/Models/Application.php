<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobListing;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id', 
        'cv',
        'status'
    ];


    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }

    // Relasi ke user (pelamar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke job listing (lowongan yang dilamar)
    // public function JobListing()
    // {
    //     return $this->belongsTo(JobListing::class);
    // }
}