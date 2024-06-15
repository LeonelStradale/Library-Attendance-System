<x-app-layout :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'route' => route('dashboard'),
        ],
        [
            'name' => 'Attendances',
        ],
    ]">

    <x-slot name="action">
        <div class="w-[345px] flex justify-center items-center">
            <!-- GENERAL REPORT: Button -->
            <button data-modal-target="general-report-modal" data-modal-toggle="general-report-modal" type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                {{ __('General report') }}
                <i class="fa-solid fa-user-group ml-1"></i>
            </button>

            <!-- GENERAL REPORT: Content -->
            <div id="general-report-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- MODAL: Header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-gradient-to-br from-purple-600 to-blue-500">
                            <h3 class="text-xl font-semibold text-white">
                                {{ __('Register entry')}}
                                <i class="fa-solid fa-person-walking-arrow-right ml-1"></i>
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="general-report-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
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
                                        "External" button.')}}
                            </p>

                            <!-- MODAL: Form -->
                            <form class="space-y-4 mt-8" action="#">
                                <div>
                                    <x-label for="key">
                                        {{ __('Student ID | Control Number')}}
                                    </x-label>
                                    <x-input type="text" name="key" id="key" autofocus placeholder="482100078"
                                        required />
                                </div>

                                <!-- MODAL: Submit -->
                                <button type="submit"
                                    class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    {{ __('Find user')}}
                                    <i class="fa-solid fa-magnifying-glass ml-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INDIVIDUAL REPORT MODAL: Button -->
            <button data-modal-target="individual-report-modal" data-modal-toggle="individual-report-modal"
                type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                {{ __('Individual report') }}
                <i class="fa-solid fa-user-group ml-1"></i>
            </button>

            <!-- INDIVIDUAL REPORT MODAL: Content -->
            <div id="individual-report-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- MODAL: Header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-gradient-to-br from-purple-600 to-blue-500">
                            <h3 class="text-xl font-semibold text-white">
                                {{ __('Register entry')}}
                                <i class="fa-solid fa-person-walking-arrow-right ml-1"></i>
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="individual-report-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
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
                                        "External" button.')}}
                            </p>

                            <!-- MODAL: Form -->
                            <form class="space-y-4 mt-8" action="#">
                                <div>
                                    <x-label for="key">
                                        {{ __('Student ID | Control Number')}}
                                    </x-label>
                                    <x-input type="text" name="key" id="key" autofocus placeholder="482100078"
                                        required />
                                </div>

                                <!-- MODAL: Submit -->
                                <button type="submit"
                                    class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    {{ __('Find user')}}
                                    <i class="fa-solid fa-magnifying-glass ml-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container">
        <div class="grid grid-cols-3 gap-4">

            <!-- Column 1 -->
            <div class="col-span-2 md:col-span-2">
                <div
                    class="w-full bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                    <h5
                        class="mb-2 text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-primary-700">
                        {{ __('Monthly attendance graph') }}
                        <i class="fa-solid fa-clock ml-1"></i>
                    </h5>
                    <canvas id="myChart"></canvas>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-span-1 md:col-span-1">
                <div class="grid grid-rows-4 gap-4">
                    <div>
                        <!-- # 1 -->
                        <div
                            class="w-full bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                            <!-- Total attendees today: Card -->
                            <h5
                                class="mb-2 text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-primary-700">
                                {{ __('Total attendees today: June 12, 2024') }}
                            </h5>

                            <!-- Total attendees today: Data -->
                            <p class="mb-3 font-normal text-center text-gray-500 dark:text-gray-400">
                                {{ __('11 Assistants') }}
                                <i class="fa-solid fa-user-clock ml-1"></i>
                            </p>
                        </div>
                    </div>
                    <div class="row-start-2">
                        <!-- # 2 -->
                        <div
                            class="w-full bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                            <!-- Today's Present Attendees: Card -->
                            <h5
                                class="mb-2 text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-primary-700">
                                {{ __("Today's Present Attendees") }}
                            </h5>

                            <!-- Today's Present Attendees: Data -->
                            <p class="mb-3 font-normal text-center text-gray-500 dark:text-gray-400">
                                {{ __("7 Assistants") }}
                                <i class="fa-solid fa-user-group ml-1"></i>
                            </p>
                        </div>
                    </div>
                    <div class="row-start-3">
                        <!-- # 3 -->
                        <div
                            class="w-full bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                            <!-- Lockers available: Card -->
                            <h5
                                class="mb-2 text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-primary-700">
                                {{ __('Lockers available') }}
                            </h5>

                            <!-- Lockers available: Data -->
                            <p class="mb-3 font-normal text-center text-gray-500 dark:text-gray-400">
                                {{ __('There are 20 lockers available') }}
                                <i class="fa-solid fa-lock-open ml-1"></i>
                            </p>
                        </div>
                    </div>
                    <div class="row-start-4">
                        <!-- # 4 -->
                        <div
                            class="w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                            <!-- Lockers in use: Card -->
                            <h5
                                class="mb-2 text-base text-white text-center rounded-t-lg font-semibold tracking-tight p-2 dark:text-white bg-primary-700">
                                {{ __('Lockers in use') }}
                            </h5>

                            <!-- Lockers in use: Data -->
                            <p class="mb-3 font-normal text-center text-gray-500 dark:text-gray-400">
                                {{ __('There are 12 lockers in use') }}
                                <i class="fa-solid fa-lock ml-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</x-app-layout>