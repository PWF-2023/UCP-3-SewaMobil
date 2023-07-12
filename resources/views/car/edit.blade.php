<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Nama Mobil') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div> --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('car.update', $car) }}" class="">
                        @csrf
                        @method('patch')
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Nama Mobil')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="old('name', $car->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div><div class="mb-6">
                            <x-input-label for="brand" :value="__('Brand Mobil')" />
                            <x-text-input id="brand" name="brand" type="text" class="block w-full mt-1"
                                :value="old('name', $car->brand)" required autofocus autocomplete="brand" />
                            <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="type" :value="__('Tipe Mobil')" />
                            <x-text-input id="type" name="type" type="text" class="block w-full mt-1"
                                :value="old('name', $car->type)" required autofocus autocomplete="type" />
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="license" :value="__('Plat Nomor')" />
                            <x-text-input id="license" name="license" type="text" class="block w-full mt-1"
                                :value="old('name', $car->license)" required autofocus autocomplete="license" />
                            <x-input-error class="mt-2" :messages="$errors->get('license')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="price" :value="__('Harga')" />
                            <x-text-input id="price" name="price" type="text" class="block w-full mt-1"
                                :value="old('name', $car->price)" required autofocus autocomplete="price" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('car.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>