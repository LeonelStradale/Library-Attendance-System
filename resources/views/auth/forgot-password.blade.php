<x-guest-layout>
    <section class="h-screen bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <!-- Logo -->
            <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://cdn-icons-png.flaticon.com/512/12626/12626844.png" alt="Logo">
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Card -->
            <div
                class="w-full p-6 bg-white rounded-lg shadow-2xl dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
                <h1
                    class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    {{ __('Forgot your password?')}}
                </h1>
                <p class="font-light text-gray-500 dark:text-gray-400">
                    {{ __('Dont fret! Just type in your email and we will send you a code to reset your password!')}}
                </p>

                <!-- Status -->
                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ $value }}
                    </div>
                @endsession

                <!-- Errors -->
                <x-validation-errors class="mb-4" />

                <!-- Form -->
                <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- E-Mail -->
                    <div class="block">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" placeholder="name@company.com" />
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <x-button class="flex justify-center items-center">
                            {{ __('Email Password Reset Link') }}
                            <i class="fa-solid fa-paper-plane ml-2"></i>
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>