<x-guest-layout>
    <section class="h-screen bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <!-- Logo -->
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                    alt="logo">
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Card -->
            <div
                class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('Sign in to your account')}}
                    </h1>

                    <!-- Form -->
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- E-Mail -->
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="username"
                                placeholder="name@company.com" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" placeholder="••••••••" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <!-- Checkbox: Remember me -->
                                <div class="flex items-center h-5">
                                    <label for="remember_me" class="flex items-center">
                                        <x-checkbox id="remember_me" name="remember" aria-describedby="remember" />
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Remember me') }}
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Forgot password -->
                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Submit -->
                        <x-button class="flex justify-center items-center">
                            {{ __('Log in') }}
                            <i class="fa-solid fa-right-to-bracket ml-2"></i>
                        </x-button>

                        <!-- Sign up -->
                        <p class="text-center text-sm font-light text-gray-500 dark:text-gray-400">
                            {{ __('Don’t have an account yet?')}}
                            <a href="{{ route('register') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                {{ __('Sign up')}}
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>