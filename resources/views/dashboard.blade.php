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
                        <a href="{{ route('export-mi-report') }}" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black font-semibold rounded-2xl shadow-lg transition duration-300 ease-in-out">
                            ⬇️ Download mi_reports CSV
                        </a>                                                                                    
                    </div>                                     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
