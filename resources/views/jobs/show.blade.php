<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Job Portal - {{ $job->title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $job->title }}
            </h2>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications -->
            {{-- @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    <div class="font-semibold">{{ session('success') }}</div>
                    
                    @if(session('success_message'))
                        <p class="mt-2">{{ session('success_message') }}</p>
                    @endif
                    
                    @if(session('show_links'))
                        <div class="mt-3 flex flex-wrap gap-3">
                            <a href="{{ route('applications.my') }}" 
                            class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                👁️ Lihat Lamaran Saya
                            </a>
                            <a href="{{ route('jobs.index') }}" 
                            class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                🔍 Cari Lowongan Lain
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Job Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Job Info -->
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Perusahaan</p>
                            <p class="text-lg font-semibold">{{ $job->company }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="text-lg font-semibold">{{ $job->location }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">Gaji</p>
                            <p class="text-lg font-semibold text-green-600">
                                Rp {{ number_format($job->salary, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        @if($job->logo)
                            <div>
                                <p class="text-sm text-gray-500">Logo Perusahaan</p>
                                <img src="{{ asset('storage/' . $job->logo) }}" 
                                     alt="{{ $job->company }}"
                                     class="h-24 w-24 object-contain">
                            </div>
                        @endif
                        
                        <div>
                            <p class="text-sm text-gray-500">Deskripsi</p>
                            <div class="mt-2 p-4 bg-gray-50 rounded">
                                <p class="text-gray-700 whitespace-pre-line">{{ $job->description }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">Diposting</p>
                            <p class="text-gray-600">{{ $job->created_at->format('d F Y') }}</p>
                        </div>
                    </div>

                    <hr class="my-8">

                    <!-- Application Form (for non-admin users) -->
                    @auth
                        @if(!Auth::user()->is_admin)
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold mb-4">Lamar Pekerjaan Ini</h3>
                                
                                <form action="{{ route('applications.store', $job) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="cv" class="block text-sm font-medium text-gray-700">
                                                Upload CV (PDF/DOC, max 2MB) *
                                            </label>
                                            <input type="file" 
                                                   name="cv" 
                                                   id="cv"
                                                   accept=".pdf,.doc,.docx"
                                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                   required>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Format: PDF, DOC, DOCX. Maksimal: 2MB
                                            </p>
                                        </div>
                                        
                                        <div class="flex items-center justify-end">
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Kirim Lamaran
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <!-- Admin actions -->
                            @if($job->user_id == Auth::id())
                                <div class="mt-8 flex space-x-3">
                                    <a href="{{ route('jobs.edit', $job) }}" 
                                       class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Edit Lowongan
                                    </a>
                                    
                                    <form action="{{ route('jobs.destroy', $job) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Hapus lowongan ini?')"
                                                class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Hapus Lowongan
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @else
                        <!-- Guest message -->
                        <div class="mt-8 p-4 bg-blue-50 rounded">
                            <p class="text-blue-800">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                    Login
                                </a> 
                                untuk melamar pekerjaan ini.
                            </p>
                        </div>
                    @endauth

                    <!-- Back link -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('jobs.index') }}" 
                           class="text-blue-600 hover:text-blue-900 font-medium">
                            ← Kembali ke Daftar Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>