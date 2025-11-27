@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un Portfolio</h2>

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Texte</label>
            <textarea name="texte" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <input type="text" name="categorie" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
