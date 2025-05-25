<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Videos
        </h2>
    </x-slot>
    <div class="container mx-auto py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <ul id="videos-list">
                @foreach ($videos as $video)
                    <li class="video-item col-md-4 pull-left">
                        @if ($video->image != '')
                            <div class="video-iamge-thumb">
                                <div class="vol-md-6 col-md-offset">
                                    <img src="{{ url('storage/'.$product->image) }}" alt="" class="img-thumbnail" width="40px">
                                    <img src="{{ url('/miniatura/'. $video->image) }}" alt="">
                                </div>
                            </div>
                        @else
                            <div class="video-iamge-thumb">
                                <div class="vol-md-6 col-md-offset">
                                    <img src="{{ url('storage/images/default.png') }}" alt="" class="img-thumbnail" width="40px">
                                </div>
                            </div>
                        @endif
                        
                        <div class="data">
                            <h4>{{ $video->title }}</h4>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>