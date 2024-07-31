<x-app-layout>

    <div class="my-2 container p-16 mx-auto">
        @if(session('update'))
                <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('update') }}
                    </div>
                    
                </div>  
        @endif
                    
        <h3 class="font-medium text-2xl my-4">Ventas por usuarios</h3>

        <div class="overflow-x-auto my-8 shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-white border-b" id="{{$user->id}}">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap name">
                                {{$user->name}}
                            </th>

                            <td class="px-6 py-4">
                                {{$user->age}}
                                
                            </td>


                            <td class="px-6 py-4">
                                {{$user->email}}
                                
                            </td>

                         

                            <td class="px-6 py-4">
                                <a href="{{ route('purchase.history-id', ['id' => $user->id]) }}" class="mx-2 font-bold text-blue-500 hover:underline">Ver reporte</a>
                            </td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
        <div class="my-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>