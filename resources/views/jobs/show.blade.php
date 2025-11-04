<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $job->position }} - {{ $job->company }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold">{{ $job->position }}</h1>
                            <p class="text-xl text-gray-600 dark:text-gray-400">{{ $job->company }}</p>
                        </div>
                        @auth
                            @if(Auth::user()->role == 'admin')
                                <div class="flex space-x-2">
                                    <a href="{{ route('jobs.edit', $job) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                                                onclick="return confirm('Hapus lowongan ini?')">
                                            <i class="fas fa-trash mr-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <!-- Job Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-money-bill-wave text-green-500 mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Gaji</p>
                                    <p class="font-semibold">Rp {{ $job->salary_range }} juta</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-blue-500 mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Kuota</p>
                                    <p class="font-semibold">{{ $job->capacity }} orang</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-red-500 mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Lokasi</p>
                                    <p class="font-semibold">{{ $job->location }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-purple-500 mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Diposting</p>
                                    <p class="font-semibold">{{ $job->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($job->description)
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-xl font-bold mb-4">Deskripsi Pekerjaan</h3>
                            <div class="prose max-w-none">
                                <p class="whitespace-pre-line">{{ $job->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                        <a href="{{ route('jobs.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>