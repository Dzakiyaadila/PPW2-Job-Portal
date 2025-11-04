<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Lowongan') }} - {{ $job->position }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('jobs.update', $job) }}" method="POST">  <!-- PAKAI $job -->
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Posisi -->
                            <div class="md:col-span-2">
                                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Posisi Pekerjaan *
                                </label>
                                <input type="text" name="position" id="position" required
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       value="{{ old('position', $job->position) }}">  <!-- PAKAI $job -->
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Perusahaan -->
                            <div class="md:col-span-2">
                                <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Perusahaan *
                                </label>
                                <input type="text" name="company" id="company" required
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       value="{{ old('company', $job->company) }}">  <!-- PAKAI $job -->
                                @error('company')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salary Simple -->
                            <div class="md:col-span-2">
                                <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Gaji *
                                </label>
                                <input type="text" name="salary" id="salary" required
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       value="{{ old('salary', $job->salary) }}"  <!-- PAKAI $job -->
                                       placeholder="Contoh: Rp 8-12 juta">
                                @error('salary')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kuota -->
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Kuota / Jumlah Orang Dibutuhkan *
                                </label>
                                <input type="number" name="capacity" id="capacity" required min="1"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       value="{{ old('capacity', $job->capacity) }}">  <!-- PAKAI $job -->
                                @error('capacity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Lokasi Kerja *
                                </label>
                                <input type="text" name="location" id="location" required
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                       value="{{ old('location', $job->location) }}">  <!-- PAKAI $job -->
                                @error('location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Deskripsi Pekerjaan
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                          placeholder="Jelaskan detail pekerjaan, requirements, dll...">{{ old('description', $job->description) }}</textarea>  <!-- PAKAI $job -->
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('jobs.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md">
                                Update Lowongan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>