<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Daftar Mobil') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('category.create') }}" />
                        </div>
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Mobil
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Brand
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipe Mobil
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Plat Nomor
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Harga Sewa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 ">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('category.edit', $category) }}" class="hover:underline">
                                            {{ $car->name }}
                                        </a>
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <p class="hover:underline">
                                            {{ $car->brand }}
                                        </p>
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <p class="hover:underline">
                                            {{ $car->type }}
                                        </p>
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <p class="hover:underline">
                                            {{ $car->license }}
                                        </p>
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <p class="hover:underline">
                                            {{ $car->price }}
                                        </p>
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <p class="hover:underline">
                                            {{ $car->status }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <form action="{{ route('category.destroy', $category) }}" method="Post">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="text-green-600 dark:text-green-400">
                                                    <a href="{{ route('category.edit', $category) }}"
                                                        class="hover:underline">
                                                        Edit
                                                    </a>
                                                </button>
                                                <form action="{{ route('category.destroy', $category) }}" method="Post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400" style="padding-left: 10px">
                                                        Delete
                                                    </button>
                                                </form>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
