<x-app-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Lockers',
        'route' => route('lockers.index'),
    ],
    [
        'name' => 'Locker information',
    ],
]">

    <x-slot name="action">
        <div class="flex">
            <button onclick="confirmDelete()"
                class="block text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none
                focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2
                mb-2">
                {{ __('Delete') }}
                <i class="fa-solid fa-trash-can ml-1"></i>
            </button>

            <a href="{{ route('lockers.edit', $locker) }}"
                class="block text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                {{ __('Edit') }}
                <i class="fa-solid fa-pen-to-square ml-1"></i>
            </a>

            <a href="{{ route('lockers.index') }}"
                class="block text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                {{ __('Go back') }}
                <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
            </a>
        </div>
    </x-slot>

    <div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <!-- Locker number -->
            <h1
                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white flex items-center space-x-2">
                {{ __('Locker number') }}
                # {{ $locker->number }}
            </h1>

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
                    <i class="fa-solid fa-lock-open ml-1"></i>
                </span>
            @elseif($locker->availability == 'No Disponible')
                <!-- Not Available Badge -->
                <span
                    class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                    {{ $locker->availability }}
                    <i class="fa-solid fa-xmark ml-1"></i>
                </span>
            @endif
        </div>
    </div>

    <form action="{{ route('lockers.destroy', $locker) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
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
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush

</x-app-layout>
