<x-guest-layout>
    <!-- Navbar -->
    @include('layouts.partials.app.navbar')

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-8">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <!-- Card: User info -->
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-2xl mb-8">
                    <h5
                        class="text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-blue-700">
                        {{ __('User information') }}
                        <i class="fa-solid fa-user ml-1"></i>
                    </h5>
                    <div class="p-6">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            <!-- Full name -->
                            {{ $assistant->first_name }} {{ $assistant->paternal_surname }}
                            {{ $assistant->maternal_surname }}
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
                                        <i class="fa-solid fa-user ml-1 mb-3"></i>
                                    </span>
                                @endif
                            </p>
                        </h1>

                        @if ($assistant->user_type == 'Estudiante')
                            <div class="mt-4">
                                <!-- Career -->
                                <x-label for="career" value="{{ __('Career') }}" />
                                <x-input id="career" class="block mt-1 w-full" type="text" name="career"
                                    value="{{ $assistant->career }}" disabled />
                            </div>

                            <div class="grid grid-cols-3 gap-4 mt-4 mb-5">
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
                            <div class="grid grid-cols-3 gap-4 mt-4">
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
            </div>

            <div>
                <!-- Card: Entrance -->
                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-2xl mb-7">
                    <h5
                        class="text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-green-700">
                        {{ __('Check-in information') }}
                        <i class="fa-solid fa-person-walking-arrow-right ml-1"></i>
                    </h5>

                    <div class="flex justify-center items-center text-center p-3">
                        <div class="p-2.5">
                            <h3 class="text-3xl font-bold dark:text-white">
                                {{ \Carbon\Carbon::now('GMT-6')->format('d') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('F') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('Y') }}
                            </h3>

                            <h4 class="text-2xl font-sans text-gray-500 dark:text-white">
                                {{ $existingAttendance->entrance }}
                            </h4>
                        </div>

                        @if ($existingAttendance->locker_number)
                            <div class="ml-4">
                                <div class="bg-green-600 rounded-lg p-3">
                                    <h1 class="font-bold text-white">
                                        Locker
                                        <i class="fa-solid fa-lock ml-1"></i>
                                    </h1>
                                    <div class="flex justify-center">
                                        <div class="bg-white rounded-full flex items-center justify-center w-10 h-10">
                                            <h1 class="font-bold text-gray-800 text-2xl">
                                                {{ $existingAttendance->locker_number }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card: Exit -->
                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-2xl mb-8">
                    <h5
                        class="text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-red-700">
                        {{ __('Check-out information') }}
                        <i class="fa-solid fa-door-open ml-1"></i>
                    </h5>

                    <div class="flex justify-center items-center text-center p-3">
                        <div class="mr-4">
                            <h3 class="text-3xl font-bold dark:text-white">
                                {{ \Carbon\Carbon::now('GMT-6')->format('d') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('F') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('Y') }}
                            </h3>

                            <h4 class="text-2xl font-sans text-gray-500 dark:text-white">
                                {{ $existingAttendance->exit }}
                            </h4>
                        </div>

                        <div>
                            <div class="bg-red-600 rounded-lg p-3">
                                <h1 class="font-bold text-white">
                                    {{ __('Total hours') }}
                                    <i class="fa-solid fa-clock ml-1"></i>
                                </h1>
                                <div class="flex justify-center">
                                    <div class="bg-white rounded-full flex items-center justify-center w-10 h-10">
                                        <h1 class="font-bold text-gray-800 text-2xl">
                                            {{ $existingAttendance->total_hours }}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="/"
            class="text-white bg-green-700 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium text-base rounded-lg px-5 py-2.5 text-center me-2 mb-2 flex justify-center items-center">
            {{ __('Return to registration panel') }}
            <i class="fa-solid fa-circle-check ml-1"></i>
        </a>

        <form action="{{ route('rollbackExit', $existingAttendance->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="mt-4 w-full text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium text-base rounded-lg px-5 py-2.5 text-center me-2 mb-2 flex justify-center items-center">
                {{ __("It's not me, return to the panel") }}
                <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
            </button>
        </form>
    </div>

</x-guest-layout>
