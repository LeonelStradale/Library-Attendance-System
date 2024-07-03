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
        <a href="{{ route('lockers.create') }}"
            class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
            {{ __('Add new locker') }}
            <i class="fa-solid fa-plus ml-1"></i>
        </a>
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
                                @if ($locker->availability == 'Disponible')
                                    <!-- Available Badge -->
                                    <span
                                        class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        {{ $locker->availability }}
                                        <i class="fa-solid fa-lock-open ml-1"></i>
                                    </span>
                                @elseif($locker->availability == 'En Uso')
                                    <!-- In Use Badge -->
                                    <span
                                        class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                        {{ $locker->availability }}
                                        <i class="fa-solid fa-lock ml-1"></i>
                                    </span>
                                @elseif($locker->availability == 'No Disponible')
                                    <!-- Not Available Badge -->
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                        {{ $locker->availability }}
                                        <i class="fa-solid fa-ban ml-1"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-2">
                                <div class="flex">
                                    <!-- Show -->
                                    <a href="{{ route('lockers.show', $locker) }}"
                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-gray-700 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-800">
                                        {{ __('Show') }}
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('lockers.edit', $locker) }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        {{ __('Edit') }}
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <!-- Delete -->
                                    <form action="{{ route('lockers.destroy', $locker) }}" method="POST"
                                        id="delete-form-{{ $locker->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $locker->id }})"
                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            {{ __('Delete') }}
                                            <i class="fa-solid fa-trash-can ml-1"></i>
                                        </button>
                                    </form>
                                </div>
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
                {{ __('There are no registered lockers in the library.') }}
                <i class="fa-solid fa-lock ml-1"></i>
            </div>
        </div>
    @endif

    @push('js')
        <script>
            function confirmDelete(lockerId) {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + lockerId).submit();
                    }
                });
            }
        </script>
    @endpush

</x-app-layout>
