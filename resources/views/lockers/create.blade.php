@php
    use App\Enums\Availability;
@endphp

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
        'name' => 'Crear locker',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('lockers.index') }}"
            class="block text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            {{ __('Go back') }}
            <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
        </a>
    </x-slot>

    <div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                {{ __('Register new locker') }}
                <i class="fa-solid fa-lock ml-1"></i>

                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __("Assign the new locker's data.") }}
                    <i class="fa-solid fa-circle-info ml-1"></i>
                </p>
            </h1>

            <!-- Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Form -->
            <form method="POST" action="{{ route('lockers.store') }}">
                @csrf

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Locker number -->
                    <div>
                        <x-label for="number" value="{{ __('Locker number') }}" />
                        <x-input id="number" class="block mt-1 w-full" type="number" name="number"
                            :value="old('number')" required autofocus autocomplete="number" placeholder="Número de locker" />
                    </div>
                    <!-- Availability -->
                    <div>
                        <x-label for="availability" :value="__('Select locker availability')" />
                        <select id="availability" name="availability" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>
                                {{ __('Escoge una disponibilidad') }}
                            </option>
                            @foreach (Availability::cases() as $availability)
                                <option value="{{ $availability->value }}"
                                    {{ old('availability') == $availability->value ? 'selected' : '' }}>
                                    {{ $availability->value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Submit -->
                <x-button class="flex justify-center items-center mt-8">
                    {{ __('Register new locker') }}
                    <i class="fa-solid fa-floppy-disk ml-1"></i>
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>
