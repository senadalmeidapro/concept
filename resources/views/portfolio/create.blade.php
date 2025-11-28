@extends('layout')

@section('title', 'Ajouter un Projet')

@section('content')
<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-plus me-2"></i>Ajouter un Projet</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('portfolio.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom complet *</label>
                            <input type="text" name="fullname" class="form-control" value="" required>
                            @error('fullname')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Titre du projet *</label>
                            <input type="text" name="title" class="form-control" value="" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description *</label>
                    <textarea name="description" class="form-control" rows="5" required></textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">URL de l'image</label>
                            <input type="url" name="image_url" class="form-control" value="" placeholder="https://example.com/image.jpg">
                            @error('image_url')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tags</label>
                            <input type="text" name="tags" class="form-control" value="" placeholder="web, design, mobile">
                            <div class="form-text">Séparez les tags par des virgules</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lien du projet</label>
                            <input type="url" name="project_link" class="form-control" value="" placeholder="https://example.com">
                            @error('project_link')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lien source</label>
                            <input type="url" name="source_link" class="form-control" value="" placeholder="https://github.com/example">
                            @error('source_link')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                    <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection