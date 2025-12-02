<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    /**
     * Menampilkan daftar lamaran (ADMIN ONLY)
     */
    public function index()
    {
        // Admin melihat semua lamaran
        $applications = Application::with(['user', 'jobListing'])->latest()->get();
        return view('applications.index', compact('applications'));
    }

    /**
     * Menyimpan lamaran baru (USER BIASA)
     */
    public function store(Request $request, JobListing $job)
    {
        // Validasi file CV
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Upload file CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Buat lamaran
        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'cv' => $cvPath,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    /**
     * Update status lamaran (ADMIN ONLY)
     */
    public function update(Request $request, Application $application)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $application->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status lamaran berhasil diupdate!');
    }

//     public function myApplications()
// {
//     // Pastikan bukan admin
//     if (Auth::user()->is_admin) {
//         return redirect('/applications');
//     }

//     $applications = Application::with('jobListing')
//         ->where('user_id', Auth::id())
//         ->latest()
//         ->get();

//     return view('applications.my-applications', compact('applications'));
// }

    public function myApplications()
    {
        if (Auth::user()->is_admin) {
            return redirect('/applications');
        }

        $applications = Application::with('jobListing')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        
        return view('applications.my-applications', compact('applications'));
    }

    public function export()
        {
        return Excel::download (new ApplicationsExport, 'applications.xlsx');
        }


    public function downloadCV($id)
    {
        $application = Application::findOrFail($id);
        $filePath = storage_path('app/public/' . $application->cv);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, 'CV_' . $application->user->name . '.pdf');
    }
}