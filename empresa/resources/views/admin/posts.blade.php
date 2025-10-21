@extends('admin.layouts.main')

@section('contenido')
<div class="d-flex justify-content-between">
    <h1>Post</h1>
    <div>
        <a href="/dashboard/posts/actions/add" class="btn btn-dark">Agregar</a>
    </div>
</div>

<div class="row">
    @foreach ($posts as $post)
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('posts/' . $post->img) }}" alt="card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="#" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
