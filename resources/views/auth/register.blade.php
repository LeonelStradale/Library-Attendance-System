<x-guest-layout>
    <section class="h-screen bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-4 mx-auto max-w-5xl md:h-full">

            <!-- Logo -->
            <a href="/" class="flex items-center mb-4 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://cdn-icons-png.flaticon.com/512/12626/12626844.png" alt="Logo">
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Card -->
            <div
                class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('Create and account') }}

                        <!-- Already registered -->
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            {{ __('Already registered?') }}
                            <a href="{{ route('login') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                {{ __('Log in') }}
                            </a>
                        </p>
                    </h1>

                    <!-- Errors -->
                    <x-validation-errors class="mb-4" />

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="first-name"
                                placeholder="Nombre Completo" />
                        </div>

                        <!-- E-Mail -->
                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username"
                                placeholder="ej. nombre@compañia.com" />
                        </div>

                        <div
                            class="flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 space-x-0 md:space-x-4 mt-4">

                            <!-- Password -->
                            <div class="w-full md:w-1/2">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="new-password" placeholder="••••••••" />
                            </div>

                            <!-- Confirm password -->
                            <div class="w-full md:w-1/2 mt-4 md:mt-0">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="••••••••" />
                            </div>
                        </div>

                        <!-- Terms -->
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required />

                                        <div class="ms-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif

                        <!-- Submit -->
                        <x-button class="flex justify-center items-center mt-8">
                            {{ __('Register') }}
                            <i class="fa-solid fa-right-to-bracket ml-1"></i>
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
