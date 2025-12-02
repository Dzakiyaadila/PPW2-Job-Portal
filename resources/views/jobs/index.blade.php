<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Job Portal - Lowongan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles dari Laravel Breeze -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- NAVIGATION DARI LARAVEL BREEZE -->
    @include('layouts.navigation')

    <!-- HEADER -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Daftar Lowongan Kerja
                </h2>
                {{-- @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('jobs.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            + Tambah Lowongan
                        </a>
                    @endif
                @endauth --}}
                <!-- Admin Actions -->
            {{-- @auth
                @if(Auth::user()->is_admin)
                    <div class="mb-6 flex justify-between items-center">
                        <div class="flex gap-3">
                            <a href="{{ route('jobs.create') }}" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Lowongan
                            </a>
                            
                            <a href="{{ route('applications.index') }}" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                                Lihat Pelamar
                            </a>
                        </div>
                        <span class="text-sm text-gray-600 ">
                            Total: {{ $jobs->count() }} lowongan
                        </span>
                    </div>
                @endif
            @endauth --}}

            <!-- Admin Actions -->
                @auth
                    @if(Auth::user()->is_admin)
                        <div class="mb-6 flex justify-between items-center">
                            <div class="flex gap-3">
                                <a href="{{ route('jobs.create') }}" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Lowongan
                                </a>
                                
                                <a href="{{ route('applications.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
                                    </svg>
                                    Lihat Pelamar
                                </a>
                            </div>
                            <span class="text-sm text-gray-600">
                                Total: {{ $jobs->count() }} lowongan
                            </span>
                        </div>
                    
                    <!-- TAMBAHKAN INI: Untuk User Biasa -->
                    @else
                        <div class="mb-6 flex justify-between items-center">
                            <div class="flex gap-3">
                                <a href="{{ route('applications.my') }}" 
                                class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Lamaran Saya
                                </a>
                            </div>
                            <span class="text-sm text-gray-600">
                                Total: {{ $jobs->count() }} lowongan tersedia
                            </span>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </header>
    
    <main class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Notifications --}}
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- <h2 class="text-xl font-semibold mb-6 text-gray-700">Daftar Lowongan Kerja</h2> --}}

        {{-- Jobs Table --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            @if($jobs->count() > 0)
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-m tracking-wider">
                                <th class="px-5 py-3 text-left">Posisi</th>
                                <th class="px-5 py-3 text-left">Perusahaan</th>
                                <th class="px-5 py-3 text-left">Lokasi</th>
                                <th class="px-5 py-3 text-left">Gaji</th>
                                <th class="px-5 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($jobs as $job)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-5 py-4">
                                        <div class="font-semibold">{{ $job->title }}</div>
                                        <div class="text-gray-500 text-xs">
                                            {{ Str::limit($job->description, 60) }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">{{ $job->company }}</td>
                                    <td class="px-5 py-4">{{ $job->location }}</td>
                                    <td class="px-5 py-4 font-bold text-green-600">
                                        Rp {{ number_format($job->salary, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        @auth
                                            @if(auth()->user()->is_admin && $job->user_id == auth()->id())
                                                <a href="{{ route('jobs.edit', $job) }}" 
                                                   class="text-blue-600 hover:text-blue-800 font-medium mr-3">
                                                    Edit
                                                </a>
                                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" 
                                                            onclick="return confirm('Hapus?')"
                                                            class="text-red-600 hover:text-red-800 font-medium">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @elseif(!auth()->user()->is_admin)
                                                <a href="{{ route('jobs.show', $job) }}" 
                                                   class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700 transition">
                                                    Lamar
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('jobs.show', $job) }}"
                                               class="text-blue-600 hover:text-blue-800 font-medium">
                                                Lihat Detail
                                            </a>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-10 text-center text-gray-500">
                    Belum ada lowongan tersedia.
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('jobs.create') }}" 
                               class="mt-4 inline-block px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Buat Lowongan Pertama
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

    </div>
</main>

</body>
</html>