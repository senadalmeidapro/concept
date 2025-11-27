@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un Portfolio</h2>

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="fullName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Titre du projet</label>
            <input type="text" name="project_title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" class="form-control" placeholder="ex: web, mobile, design">
        </div>

        <div class="mb-3">
            <label class="form-label">Source du projet (lien)</label>
            <input type="text" name="source_link" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image_url" class="form-control">
        </div>

        <button class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
