<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                @auth
                    <div
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 3000)"
                        x-show="show"
                        x-transition
                        x-transition:enter="transition ease-in duration-500"
                        x-transition:leave="transition ease-out duration-500"
                        class="fixed top-5 left-1/2 -translate-x-1/2 z-50 bg-emerald-600 text-white px-4 py-3 rounded-lg shadow-lg"
                    >
                        Welcome, {{ auth()->user()->name }}!
                    </div>
                @endauth
                <x-posts.table :posts="$posts"/>
            </div>
        </div>
    </div>
</x-app-layout>
