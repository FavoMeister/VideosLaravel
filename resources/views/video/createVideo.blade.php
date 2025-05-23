@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <hr>
        <form action="{{ route('saveVideo') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea type="text" name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Miniatura</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="video">Video</label>
                <input type="file" name="video" id="video" class="form-control">
            </div>

            <button class="btn btn-success" type="submit">Crear Video</button>
        </form>
    </div>
</div>

@endsection