<x-app-layout>


    <div class="max-w-6xl mx-auto my-10">
        @if(session('success'))
            <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
            </div>  
        @endif

        @if(session('read'))
            <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('read') }}
                </div>
            </div>  
        @endif
        <h2 class="text-2xl font-semibold mb-6">Mensajes de Contacto</h2>
    
        <div class="mb-4">
            <button id="readBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Leídos</button>
            <button id="unreadBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">No Leídos</button>
        </div>
    
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mensaje
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                            Acciones
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Responder
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($messages as $message)
                    <tr class="{{ $message->is_read ? 'read' : 'unread' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $message->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $message->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $message->message }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="{{ $message->is_read ? 'text-green-500' : 'text-red-500' }}">
                                {{ $message->is_read ? 'Leído' : 'No leído' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-col justify-center items-center">
                            @if (!$message->is_read)
                            <form method="post" action="/admin/messages/{{ $message->id }}/read" class="inline">
                                @csrf
                                @method('patch')
                                <button type="submit" class="text-indigo-600 hover:text-indigo-900">Marcar como leído</button>
                            </form>
                            @endif
                            <form method="post" action="/admin/messages/{{ $message->id }}" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('admin.messages.respond', $message->id) }}" method="POST">
                                @csrf
                                <textarea name="response" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Escribe una respuesta..."></textarea>
                                <button type="submit" class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Enviar Respuesta
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-4">
            {{ $messages->links() }}
        </div>
    </div>
    
    <script>
        document.getElementById('unreadBtn').addEventListener('click', function() {
            document.querySelectorAll('.read').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.unread').forEach(el => el.style.display = 'table-row');
        });
    
        document.getElementById('readBtn').addEventListener('click', function() {
            document.querySelectorAll('.unread').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.read').forEach(el => el.style.display = 'table-row');
        });
    </script>
    
    
    
</x-app-layout>