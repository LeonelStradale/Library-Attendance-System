<x-app-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Asistencias',
    ],
]">

    <x-slot name="action">
        <div class="w-[380px] flex justify-center items-center">
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
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-red-700">
                            <h3 class="text-xl font-semibold text-white">
                                {{ __('Generate general report in PDF') }}
                                <i class="fa-solid fa-user-group ml-1"></i>
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="general-report-modal">
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
                                {{ __("To create a general library attendance report, first choose the time period in which the report will be generated, then click 'Download Report' to obtain the PDF file.") }}
                            </p>

                            <!-- MODAL: Form -->
                            <form class="space-y-4 mt-4" action="{{ route('reportGeneral') }}" method="GET">
                                @csrf

                                <div>
                                    <x-label>
                                        {{ __('Select the time period') }}
                                    </x-label>
                                    <div date-rangepicker class="flex items-center">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <!-- Start Date -->
                                            <input name="start" type="text" required
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Fecha Inicial">
                                        </div>


                                        <span class="mx-4 text-gray-500">
                                            {{ __('to') }}
                                        </span>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <!-- End Date -->
                                            <input name="end" type="text" required
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Fecha Inicial">
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL: Submit -->
                                <button type="submit"
                                    class="w-full text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    {{ __('Download report') }}
                                    <i class="fa-solid fa-arrow-down ml-1"></i>
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
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-red-700">
                            <h3 class="text-xl font-semibold text-white">
                                {{ __('Generate individual report in PDF') }}
                                <i class="fa-solid fa-user ml-1"></i>
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-200 hover:text-gray-300 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="individual-report-modal">
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
                                {{ __("To create an individual library attendance report, first enter the user's license plate, control number or full name, then choose the time period in which the report will be generated, then click 'Download Report' to get the PDF file.") }}
                            </p>

                            <!-- MODAL: Form -->
                            <form class="space-y-4 mt-4" action="{{ route('reportIndividual') }}" method="GET">
                                @csrf

                                <div>
                                    <x-label for="key">
                                        {{ __('Student ID | Control Number | Full Name') }}
                                    </x-label>
                                    <x-input type="text" name="key" id="key" autofocus
                                        placeholder="ej. 482100078, 393, Nombre Completo" required />
                                </div>

                                <div>
                                    <x-label>
                                        {{ __('Select the time period') }}
                                    </x-label>
                                    <div date-rangepicker class="flex items-center">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <!-- Start Date -->
                                            <input name="start" type="text"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Fecha Inicial">
                                        </div>
                                        <span class="mx-4 text-gray-500">
                                            {{ __('to') }}
                                        </span>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <!-- End Date -->
                                            <input name="end" type="text"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Fecha Inicial">
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL: Submit -->
                                <button type="submit"
                                    class="w-full text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    {{ __('Download report') }}
                                    <i class="fa-solid fa-arrow-down ml-1"></i>
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
                                {{ __('Total attendees today:') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('d') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('F') }}
                                {{ \Carbon\Carbon::now('GMT-6')->format('Y') }}
                            </h5>

                            <!-- Total attendees today: Data -->
                            <p class="mb-3 font-normal text-center text-gray-500 dark:text-gray-400">
                                @if ($numberUsersAttended == 0)
                                    {{ __('There are no user assistance today') }}
                                @else
                                    {{ $numberUsersAttended }}
                                    {{ __('Assistants') }}
                                @endif
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
                                @if ($numberUsersPresent == 0)
                                    {{ __('No assistants present in the library') }}
                                @else
                                    {{ $numberUsersPresent }}
                                    {{ __('Assistants') }}
                                @endif
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
                                @if ($numberLockersAvailable == 0)
                                    {{ __('There are no lockers available') }}
                                @else
                                    {{ $numberLockersAvailable }}
                                    {{ __('Lockers available') }}
                                @endif
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
                                @if ($numberLockersInUse == 0)
                                    {{ __('There are no lockers in use') }}
                                @else
                                    {{ $numberLockersInUse }}
                                    {{ __('Lockers in use') }}
                                @endif
                                <i class="fa-solid fa-lock ml-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var dataAssists = {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Asistencias Mensuales',
                data: {!! json_encode($dataAssists) !!},
                backgroundColor: 'rgba(224, 36, 36, 1)',
                borderColor: 'rgba(155, 28, 28, 1)',
                borderWidth: 1
            }]
        };

        var opciones = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        };

        var ctx = document.getElementById('myChart').getContext('2d');

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: dataAssists,
            options: opciones
        });
    </script>

</x-app-layout>
