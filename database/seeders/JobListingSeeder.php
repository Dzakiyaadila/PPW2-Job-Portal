<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;
use App\Models\User;

class JobListingSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('is_admin', true)->first();

        if ($admin) {
            JobListing::create([
                'title' => 'Full Stack Developer',
                'company' => 'PT Tech Indonesia',
                'location' => 'Jakarta',
                'salary' => 15000000,
                'description' => 'Membuat aplikasi web dengan Laravel dan Vue.js',
                'user_id' => $admin->id
            ]);

            JobListing::create([
                'title' => 'UI/UX Designer',
                'company' => 'Creative Studio',
                'location' => 'Bandung',
                'salary' => 12000000,
                'description' => 'Mendesain interface yang user-friendly',
                'user_id' => $admin->id
            ]);

            JobListing::create([
                'title' => 'Data Analyst',
                'company' => 'Data Corp',
                'location' => 'Surabaya',
                'salary' => 13000000,
                'description' => 'Analisis data untuk business intelligence',
                'user_id' => $admin->id
            ]);
        }
    }
}