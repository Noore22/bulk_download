<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-4">
                        <a href="{{ route('export.users.csv') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-2xl shadow-md">
                            ⬇️ Download Users CSV
                        </a>                                                                                                          
                    </div>                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
