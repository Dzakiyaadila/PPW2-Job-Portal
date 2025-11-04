<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // TAMPILKAN SEMUA LOWONGAN (UNTUK USER BIASA)
    public function index()
    {
        $jobs = Job::where('is_active', true)->get();
        return view('jobs.index', compact('jobs'));
    }

    // TAMPILKAN FORM TAMBAH LOWONGAN (ADMIN ONLY)
    public function create()
    {
        return view('jobs.create');
    }

    // SIMPAN LOWONGAN BARU (ADMIN ONLY)
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'salary_range' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Job::create($request->all());

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil ditambahkan!');
    }

    // TAMPILKAN DETAIL LOWONGAN
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    // TAMPILKAN FORM EDIT (ADMIN ONLY)
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    // UPDATE LOWONGAN (ADMIN ONLY)
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'salary_range' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $job->update($request->all());

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil diupdate!');
    }

    // HAPUS LOWONGAN (ADMIN ONLY)
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }
}