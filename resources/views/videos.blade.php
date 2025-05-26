

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="w-full lg:max-w-4xl max-w-[335px] space-y-6">
            @forelse ($videos as $video)
                <div class="border rounded-lg overflow-hidden shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <!-- Imagen del Video -->
                    <div class="relative aspect-video bg-gray-100 dark:bg-gray-700">
                        @if($video->image)
                            <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/'.$video->image) }}" alt="{{ $video->title }}" loading="lazy">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
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
                            <a href="{{ url('video', $video->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Ver Video
                            </a>
                            
                            @if(auth()->id() == $video->user_id)
                            <div class="flex space-x-2">
                                <a href="#" class="inline-flex items-center px-3 py-1 border border-yellow-300 dark:border-yellow-600 rounded-md text-xs font-medium text-yellow-700 dark:text-yellow-400 bg-yellow-50 dark:bg-gray-800 hover:bg-yellow-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('delete.video', $video) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-300 dark:border-red-600 rounded-md text-xs font-medium text-red-700 dark:text-red-400 bg-red-50 dark:bg-gray-800 hover:bg-red-100 dark:hover:bg-gray-700 transition-colors">
                                        Eliminar
                                    </button>
                                </form>
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
                    @guest
                        <div class="mt-6">
                            <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                Regístrate para subir videos
                            </a>
                        </div>
                    @endguest
                </div>
            @endforelse
            <div class="mt-6 flex justify-center">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
    
