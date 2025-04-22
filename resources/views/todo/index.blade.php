<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center">
    <div class="w-3/4 md:w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <x-create-button href="{{ route('todo.create')}}"/>
                </div>
            </div>
            @if (session('success'))
            <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 5000)"
                class="text-sm text-green-600 dark:text-green-400">{{session('success')}}
            </p>
            @endif
            @if (session('danger'))
            <p x-data="{ show : true }" x-show="show" x-transition
                 x-init="setTimeout(() => show = false, 5000)"
                 class="text-sm text-red-600 dark:text-red-400">{{session('danger')}}
            </p>
            @endif
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-00 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="hidden px-6 py-3 md:block">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todos as $todo)
                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">
                                {{ $todo->title }}
                            </a>
                        </td>
                        <td class="hidden px-6 py-4 md:block">
                            @if ($todo->is_done == false)
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                OnGoing
                            </span>
                            @else
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                Completed
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-3"></div>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">empty</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>