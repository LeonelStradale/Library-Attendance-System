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
        'name' => $assistant->first_name . ' ' . $assistant->paternal_surname . ' ' . $assistant->maternal_surname,
    ],
]">

    <x-slot name="action">
        <button type="button"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
            <a href="#">
                {{ __('Delete') }}
                <i class="fa-solid fa-trash-can ml-1"></i>
            </a>
        </button>

        <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <a href="{{ route('assistants.edit', $assistant) }}">
                {{ __('Edit') }}
                <i class="fa-solid fa-pen-to-square ml-1"></i>
            </a>
        </button>

        <button type="button"
            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
            <a href="{{ route('assistants.index') }}">
                {{ __('Go back') }}
                <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
            </a>
        </button>
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
                <!-- Career and other fields for Estudiante -->
                <div class="grid grid-cols-3 gap-4">
                    <!-- Column 1 -->
                    <div class="col-span-2">
                        <!-- Career -->
                        <x-label for="career" value="{{ __('Career') }}" />
                        <x-input id="career" class="block mt-1 w-full" type="text" name="career"
                            value="{{ $assistant->career }}" disabled />
                    </div>

                    <!-- Column 2 -->
                    <div class="col-span-1">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <!-- Degree -->
                                <x-label for="degree" value="{{ __('Degree') }}" />
                                <x-input id="degree" class="mt-1" type="text" name="degree"
                                    value="{{ $assistant->degree }}" disabled />
                            </div>
                            <div>
                                <!-- Area -->
                                <x-label for="area" value="{{ __('Area') }}" />
                                <x-input id="area" class="mt-1" type="text" name="area"
                                    value="{{ $assistant->area }}" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($assistant->user_type == 'Docente')
                <!-- Only Career for Docente -->
                <div>
                    <!-- Career -->
                    <x-label for="career" value="{{ __('Career') }}" />
                    <x-input id="career" class="block mt-1 w-full" type="text" name="career"
                        value="{{ $assistant->career }}" disabled />
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
