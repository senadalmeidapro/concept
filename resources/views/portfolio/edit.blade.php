@extends('layout')

@section('title', 'Modifier le Projet')

@section('content')
<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-edit me-2"></i>Modifier le Projet</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom complet *</label>
                            <input type="text" name="fullname" class="form-control" value="{{ old('fullname', $portfolio->fullname) }}" required>
                            @error('fullname')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Titre du projet *</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description *</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $portfolio->description) }}</textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">URL de l'image</label>
                            <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $portfolio->image_url) }}">
                            @error('image_url')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tags</label>
                            <input type="text" name="tags" class="form-control" value="{{ old('tags', $portfolio->tags) }}">
                            <div class="form-text">Séparez les tags par des virgules</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lien du projet</label>
                            <input type="url" name="project_link" class="form-control" value="{{ old('project_link', $portfolio->project_link) }}">
                            @error('project_link')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lien source</label>
                            <input type="url" name="source_link" class="form-control" value="{{ old('source_link', $portfolio->source_link) }}">
                            @error('source_link')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                @if($portfolio->image_url)
                <div class="mb-3">
                    <label class="form-label fw-bold">Image actuelle</label>
                    <div>
                        <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="portfolio-image" style="max-width: 200px;">
                    </div>
                </div>
                @endif

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Modifier
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