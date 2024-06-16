<x-app-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Lockers',
    ],
]">

    <x-slot name="action">
        <button type="button"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
            <a href="">
                {{ __('Add new locker') }}
                <i class="fa-solid fa-plus ml-1"></i>
            </a>
        </button>
    </x-slot>

    @if ($lockers->count())
        <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-primary-500 dark:bg-primary-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Locker number') }}
                            <i class="fa-solid fa-hashtag ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Availability') }}
                            <i class="fa-solid fa-lock ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Options') }}
                            <i class="fa-solid fa-gear ml-1"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lockers as $locker)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $locker->number }}
                            </th>
                            <td class="px-6 py-4">
                                @if ($locker->availability == 0)
                                    <!-- Available Badge -->
                                    <span
                                        class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        {{ __('Available') }}
                                        <i class="fa-solid fa-lock-open ml-1"></i>
                                    </span>
                                @elseif($locker->availability == 1)
                                    <!-- In use Badge -->
                                    <span
                                        class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                        {{ __('In use') }}
                                        <i class="fa-solid fa-lock ml-1"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href=""
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    {{ __('Edit') }}
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href=""
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    {{ __('Delete') }}
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $lockers->links() }}
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
