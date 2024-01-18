<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Modifier la voiture
            </h2>

            <a href="{{ route('cars.index') }}" class="dark:text-white px-4 py-2 focus:outline rounded-lg bg-blue-900">
                {{ __('Revenir à l\'accueil') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('cars.update', $car) }}" method="post">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div>
                        <x-label for="name" value="{{ __('Nom de la voiture') }}" />
                        <input id="name"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            type="text" name="name" required autofocus autocomplete="name" value="{{ $car->name }}" />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="description" value="{{ __('Description de la voiture') }}" />
                        <input id="description"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            type="text" name="description" required autofocus autocomplete="description"
                            value="{{ $car->description }}" />
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="price" value="{{ __('Prix de la location de la voiture') }}" />
                        <input id="price"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            type="number" name="price" required autofocus autocomplete="price"
                            value="{{ $car->price }}" />
                        <x-input-error for="price" class="mt-2" />
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <button type="submit" class="bg-white p-2 rounded-lg ms-4 my-6">
                        {{ __('Modifier la voiture') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>