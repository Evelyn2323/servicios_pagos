<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Formulario de edición solo para Servicio y Monto -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
            
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700">{{ __('Servicio') }}</label>
                        <input type="text" name="service" id="service" value="{{ old('service', auth()->user()->service) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            required>
                    </div>
            
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">{{ __('Monto') }}</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount', auth()->user()->amount) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            required min="0" step="any">
                    </div>
            
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">{{ __('Actualizar Servicio') }}</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>
