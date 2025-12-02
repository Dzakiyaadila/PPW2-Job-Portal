<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\JobsImport;
use Maatwebsite\Excel\Facades\Excel;

class JobListingController extends Controller
{

    /**
     * Menampilkan daftar lowongan
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $jobs = JobListing::where('user_id', Auth::id())->latest()->get();
        } else {
            $jobs = JobListing::latest()->get();
        }
        
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Form tambah lowongan (admin only)
     */
    // public function create()
    // {
    //     if (!Auth::user()->is_admin) {
    //         return redirect('/jobs')->with('error', 'Akses ditolak!');
    //     }
        
    //     return view('jobs.create');
    // }
    public function create()
    {
        // Debug sederhana
        // if (!Auth::check()) {
        //     return redirect('/login');
        // }
        
        if (!Auth::user()->is_admin) {
            return redirect('/jobs')->with('error', 'Hanya admin yang bisa buat lowongan!');
        }
        
        // Pakai view sederhana dulu
        return view('jobs.create');
    }


    /**
     * Simpan lowongan baru (admin only)
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/jobs')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        // Handle upload logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $validated['user_id'] = Auth::id();

        JobListing::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil dibuat!');
    }

    public function show(JobListing $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(JobListing $job)
    {
        // Pastikan hanya admin PEMILIK lowongan yang bisa edit
        if (!Auth::user()->is_admin || $job->user_id != Auth::id()) {
            return redirect('/jobs')->with('error', 'Akses ditolak!');
        }
        
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        // Pastikan hanya admin PEMILIK lowongan yang bisa update
        if (!Auth::user()->is_admin || $job->user_id != Auth::id()) {
            return redirect('/jobs')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        // Handle upload logo baru jika ada
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $job->update($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil diupdate!');
    }


    public function destroy(JobListing $job)
    {
        // Pastikan hanya admin PEMILIK lowongan yang bisa hapus
        if (!Auth::user()->is_admin || $job->user_id != Auth::id()) {
            return redirect('/jobs')->with('error', 'Akses ditolak!');
        }

        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }

    public function import(Request $request)
    {
        
    $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::import(new JobsImport,
    $request->file('file'));
        return back()->with('success', 'Data lowongan berhasil diimport');
    }


}