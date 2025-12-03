<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Models\JobListing;

class JobApiController extends Controller
{
    public function index()
    {
        $jobs = JobListing::all();
        return new JobResource(true, 'List Data Lowongan Kerja', $jobs);
    }
    
    public function show($id)
    {
        $job = JobListing::find($id);
        
        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Data lowongan tidak ditemukan'
            ], 404);
        }
        
        return new JobResource(true, 'Detail Data Lowongan', $job);
    }
}