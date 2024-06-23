@php
    use App\Enums\Gender;
@endphp

<x-guest-layout>
    <!-- Navbar -->
    @include('layouts.partials.app.navbar')

    <div class="py-8 px-4 mx-auto max-w-screen-xl">

        <!-- Card: User info -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-2xl mb-8">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    {{ __('Register new external') }}
                    <i class="fa-solid fa-user ml-1"></i>

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        {{ __("Assign the new user's data.") }}
                        <i class="fa-solid fa-circle-info ml-1"></i>
                    </p>
                </h1>

                <!-- Errors -->
                <x-validation-errors class="mb-4" />

                <!-- Form -->
                <form method="POST" action="{{ route('assistants.storeExternalPeople') }}">
                    @csrf

                    <div class="grid grid-cols-3 gap-4">
                        <!-- First name -->
                        <div>
                            <x-label for="first_name" value="{{ __('First name') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name')" required autofocus autocomplete="first-name"
                                placeholder="Nombre(s)" />
                        </div>
                        <!-- Paternal Last Name -->
                        <div>
                            <x-label for="paternal_surname" value="{{ __('Paternal last name') }}" />
                            <x-input id="paternal_surname" class="block mt-1 w-full" type="text"
                                name="paternal_surname" :value="old('paternal_surname')" required autocomplete="paternal_surname"
                                placeholder="Apellido paterno" />
                        </div>
                        <!-- Maternal Last Name -->
                        <div>
                            <x-label for="maternal_surname" value="{{ __('Maternal last name') }}" />
                            <x-input id="maternal_surname" class="block mt-1 w-full" type="text"
                                name="maternal_surname" :value="old('maternal_surname')" required autocomplete="maternal_surname"
                                placeholder="Apellido materno" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <!-- Gender -->
                        <x-label for="gender" value="{{ __('Select a gender') }}" />
                        <select id="gender" name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>
                                {{ __('Escoge un género') }}
                            </option>
                            @foreach (Gender::cases() as $gender)
                                <option value="{{ $gender->value }}">
                                    {{ $gender->value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit -->
                    <x-button class="flex justify-center items-center mt-8">
                        {{ __('Register') }}
                        <i class="fa-solid fa-floppy-disk ml-2"></i>
                    </x-button>

                    <a href="/"
                        class="mt-4 block text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                        {{ __('Go back') }}
                        <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
                    </a>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
