<div>
    <x-app-layout>
        <x-slot name="header">
        <h2 class="text-base/15 font-bold text-xl text-gray-900 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h2>
        <a type="button" href="{{ url('users/create') }}" class="btn btn-primary p-2 btn-sm absolute right-10  py-2 px-4 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none 
        focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Nuevo Usuario</a>
        </x-slot>
            <div class="absolute inset-x-40 top-500 block overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-900">
                    <thead class="text-xs text-gray-900 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 text-center py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 text-center py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 text-center py-3">
                                E-mail
                            </th>
                            <th scope="col" class="px-6 text-center py-3">
                                Acción
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-2 dark:border-gray-700 text-gray-50">
                                <th scope="row"
                                    class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->id }}
                                </th>
                                <td class="px-6 text-center py-4">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 text-center py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <!--
                                        <a href="{{route('users.edit', $user)}}" type="button" class="p-2 m-1 btn btn-succes btn-sm py-2 text-sm font-medium  text-white bg-green-600 rounded-lg
                                        hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Editar</a>
                                    --> 
                                    <button wire:click="delete({{$user->id}})" wire:confirm="Seguro???" type="button">eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-body">
                    {{ $users->links() }}
                </div>
            </div>
    </x-app-layout>
</div>
