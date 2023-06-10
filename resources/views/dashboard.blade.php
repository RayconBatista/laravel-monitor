<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"> --}}
                <div class="flex justify-between">
                    <div class="overflow-hidden bg-white rounded shadow-lg max-w dark:bg-gray-800">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold text-white">Total de sites</div>
                            <p class="text-2xl text-gray-700 dark:text-gray-300">{{ $sites }}</p>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-white rounded shadow-lg max-w dark:bg-gray-800">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold text-white">Sites Online</div>
                            <p class="text-2xl text-gray-700 dark:text-gray-300">
                                {{ $online }}
                            </p>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-white rounded shadow-lg max-w dark:bg-gray-800">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold text-white">Site Offline</div>
                            <p class="text-2xl text-gray-700 dark:text-gray-300"> {{ $offline }}</p>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-white rounded shadow-lg max-w dark:bg-gray-800">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold text-white">Total de Usuários</div>
                            <p class="text-2xl text-gray-700 dark:text-gray-300">500</p>
                        </div>
                    </div>
                </div>
                
                
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
