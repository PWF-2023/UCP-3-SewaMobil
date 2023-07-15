@php
use App\Models\Car;
$cars = Car::all();
$duration = 0;
$total_price = 0;
$is_completed = 0;
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
                <form method="post" action="{{ route('rental.store') }}" class="">
                    @csrf
                    <div class="grid grid-cols-3 gap-4 p-6">
                        <div class="col-span-3 sm:col-span-1">
                            <img src="https://media.carsandbids.com/cdn-cgi/image/width=2080,quality=70/7a0a3c6148108c9c64425dd85e0181fa3cccb652/photos/KDEXwwVp.fAM5GswIi-(edit).jpg?t=162654816554" alt="Car Image" class="w-full">
                        </div>
                        <div class="col-span-3 sm:col-span-1">
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
                                    <span class="font-semibold text-gray-800 dark:text-gray-200">License:</span>
                                    <span class="font-semibold text-gray-800 dark:text-gray-200" id="license"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3 sm:col-span-1">
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
                                    <x-input-label for="name" :value="__('duration')" />
                                    <x-text-input id="duration" name="duration" type="text" class="block w-full mt-1" required autofocus autocomplete="duration" :value="old('duration')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('total_price')" />
                                    <x-text-input id="total_price" name="total_price" type="text" class="block w-full mt-1" required autofocus autocomplete="total_price" :value="old('total_price')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('total_price')" />
                                </div>
                                    <input id="is_completed" name="is_completed" type="hidden" value="{{ old('is_completed', $is_completed) }}">
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('rental.index') }}" />
                        </div>
                    </div>
            </div>
            </form>
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
            display: flex;
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
                        $('#license').text(selectedCar.license);
                        calculateTotalPrice();
                    }
                }
            });

            var durationDays = 0;

            function calculateDuration() {
                var startDate = $('#start_date').datepicker('getDate');
                var endDate = $('#end_date').datepicker('getDate');
                if (startDate && endDate) {
                    var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                    durationDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    $('#duration').val(durationDays); // Update the duration input field
                    calculateTotalPrice();
                }
            }

            function calculateTotalPrice() {
                var pricePerDay = parseFloat($('#price').text());
                if (!isNaN(pricePerDay) && !isNaN(durationDays)) {
                    var totalPrice = pricePerDay * durationDays;
                    $('#total_price').val(totalPrice.toFixed(2)); // Update the total_price input field with the total price
                }
            }

            $("#start_date").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                onSelect: function(selectedDate) {
                    $("#end_date").datepicker("option", "minDate", selectedDate);
                    calculateDuration();
                }
            });

            $("#end_date").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                onSelect: function(selectedDate) {
                    $("#start_date").datepicker("option", "maxDate", selectedDate);
                    calculateDuration();
                }
            });
        });
    </script>
</x-app-layout>