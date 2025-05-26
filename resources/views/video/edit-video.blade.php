<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <form action="{{ route('update.video', $video) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method($method)

                <div class="space-y-6">
                    <!-- Título -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título del Video</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               required>
                        <x-input-error :messages="$errors->get('title')" class="mt-1"/>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('description', $video->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1"/>
                    </div>

                    <!-- Miniatura -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Miniatura</label>
                        
                        @if($video->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $video->image) }}" alt="Miniatura actual" class="h-32 rounded-lg mb-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Miniatura actual</p>
                            </div>
                        @endif
                        
                        <input type="file" name="image" id="image"
                               class="block w-full text-sm text-gray-500 dark:text-gray-400
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 dark:file:bg-gray-600 dark:file:text-gray-200
                                      hover:file:bg-blue-100 dark:hover:file:bg-gray-500">
                        <x-input-error :messages="$errors->get('image')" class="mt-1"/>
                    </div>

                    <!-- Archivo de Video -->
                    <div>
                        <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Archivo de Video</label>
                        
                        @if($video->video_path)
                            <div class="mb-3">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Video actual: {{ basename($video->video_path) }}</p>
                            </div>
                        @endif
                        
                        <input type="file" name="video" id="video" {{ !$video->exists ? 'required' : '' }}
                               class="block w-full text-sm text-gray-500 dark:text-gray-400
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 dark:file:bg-gray-600 dark:file:text-gray-200
                                      hover:file:bg-blue-100 dark:hover:file:bg-gray-500">
                        <x-input-error :messages="$errors->get('video')" class="mt-1"/>
                    </div>

                    <!-- Botón de envío -->
                    <div class="pt-4">
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 ease-in-out transform hover:scale-[1.01]">
                            {{ $video->exists ? 'Actualizar Video' : 'Crear Video' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>