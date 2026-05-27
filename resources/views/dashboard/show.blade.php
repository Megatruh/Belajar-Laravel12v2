<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col bg-white overflow-hidden shadow-xs sm:rounded-lg">
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
                <x-posts.preview :post="$post"/>
                <div class="flex justify-center mb-4">
                    <a href="/dashboard"
                        class="inline-flex items-center font-xs text-blue-600 dark:text-primary-500 hover:underline"
                    >
                        &laquo; Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
