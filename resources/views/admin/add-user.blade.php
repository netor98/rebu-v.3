<x-app-layout>

    <div class="my-14 container p-16 mx-auto ">
        <h3 class="font-medium text-2xl my-4">@if (isset($edit->id)) {{ 'Edición de usuario' }} @else {{'Creación de usuario'}}@endif</h3>


        <form action="@if (isset($edit->id)) {{ route('user.update', ['id' => $edit->id]) }}@else{{ route('user.add') }} @endif" method="POST" class="bg-gray-200 p-5 shadow-xl rounded-lg" novalidate enctype="multipart/form-data">
            @csrf

            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-md text-center text-sm p-2">
                    {{session('mensaje')}}
                </p>
            @endif

        
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-black font-bold">
                    Nombre
                </label>
                <input 
                    id="name"
                    name="name" 
                    type="text" 
                    class="border p-3 w-full rounded-xl
                    @error('name')
                        border-red-500    
                    @enderror"
                    placeholder="Nombre"
                    value="@if (isset($edit->id)) {{ $edit->name }}@endif">
                    
                    
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-md text-center text-sm p-2">
                            {{$message}}
                        </p>
                    @enderror
            </div>

            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-black font-bold">
                    Usuario
                </label>
                <input 
                    id="username"
                    name="username" 
                    type="text" 
                    class="border p-3 w-full rounded-xl
                    @error('username')
                        border-red-500    
                    @enderror"
                    placeholder="Usuario"
                    value="@if (isset($edit->id)) {{ $edit->username }}@endif">
                    
                    
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-md text-center text-sm p-2">
                            {{$message}}
                        </p>
                    @enderror
            </div>

            <div class="mb-5">
                <label for="age" class="mb-2 block uppercase text-black font-bold">
                    Edad
                </label>
                <input 
                    id="age"
                    name="age" 
                    type="text" 
                    class="border p-3 w-full rounded-xl
                    @error('age')
                        border-red-500    
                    @enderror"
                    placeholder="Ej: 5"
                    value="@if (isset($edit->id)) {{ $edit->age  }}@endif">

                    @error('age')
                        <p class="bg-red-500 text-white my-2 rounded-md text-center text-sm p-2">
                            {{$message}}
                        </p>
                    @enderror
            </div>


            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-black font-bold">
                    Password
                </label>
                <input 
                    id="password"
                    name="password" 
                    type="text" 
                    class="border p-3 w-full rounded-xl
                    @error('age')
                        border-red-500    
                    @enderror"
                    placeholder="Tu password"
                    value="@if (isset($edit->id)) {{ $edit->password  }}@endif">

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md text-center text-sm p-2">
                            {{$message}}
                        </p>
                    @enderror

            </div>

            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-black font-bold">
                    Email
                </label>
                <input 
                    id="email"
                    name="email" 
                    type="email" 
                    class="border p-3 w-full rounded-xl
                    @error('price')
                        border-red-500    
                    @enderror"
                    placeholder="Ej: ejemplo@gmail.com"
                    value="@if (isset($edit->id)) {{ $edit->email }}@endif"> 

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-md text-center text-sm p-2">
                            {{$message}}
                        </p>
                    @enderror
            </div>


            <div class="mb-5">
                
            <input type="submit"
            class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase w-full p-2 rounded-lg text-white font-bold"
            value="@if (isset($edit->id)) Editar usuario @else Crear usuario @endif">
        </form>
  
    </div>
</x-app-layout>