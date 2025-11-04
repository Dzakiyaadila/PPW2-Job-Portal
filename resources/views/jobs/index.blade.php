<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lowongan Kerja Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Admin Actions -->
            @auth
                @if(Auth::user()->role == 'admin')
                    <div class="mb-6 flex justify-end">
                        <a href="{{ route('jobs.create') }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Lowongan Baru
                        </a>
                    </div>
                @endif
            @endauth

            <!-- Jobs Grid -->
            @if($jobs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jobs as $job)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $job->position }}</h3>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $job->company }}</p>
                                    </div>
                                    @auth
                                        @if(Auth::user()->role == 'admin')
                                            <div class="flex space-x-2">
                                                <a href="{{ route('jobs.edit', $job) }}" 
                                                   class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700" 
                                                            onclick="return confirm('Hapus lowongan ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-money-bill-wave mr-2"></i>
                                        <span>{{ $job->salary }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-users mr-2"></i>
                                        <span>Dibutuhkan: {{ $job->capacity }} orang</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        <span>{{ $job->location }}</span>
                                    </div>
                                </div>

                                @if($job->description)
                                    <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-2">
                                        {{ Str::limit($job->description, 100) }}
                                    </p>
                                @endif

                                <div class="flex justify-between items-center">
                                    <a href="{{ route('jobs.show', $job) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                        Lihat Detail
                                    </a>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $job->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                    <i class="fas fa-briefcase text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-600 dark:text-gray-400 mb-2">
                        Belum ada lowongan kerja
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">Silakan check kembali nanti</p>
                    @auth
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('jobs.create') }}" 
                               class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                                Tambah Lowongan Pertama
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</x-app-layout>