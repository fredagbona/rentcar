<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Liste des utilisateurs ayant loués une voiture
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($users as $user)
                <div class=" p-4 border-b text-white">
                    <div class="flex flex-wrap justify-between">
                        <div class="my-auto">
                            {{$user->name}}
                        </div>
                        @auth
                        <div class="flex">
                            <a href="{{ route('listlocate', $user->id) }}"
                                class="dark:text-white mx-2 px-4 py-2 focus:outline rounded-lg bg-blue-900">
                                {{ __('Voir les voitures louées') }}
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
                @endforeach
                <div class="w-full p-1">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>