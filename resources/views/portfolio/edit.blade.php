@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Modifier le Portfolio</h2>

    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="fullName" class="form-control" value="{{ $portfolio->fullName }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Titre du projet</label>
            <input type="text" name="project_title" class="form-control" value="{{ $portfolio->project_title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $portfolio->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" class="form-control" value="{{ $portfolio->tags }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Source du projet</label>
            <input type="text" name="source_link" class="form-control" value="{{ $portfolio->source_link }}">
        </div>

        <div class="mb-3">
            <label>Image actuelle</label><br>
            @if($portfolio->image_url)
                <img src="{{ asset('storage/'.$portfolio->image_url) }}" width="150">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Changer l’image</label>
            <input type="file" name="image_url" class="form-control">
        </div>

        <button class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
