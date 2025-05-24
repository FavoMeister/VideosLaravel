<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crear Video
        </h2>
    </x-slot>
    <div class="container mx-auto py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <hr>
            <form action="{{ route('saveVideo') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300">Título</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300">Descripción</label>
                    <textarea name="description" id="description" class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 dark:text-gray-300">Miniatura</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="video" class="block text-gray-700 dark:text-gray-300">Video</label>
                    <input type="file" name="video" id="video" class="mt-1 block w-full">
                    @error('video')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Crear Video
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
