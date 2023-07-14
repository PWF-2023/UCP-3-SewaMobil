@php
use App\Models\Car;
$cars = App\Models\Car::all();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 gap-4 p-6">
                    <div class="column3">
                        <img src="https://media.carsandbids.com/cdn-cgi/image/width=2080,quality=70/7a0a3c6148108c9c64425dd85e0181fa3cccb652/photos/KDEXwwVp.fAM5GswIi-(edit).jpg?t=162654816554" alt="Car Image" class="w-full">
                    </div>
                    <div class="column3" style="column-gap: px">
                        <div class="divide-y divide-slate-200">
                            <div class="mb-4">
                                <label for="car_id" class="font-semibold text-gray-800 dark:text-gray-200">Nama:</label>
                                <x-select id="car_id" name="car_id" class="block w-full mt-1">
                                    <option class="text-gray-800 dark:text-gray-200" value="">Empty</option>
                                    @foreach ($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->name }}
                                    </option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('car_id')" />
                            </div>
                            <div class="mb-4">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Brand:</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200" id="brand"></span>
                            </div>
                            <div class="mb-4">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Type:</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200" id="type"></span>
                            </div>
                            <div class="mb-4">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Harga/Hari:</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200" id="price"></span>
                            </div>
                            <div class="mb-4">
                                <label for="car_id" class="font-semibold text-gray-800 dark:text-gray-200">License:</label>
                                <x-select id="car_license" name="car_license" class="block w-full mt-1">
                                    <option class="text-gray-800 dark:text-gray-200" value="">Empty</option>
                                    @foreach ($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->license }}
                                    </option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('car_id')" />
                            </div>

                        </div>
                    </div>
                    <div class="column3" style="column-gap: px">
                        <div class="divide-y divide-slate-200">
                            <div class="mb-4">
                                <label for="start_date" class="font-semibold text-gray-800 dark:text-gray-200">Start day:</label>
                                <div class="relative">
                                    <input type="text" id="start_date" name="start_date" class="border border-gray-300 px-3 py-2 rounded w-full focus:outline-none focus:border-blue-500" placeholder="Select start date" readonly>
                                    <span class="absolute top-1/2 right-3 transform -translate-y-1/2">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="end_date" class="font-semibold text-gray-800 dark:text-gray-200">End day:</label>
                                <div class="relative">
                                    <input type="text" id="end_date" name="end_date" class="border border-gray-300 px-3 py-2 rounded w-full focus:outline-none focus:border-blue-500" placeholder="Select end date" readonly>
                                    <span class="absolute top-1/2 right-3 transform -translate-y-1/2">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Durasi Hari: </span>
                            </div>
                            <div class="mb-4">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Total Price: </span>
                            </div>
                        </div>

                        <button id="booking_button" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Rent Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ui-datepicker {
            background-color: #fff;
            border: 1px solid #ddd;
            color: #333;
            padding: 10px;
        }

        .ui-datepicker-header {
            background-color: #f7fafc;
            border-bottom: 1px solid #ddd;
            color: #333;
            display: contents;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
        }

        .ui-datepicker-title {
            font-weight: bold;
        }

        .ui-datepicker-prev,
        .ui-datepicker-next {
            background-color: #f7fafc;
            border: 1px solid #ddd;
            color: #333;
            padding: 6px 10px;
            font-weight: bold;
            cursor: pointer;
        }


        .ui-datepicker-calendar {
            background-color: #fff;
            border: none;
            color: #333;
        }

        .ui-datepicker-calendar .ui-state-default {
            background-color: #f7fafc;
            border: none;
            color: #333;
            padding: 6px;
            text-align: center;
        }

        .ui-datepicker-calendar .ui-state-default:hover {
            background-color: #e2e8f0;
            color: #333;
        }

        .ui-datepicker-calendar .ui-state-active {
            background-color: #1a202c;
            border: none;
            color: #fff;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script>
        $(function() {

            $('#car_id').change(function() {
                var car_id = $(this).val();
                var car = @json($cars);
                if (car) {
                    var selectedCar = car.find(function(item) {
                        return item.id == car_id;
                    });
                    if (selectedCar) {
                        $('#brand').text(selectedCar.brand);
                        $('#type').text(selectedCar.type);
                        $('#price').text(selectedCar.price);
                    }
                }
            });


            $("#start_date").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                onSelect: function(selectedDate) {
                    $("#end_date").datepicker("option", "minDate", selectedDate);
                }
            });

            $("#end_date").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                onSelect: function(selectedDate) {
                    $("#start_date").datepicker("option", "maxDate", selectedDate);
                }
            });
        });
    </script>
</x-app-layout>