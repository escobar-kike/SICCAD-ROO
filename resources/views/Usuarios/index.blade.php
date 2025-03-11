<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200">Usuarios</h2>
            <x-utilities.nav-button href="{{route('users.create')}}">Nuevo Usuario</x-utilities.nav-button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <livewire:tables.user-table>
            </div>
        </div>
    </div>
</x-app-layout> 