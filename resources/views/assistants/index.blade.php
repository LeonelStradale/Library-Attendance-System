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
        <!-- SEARCH USER MODAL: Button -->
        <button data-modal-target="search-user-modal" data-modal-toggle="search-user-modal" type="button"
            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
            {{ __('Search user') }}
            <i class="fa-solid fa-magnifying-glass ml-1"></i>
        </button>

        <!-- SEARCH USER MODAL: Content -->
        <div id="search-user-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- MODAL: Header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-blue-700">
                        <h3 class="text-xl font-semibold text-white">
                            {{ __('Search user') }}
                            <i class="fa-solid fa-magnifying-glass ml-1"></i>
                        </h3>
                        <button type="button"
                            class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="search-user-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- MODAL: Body -->
                    <div class="p-4 md:p-5">
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            {{ __('To search for a specific user, enter their license plate, control number or full name to identify them.') }}
                        </p>

                        <!-- MODAL: Form -->
                        <form class="space-y-4 mt-4" action="{{ route('assistants.searchUser') }}" method="POST">
                            @csrf
                            <div>
                                <x-label for="key">
                                    {{ __('Student ID | Control Number | Full Name') }}
                                </x-label>
                                <x-input type="text" name="key" id="key" autofocus
                                    placeholder="ej. 482100078, 393, Name" required />
                            </div>

                            <!-- MODAL: Submit -->
                            <button type="submit"
                                class="w-full text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                {{ __('Find user') }}
                                <i class="fa-solid fa-magnifying-glass ml-1"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- CREATE NEW USER DROPDOWN: Button -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            type="button">
            {{ __('Create new user') }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <!-- CREATE NEW USER DROPDOWN: Menu -->
        <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <!-- Create student -->
                    <a href="{{ route('assistants.create') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ __('Create student') }}
                        <i class="fa-solid fa-user-graduate ml-1"></i>
                    </a>
                </li>
                <li>
                    <!-- Create teacher -->
                    <a href="{{ route('assistants.createTeacher') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ __('Create teacher') }}
                        <i class="fa-solid fa-chalkboard-user ml-1"></i>
                    </a>
                </li>
                <li>
                    <!-- Create external -->
                    <a href="{{ route('assistants.createExternal') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ __('Create external') }}
                        <i class="fa-solid fa-user ml-1"></i>
                    </a>
                </li>
            </ul>
        </div>

    </x-slot>

    @if ($assistants->count())
        <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-primary-500 dark:bg-primary-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Number') }}
                            <i class="fa-solid fa-hashtag ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Key') }}
                            <i class="fa-solid fa-address-card ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Full name') }}
                            <i class="fa-solid fa-user ml-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Type of user') }}
                            <i class="fa-solid fa-layer-group m-1"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Options') }}
                            <i class="fa-solid fa-gear ml-1"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assistants as $assistant)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $assistant->id }}
                            </th>
                            <td class="px-6 py-4">
                                @if ($assistant->user_type == 'Externo')
                                    {{ __('EXT') }}
                                @endif
                                {{ $assistant->number_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $assistant->first_name }} {{ $assistant->paternal_surname }}
                                {{ $assistant->maternal_surname }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($assistant->user_type == 'Estudiante')
                                    <!-- Student Badge -->
                                    <span
                                        class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        {{ $assistant->user_type }}
                                        <i class="fa-solid fa-user-graduate ml-1"></i>
                                    </span>
                                @elseif($assistant->user_type == 'Docente')
                                    <!-- Teacher Badge -->
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                        {{ $assistant->user_type }}
                                        <i class="fa-solid fa-chalkboard-user ml-1"></i>
                                    </span>
                                @elseif($assistant->user_type == 'Externo')
                                    <!-- External Badge -->
                                    <span
                                        class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">
                                        {{ $assistant->user_type }}
                                        <i class="fa-solid fa-user ml-1"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('assistants.show', $assistant) }}"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-gray-700 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-800">
                                    {{ __('Show') }}
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('assistants.edit', $assistant) }}"
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
