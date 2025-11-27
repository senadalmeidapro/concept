@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Ajouter un projet</h3>
        </div>

        <div class="card-body">
            <!-- Affichage des erreurs -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire -->
            <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Titre -->
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre du projet</label>
                    <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
                </div>

                <!-- Description / Texte -->
                <div class="mb-3">
                    <label for="texte" class="form-label">Description</label>
                    <textarea name="texte" id="texte" rows="5" class="form-control" required>{{ old('texte') }}</textarea>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image du projet</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>

                <!-- Catégorie -->
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select name="categorie" id="categorie" class="form-control" required>
                        <option value="">-- Choisir une catégorie --</option>
                        <option value="web">Développement Web</option>
                        <option value="mobile">Application Mobile</option>
                        <option value="design">Design</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <!-- Bouton -->
                <button type="submit" class="btn btn-success">Enregistrer le projet</button>
                <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
