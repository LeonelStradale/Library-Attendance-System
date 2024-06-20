<x-app-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Assistants',
        'route' => route('assistants.index'),
    ],
    [
        'name' => 'User information',
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

            <a href="{{ route('assistants.edit', $assistant) }}"
                class="block text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                {{ __('Edit') }}
                <i class="fa-solid fa-pen-to-square ml-1"></i>
            </a>

            <a href="{{ route('assistants.index') }}"
                class="block text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                {{ __('Go back') }}
                <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
            </a>
        </div>

    </x-slot>

    <div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                <!-- Full name -->
                {{ $assistant->first_name }} {{ $assistant->paternal_surname }} {{ $assistant->maternal_surname }}
                @if ($assistant->gender == 'Masculino')
                    <!-- Male -->
                    <i class="fa-solid fa-mars ml-1 text-blue-600"></i>
                @elseif($assistant->gender == 'Femenino')
                    <!-- Female -->
                    <i class="fa-solid fa-venus ml-1 text-pink-600"></i>
                @else
                    <i class="fa-solid fa-user ml-1 text-primary-600"></i>
                @endif
                <!-- User type -->
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-1">
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
                </p>
            </h1>

            @if ($assistant->user_type == 'Estudiante')
                <div>
                    <!-- Career -->
                    <x-label for="career" value="{{ __('Career') }}" />
                    <x-input id="career" class="block mt-1 w-full" type="text" name="career"
                        value="{{ $assistant->career }}" disabled />
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <!-- Student ID -->
                        <x-label for="number_id" value="{{ __('Student ID') }}" />
                        <x-input id="number_id" class="mt-1" type="text" name="number_id"
                            value="{{ $assistant->number_id }}" disabled />
                    </div>

                    <div>
                        <!-- Grade -->
                        <x-label for="grade" value="{{ __('Grade') }}" />
                        <x-input id="grade" class="mt-1" type="text" name="grade"
                            value="{{ $assistant->grade }}" disabled />
                    </div>
                    <div>
                        <!-- Area -->
                        <x-label for="area" value="{{ __('Area') }}" />
                        <x-input id="area" class="mt-1" type="text" name="area"
                            value="{{ $assistant->area }}" disabled />
                    </div>
                </div>
            @elseif ($assistant->user_type == 'Docente')
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <!-- Number control -->
                        <x-label for="number_id" value="{{ __('Number control') }}" />
                        <x-input id="number_id" class="mt-1" type="text" name="number_id"
                            value="{{ $assistant->number_id }}" disabled />
                    </div>
                    <div class="col-span-2">
                        <!-- Career direction -->
                        <x-label for="career" value="{{ __('Career direction') }}" />
                        <x-input id="career" class="block mt-1 w-full" type="text" name="career"
                            value="{{ $assistant->career }}" disabled />
                    </div>
                </div>
            @endif
        </div>
    </div>

    <form action="{{ route('assistants.destroy', $assistant) }}" method="POST" id="delete-form">
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
