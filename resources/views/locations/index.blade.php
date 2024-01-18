<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Liste des locations
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($locations as $loc)
                <div class="p-4 border-b text-white">
                    <div class="flex flex-wrap justify-between">
                        <div class="flex flex-wrap">
                            <div class="my-auto">
                                {{$loc->car->name}} :
                            </div>
                            <div class="my-auto mx-2">
                                {{$loc->price}}
                            </div>
                        </div>
                        @auth
                        <div class="flex">
                            <form method="POST" action="{{ route('location.destroy', $loc) }}"
                                class="dark:text-white mx-2 px-4 py-2 focus:outline rounded-lg bg-blue-900" x-data>
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button>
                                    {{ __('Terminer la location') }}
                                </button>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
                @endforeach
                <div class="w-full p-1">
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>