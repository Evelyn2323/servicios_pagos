<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Perfil') }}
        </h2>
        
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            
            <!-- Botón para regresar al Dashboard -->
            <div class="mb-4">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    {{ __('Volver al Dashboard') }}
                </a>
            </div>
            
            <!-- Mostrar mensaje de éxito si existe -->
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Formulario de edición para el usuario -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
            
                <div class="grid grid-cols-1 gap-4">
                    
                    <!-- Campo para Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            required>
                    </div>

                    <!-- Campo para Correo Electrónico -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Correo Electrónico') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            required>
                    </div>

                    <!-- Campo para Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                        <input type="password" name="password" id="password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Confirmación de Contraseña -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
            
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">{{ __('Actualizar Perfil') }}</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>
