<x-app-layout :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'route' => route('dashboard'),
        ],
        [
            'name' => 'Assistants',
        ],
    ]">

    <x-slot name="action">
        <x-button>
            <a href="">
                {{ __('Register new user') }}
                <i class="fa-solid fa-user-plus ml-1"></i>
            </a>
        </x-button>
    </x-slot>

    @if ($assistants->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <td scope="col" class="px-6 py-3">
                            Nombre
                        </td>
                        <td scope="col" class="px-6 py-3">

                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assistants as $assistant)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $assistant->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $assistant->name }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $assistants->links() }}
        </div>
    @else
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">
                    {{ __('Info alert!') }}
                </span>
                {{ __('There are no registered library users') }}
                <i class="fa-solid fa-user-group ml-1"></i>
            </div>
        </div>
    @endif
</x-app-layout>