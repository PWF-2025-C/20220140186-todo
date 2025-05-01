<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Formulir Pencarian -->
                    <form method="GET" action="{{ route('user.index') }}" class="mb-4 flex space-x-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari pengguna..." 
                            class="w-full px-4 py-2 text-gray-300 bg-gray-800 rounded-lg focus:outline-none"
                            value="{{ request('search') }}"
                        />
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-gray-300">
                        <thead class="text-xs uppercase bg-gray-900 text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-16 text-center">ID</th>
                                <th scope="col" class="px-6 py-3 text-left">NAMA</th>
                                <th scope="col" class="px-6 py-3 text-right">TODO</th>
                                <th scope="col" class="px-6 py-3 text-right">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-gray-900">
                                    <td class="px-6 py-3 text-center text-blue-400">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-3 text-right">
                                        <span class="text-blue-400">
                                            {{ $user->todos->where('is_done', true)->count() }} ({{ $user->todos->count() }})
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        {{-- Action here --}}
                                        @if ($user->is_admin)
                                        <form action="{{ route('user.removeadmin', $user) }}" method="Post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-blue-600 dark:text-blue-400 whitespace-nowrap">
                                                Remove Admin
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('user.makeadmin', $user) }}" method="Post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                                Make Admin
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('user.destroy', $user) }}" method="Post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                </tr>
                            @empty
                                <tr class="bg-gray-900">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                        Tidak ada data tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-5 bg-gray-900 text-gray-400">
                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            Menampilkan 1 hingga 20 dari 100 hasil
                        </div>
                        <div class="flex space-x-1">
                            <a href="#" class="px-3 py-1 text-gray-400">&lt;</a>
                            <a href="#" class="px-3 py-1 text-white">1</a>
                            <a href="#" class="px-3 py-1 text-gray-400 hover:text-white">2</a>
                            <a href="#" class="px-3 py-1 text-gray-400 hover:text-white">3</a>
                            <a href="#" class="px-3 py-1 text-gray-400 hover:text-white">4</a>
                            <a href="#" class="px-3 py-1 text-gray-400 hover:text-white">5</a>
                            <a href="#" class="px-3 py-1 text-gray-400 hover:text-white">&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>