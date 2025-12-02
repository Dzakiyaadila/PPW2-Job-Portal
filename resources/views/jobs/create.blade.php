<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Job Portal - Buat Lowongan</title>

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
                Buat Lowongan Baru
            </h2>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications -->
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul Lowongan *</label>
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       value="{{ old('title') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required>
                            </div>

                            <!-- Perusahaan -->
                            <div>
                                <label for="company" class="block text-sm font-medium text-gray-700">Nama Perusahaan *</label>
                                <input type="text" 
                                       name="company" 
                                       id="company" 
                                       value="{{ old('company') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required>
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi *</label>
                                <input type="text" 
                                       name="location" 
                                       id="location" 
                                       value="{{ old('location') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required>
                            </div>

                            <!-- Gaji -->
                            <div>
                                <label for="salary" class="block text-sm font-medium text-gray-700">Gaji *</label>
                                <input type="number" 
                                       name="salary" 
                                       id="salary" 
                                       value="{{ old('salary') }}"
                                       min="0"
                                       step="100000"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required>
                                <p class="mt-1 text-sm text-gray-500">Contoh: 10000000 untuk Rp 10.000.000</p>
                            </div>

                            <!-- Logo Perusahaan -->
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo Perusahaan (Opsional)</label>
                                <input type="file" 
                                       name="logo" 
                                       id="logo"
                                       accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Lowongan *</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                          required>{{ old('description') }}</textarea>
                            </div>

                            <!-- Button Group -->
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('jobs.index') }}" 
                                   class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Batal
                                </a>
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Lowongan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>