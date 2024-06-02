<x-app-layout :breadcrumbs="[
        [
            'name' => 'Dashboard',
        ],
    ]">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl p-6 border">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="Picture of {{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold dark:text-gray-200">
                        {{ __('Welcome!') }} {{ Auth::user()->name }}
                        <i class="fa-solid fa-user ml-1"></i>
                    </h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-sm font-light text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-600">
                            {{ __('Log Out') }}
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl p-6 border">
            <h2 class="text-xl font-semibold text-center dark:text-gray-200">
                {{ config('app.name', 'Laravel') }}
                <i class="fa-solid fa-book-open-reader ml-1"></i>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('Library Attendance System') }}
                </p>
            </h2>
        </div>
    </div>
</x-app-layout>