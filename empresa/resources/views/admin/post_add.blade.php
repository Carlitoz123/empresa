@extends('admin.layouts.main')
@section('contenido')

    <h1>Agregar Posts</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">

    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>

    </div>
    @endif

    <form action="/dashboard/posts" method="POST" id="form" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input value="{{ old('title') }}" name="title" type="text" class="form-control" id="title">

        </div>

        <div class="form-group">
        <label for="description">Description</label>
        <input value="{{ old('description') }}" name="description" type="text" class="form-control" id="description">

        </div>

        <div class="form-group">
        <label for="file">Img</label>
        <input name="image" type="file" class="form-control" id="file">

        </div>
        <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
        @foreach($categories as $cate)
        <option value="{{$cate->id}}">{{$cate->name}}</option>
        @endforeach
        </select>
        </div>
        <input type="hidden" name="content" id="content">
        <div id="editor">
            <p>Hello Word</p>
            <p>Some Initial <strong>bold</strong> text</p>
            
        </div>
        <div class="form-group">
            <button class="btn btn-primary">insertar</button>
        </div>


    </form>

    

@endsection
@section("scripts")
<script>

const quill = new Quill('#editor', {
    theme: 'snow'
  });

  const form = document.querySelector('#form');
  form.onsubmit = function() {
    // Copiar el contenido HTML de Quill al input oculto
    const contentInput = document.querySelector('input[name=content]');
    contentInput.value = quill.root.innerHTML;
  };
</script>


@endsection