<x-guest-layout>
    <!-- Navbar -->
    @include('layouts.partials.app.navbar')

    <!-- Content -->
    <div class="flex justify-center items-center mt-16">

        <!-- Card -->
        <div class="block max-w-xl p-6 mx-0 rounded-lg shadow-2xl dark:bg-gray-900 border">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                {{ __('Library Assistance') }}
                <i class="fa-solid fa-book-open-reader ml-1"></i>
            </h1>

            <!-- Date -->
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                {{ \Carbon\Carbon::now('GMT-6')->format('d') }}
                {{ \Carbon\Carbon::now('GMT-6')->format('F') }}
                {{ \Carbon\Carbon::now('GMT-6')->format('Y') }}
            </h1>

            <!-- Time -->
            <h1 class="mt-2 text-2xl text-gray-900 dark:text-white text-center" id="current-time">
            </h1>
            <div class="flex justify-center mt-4">

                <!-- ENTRANCE MODAL: Button -->
                <button data-modal-target="entrance-modal" data-modal-toggle="entrance-modal" type="button"
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0 text-base font-bold">
                        {{ __('Entrance') }}
                        <i class="fa-solid fa-person-walking-arrow-right ml-1"></i>
                    </span>
                </button>

                <!-- ENTRANCE MODAL: Content -->
                <div id="entrance-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                            <!-- MODAL: Header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-gradient-to-br from-purple-600 to-blue-500">
                                <h3 class="text-xl font-semibold text-white">
                                    {{ __('Register entry') }}
                                    <i class="fa-solid fa-person-walking-arrow-right ml-1"></i>
                                </h3>
                                <button type="button"
                                    class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="entrance-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <!-- MODAL: Body -->
                            <div class="p-4 md:p-5">
                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                    {{ __('To register your entry in the library please enter your student id or
                                                                                                                                                                                                                                                                                                    control number if you are a teacher. If
                                                                                                                                                                                                                                                                                                    you do not belong to the university community, access the registration with the
                                                                                                                                                                                                                                                                                   "External" button.') }}
                                </p>

                                <!-- MODAL: Form -->
                                <form class="space-y-4 mt-8" action="#">
                                    <div>
                                        <x-label for="key">
                                            {{ __('Student ID | Control Number | Full Name') }}
                                        </x-label>
                                        <x-input type="text" name="key" id="key" autofocus
                                            placeholder="482100078" required />
                                    </div>

                                    <div>
                                        <x-label>
                                            {{ __('Do you want to request a locker?') }}
                                        </x-label>
                                        <div class="mt-2">

                                            <div class="flex items-center me-4">
                                                <input id="locker_yes" name="request_locker" type="checkbox"
                                                    value="yes" onclick="toggleCheckbox('locker_no')"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="locker_yes"
                                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ __('Yes, request a locker') }}
                                                </label>

                                                <input checked id="locker_no" name="request_locker" type="checkbox"
                                                    value="no" onclick="toggleCheckbox('locker_yes')"
                                                    class="ml-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="locker_no"
                                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ __('No, thanks') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MODAL: Submit -->
                                    <button type="submit"
                                        class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        {{ __('Find user') }}
                                        <i class="fa-solid fa-magnifying-glass ml-1"></i>
                                    </button>

                                    <a href=""
                                        class="block text-white bg-gradient-to-br from-gray-600 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        {{ __('Register external user') }}
                                        <i class="fa-solid fa-user ml-1"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EXIT MODAL: Button -->
                <button data-modal-target="exit-modal" data-modal-toggle="exit-modal" type="button"
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0 text-base font-bold">
                        {{ __('Exit') }}
                        <i class="fa-solid fa-door-open ml-2"></i>
                    </span>
                </button>

                <!-- EXIT MODAL: Content -->
                <div id="exit-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                            <!-- MODAL: Header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-gradient-to-br from-pink-500 to-orange-400">
                                <h3 class="text-xl font-semibold text-white">
                                    {{ __('Check out') }}
                                    <i class="fa-solid fa-door-open ml-2"></i>
                                </h3>
                                <button type="button"
                                    class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="exit-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <!-- MODAL: Body -->
                            <div class="p-4 md:p-5">
                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                    {{ __('To check out of the library, enter your student registration number or Control Number if you are a teacher. If you do not belong to the university community, access the check-out with the "External" Button.') }}
                                </p>

                                <!-- MODAL: Form -->
                                <form class="space-y-4 mt-8" action="#">
                                    <div>
                                        <x-label for="key">
                                            {{ __('Student ID | Control Number | Full Name') }}
                                        </x-label>
                                        <x-input type="text" name="key" id="key" autofocus
                                            placeholder="482100078" required />
                                    </div>

                                    <!-- MODAL: Submit -->
                                    <button type="submit"
                                        class="w-full text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        {{ __('Find user') }}
                                        <i class="fa-solid fa-magnifying-glass ml-1"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <p class="mt-2 font-normal text-gray-700 dark:text-gray-400 text-center">
                {{ __('To check in or out please select one of two options.') }}
                <i class="fa-solid fa-circle-info"></i>
            </p>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function updateTime() {
            const currentTime = new Date();
            const formattedTime = currentTime.toLocaleTimeString();
            document.getElementById('current-time').textContent = formattedTime;
        }

        updateTime();

        setInterval(updateTime, 1000);

        function toggleCheckbox(otherCheckboxId) {
            document.getElementById(otherCheckboxId).checked = false;
        }
    </script>
</x-guest-layout>
