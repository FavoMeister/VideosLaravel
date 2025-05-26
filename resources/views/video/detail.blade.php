<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $video->title }}
            </h2>
            @if(auth()->id() == $video->user_id)
                <div class="flex space-x-2">
                    {{-- <a href="{{ route('videos.edit', $video) }}" class="inline-flex items-center px-3 py-1 border border-yellow-300 dark:border-yellow-600 rounded-md text-xs font-medium text-yellow-700 dark:text-yellow-400 bg-yellow-50 dark:bg-gray-800 hover:bg-yellow-100 dark:hover:bg-gray-700 transition-colors">
                        Editar
                    </a> --}}
                    <form method="POST" action="{{ route('delete.video', $video) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-300 dark:border-red-600 rounded-md text-xs font-medium text-red-700 dark:text-red-400 bg-red-50 dark:bg-gray-800 hover:bg-red-100 dark:hover:bg-gray-700 transition-colors">
                            Eliminar Video
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Card del Video -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <!-- Reproductor de Video -->
                <div class="w-full aspect-video bg-black">
                    <video controls class="w-full h-full">
                        <source src="{{ asset('storage/'.$video->video_path) }}" type="video/mp4">
                        Tu navegador no soporta el elemento de video.
                    </video>
                </div>
                
                <!-- Información del Video -->
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $video->title }}</h1>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Subido por: {{ $video->user->name . ' ' . $video->user->surname}}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $video->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-500 dark:text-gray-400">{{ $video->views }} vistas</span>
                        </div>
                    </div>
                    
                    <div class="prose dark:prose-invert max-w-none mt-4">
                        <p class="text-gray-700 dark:text-gray-300">{{ $video->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Sección de Comentarios -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Comentarios ({{ $video->comments->count() }})</h3>
                    
                    <!-- Formulario para nuevo comentario -->
                    @auth
                    <form method="POST" action="{{ route('comment', $video) }}" class="mb-6">
                        @csrf
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                @if(auth()->user()->profile_photo_path)
                                    <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <textarea name="content" rows="2" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Añade un comentario..." required></textarea>
                                <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 dark:bg-indigo-700 text-white rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors">
                                    Comentar
                                </button>
                            </div>
                        </div>
                    </form>
                    @endauth
                    
                    <!-- Lista de Comentarios -->
                    <div class="space-y-6">
                        @forelse ($video->commentsOrdered as $comment)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    @if(auth()->user()->profile_photo_path)
                                        <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            @if(auth()->id() == $comment->user_id)
                                                <form method="POST" action="{{ route('deleteComment', $comment) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 dark:hover:text-red-400 text-sm">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->body }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">No hay comentarios aún. ¡Sé el primero en comentar!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>