<x-app-layout>
    <x-slot name="header" class="fixed">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $car->name }}
            </h2>

            <a href="{{ route('cars.index') }}" class="dark:text-white px-4 py-2 focus:outline rounded-lg bg-blue-900">
                {{ __('Revenir à l\'accueil') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 flex-wrap flex justify-between text-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <img src="{{ $car->banner_image }}" alt="{{ $car->banner_image }}">
                </div>
                <div>
                    Prix de la location : {{ $car->price }}
                </div>
                <div>
                    <a href="{{ route('cars.index') }}"
                        class="dark:text-white mx-2 px-4 py-2 focus:outline rounded-lg bg-blue-900">
                        {{ __('Louer la voiture') }}
                    </a>
                    @auth
                    <a href="{{ route('cars.index') }}"
                        class="dark:text-white mx-2 px-4 py-2 focus:outline rounded-lg bg-blue-900">
                        {{ __('Modifier la voiture') }}
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 text-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                {{ $car->description }}
            </div>
        </div>
    </div>
</x-app-layout>