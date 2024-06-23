@php
    use App\Enums\CareerDirection;
    use App\Enums\Gender;
@endphp

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
        'name' => 'Create teacher',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('assistants.index') }}"
            class="block text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            {{ __('Go back') }}
            <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
        </a>
    </x-slot>

    <div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                {{ __('Register new teacher') }}
                <i class="fa-solid fa-chalkboard-user ml-1"></i>

                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __("Assign the new user's data.") }}
                    <i class="fa-solid fa-circle-info ml-1"></i>
                </p>
            </h1>

            <!-- Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Form -->
            <form method="POST" action="{{ route('assistants.storeTeacher') }}">
                @csrf

                <div class="grid grid-cols-3 gap-4">
                    <!-- First name -->
                    <div>
                        <x-label for="first_name" value="{{ __('First name') }}" />
                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                            :value="old('first_name')" required autofocus autocomplete="first-name" placeholder="Nombre(s)" />
                    </div>
                    <!-- Paternal Last Name -->
                    <div>
                        <x-label for="paternal_surname" value="{{ __('Paternal last name') }}" />
                        <x-input id="paternal_surname" class="block mt-1 w-full" type="text" name="paternal_surname"
                            :value="old('paternal_surname')" required autocomplete="paternal-surname" placeholder="Apellido paterno" />
                    </div>
                    <!-- Maternal Last Name -->
                    <div>
                        <x-label for="maternal_surname" value="{{ __('Maternal last name') }}" />
                        <x-input id="maternal_surname" class="block mt-1 w-full" type="text" name="maternal_surname"
                            :value="old('maternal_surname')" required autocomplete="maternal-surname" placeholder="Apellido materno" />
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Control number -->
                    <div>
                        <x-label for="number_id" value="{{ __('Control number') }}" />
                        <x-input id="number_id" class="block mt-1 w-full" type="number" name="number_id"
                            :value="old('number_id')" required autocomplete="number-id" placeholder="Número de control" />
                    </div>
                    <!-- Gender -->
                    <div>
                        <x-label for="gender" value="{{ __('Select a gender') }}" />
                        <select id="gender" name="gender" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>
                                {{ __('Escoge un género') }}
                            </option>
                            @foreach (Gender::cases() as $gender)
                                <option value="{{ $gender->value }}"
                                    {{ old('gender') == $gender->value ? 'selected' : '' }}>
                                    {{ $gender->value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <!-- Career -->
                    <x-label for="career" value="{{ __('Select a career direction') }}" />
                    <select id="career" name="career" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected disabled>
                            {{ __('Escoge una dirección de carrera') }}
                        </option>
                        @foreach (CareerDirection::cases() as $career)
                            <option value="{{ $career->value }}"
                                {{ old('career') == $career->value ? 'selected' : '' }}>
                                {{ $career->value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <x-button class="flex justify-center items-center mt-8">
                    {{ __('Register new teacher') }}
                    <i class="fa-solid fa-floppy-disk ml-1"></i>
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>
