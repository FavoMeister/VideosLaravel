<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de Videos') }}
            </h2>
            <a href="{{ route('createVideo') }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nuevo Video
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid de Videos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($videos as $video)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-lg">
                    <!-- Imagen del Video -->
                    <div class="relative h-48 w-full">
                        @if($video->image)
                            <img class="absolute inset-0 w-full h-full object-contain" src="{{ asset('storage/'.$video->image) }}" alt="{{ $video->title }}">
                        @else
                            <div class="absolute h-full w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Contenido de la Card -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                            <a href="{{ url('video', [$video->id]) }}">{{ $video->title }}</a>
                        </h3>
                        
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <span class="font-medium">Autor:</span> {{ $video->user->name }} {{ $video->user->lastname }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Ver Video
                            </a>
                            
                            @if(auth()->id() == $video->user_id)
                            <div class="flex space-x-2">
                                <a href="#" class="inline-flex items-center px-3 py-1 border border-yellow-300 dark:border-yellow-600 rounded-md text-xs font-medium text-yellow-700 dark:text-yellow-400 bg-yellow-50 dark:bg-gray-800 hover:bg-yellow-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Editar
                                </a>
                                <a href="#" class="inline-flex items-center px-3 py-1 border border-red-300 dark:border-red-600 rounded-md text-xs font-medium text-red-700 dark:text-red-400 bg-red-50 dark:bg-gray-800 hover:bg-red-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Eliminar
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No hay videos disponibles</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Crea un nuevo video para comenzar</p>
                </div>
                @endforelse
            </div>

            <!-- Paginación (centrada) -->
            <div class="mt-8 px-4 sm:px-0">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>