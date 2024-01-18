<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Nouvelle location
            </h2>

            <a href="{{ route('cars.index') }}" class="dark:text-white px-4 py-2 focus:outline rounded-lg bg-blue-900">
                {{ __('Revenir à l\'accueil') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:text-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('location.store') }}" method="post">
                    {{ csrf_field() }}

                    <div>
                        Nom de la voiture : {{ $car->name }}
                    </div>

                    <div>
                        Description de la voiture : {{ $car->description }}
                    </div>

                    <div>
                        Prix par mois de la voiture : {{ $car->price }} FCFA
                    </div>

                    <div class="my-4">
                        <x-label for="date" value="{{ __('Durée de la location en mois') }}" />
                        <input id="date"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            type="number" name="date" required autofocus autocomplete="date" />
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <input type="hidden" name="car_id" value="{{ $car->id }}">

                    <button type="submit" class="bg-white p-2 dark:text-black rounded-lg ms-4 my-6">
                        {{ __('Louer la voiture') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>